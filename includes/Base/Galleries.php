<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Galleries
	 * @package Inc\Base
	 */
	class Galleries extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'gallery_manager' ) ) {
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
					'page_title'  => 'Galleries Manager',
					'menu_title'  => 'Galleries',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_gallery',
					'callback'    => [ $this->admin_callbacks, 'getGallery' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}