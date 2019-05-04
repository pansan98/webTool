<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad tempaltes">
	<div class="<?php echo $template->getID(); ?>">
		<dl>
			<dd>
				<?php if($template->useAllButton()): ?>
				<ul class="txt">
					<li class="no_active">
						<label><input type="checkbox" id="<?php echo $template->getID(); ?>_all" value="1" style="display: none;">&nbsp;全て選択</label>
					</li>
				</ul>
				<?php endif; ?>
				<ul class="txt list">
					<?php
					$list = (array)$template->getValue();
					foreach ($template->getList() as $key => $val):
						if(in_array($key, $list)){
							$checked = "checked";
						}else{
							$checked = "";
						}
					?>
					<li class="no_active">
						<input type="checkbox" name="<?php echo $template->getName(); ?>[]" value="<?php echo $key; ?>" id="<?php echo ($template->getID() . "_" . $key); ?>" style="display: none;" <?php echo $checked; ?>>
						<label for="<?php echo ($template->getID() . "_" . $key); ?>">&nbsp;<?php echo $val; ?></label>
					</li>
					<?php endforeach; ?>
				</ul>
			</dd>
		</dl>
	</div>
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
	
if($template->useAllButton()):
$content_js["init"][] = <<<"EOT"
	//全て
	$(".{$template->getID()}").find('#{$template->getID()}_all').change(function(){
		if($(this).is(':checked')){
			$(".{$template->getID()} .list").each(function(){
				$(this).find('[type="checkbox"]').each(function(){
					$(this).parents("li").removeClass("no_active");
					$(this).parents("li").addClass("active");
					$(this).prop("checked", true);
				});
			});
		}else{
			$(".{$template->getID()} .list").each(function(){
				$(this).find('[type="checkbox"]').each(function(){
					$(this).parents("li").removeClass("active");
					$(this).parents("li").addClass("no_active");
					$(this).prop("checked", false);
				});
			});
		}
	});
EOT;
endif;