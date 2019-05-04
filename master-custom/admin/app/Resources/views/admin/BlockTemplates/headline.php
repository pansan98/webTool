<?php
$val = $template->getValue();
$position = isset($val["size"])?$val["size"]:"large";
$text = isset($val["text"])?$val["text"]:"";
?>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<div class="input-group col-xs-12">
		表示の種類：
		<input type="radio" id="<?php echo $template->getId(); ?>_position" name="<?php echo $template->getName(); ?>[size]" value="large" <?php echo ("large" == $position)?"checked":""; ?>>大見出し
		<input type="radio" id="<?php echo $template->getId(); ?>_position" name="<?php echo $template->getName(); ?>[size]" value="medium" <?php echo ("medium" == $position)?"checked":""; ?>>中見出し
		<input type="radio" id="<?php echo $template->getId(); ?>_position" name="<?php echo $template->getName(); ?>[size]" value="small" <?php echo ("small" == $position)?"checked":""; ?>>小見出し
	</div>
	<div class="input-group col-xs-12">
		<input type="text" class="form-control" name="<?php echo $template->getName(); ?>[text]" id="<?php echo $template->getId(); ?>" placeholder="<?php echo $template->getPlaceholder(); ?>" value="<?php echo $text; ?>" <?php echo ($template->isReadonly()) ? "readonly" : ""; ?>>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>