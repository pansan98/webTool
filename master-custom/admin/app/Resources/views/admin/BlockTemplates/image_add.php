<div class="box box-solid box-success image sort_box" id="<?php echo isset($image_num) ? $template->getID() . "-" . $image_num : "box_id" ?>">
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="pull-left box-tools" style="margin:0px 0px 5px;">
					<?php if ($template->useTrimming()): ?>
					<a name="demo01" href="#animatedModal" onclick="init_cropper(this, <?php echo $template->getTrimmingWidth(); ?> , <?php echo $template->getTrimmingHeight(); ?>)">
						<button name="curopper_button" type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="">
							<i class="fa fa-image" style="font-size: 1.4em"></i>
						</button>
					</a>
					<?php endif; ?>
					<?php if(!isset($image_num)):?>
					<script>
						animatedM();
					</script>
					<?php endif; ?>
				</div>
				<div class="pull-right box-tools" style="margin:0px 0px 5px;">
					<button name="up_button" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" onClick="move_up(this)">
						<i class="fa fa-caret-square-o-up" style="font-size: 1.4em"></i>
					</button>
					<span style="padding:0px 3px"></span>
					<button name="down_button" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" onClick="move_down(this)">
						<i class="fa fa-caret-square-o-down" style="font-size: 1.4em"></i>
					</button>
					<span style="padding:0px 5px"></span>
					<button name="del_button" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" onClick="<?php echo (isset($image_num)) ? "del_add_{$template->getID()}('{$template->getID()}-{$image_num}')" : ""; ?>">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			
			<div class="col-xs-12 center">
				<!-- l_col_fix -->
				<div class="l_col_fix">
					<div class="image01">
						<div class="image_center">
							<img src="<?php echo isset($image_num) ? rtrim(THREES__WEB_ROOT_PATH, '/') . $image_value["thumbnail"] : "" ?>" style="max-width:234px; max-height:234px;" name="<?php echo isset($image_num) ? $template->getName() . "[image][]" : "image_id"; ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_image" : "image_id"; ?>">
						</div>
					</div>
					<input type="hidden" name="<?php echo isset($image_num) ? $template->getName() . "[filename][]" : "uniq_id"; ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_filename" : "uniq_id"; ?>" value="<?php echo isset($image_num) ? $image_value["filename"] : ""; ?>" />
					<input type="hidden" name="<?php echo isset($image_num) ? $template->getName() . "[preview][]" : "preview_id"; ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_preview" : "preview_id"; ?>" value="" />
				</div>
				<!-- /l_col_fix -->

				<!-- r_col_liquid -->
				<div class="r_col_liquid">

					<!-- r_contents -->
					<div class="r_contents">

						<table class="table" style="background:white;">
							<col width="90px"/>
							<tr>
								<th style="padding:3px;">サイズ</th>
								<td style="padding:5px;">
									<div><small>[容量]</small><span class="filesize" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["size"]) : "" ?></span><small>Byte</small></div>
									<div><small>[横幅]</small><span class="size_width" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["width"]) : "" ?></span><small>px</small> <small>[縦幅]</small><span class="size_height" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["height"]) : "" ?></span><small>px</small></div>
								</td>
							</tr>
							<tr>
								<th style="padding:3px;">ファイル名</th>
								<td style="padding:5px;">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control" name="<?php echo isset($image_num) ? $template->getName() . "[dispname][]" : "dispname_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_dispname" : "dispname_id" ?>" value="<?php echo isset($image_num) ? $image_value["dispname"] : "sp[0]" ?>">
									</div>
								</td>
							</tr>
							<tr>
								<th style="padding:3px;">ALT</th>
								<td style="padding:5px;">
									<div class="input-group col-xs-12">
										<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[alt][]" : "alt_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_alt" : "alt_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["alt"] : "" ?>">
									</div>
								</td>
							</tr>
							<?php if ($template->useCaption()): ?>
								<tr>
									<th style="padding:3px;">キャプション</th>
									<td style="padding:5px;">
										<div class="input-group col-xs-12">
											<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[caption][]" : "caption_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_caption" : "captiont_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["caption"] : "" ?>">
										</div>
									</td>
								</tr>
							<?php endif; ?>
							<?php if ($template->useURL()): ?>
								<tr>
									<th style="padding:3px;">URL</th>
									<td style="padding:5px;">
										<div class="input-group col-xs-12">
											<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[url][]" : "url_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_url" : "url_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["url"] : "" ?>">
											<input type="checkbox" name="<?php echo isset($image_num) ? $template->getName() . "[target][]" : "target_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_target" : "target_id" ?>" value="1" <?php echo isset($image_num) ? ("1" == $image_value["target"] ? "checked" : "") : ""; ?>>
											<label for="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_target" : "target_id" ?>"><small>&nbsp;新しいウインドウで開く</small></label>
										</div>
									</td>
								</tr>
							<?php endif; ?>
						</table>

					</div>
					<!-- /r_contents -->

				</div>
				<!-- /r_col_liquid -->

			</div>
			<?php
			/*
			<div class="col-xs-12 col-sm-5">
				<!-- 添付エリア -->
				<div style="padding:3px; border: 1px solid #d2d6de; background-color: #d2d6de">
					<div class="squareBox">
						<div class="content2">
							<div class="centerTable">
								<div class="tableCell">
									<img class="thumb" src="<?php echo isset($image_num) ? "/datas/thumbnail_" . $image_value["filename"] : "" ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="<?php echo isset($image_num) ? $template->getName() . "[filename][]" : "uniq_id"; ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_key" : "uniq_id"; ?>" value="<?php echo isset($image_num) ? $image_value["filename"] : ""; ?>" />
				<input type="hidden" name="<?php echo isset($image_num) ? $template->getName() . "[preview][]" : "preview_id"; ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_preview" : "preview_id"; ?>" value="" />
			</div>
			<div class="col-xs-12 col-sm-7">
				<table class="table table-responsive">
					<col width="90px"/>
					<tr>
						<th style="padding:3px;">サイズ</th>
						<td style="padding:5px;">
							<div><small>[容量]</small><span class="filesize" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["size"]) : "" ?></span><small>Byte</small></div>
							<div><small>[横]</small><span class="size_width" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["width"]) : "" ?></span><small>px</small> <small>[縦]</small><span class="size_height" style="margin:0px 2px;"><?php echo isset($image_num) ? number_format($image_value["height"]) : "" ?></span><small>px</small></div>
						</td>
					</tr>
					<tr>
						<th style="padding:3px;">ファイル名</th>
						<td style="padding:5px;">
							<div class="input-group col-xs-12">
								<input type="text" class="form-control" name="<?php echo isset($image_num) ? $template->getName() . "[dispname][]" : "dispname_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "-{$image_num}_dispname" : "dispname_id" ?>" value="<?php echo isset($image_num) ? $image_value["dispname"] : "sp[0]" ?>">
							</div>
						</td>
					</tr>
					<tr>
						<th style="padding:3px;">ALT</th>
						<td style="padding:5px;">
							<div class="input-group col-xs-12">
								<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[alt][]" : "alt_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_alt" : "alt_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["alt"] : "" ?>">
							</div>
						</td>
					</tr>
					<?php if ($template->useCaption()): ?>
						<tr>
							<th style="padding:3px;">キャプション</th>
							<td style="padding:5px;">
								<div class="input-group col-xs-12">
									<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[caption][]" : "caption_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_caption" : "captiont_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["caption"] : "" ?>">
								</div>
							</td>
						</tr>
					<?php endif; ?>
					<?php if ($template->useURL()): ?>
						<tr>
							<th style="padding:3px;">URL</th>
							<td style="padding:5px;">
								<div class="input-group col-xs-12">
									<input type="text" name="<?php echo isset($image_num) ? $template->getName() . "[url][]" : "url_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_url" : "url_id" ?>" class="form-control" value="<?php echo isset($image_num) ? $image_value["url"] : "" ?>">
									<input type="checkbox" name="<?php echo isset($image_num) ? $template->getName() . "[target][]" : "target_id" ?>" id="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_target" : "target_id" ?>" value="1" <?php echo isset($image_num) ? ("1" == $image_value["target"] ? "checked" : "") : ""; ?>>
									<label for="<?php echo isset($image_num) ? $template->getID() . "_{$image_num}_target" : "target_id" ?>"><small>&nbsp;新しいウインドウで開く</small></label>
								</div>
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
			*/
			?>
		</div>
	</div>
</div>