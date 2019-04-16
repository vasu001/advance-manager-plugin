<?php


	namespace Inc\Api\Callbacks;

	/**
	 * Class CptCallbacks
	 * @package Inc\Api\Callbacks
	 */
	class CptCallbacks {
		public function cptSanitize( $input ) {

			$output = get_option( 'amp_manager_cpt' );

			if ( array_key_exists( 'remove', $_POST ) ) {
				unset( $output[ $_POST['remove'] ] );

				return $output;
			}

			if ( ! ( $input['post_type'] == '' ) && ! ( $input['singular_name'] == '' ) && ! ( $input['plural_name'] == '' ) ) {
//				var_dump( "Input array is filled" );
//				var_dump( $input );

				$new_input = [
					$input['post_type'] => [
						'post_type'     => $input['post_type'],
						'singular_name' => $input['singular_name'],
						'plural_name'   => $input['plural_name'],
						'menu_icon'     => 'dashicons-' . ( ( $input['menu_icon'] == '' ) ? 'admin-post' : $input['menu_icon'] ),
						'public'        => ( $input['public'] == '1' ) ? true : false,
						'has_archive'   => ( $input['has_archive'] == '1' ) ? true : false,
					],
				];

//				var_dump( "New Input Array: " );
//				var_dump( $new_input );

				if ( $output ) {
					if ( array_key_exists( $input['post_type'], $output ) ) {
						$output[ $input['post_type'] ] = [
							'post_type'     => $input['post_type'],
							'singular_name' => $input['singular_name'],
							'plural_name'   => $input['plural_name'],
							'menu_icon'     => 'dashicons-' . ( ( $input['menu_icon'] == '' ) ? 'admin-post' : $input['menu_icon'] ),
							'public'        => ( $input['public'] == '1' ) ? true : false,
							'has_archive'   => ( $input['has_archive'] == '1' ) ? true : false,
						];
					} else {
						$output[ $input['post_type'] ] = [
							'post_type'     => $input['post_type'],
							'singular_name' => $input['singular_name'],
							'plural_name'   => $input['plural_name'],
							'menu_icon'     => 'dashicons-' . ( ( $input['menu_icon'] == '' ) ? 'admin-post' : $input['menu_icon'] ),
							'public'        => ( $input['public'] == '1' ) ? true : false,
							'has_archive'   => ( $input['has_archive'] == '1' ) ? true : false,
						];
					}
				} else {
					$output = $new_input;
				}

//				var_dump( "Output array: " );
//				var_dump( $output );
			}

//			var_dump( "Input array is empty" );
//			var_dump( $input );
//			var_dump( $output );
//
//			die();

			return $output;
		}

		public function cptSectionManager() {
			echo "Create your own Custom Post Type";
		}

		public function cptTextFields( $args ) {
			$name        = $args['label_for'];
			$option_name = $args['option_name'];
			$input       = get_option( $option_name );

			$value = isset( $_POST['edit_post'] ) ? $input[ $_POST['edit_post'] ][ $name ] : '';

			if ( preg_match( '/dashicons-/', $value ) ) {
				$value = explode( '-', $value );
				unset( $value[0] );
				$value = implode( '-', $value );
			}

			echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '">';
		}

		public function cptCheckboxFields( $args ) {
			$name        = $args['label_for'];
			$classes     = $args['class'];
			$option_name = $args['option_name'];
			$checked     = false;

			if ( isset( $_POST['edit_post'] ) ) {
				$checkbox = get_option( $option_name );
				if ( $checkbox[ $_POST['edit_post'] ][ $name ] ) {
					$checked = $checkbox[ $_POST['edit_post'] ][ $name ];
				}
			}

			echo "<div class=$classes>
                    <input type='checkbox' id=$name name=" . "$option_name" . "[$name] value='1' class=$classes " . ( $checked ?
					'checked' : '' ) . ">
                    <label for=$name><div></div></label>
                </div>";
		}
	}