<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<?php if ($template->use2Column()): ?>
	<div class="form-group">
		<label for="<?php echo $template->getID(); ?>" class="col-sm-2 control-label"><?php echo $template->getTitle(); ?></label>
		<div class="col-sm-10">
	<?php else: ?>
	<div class="input-group col-xs-12">
		<?php if(!empty($template->getTitle())): ?>
			<p><?php echo $template->getTitle(); ?></p>
		<?php endif; ?>
	<?php endif; ?>
		<textarea class="form-control <?php echo $template->useEditor()?"editor":""?>" id="<?php echo $template->getID(); ?>" name="<?php echo $template->getName(); ?>" rows="<?php echo $template->getRows(); ?>" <?php echo ($template->isReadonly())?"readonly":""; ?>><?php echo $template->getValue(); ?></textarea>
	</div>
	<?php if ($template->use2Column()): ?>
	</div>
	<?php endif; ?>	
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<?php
	if ($template->useEditor()):
		$content_js["init"][] = <<<"EOT"
		CKEDITOR.replace("{$template->getID()}");
EOT;
	endif;


