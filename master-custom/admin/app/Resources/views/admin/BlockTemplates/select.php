<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<?php $class = $template->getId(); ?>
<div class="box-body pad contents">
	<div>
        <select name="<?php echo $class ?>" class="form-control">
	        <?php
	        $value = $template->getValue();
	        if("" == $value) {
		        $value = $template->getDefault();
	        }
	        foreach ($template->getList() as $key => $val):
                if($value == $key){
                    $selected = ' selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option id="<?php echo ($class . "_" . $key); ?>" value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $val; ?></option>
            <?php endforeach; ?>
        </select>
		<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
