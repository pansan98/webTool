<div class="box box-solid box-success image" id="<?php echo isset($image_num)?$template->getID()."_".$image_num:"box_id"?>">
	<div class="box-body">
		<div class="pull-right box-tools" style="margin:0px 0px 5px;background-color: #7ea2b4">
			<button name="del_button" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" data-original-title="Remove" onclick="<?php echo isset($image_num)?"del_add('{$template->getID()}_{$image_num}')":""; ?>">
				<i class="fa fa-times"></i></button>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-5">
				<div style="padding:3px; border: 1px solid #d2d6de; background-color: #d2d6de">
					<div class="squareBox">
						<div class="content2">
							<div class="centerTable">
								<div class="tableCell">
									<img class="thumb" src="<?php echo isset($image_value["filename"])?"/datas/thumbnail_".$image_value["filename"]:""?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="<?php echo isset($image_value["filename"])?$template->getID() . "[{$image_num}][filename]":"uniq_id"; ?>" id="<?php echo isset($image_value["filename"])?$template->getID() . "_{$image_num}_key":"uniq_id"; ?>" value="<?php echo isset($image_value["filename"])?$image_value["filename"]:""; ?>" />
			</div>
			<div class="col-xs-12 col-sm-7">
				<table class="table table-responsive">
					<col width="40%"/>
					<tr>
						<th>表示名</th>
						<td>
							<div class="input-group col-xs-12">
								<input type="text" class="form-control" name="<?php echo isset($image_value["dispname"])?$template->getID() . "[{$image_num}][dispname]":"dispname_id"?>" id="<?php echo isset($image_value["dispname"])?$template->getID() . "_{$image_num}_dispname":"dispname_id"?>" value="<?php echo isset($image_value["dispname"])?$image_value["dispname"]:"sp[0]"?>">
							</div>
						</td>
					</tr>
					<tr>
						<th>ファイル容量</th>
						<td><span class="filesize"></span><small> byte</small></td>
					</tr>
					<?php /*
					<tr>
						<th>キャプション</th>
						<td>
							<div class="input-group col-xs-12">
								<input type="text" name="caption_id" id="caption_id" class="form-control">
							</div>
						</td>
					</tr>
					*/ ?>
					<tr>
						<th>ALT</th>
						<td>
							<div class="input-group col-xs-12">
								<input type="text" name="<?php echo isset($image_value["alt"])?$template->getID() . "[{$image_num}][alt]":"alt_id"?>" id="<?php echo isset($image_value["alt"])?$template->getID() . "_{$image_num}_alt":"alt_id"?>" class="form-control" value="<?php echo isset($image_value["alt"])?$image_value["alt"]:""?>">
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>