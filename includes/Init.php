<?php

	namespace Inc;

	use Inc\Base\AJAX;
	use Inc\Base\Chat;
	use Inc\Base\CustomPostType;
	use Inc\Base\Enqueue;
	use Inc\Base\Galleries;
	use Inc\Base\MediaWidget;
	use Inc\Base\Members;
	use Inc\Base\PluginLinks;
	use Inc\Base\Taxonomies;
	use Inc\Base\Templates;
	use Inc\Base\Testimonials;
	use Inc\Pages\Dashboard;

	/**
	 * Class Init
	 * @package Inc
	 */
	class Init {

		/**
		 * @return array of values containing required classes
		 */
		public static function get_service() {
			return [
				Dashboard::class,
				Enqueue::class,
				PluginLinks::class,
				CustomPostType::class,
				MediaWidget::class,
				Galleries::class,
				Testimonials::class,
				Templates::class,
				AJAX::class,
				Members::class,
				Chat::class,
				Taxonomies::class,
			];
		}


		/**
		 * @param $class $class from the services array
		 *
		 * @return mixed class instance of parameter class
		 */
		public static function instantiate_class( $class ) {
			return new $class;
		}


		/**
		 * Register the services by looping through,
		 * services and initialize them,
		 * then call the register method within if exists
		 */
		public static function register_services() {
			foreach ( self::get_service() as $class ) {
				$service = self::instantiate_class( $class );

				if ( method_exists( $service, 'register' ) ) {
					$service->register();
				}
			}
		}


	}