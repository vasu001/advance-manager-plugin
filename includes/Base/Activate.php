<?php


	namespace Inc\Base;

	/**
	 * Class Activate
	 * @package Inc\Base
	 */
	class Activate {
		public static function activate() {
			flush_rewrite_rules();

			$default = [];

			if ( ! get_option( 'amp_manager' ) ) {
				update_option( 'amp_manager', $default );
			}

			if ( ! get_option( 'amp_manager_cpt' ) ) {
				update_option( 'amp_manager_cpt', $default );
			}
		}
	}