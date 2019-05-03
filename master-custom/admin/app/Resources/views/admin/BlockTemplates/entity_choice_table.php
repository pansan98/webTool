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
				<table class="table table-bordered">
					<?php
                    // 選択肢全体
                    $collection = $template->getList();

                    // チェックされた項目
					$values = (array)$template->getValue();
					?>
                    <colgroup>
                        <col style="width:auto;">
                        <col style="width:3em;">
                    </colgroup>
                    <tbody>
                    <?php
					foreach ($collection as $val):
						if(in_array($val, $values)){
							$checked = " checked";
						}else{
							$checked = "";
						}

						if(method_exists($val, 'getDisplayName')){
						    $labelName = $val->getDisplayName();
                        } elseif(method_exists($val, 'getName')){
						    $labelName = $val->getName();
                        } else {
						    $labelName = (string)$val;
                        }
					?>
                    <tr>
                        <th>
                            <label for="<?php echo ($template->getID() . "_" . $val->getId()); ?>">&nbsp;<?php echo $view->escape($labelName); ?></label>
                        </th>
                        <td class="text-center">
                            <input type="checkbox" name="<?php echo $view->escape($template->getID()); ?>[]" value="<?php echo $val->getId(); ?>" id="<?php echo ($template->getID() . "_" . $val->getId()); ?>"<?php echo $checked; ?>>
                        </td>
                    </tr>
					<?php endforeach; ?>
                    </tbody>
				</table>
				<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
			</dd>
		</dl>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<?php
	
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