<div class="box box-info sort_box">
	<?php if ($template->useAdd()): ?>
		<?php /* <div class="col-xs-12" style="background-color: #dcd7d7"><p><span><?php //echo $i+1;  ?></span>行目</p></div> */ ?>
	<?php endif; ?>
	<div class="box-header">
		<div>&nbsp;</div>
		<div class="pull-right box-tools" style="margin:0px 0px 5px;">
			<button name="up_button" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" onClick="move_up(this)">
				<i class="fa fa-caret-square-o-up" style="font-size: 1.4em"></i>
			</button>
			<span style="padding:0px 3px"></span>
			<button name="down_button" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" onClick="move_down(this)">
				<i class="fa fa-caret-square-o-down" style="font-size: 1.4em"></i>
			</button>
			<span style="padding:0px 5px"></span>
			<button name="del_button" type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="" onClick="box_del(this)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<table>
			<tr>
				<th width="25" style="font-size:0.8em;padding:5px;text-align: center;">見出</th>
				<td style="padding:5px;"><textarea rows="2" id="<?php echo $template->getId() . "_{$key}_col1"; ?>" name="<?php echo $template->getName(); ?>[col1][]" style="width:100%;height:100%;padding:7px;"><?php echo isset($row["col1"]) ? $row["col1"] : ""; ?></textarea></td>
			</tr>
			<tr>
				<th width="25" style="font-size:0.8em;padding:5px;text-align: center;">内容</th>
				<td style="padding:5px;"><textarea class="editor" rows="5" id="<?php echo $template->getId() . "_{$key}_col2"; ?>" name="<?php echo $template->getName(); ?>[col2][]" style="width:100%"><?php echo isset($row["col2"]) ? $row["col2"] : ""; ?></textarea></td>
			</tr>
		</table>
	</div>
</div>

<?php
if (isset($key)) {
	$content_js["init"][] = <<<"EOT"
	CKEDITOR.replace("{$template->getID()}_{$key}_col2");
EOT;
}
	
