<?php if(!Empty($setting["header_comment"])): ?>
<div class="box-body pad header"><?php echo $setting["header_comment"]; ?></div>
<?php endif;?>
<div class="box-body contents">
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<div id="dropArea" style="height: 100%">"ファイルをドラッグ"<br>又は<br>"領域内をクリック"</div>
			<input id="fileInput3" type="file" accept="image/*" multiple>
			<div id="output"></div>
		</div>
		<div class="col-xs-12 col-sm-7">
			<div>
				<button type="button" class="btn btn-primary btn-sm">ファイルダウンロード</button>
				<button type="button" class="btn btn-danger btn-sm">ファイル削除</button>
			</div>
			<br>
			<div>
				<dl>
					<dt>ファイルサイズ</dt>
					<dd>
						<div class="input-group col-xs-12">
							<input type="text" class="form-control">
						</div>
					</dd>
					<dt>表示名</dt>
					<dd>
						<div class="input-group col-xs-12">
							<input type="text" class="form-control">
						</div>
					</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
<?php if(!Empty($setting["footer_comment"])): ?>
<div class="box-body pad footer"><?php echo $setting["footer_comment"]; ?></div>
<?php endif;?>