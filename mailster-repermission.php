<?php
/*
Plugin Name: Mailster RePermission
Plugin URI: https://mailster.co/?utm_campaign=wporg&utm_source=Mailster+Re-Permission+Integration
Description: Helps to setup your Re-Permission Campaign for GDPR compliance in Mailster.
Version: 1.2
Author: EverPress
Author URI: https://mailster.co
Text Domain: mailster-repermission
License: GPLv2 or later
*/


define( 'MAILSTER_REPERMISSION_VERSION', '1.2' );
define( 'MAILSTER_REPERMISSION_REQUIRED_VERSION', '2.3' );
define( 'MAILSTER_REPERMISSION_FILE', __FILE__ );

require_once dirname( __FILE__ ) . '/classes/repermission.class.php';
new MailsterRePermission();
