<?php
include THREES__APP_ROOT_DIR . "/app/Resources/views/" . $contents_view;
if(isset($content_template_tags)) :
	foreach ($content_template_tags as $template_tags):
		echo $template_tags . PHP_EOL;
	endforeach;
endif;
?>
<script>
<?php
	if(isset($content_js["raw"])) :
		foreach ($content_js["raw"] as $js):
			echo $js . PHP_EOL;
		endforeach;
	endif;
	if(isset($content_js["init"])) :
		foreach ($content_js["init"] as $js):
			echo $js . PHP_EOL;
		endforeach;
	endif;
	
?>
</script>