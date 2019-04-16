<?php


	namespace Inc\Pages;

	use Inc\Api\Callbacks\ManagerCallbacks;
	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;
	use Inc\Base\BaseController;

	/**
	 * Class Dashboard
	 * @package Inc\Pages
	 */
	class Dashboard extends BaseController {

		public $settings;
		public $admin_callbacks;
		public $manager_callbacks;
		public $admin_pages = [];

		public function register() {

			$this->settings          = new SettingsApi();
			$this->admin_callbacks   = new AdminCallbacks();
			$this->manager_callbacks = new ManagerCallbacks();

			$this->setAdminPages();

			$this->setSettings();
			$this->setSections();
			$this->setFields();

			$this->settings->setAdminPages( $this->admin_pages )->withSubpage( 'Dashboard' )->register();

		}

		public function setAdminPages() {
			$this->admin_pages = [
				[
					'page_title' => 'Advanced Manager Plugin',
					'menu_title' => 'AMP',
					'capability' => 'manage_options',
					'menu_slug'  => 'amp_admin_dashboard',
					'callback'   => [ $this->admin_callbacks, 'getDashboard' ],
					'icon_url'   => 'dashicons-admin-generic',
					'position'   => 110,
				],
			];
		}

		public function setSettings() {
			$args = [
				[
					'option_group' => 'amp_manager_group',
					'option_name'  => 'amp_manager',
					'callback'     => [ $this->manager_callbacks, 'managerSanitize' ],
				],
			];

			$this->settings->setSettings( $args );
		}

		public function setSections() {
			$args = [
				[
					'id'       => 'amp_admin_dashboard_index',
					'title'    => 'Advanced Manager Settings',
					'callback' => [ $this->manager_callbacks, 'dashboardSectionManager' ],
					'page'     => 'amp_admin_dashboard',
				],
			];

			$this->settings->setSections( $args );
		}

		public function setFields() {
			$args = [];

			foreach ( $this->managers as $manager => $name ) {
				$args[] = [
					'id'       => $manager,
					'title'    => $name,
					'callback' => [ $this->manager_callbacks, 'dashboardCheckboxFields' ],
					'page'     => 'amp_admin_dashboard',
					'section'  => 'amp_admin_dashboard_index',
					'args'     => [
						'option_name' => 'amp_manager',
						'class'       => 'ui-toggle',
						'label_for'   => $manager,
					],
				];
			}
			$this->settings->setFields( $args );
		}
	}



	//	public function setAdminSubpages() {
	//		$this->admin_subpages = [
	//			[
	//				'parent_slug' => 'amp_admin_dashboard',
	//				'page_title'  => 'Custom Post Type Manager',
	//				'menu_title'  => 'CPT Manager',
	//				'capability'  => 'manage_options',
	//				'menu_slug'   => 'amp_admin_cpt',
	//				'callback'    => [ $this->admin_callbacks, 'getCPT' ],
	//			],
	//			[
	//				'parent_slug' => 'amp_admin_dashboard',
	//				'page_title'  => 'Media Widget Manager',
	//				'menu_title'  => 'Widget Manager',
	//				'capability'  => 'manage_options',
	//				'menu_slug'   => 'amp_admin_widget',
	//				'callback'    => [ $this->admin_callbacks, 'getWidget' ],
	//			],
	//			[
	//				'parent_slug' => 'amp_admin_dashboard',
	//				'page_title'  => 'Templates Manager',
	//				'menu_title'  => 'Templates Manager',
	//				'capability'  => 'manage_options',
	//				'menu_slug'   => 'amp_admin_template',
	//				'callback'    => [ $this->admin_callbacks, 'getTemplates' ],
	//			],
	//		];
	//	}