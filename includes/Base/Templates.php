<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Templates
	 * @package Inc\Base
	 */
	class Templates extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'templates_manager' ) ) {
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
					'page_title'  => 'Templates Manager',
					'menu_title'  => 'Templates Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_templates',
					'callback'    => [ $this->admin_callbacks, 'getTemplates' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}