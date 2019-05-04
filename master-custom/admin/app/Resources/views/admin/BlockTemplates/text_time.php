<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<div class="bootstrap-timepicker">
		<div class="input-group">
			<input type="text" class="form-control timepicker">
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-time"></span>
			</span>
		</div>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<?php
$template_js["init"][] = '$(".timepicker").timepicker({showInputs: false});';
