<?php


	namespace Inc\Base;

	use Inc\Api\Callbacks\AdminCallbacks;
	use Inc\Api\Callbacks\CptCallbacks;
	use Inc\Api\SettingsApi;

	/**
	 * Class CustomPostType
	 * @package Inc\Base
	 */
	class CustomPostType extends BaseController {

		public $settings;
		public $admin_callbacks;
		public $cpt_callbacks;

		public $custom_post_types = [];


		public function register() {

			if ( ! $this->isActivated( 'cpt_manager' ) ) {
				return;
			}

			$this->settings        = new SettingsApi();
			$this->admin_callbacks = new AdminCallbacks();
			$this->cpt_callbacks   = new CptCallbacks();

			$this->setSettings();
			$this->setSections();
			$this->setFields();

			$this->storeCustomPostType();

			$this->setCptSubpage();

			if ( ! empty( $this->custom_post_types ) ) {
				add_action( 'init', [ $this, 'registerCustomPostTypes' ] );
			}

			$this->settings->register();

		}

		public function setCptSubpage() {
			$args = [
				[
					'parent_slug' => 'amp_admin_dashboard',
					'page_title'  => 'Custom Post Type Manager',
					'menu_title'  => 'CPT Manager',
					'capability'  => 'manage_options',
					'menu_slug'   => 'amp_admin_cpt',
					'callback'    => [ $this->admin_callbacks, 'getCPT' ],
				],
			];

			$this->settings->setAdminSubpages( $args );
		}

		public function setSettings() {
			$args = [
				[
					'option_group' => 'amp_manager_group_cpt',
					'option_name'  => 'amp_manager_cpt',
					'callback'     => [ $this->cpt_callbacks, 'cptSanitize' ],
				],
			];

			$this->settings->setSettings( $args );
		}

		public function setSections() {
			$args = [
				[
					'id'       => 'amp_admin_cpt_index',
					'title'    => 'Custom Post Type Settings',
					'callback' => [ $this->cpt_callbacks, 'cptSectionManager' ],
					'page'     => 'amp_admin_cpt',
				],
			];

			$this->settings->setSections( $args );
		}

		public function setFields() {
			$args = [
				[
					'id'       => 'post_type',
					'title'    => 'Custom Post Type ID',
					'callback' => [ $this->cpt_callbacks, 'cptTextFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'post_type',
						'placeholder' => 'eg. product',
					],
				],
				[
					'id'       => 'singular_name',
					'title'    => 'Singular Name',
					'callback' => [ $this->cpt_callbacks, 'cptTextFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'singular_name',
						'placeholder' => 'eg. Product',
					],
				],
				[
					'id'       => 'plural_name',
					'title'    => 'Plural Name',
					'callback' => [ $this->cpt_callbacks, 'cptTextFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'plural_name',
						'placeholder' => 'eg. Products',
					],
				],
				[
					'id'       => 'menu_icon',
					'title'    => 'Dashicons Slug',
					'callback' => [ $this->cpt_callbacks, 'cptTextFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'menu_icon',
						'placeholder' => 'eg. dashboard [optional]',
					],
				],
				[
					'id'       => 'public',
					'title'    => 'Public',
					'callback' => [ $this->cpt_callbacks, 'cptCheckboxFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'public',
						'class'       => 'ui-toggle',
					],
				],
				[
					'id'       => 'has_archive',
					'title'    => 'Archive',
					'callback' => [ $this->cpt_callbacks, 'cptCheckboxFields' ],
					'page'     => 'amp_admin_cpt',
					'section'  => 'amp_admin_cpt_index',
					'args'     => [
						'option_name' => 'amp_manager_cpt',
						'label_for'   => 'has_archive',
						'class'       => 'ui-toggle',
					],
				],
			];

			$this->settings->setFields( $args );
		}

		public function storeCustomPostType() {

			if ( ! get_option( 'amp_manager_cpt' ) ) {
				update_option( 'amp_manager_cpt', [] );

				return;
			}

			$options = get_option( 'amp_manager_cpt' );


//			var_dump( $options );
//			die();

			foreach ( $options as $option ) {
				$this->custom_post_types[] = [
					'post_type'             => $option['post_type'],
					'name'                  => $option['plural_name'],
					'singular_name'         => $option['singular_name'],
					'menu_name'             => $option['plural_name'],
					'name_admin_bar'        => $option['singular_name'],
					'archives'              => $option['singular_name'] . ' Archives',
					'attributes'            => $option['singular_name'] . ' Attributes',
					'parent_item_colon'     => 'Parent ' . $option['singular_name'],
					'all_items'             => 'All ' . $option['plural_name'],
					'add_new_item'          => 'Add New ' . $option['singular_name'],
					'add_new'               => 'Add New',
					'new_item'              => 'New ' . $option['singular_name'],
					'edit_item'             => 'Edit ' . $option['singular_name'],
					'update_item'           => 'Update ' . $option['singular_name'],
					'view_item'             => 'View ' . $option['singular_name'],
					'view_items'            => 'View ' . $option['plural_name'],
					'search_items'          => 'Search ' . $option['plural_name'],
					'not_found'             => 'No ' . $option['singular_name'] . ' Found',
					'not_found_in_trash'    => 'No ' . $option['singular_name'] . ' Found in Trash',
					'featured_image'        => 'Featured Image',
					'set_featured_image'    => 'Set Featured Image',
					'remove_featured_image' => 'Remove Featured Image',
					'use_featured_image'    => 'Use Featured Image',
					'insert_into_item'      => 'Insert' . ' into ' . $option['singular_name'],
					'uploaded_to_this_item' => 'Upload to this ' . $option['singular_name'],
					'items_list'            => $option['plural_name'] . ' List',
					'items_list_navigation' => $option['plural_name'] . ' List Navigation',
					'filter_items_list'     => 'Filter' . $option['plural_name'] . ' List',
					'label'                 => $option['singular_name'],
					'description'           => $option['plural_name'] . 'Custom Post Type',
					'supports'              => [ 'title', 'editor', 'thumbnail' ],
					'taxonomies'            => [ 'category', 'post_tag' ],
					'hierarchical'          => false,
					'public'                => $option['public'],
					'show_ui'               => true,
					'show_in_menu'          => true,
					'menu_position'         => 5,
					'show_in_admin_bar'     => true,
					'show_in_nav_menus'     => true,
					'can_export'            => true,
					'has_archive'           => $option['has_archive'],
					'exclude_from_search'   => false,
					'publicly_queryable'    => true,
					'capability_type'       => 'post',
					'menu_icon'             => $option['menu_icon'],
				];
			}

		}

		public function registerCustomPostTypes() {

//			var_dump( $this->custom_post_types );
//			die();

			foreach ( $this->custom_post_types as $post_type ) {

				register_post_type( $post_type['post_type'],
					[
						'labels'              => [
							'name'                  => $post_type['name'],
							'singular_name'         => $post_type['singular_name'],
							'menu_name'             => $post_type['menu_name'],
							'name_admin_bar'        => $post_type['name_admin_bar'],
							'archives'              => $post_type['archives'],
							'attributes'            => $post_type['attributes'],
							'parent_item_colon'     => $post_type['parent_item_colon'],
							'all_items'             => $post_type['all_items'],
							'add_new_item'          => $post_type['add_new_item'],
							'add_new'               => $post_type['add_new'],
							'new_item'              => $post_type['new_item'],
							'edit_item'             => $post_type['edit_item'],
							'update_item'           => $post_type['update_item'],
							'view_item'             => $post_type['view_item'],
							'view_items'            => $post_type['view_items'],
							'search_items'          => $post_type['search_items'],
							'not_found'             => $post_type['not_found'],
							'not_found_in_trash'    => $post_type['not_found_in_trash'],
							'featured_image'        => $post_type['featured_image'],
							'set_featured_image'    => $post_type['set_featured_image'],
							'remove_featured_image' => $post_type['remove_featured_image'],
							'use_featured_image'    => $post_type['use_featured_image'],
							'insert_into_item'      => $post_type['insert_into_item'],
							'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
							'items_list'            => $post_type['items_list'],
							'items_list_navigation' => $post_type['items_list_navigation'],
							'filter_items_list'     => $post_type['filter_items_list'],
						],
						'label'               => $post_type['label'],
						'description'         => $post_type['description'],
						'supports'            => $post_type['supports'],
						'taxonomies'          => $post_type['taxonomies'],
						'hierarchical'        => $post_type['hierarchical'],
						'public'              => $post_type['public'],
						'show_ui'             => $post_type['show_ui'],
						'show_in_menu'        => $post_type['show_in_menu'],
						'menu_position'       => $post_type['menu_position'],
						'show_in_admin_bar'   => $post_type['show_in_admin_bar'],
						'show_in_nav_menus'   => $post_type['show_in_nav_menus'],
						'can_export'          => $post_type['can_export'],
						'has_archive'         => $post_type['has_archive'],
						'exclude_from_search' => $post_type['exclude_from_search'],
						'publicly_queryable'  => $post_type['publicly_queryable'],
						'capability_type'     => $post_type['capability_type'],
						'menu_icon'           => $post_type['menu_icon'],
					]
				);
			}
		}
	}