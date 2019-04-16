<?php


	namespace Inc\Base;

	/**
	 * Class Enqueue
	 * @package Inc\Base
	 */
	class Enqueue extends BaseController {

		/**
		 * Register Admin Side Scripting and Stylesheet
		 */
		public function register() {

			add_action( 'admin_enqueue_scripts', [ $this, 'amp_enqueue' ] );

		}

		/**
		 * Function to register custom script and styles
		 */
		public function amp_enqueue() {

			wp_enqueue_script( 'amp_admin_script', $this->plugin_url . '/assets/js/advanced-manager-plugin-bundle-script.js', [],
				microtime(), true );

//			wp_enqueue_script( 'amp_admin_code_pretty', '//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js' );

//			wp_enqueue_style( 'amp_admin_bootstrap_4.3.1', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );

			wp_enqueue_style( 'amp_admin_style', $this->plugin_url . '/assets/css/advanced-manager-plugin-style.css', [], microtime(), 'all' );

		}

	}