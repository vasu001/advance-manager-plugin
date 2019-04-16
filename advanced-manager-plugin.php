<?php

	/*
	Plugin Name: Advanced Manager Plugin
	Plugin URI: https://github.com/vasu001/advanced-manager-plugin
	Description: A fully customized plugin manager
	Version: 1.0
	Author: Vasu Srivastava
	Author URI: https://github.com/vasu001
	License: GPL2+
	Text Domain: advanced-manager-plugin
	*/

	use Inc\Init;
	use Inc\Base\Activate;
	use Inc\Base\Deactivate;

	/**
	 * If attempt to access the advanced-manager-plugin.php directly, abort!
	 */
	defined( 'ABSPATH' ) or die( 'Unauthorized access detected! Aborting...' );


	/**
	 * Require once the Composer Autoload
	 */
	if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	}


	/*
	 * This code runs on plugin activation
	 */
	function activate() {
		Activate::activate();
	}

	register_activation_hook( __FILE__, 'activate' );

	/*
	 * This code runs on plugin deactivation
	 */
	function deactivate() {
		Deactivate::deactivate();
	}

	register_deactivation_hook( __FILE__, 'deactivate' );

	/**
	 * Register Services using Init Class
	 */

	if ( class_exists( 'Inc\\Init' ) ) {
		Init::register_services();
	}



