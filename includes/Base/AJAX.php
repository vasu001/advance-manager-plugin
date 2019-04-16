<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class AJAX
	 * @package Inc\Base
	 */
	class AJAX extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'ajax_manager' ) ) {
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
					'page_title'  => 'AJAX Manager',
					'menu_title'  => 'AJAX Login & Signup',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_ajax',
					'callback'    => [ $this->admin_callbacks, 'getAJAX' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}