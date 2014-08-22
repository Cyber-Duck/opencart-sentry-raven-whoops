opencart-sentry-raven-whoops
============================

Integrates the [Raven Sentry](https://github.com/getsentry/raven-php) client to report errors on the live environment and adds [Whoops](http://filp.github.io/whoops/) error handling for development and test environments.

# Installation

Copy the contents of the upload directory into your OpenCart directory.

# Configuration

1. Modify the vqmod script to include your sentry DSN
2. Make sure you add `define('ENVIROMENT', 'LIVE');` in your live config.php