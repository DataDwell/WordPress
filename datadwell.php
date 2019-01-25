<?php
/*
 * Plugin Name: Data Dwell
 * Version: 1.0.2
 * Plugin URI: https://www.datadwell.com/
 * Description: Connector plugin with Data Dwell to enable connection with other WordPress plugins
 * Author: Data Dwell Ltd.
 * Author URI: https://www.datadwell.com/
 * Requires at least: 4.0
 * Tested up to: 5.0.3
 *
 * Text Domain: datadwell
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Data Dwell
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

require_once 'includes/class.datadwell.php';
require_once 'includes/class.datadwell.admin.php';

/**
 * Returns the singleton instance of DataDwell.
 *
 * @return object DataDwell
 */
function DataDwell() {
	$instance = DataDwell::instance( __FILE__ );
	return $instance;
}

/**
 * Returns the singleton instance of DataDwellAdmin.
 *
 * @return object DataDwellAdmin
 */
function DataDwellAdmin() {
	$instance = DataDwellAdmin::instance( __FILE__ );
	return $instance;
}

DataDwell();
DataDwellAdmin();