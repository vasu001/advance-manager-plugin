<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Testimonials
	 * @package Inc\Base
	 */
	class Testimonials extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'testimonial_manager' ) ) {
				return;
			}

			$this->settings        = new SettingsApi();
			$this->admin_callbacks = new AdminCallbacks();

			$this->setCptSubpage();

			$this->settings->register();

		}

		public function setCptSubpage() {
			$args = [
				[
					'parent_slug' => 'amp_admin_dashboard',
					'page_title'  => 'Testimonials Manager',
					'menu_title'  => 'Testimonials Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_testimonials',
					'callback'    => [ $this->admin_callbacks, 'getTestimonial' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}