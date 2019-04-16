<?php


	namespace Inc\Api;

	/**
	 * Class SettingsApi
	 * @package Inc\Api
	 */
	class SettingsApi {

		public $admin_pages = [];
		public $admin_subpages = [];

		public $settings = [];
		public $sections = [];
		public $fields = [];


		/**
		 * Register function for adding menus on the dashboard on activation of plugin
		 * Register settings, sections, and fields
		 */
		public function register() {

			if ( ! empty( $this->admin_pages ) || ! empty( $this->admin_subpages ) ) {
				add_action( 'admin_menu', [ $this, 'addAdminPages' ] );
			}

			if ( ! empty( $this->settings ) ) {
				add_action( 'admin_init', [ $this, 'addRegisterSettings' ] );
			}

		}

		/**
		 * @param array $admin_page
		 *
		 * @return $this
		 */
		public function setAdminPages( array $admin_page ) {
			$this->admin_pages = $admin_page;

			return $this;
		}

		public function setAdminSubpages( array $admin_subpage ) {
			$this->admin_subpages = array_merge( $this->admin_subpages, $admin_subpage );

			return $this;
		}

		/**
		 * @param string|NULL $title of First Subpage
		 *
		 * @return $this for continuous chain calling functionality
		 */
		public function withSubpage( string $title = NULL ) {

			if ( empty( $this->admin_pages ) ) {
				return $this;
			}

			$required_admin_page = $this->admin_pages[0];

			$subpage = [
				[
					'parent_slug' => $required_admin_page['menu_slug'],
					'page_title'  => $required_admin_page['page_title'],
					'menu_title'  => ( $title ) ? $title : $required_admin_page['menu_title'],
					'capability'  => $required_admin_page['capability'],
					'menu_slug'   => $required_admin_page['menu_slug'],
					'callback'    => $required_admin_page['callback'],
				],
			];

			$this->admin_subpages = $subpage;

			return $this;
		}

		/**
		 * Function for adding menus and sub menus along with their respective pages
		 */
		public function addAdminPages() {
			foreach ( $this->admin_pages as $admin_page ) {
				add_menu_page( $admin_page['page_title'], $admin_page['menu_title'], $admin_page['capability'], $admin_page['menu_slug'], $admin_page['callback'], $admin_page['icon_url'], $admin_page['position'] );
			}

			foreach ( $this->admin_subpages as $admin_subpage ) {
				add_submenu_page( $admin_subpage['parent_slug'], $admin_subpage['page_title'], $admin_subpage['menu_title'],
					$admin_subpage['capability'], $admin_subpage['menu_slug'], $admin_subpage['callback'] );
			}
		}


		/**
		 * Register Settings, Sections, and Fields
		 */

		/**
		 * @param array $setting
		 *
		 * @return $this
		 */
		public function setSettings( array $setting ) {
			$this->settings = $setting;

			return $this;
		}

		/**
		 * @param array $section
		 *
		 * @return $this
		 */
		public function setSections( array $section ) {
			$this->sections = $section;

			return $this;
		}

		/**
		 * @param array $field
		 *
		 * @return $this
		 */
		public function setFields( array $field ) {
			$this->fields = $field;

			return $this;
		}


		public function addRegisterSettings() {

			foreach ( $this->settings as $setting ) {
				register_setting( $setting['option_group'], $setting['option_name'], isset( $setting['callback'] ) ?
					$setting['callback'] : '' );
			}

			foreach ( $this->sections as $section ) {
				add_settings_section( $section['id'], $section['title'], isset( $section['callback'] ) ?
					$section['callback'] : '', $section['page'] );
			}

			foreach ( $this->fields as $field ) {
				add_settings_field( $field['id'], $field['title'], isset( $field['callback'] ) ? $field['callback'] : '',
					$field['page'], $field['section'], isset( $field['args'] ) ? $field['args'] : '' );
			}

		}

	}