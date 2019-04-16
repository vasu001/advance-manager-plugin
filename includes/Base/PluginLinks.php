<?php


	namespace Inc\Base;

	/**
	 * Class PluginLinks
	 * @package Inc\Base
	 */
	class PluginLinks extends BaseController {

		public function register() {
			add_action( 'plugin_action_links_' . $this->plugin_name, [ $this, 'add_plugin_links' ] );
		}

		/**
		 * @param array $links
		 *
		 * @return array
		 */
		public function add_plugin_links( array $links ): array {
			$edit_link    = "<a href='admin.php?page=amp_admin_dashboard'>Edit</a>";
			$setting_link = "<a href='admin.php?page=amp_admin_dashboard'>Settings</a>";

			array_push( $links, $edit_link );
			array_push( $links, $setting_link );

			return $links;
		}

	}