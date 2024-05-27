<?php
/*
Plugin Name: Mailster RePermission
Plugin URI: https://mailster.co/?utm_campaign=wporg&utm_source=wordpress.org&utm_medium=plugin&utm_term=Re-Permission
Description: Helps to setup your Re-Permission Campaign for GDPR compliance in Mailster.
Version: 1.7.1
Author: EverPress
Author URI: https://mailster.co
Text Domain: mailster-repermission
License: GPLv2 or later
*/


define( 'MAILSTER_REPERMISSION_VERSION', '1.7.1' );
define( 'MAILSTER_REPERMISSION_REQUIRED_VERSION', '2.4' );
define( 'MAILSTER_REPERMISSION_FILE', __FILE__ );

require_once __DIR__ . '/classes/repermission.class.php';
new MailsterRePermission();
