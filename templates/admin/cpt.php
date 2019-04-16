<div class="wrap">

	<h1>Custom Post Type Manager</h1>
	<?php
		settings_errors();

		if ( array_key_exists( 'edit_post', $_POST ) ) {

		}
	?>

	<ul class="nav nav-tabs">
		<li class="<?php echo ! array_key_exists( 'edit_post', $_POST ) ? 'active' : '' ?>"><a href="#tab-1">Custom Post
		                                                                                                     Types</a></li>
		<li class="<?php echo array_key_exists( 'edit_post', $_POST ) ? 'active' : '' ?>"><a href="#tab-2"><?php echo
				array_key_exists( 'edit_post', $_POST ) ? 'Edit ' : 'Add ' ?> Custom Post
		                                                                      Types</a></li>
		<li><a href="#tab-3">Export Custom Post Types</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo ! array_key_exists( 'edit_post', $_POST ) ? 'active' : '' ?>">
			<h3>Manage Previously Created Custom Post Types</h3>
			<?php

				$options = get_option( 'amp_manager_cpt' ) ?: [];

				echo "
					<table class=\"table table-bordered table-hover table-sm text-center\">
						 <thead class=\"bg-primary text-white\">
						    <tr>
								<th>ID</th>
								<th>Singular Name</th>
								<th>Plural Name</th>
								<th>Menu Icon</th>
								<th>Public</th>
								<th>Archive</th>
								<th>Actions</th>
							</tr>
						 </thead>
						 <tbody>
				";

				foreach ( $options as $option ) {
					$public  = $option['public'] ? 'Yes' : 'No';
					$archive = $option['has_archive'] ? 'Yes' : 'No';
					echo "
					<tr>
						<td>{$option['post_type']}</td>
						<td>{$option['singular_name']}</td>
						<td>{$option['plural_name']}</td>
						<td>{$option['menu_icon']}</td>
						<td>{$public}</td>
						<td>{$archive}</td>
						<td>
							<form action=\"\" method='post' class='inline-block'>
					";
					submit_button( 'Edit', 'primary small', 'submit', false );

					echo "
								<input type=\"hidden\" name='edit_post' value=" . $option['post_type'] . ">
							</form>
					
					<form action = \"options.php\" method='post' class='inline-block'>
					";
					settings_fields( 'amp_manager_group_cpt' );
					submit_button( 'Delete', 'delete small', 'submit', false, [
						'onclick' => 'return confirm("Are you sure?");',
					] );

					echo "
								<input type=\"hidden\" name='remove' value=" . $option['post_type'] . ">
							</form>
						</td>
					</tr>
					";
				}
				echo "</tbody></table>";

			?>
		</div>
		<div id="tab-2" class="tab-pane <?php echo array_key_exists( 'edit_post', $_POST ) ? 'active' : '' ?>">
			<form action="options.php" method="POST">
				<?php
					settings_fields( 'amp_manager_group_cpt' );
					do_settings_sections( 'amp_admin_cpt' );
					submit_button();
				?>
			</form>
		</div>
		<div id="tab-3" class="tab-pane">
			<h3>Export Custom Post Types</h3>

			<?php foreach ( $options as $option ): ?>

				<?php echo "<h3>" . $option['singular_name'] . "</h3>"; ?>
				<pre class="prettyprint pad-3">
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( '<?php echo $option["plural_name"]; ?>', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( '<?php echo $option["singular_name"]; ?>', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( '<?php echo $option["plural_name"]; ?>', 'text_domain' ),
		'name_admin_bar'        => __( '<?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'archives'              => __( '<?php echo $option["singular_name"]; ?> Archives', 'text_domain' ),
		'attributes'            => __( '<?php echo $option["singular_name"]; ?> Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent <?php echo $option["singular_name"]; ?>:', 'text_domain' ),
		'all_items'             => __( 'All <?php echo $option["plural_name"]; ?>', 'text_domain' ),
		'add_new_item'          => __( 'Add New <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'edit_item'             => __( 'Edit  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'update_item'           => __( 'Update  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'view_item'             => __( 'View  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'view_items'            => __( 'View  <?php echo $option["plural_name"]; ?>', 'text_domain' ),
		'search_items'          => __( 'Search  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this  <?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'items_list'            => __( '<?php echo $option["plural_name"]; ?> list', 'text_domain' ),
		'items_list_navigation' => __( '<?php echo $option["plural_name"]; ?> list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter <?php echo $option["plural_name"]; ?> list', 'text_domain' ),
	);
	$args = [
		'label'                 => __( '<?php echo $option["singular_name"]; ?>', 'text_domain' ),
		'description'           => __( '<?php echo $option["singular_name"]; ?> Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => [ 'category', 'post_tag' ],
		'hierarchical'          => false,
		'public'                => <?php echo $option["public"] == '1' ? 'true' : 'false'; ?>,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => <?php echo $option["has_archive"] == '1' ? 'true' : 'false'; ?>,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'menu_icon'             => '<?php echo $option["menu_icon"]; ?>'
	];
	register_post_type( '<?php echo $option["post_type"]; ?>', $args );

}
add_action( 'init', 'custom_post_type', 0 );
				</pre>

			<?php endforeach; ?>
		</div>
	</div>

</div>

