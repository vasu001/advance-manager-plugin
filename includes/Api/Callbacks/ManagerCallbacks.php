<?php


	namespace Inc\Api\Callbacks;

	use Inc\Base\BaseController;

	/**
	 * Class ManagerCallbacks
	 * @package Inc\Api\Callbacks
	 */
	class ManagerCallbacks extends BaseController {
		public function managerSanitize( $input ) {
			$output = [];
			foreach ( $this->managers as $manager => $name ) {
				$output[ $manager ] = isset( $input[ "'" . $manager . "'" ] ) ? true : false;
			}

			return $output;
		}

		public function dashboardSectionManager() {
			echo "<strong>Check</strong> to <strong>activate</strong> the required manager";
		}

		public function dashboardCheckboxFields( $args ) {
			$name        = $args['label_for'];
			$classes     = $args['class'];
			$option_name = $args['option_name'];
			$checkbox    = get_option( $option_name );
			$checked     = ( isset( $checkbox[ $name ] ) ? ( $checkbox[ $name ] ? true : false ) : false );
			echo "<div class=$classes>
                    <input type='checkbox' id=$name name=" . "$option_name" . "['$name'] value='1' class=$classes " . ( $checked ? 'checked' : '' ) . ">
                    <label for=$name><div></div></label>
                </div>";
		}
	}