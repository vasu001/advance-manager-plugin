<div class="wrap">

	<h1>Advance Manager Plugin Dashboard</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">AMP Settings</a></li>
		<li><a href="#tab-2">Updates</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			<form action="options.php" method="POST">
				<?php
					settings_fields( 'amp_manager_group' );
					do_settings_sections( 'amp_admin_dashboard' );
					submit_button();
				?>
			</form>
		</div>
		<div id="tab-2" class="tab-pane">
			<h3>Updates</h3>
			<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae consequuntur minima modi veniam sit est expedita
			   maiores error perspiciatis. Necessitatibus, doloribus? Expedita tempora perferendis harum doloremque vitae fugit
			   maxime consequatur iusto consectetur provident! Illum delectus nemo voluptate dignissimos nobis at, deserunt quae
			   quibusdam? Possimus rem nam id! Est aliquam ratione eius a. Ducimus facere exercitationem quidem, minus totam odit
			   culpa aliquid neque. Nostrum est corporis laborum debitis cupiditate ad, aliquid modi voluptates, obcaecati
			   molestiae maiores placeat, beatae doloribus assumenda laboriosam dolorum totam! Voluptatem officiis laboriosam,
			   perferendis suscipit iste doloribus, animi deleniti assumenda nostrum totam accusantium cupiditate eligendi. Quas,
			   repellat vero.</p>
		</div>
		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt, laboriosam. Sapiente debitis in corrupti velit
			   commodi natus voluptas voluptates quod recusandae quos ex delectus, cupiditate repudiandae aliquid quae sunt? Ab
			   assumenda, dolore architecto dolor tenetur aperiam accusamus quis debitis suscipit inventore culpa necessitatibus
			   omnis iusto et quaerat ut non harum sed reprehenderit accusantium sunt repellendus! Quo veritatis amet hic
			   similique optio, quidem ullam dolor qui deserunt a quae repellat, quia sunt consequuntur voluptatem vitae
			   doloremque quis. Quisquam quos corrupti eligendi minus magni, quis cumque consequuntur iste laborum, reiciendis
			   facilis beatae ipsum deleniti eius non ipsa. Repellendus inventore molestiae quod consequuntur.</p>
		</div>
	</div>

</div>