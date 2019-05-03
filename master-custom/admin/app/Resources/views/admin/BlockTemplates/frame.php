<div class="row" id="<?php echo isset($num)?$template->getID()."-row":"block_id"; ?>">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header" style="border-bottom: 1px solid #d2d6de;">
				<div class="pull-left">
					並順：
					<select id="<?php echo (isset($num))?$template->getID()."-sortno":"block_id_sortno"?>" class="form-control" style="display:initial;width: auto;" onChange="block_sort('<?php echo (isset($num) OR 0 == $num)?$template->getID()."-row":"block_id"?>', this)">
						<?php 
						if(isset($num)):
							for($i=1; $i<=count($custom_block->getValue());$i++):
								echo '<option value="' . $i .'" ' . (($num+1 == $i)?'selected="selected"':'') . ' >No.'.$i.'</option>';
							endfor;
						endif;
						?>
					</select>
				</div>
				<!-- tools box -->
				<div class="pull-right" style="margin-top: 3px;">
					<!--<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
						<i class="fa fa-minus"></i></button>&nbsp;&nbsp;-->
					<!--<button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
						<i class="fa fa-times"></i></button>-->
					<button type="button" name="del_block" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" <?php echo isset($num)?'onClick="del_block2(' . "'" . $template->getID()."-row" . "'" . ');"':''; ?>>
						<i class="fa fa-times"></i></button>
				</div>
				<!-- /. tools -->
				
				<div class="menu" style="margin:10px 90px 6px 120px">
					<h3 class="box-title"><?php echo (isset($num) OR 0 == $num)?$template->getListTitle():"タイトルが入ります"?></h3>
					<div style="float:right;margin-top:-7px">
						<!--<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" title="">
							<i class="fa fa-arrow-up"></i></button>-->
						<!--<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" title="">
							<i class="fa fa-arrow-down"></i></button>-->
					</div>
				</div>
			</div>
			<?php
			if(isset($num)){
			//テンプレート設定
			include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/" . $template->getPath() . ".php";
			}
			?>
		</div>
	</div>
</div>