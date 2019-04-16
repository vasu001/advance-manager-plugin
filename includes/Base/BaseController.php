<?php


	namespace Inc\Base;

	/**
	 * Class BaseController
	 * @package Inc\Base
	 */
	class BaseController {

		public $plugin_path;
		public $plugin_url;
		public $plugin_name;

		public $managers = [];

		public function __construct() {

			$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
			$this->plugin_url  = plugin_dir_url( dirname( __FILE__, 2 ) );
			$this->plugin_name = plugin_basename( dirname( __FILE__, 3 ) ) . '/advanced-manager-plugin.php';

			$this->managers = [
				'cpt_manager'         => 'CPT Manager',
				'media_widget'        => 'Media Widget',
				'gallery_manager'     => 'Gallery Manager',
				'testimonial_manager' => 'Testimonial Manager',
				'templates_manager'   => 'Templates Manager',
				'ajax_manager'        => 'Login & Signup',
				'membership_manager'  => 'Membership Manager',
				'chat_manager'        => 'Chat Manager',
				'taxonomy_manager'    => 'Taxonomy Manager',
			];

		}

		public function isActivated( $key ) {
			$option = get_option( 'amp_manager' );

			return isset( $option[ $key ] ) ? $option[ $key ] : false;
		}

	}