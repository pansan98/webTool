<?php { /* スコープ開始 */ ?>
<?php 
	if(isset($content_template_tags)) :
		foreach ($content_template_tags as $template_tags):
			echo $template_tags . PHP_EOL;
		endforeach;
	endif;
?>
<?php } /* スコープ開始 */