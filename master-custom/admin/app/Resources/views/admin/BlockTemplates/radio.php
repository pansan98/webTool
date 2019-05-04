<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<?php $class = $template->getID(); ?>
<div class="box-body pad contents">
	<div class="<?php echo $class ?>">
		<dl>
			<dd>
				<ul class="txt list">
					<?php
					$value = $template->getValue();
					if("" == $value) {
						$value = $template->getDefault();
					}
					foreach ($template->getList() as $key => $val):
						if($value == $key){
							$checked = "checked";
						}else{
							$checked = "";
						}
					?>
					<li class="no_active">
						<input type="radio" name="<?php echo $class; ?>" value="<?php echo $key; ?>" id="<?php echo ($class . "_" . $key); ?>" style="display: none;" <?php echo $checked; ?>>
						<label for="<?php echo ($class . "_" . $key); ?>">&nbsp;<?php echo $val; ?></label>
					</li>
					<?php endforeach; ?>
				</ul>
			</dd>
		</dl>
		<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>

<?php
$content_js["init"][] = <<<"EOT"
	//初期化
	$(".{$class}").each(function(){
		$(this).find('[type="radio"]').css({"display":"none"});
		$(this).find('[type="radio"]').parents("li").removeClass("active");
		$(this).find('[type="radio"]').parents("li").addClass("no_active");
		$(this).find('[type="radio"]:checked').each(function(){
			$(this).parents("li").removeClass("no_active");
			$(this).parents("li").addClass("active");
		});
	});
	
	//イベント
	$(".{$class}").find('[type="radio"]').change(function(){
		$(".txt").each(function(){
			$(this).find('[type="radio"]').parents("li").removeClass("active");
			$(this).find('[type="radio"]').parents("li").addClass("no_active");
			$(this).find('[type="radio"]:checked').each(function(){
				$(this).parents("li").removeClass("no_active");
				$(this).parents("li").addClass("active");
			});
		});
	});
EOT;
