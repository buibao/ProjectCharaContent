<ul class="nav nav-tabs" role="tablist">

	<li role="presentation" class="active">

		<a href="#facebook" aria-controls="email_config" role="tab" data-toggle="tab"><?php echo _l('setting_facebook_access_token'); ?></a>

	</li>

	<li role="presentation">

		<a href="#call" aria-controls="email_queue" role="tab" data-toggle="tab"><?php echo _l('setting_call'); ?></a>

	</li>

</ul>

<div class="tab-content">

	<div role="tabpanel" class="tab-pane active" id="facebook">



		<br />

		<h4 style="margin-top:-20px;"><?php echo _l('settings_facebook'); ?></h4>

		<hr />

		<div class="smtp-fields<?php if (get_option('email_protocol') == 'mail') {
									echo ' hide';
								} ?>">

			<?php echo render_input('settings[access_token]', 'access_token'); ?>

			<hr />
		</div>
	</div>

	<div role="tabpanel" class="tab-pane" id="call">
		<div class="row">
			<div class="col-md-12">
			<br />
			<h4 style="margin-top:-20px;"><?php echo _l('settings_call'); ?></h4>
			<hr />
				<?php echo render_input('settings[Ext]', 'Ext'); ?>

				<?php echo render_input('settings[Pass]', 'Pass'); ?>

				<?php echo render_input('settings[API_Key]', 'API_Key'); ?>

				<?php echo render_input('settings[API_Secret]', 'API_Secret'); ?>

				<?php echo render_input('settings[Token]', 'Token'); ?>
			</div>
		</div>
	</div>
</div>
<div id="new_version"></div>
</div>

</div>