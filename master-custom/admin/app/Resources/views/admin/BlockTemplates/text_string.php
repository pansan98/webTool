<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<?php if ($template->use2Column()): ?>
		<div class="form-group">
			<label for="<?php echo $template->getID(); ?>" class="col-sm-2 control-label"><?php echo $template->getTitle(); ?></label>
			<div class="col-sm-10">
	<?php else: ?>
		<div class="input-group col-xs-12">
			<?php if ($template->isTitle() AND ! $template->use2Column()): ?>
				<p><?php echo $template->getTitle(); ?></p>
			<?php endif; ?>
	<?php endif; ?>
		<input type="text" class="form-control" name="<?php echo $template->getName(); ?>" id="<?php echo $template->getID(); ?>" placeholder="<?php echo $template->getPlaceholder(); ?>" value="<?php echo $template->getValue(); ?>" <?php echo ($template->isReadonly()) ? "readonly" : ""; ?>>
	</div>
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
	<?php if ($template->use2Column()): ?>
		</div>
	<?php endif; ?>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>