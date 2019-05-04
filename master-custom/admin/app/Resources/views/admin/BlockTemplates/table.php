<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents" id="<?php echo $template->getID(); ?>">
	<?php foreach ($template->getValue() as $key => $row): ?>
		<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/table_add.php"; ?>
	<?php endforeach; ?>
</div>
<?php if ($template->useAdd()): ?>
	<div class="box-footer">
		<div class="text-right"><input type="button" value="行を追加する" onclick="line_add_<?php echo $template->getID() ?>()"></div>
	</div>
<?php endif; ?>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<script>
	/* 業追加 */
	function line_add_<?php echo $template->getID(); ?>() {

		var id = "<?php echo $template->getID(); ?>";
		var output = document.getElementById(id);
		var block_childrens = $(output).children();
		var cnt = block_childrens.length;

		//テンプレート取得
		var t = document.querySelector("#template_table_add_" + id);
		var clone = document.importNode(t.content, true);

		ele = clone.querySelector("#" + id + "__col1");
		ele.id = id + "_" + cnt + "_col1";

		ele = clone.querySelector("#" + id + "__col2");
		ele.id = id + "_" + cnt + "_col2";

		output.appendChild(clone);

		CKEDITOR.replace(id + "_" + cnt + "_col2");
	}
</script>

<?php {
	$key = $row = NULL;
	ob_start();
	include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/table_add.php";
	$ret = ob_get_contents();
	ob_end_clean();
	$content_template_tags["table_add_" . $template->getID()] = <<< "EOT"
	<template id="template_table_add_{$template->getID()}">
		{$ret}
	</template>
EOT;
}
?>