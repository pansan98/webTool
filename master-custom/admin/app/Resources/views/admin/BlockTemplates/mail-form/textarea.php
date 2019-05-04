<?php
$values = $template->getValue();
if(empty($values)) $values = [];
$name = isset($values['name']) ? $values['name'] : '';
$label = isset($values['label']) ? $values['label'] : '';
$helpText = isset($values['help_text']) ? $values['help_text'] : '';
$isRequired = (isset($values['is_required']) && $values['is_required'] == 1) ? true : false;
?>
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
        <div class="form-group">
            <label class="control-label">フィールド名（英数字）</label>
            <input type="text" class="form-control" name="<?php echo $template->getName(); ?>[name]" id="<?php echo $template->getID(); ?>_name" value="<?php echo $view->escape($name); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label">ラベル</label>
            <input type="text" class="form-control" name="<?php echo $template->getName(); ?>[label]" id="<?php echo $template->getID(); ?>_label" value="<?php echo $view->escape($label); ?>" required>
        </div>

        <div class="form-group">
            <label class="control-label">入力時の注意点</label>
            <textarea class="form-control" name="<?php echo $template->getName(); ?>[help_text]" id="<?php echo $template->getID(); ?>_help_text" placeholder="<?php echo $template->getPlaceholder(); ?>"><?php echo nl2br($helpText); ?></textarea>
        </div>

        <div>
            <label><input type="checkbox" name="<?php echo $template->getName();?>[is_required]" value="1"<?php echo ($isRequired) ? ' checked' : ''; ?>> 必須にする</label>
        </div>
	</div>
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
	<?php if ($template->use2Column()): ?>
		</div>
	<?php endif; ?>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>