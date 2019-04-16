<?php


	namespace Inc\Api\Callbacks;

	use Inc\Base\BaseController;

	/**
	 * Class AdminCallbacks
	 * @package Inc\Api\Callbacks
	 */
	class AdminCallbacks extends BaseController {

		public function getDashboard() {
			require_once $this->plugin_path . '/templates/admin/dashboard.php';
		}

		public function getCPT() {
			require_once $this->plugin_path . '/templates/admin/cpt.php';
		}

		public function getWidget() {
			require_once $this->plugin_path . '/templates/admin/widget.php';
		}

		public function getTemplates() {
			require_once $this->plugin_path . '/templates/admin/templates.php';
		}

		public function getTestimonial() {
			require_once $this->plugin_path . '/templates/admin/testimonial.php';
		}

		public function getMember() {
			require_once $this->plugin_path . '/templates/admin/member.php';
		}

		public function getChat() {
			require_once $this->plugin_path . '/templates/admin/chat.php';
		}

		public function getTaxonomy() {
			require_once $this->plugin_path . '/templates/admin/taxonomy.php';
		}

		public function getAJAX() {
			require_once $this->plugin_path . '/templates/admin/ajax.php';
		}

		public function getGallery() {
			require_once $this->plugin_path . '/templates/admin/gallery.php';
		}

	}