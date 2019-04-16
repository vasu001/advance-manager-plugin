<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Members
	 * @package Inc\Base
	 */
	class Members extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'membership_manager' ) ) {
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
					'page_title'  => 'Membership Manager',
					'menu_title'  => 'Members Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_members',
					'callback'    => [ $this->admin_callbacks, 'getMember' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}