<?php

if (!function_exists('error_handler')) {
	function error_handler($errno, $errstr, $errfile, $errline) {

		global $log, $config;

		// If this error is not in error reporting
		if (!(error_reporting() & $errno)) {
			return;
		}   

  		// Send the 500 error headers
  		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

  		// Clear any existing output buffers
  		while (ob_get_level() > 0) ob_end_clean();
  		
  		// Include custom error page
  		ob_start();
		require realpath(dirname(__FILE__))."/../../error.php";
		$buffer = ob_get_contents();
		ob_end_clean();

		echo $buffer;

		// Die to prevent messy pages
		exit(1);

	}
}

if (!function_exists('fatal_error_handler')) {
	function fatal_error_handler() {

		// If script dies check it was not an error. If it was trigger the error handler function
		$shutdown_errors = array(E_PARSE, E_ERROR, E_USER_ERROR, E_COMPILE_ERROR);
	   	$last_error = error_get_last();

        if ($last_error = error_get_last() AND in_array($last_error['type'], $shutdown_errors)) {
            error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
            exit(1);
        }
	}
}

// Handlers for errors and script shutdown
set_error_handler('error_handler');
register_shutdown_function('fatal_error_handler');