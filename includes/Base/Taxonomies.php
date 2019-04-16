<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class Taxonomies
	 * @package Inc\Base
	 */
	class Taxonomies extends BaseController {

		public $admin_callbacks;
		public $settings;

		public function register() {

			if ( ! $this->isActivated( 'taxonomy_manager' ) ) {
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
					'page_title'  => 'Taxonomy Manager',
					'menu_title'  => 'Taxonomy',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_taxonomy',
					'callback'    => [ $this->admin_callbacks, 'getTaxonomy' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

	}