<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Chat
	 * @package Inc\Base
	 */
	class Chat extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'chat_manager' ) ) {
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
					'page_title'  => 'Chat Manager',
					'menu_title'  => 'Chat Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_chat',
					'callback'    => [ $this->admin_callbacks, 'getChat' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}