<?php $class = $tempalte->getId(); ?>
<?php if (!Empty($tempalte->getTitle()) OR ! Empty($tempalte->getHeaderComment())): ?>
	<div class="box-body pad header">
		<?php if (!Empty($tempalte->getTitle())): ?>
			<h4><?php echo $tempalte->getTitle(); ?></h4>
		<?php endif; ?>
		<?php
		if (!Empty($tempalte->getHeaderComment())):
			echo $tempalte->getHeaderComment();
		endif;
		?>
	</div>
<?php endif; ?>
<div class="box-body contents">
	<div>
		<div class="col-xs-12" style="background-color: #dcd7d7"><p>1行目</p></div>
		<div class="col-xs-12 col-sm-4" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<td style="width: 10px">見出し</td>
					<td><textarea rows="5" style="width:100%">見出し１</textarea></td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-4" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<td style="width: 10px">内容１</td>
					<td><textarea rows="5" style="width:100%">内容１</textarea></td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-4" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<td style="width: 10px">内容２</td>
					<td><textarea rows="5" style="width:100%">内容２</textarea></td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<div class="col-xs-12" style="background-color: #dcd7d7"><p>2行目</p></div>
		<div class="col-xs-12 col-sm-6" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<th style="width: 10px">見出し</th>
					<td><textarea rows="5" style="width:100%">見出し2</textarea></td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-6" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<th style="width: 10px">内容</th>
					<td><textarea rows="5" style="width:100%">内容2</textarea></td>
				</tr>
			</table>
		</div>
	</div>
	<div>
		<div class="col-xs-12" style="background-color: #dcd7d7"><p>3行目</p></div>
		<div class="col-xs-12 col-sm-6" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<th style="width: 10px">見出し</th>
					<td><textarea rows="5" style="width:100%">見出し3</textarea></td>
				</tr>
			</table>
		</div>
		<div class="col-xs-12 col-sm-6" style="padding-right:0px;padding-left: 0px;">
			<table class="table table-bordered" style="margin-bottom: 0px;">
				<tr>
					<th style="width: 10px">内容</th>
					<td><textarea rows="5" style="width:100%">内容3</textarea></td>
				</tr>
			</table>
		</div>
	</div>
	

	<div><input type="button">追加</button></div>
</div>
<?php if (!Empty($tempalte->getFooterComment())): ?>
	<div class="box-body pad footer"><?php echo $tempalte->getFooterComment(); ?></div>
<?php endif; ?>
