<?php if(!Empty($setting["header_comment"])): ?>
<div class="box-body pad header"><?php echo $setting["header_comment"]; ?></div>
<?php endif;?>
<div class="box-body">
	<div class="input-group col-xs-12">
		<lanel>URL：</lanel>
		<input type="text" class="form-control" value="https://www.youtube.com/embed/58Hj4BsMIQs">
	</div>
	<div class="input-group col-xs-12">
		<style>
			.video{
				position:relative;
				width:100%;
				padding-top:56.25%;
			}
			.video iframe{
				position:absolute;
				top:0;
				right:0;
				width:100%;
				height:100%;
			}
		</style>
		<hr>
		<div class="video">
			<iframe src="https://www.youtube.com/embed/58Hj4BsMIQs" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
</div>
<?php if(!Empty($setting["footer_comment"])): ?>
<div class="box-body pad footer"><?php echo $setting["footer_comment"]; ?></div>
<?php endif;?>