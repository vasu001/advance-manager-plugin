<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class MediaWidget
	 * @package Inc\Base
	 */
	class MediaWidget extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'media_widget' ) ) {
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
					'page_title'  => 'Media Widget Manager',
					'menu_title'  => 'Widget Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_media_widget',
					'callback'    => [ $this->admin_callbacks, 'getWidget' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}