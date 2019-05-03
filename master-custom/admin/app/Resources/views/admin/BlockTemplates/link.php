<?php
	$val = $template->getValue();
	$link["link"]["blank"] = "";
	$link["link"]["url"] = "";
	$link["link"]["disp"] = "";
	if(!empty($val)){
		$link = $val;
	}
?>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<?php if ($template->useBlank()): ?>
	<div class="input-group col-xs-12">
		<div class="<?php echo $template->getID(); ?>">
			<dl>
				<dd>
					<ul class="txt list">
						<li class="no_active">
							<input type="checkbox" name="<?php echo $template->getName(); ?>[link][blank]" value="_blank" id="<?php echo ($template->getID() . "_blank"); ?>" style="display: none;">
							<label for="<?php echo ($template->getID() . "_blank"); ?>">&nbsp;新規ウインドウで開く</label>
						</li>
					</ul>
				</dd>
			</dl>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($template->useDispName()): ?>
	 	<div class="input-group col-xs-12">
			<lanel>表示名：</lanel>
			<input type="text" class="form-control" name="<?php echo $template->getName(); ?>[link][disp]" id="<?php echo $template->getID(); ?>:link:name" value="<?php echo $link["link"]["disp"]; ?>">
		</div>
	<?php endif; ?>
	<div class="input-group col-xs-12">
		<lanel>URL：</lanel>
		<input type="text" class="form-control" name="<?php echo $template->getName(); ?>[link][url]" id="<?php echo $template->getID(); ?>:link:url" value="<?php echo $link["link"]["url"]; ?>" placeholder="<?php echo $template->getPlaceholder(); ?>">
	</div>
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<?php
$content_js["init"][] = <<<"EOT"
	//初期化
	$(".{$template->getID()}").each(function(){
		$(this).find('[type="checkbox"]').css({"display":"none"});
		$(this).find('[type="checkbox"]').parents("li").removeClass("active");
		$(this).find('[type="checkbox"]').parents("li").addClass("no_active");
		$(this).find('[type="checkbox"]:checked').each(function(){
			$(this).parents("li").removeClass("no_active");
			$(this).parents("li").addClass("active");
		});
	});
	
	//イベント
	$(".{$template->getID()}").find('[type="checkbox"]').change(function(){
		$(".txt").each(function(){
			$(this).find('[type="checkbox"]').parents("li").removeClass("active");
			$(this).find('[type="checkbox"]').parents("li").addClass("no_active");
			$(this).find('[type="checkbox"]:checked').each(function(){
				$(this).parents("li").removeClass("no_active");
				$(this).parents("li").addClass("active");
			});
		});
	});
EOT;
