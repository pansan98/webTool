<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<?php if ($template->isTitle()): ?>
		<p><?php echo $template->getTitle(); ?></p>
	<?php endif; ?>
	<div class="row">
		<div id="<?php echo $template->getId(); ?>--output" class="col-xs-12 output">
			<?php $i = 0;
			foreach ($template->getValue() as $image_num => $image_value): $i++; ?>
				<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php"; ?>
<?php endforeach; ?>
		</div>
		<div class="col-xs-12">
			<div id="<?php echo $template->getId(); ?>--droparea" class="droparea" <?php echo ($template->getMaxNumber() <= $i) ? 'style="display:none;"' : '' ?>><p>ここにファイルをドロップ</p><p>または</p><p>領域内をクリック</p></div>
			<input type="hidden" name="<?php echo $template->getName(); ?>[dummy]" value="">
			<input id="<?php echo $template->getId(); ?>_fileInput" class="droparea" name="<?php echo $template->getName(); ?>_fileInput[]" type="file" accept="image/*" multiple>
		</div>
<?php if ($template->useExplanation()): ?>
			<div class="col-xs-12">
				<table class="table table-responsive">
					<col width="100px"/>
					<?php if ($template->isComment()): ?>
		<?php foreach ($template->getComments() as $title => $comment): ?>
							<tr>
								<th style="padding:3px;"><?php echo $title; ?></th>
								<td style="padding:5px;font-size:0.9em;"><?php echo $comment; ?></td>
							</tr>
						<?php endforeach; ?>
	<?php endif; ?>
					<tr>
						<th style="padding:3px;">添付可能枚数</th>
						<td style="padding:5px;font-size:0.9em;">最大 <strong><?php echo $template->getMaxNumber() ?>枚 </strong>まで添付可能です</td>
					</tr>
					<tr>
						<th style="padding:3px;">ファイル容量</th>
						<td style="padding:5px;font-size:0.9em;">1枚あたり <strong><?php echo $template->getOneMaxCapacity() ?>MByte </strong>以内のファイルが添付可能です</td>
					</tr>
					<tr>
						<th style="padding:3px;">ファイルの種類</th>
						<td style="padding:5px;font-size:0.9em;">JPG/GIF/PNGのみ利用可能です<br />※PNGは透過が正しく処理されない場合があります<br />※アニメーションGIFは未対応です</td>
					</tr>
				</table>
			</div>
		<?php endif; ?>
	</div>
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_error.php" ?>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>

<?php {
	$image_num = $image_value = NULL;
	ob_start();
	include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php";
	$ret = ob_get_contents();
	ob_end_clean();
	$content_template_tags["image_add_" . $template->getId()] = <<< "EOT"
	<template id="template_image_add_{$template->getId()}">
		{$ret}
	</template>
EOT;
}
?>
<?php
$content_js["init"][] = <<<"EOT"
	$("a[name='demo01']").animatedModal();
	$("button[name='demo01']").animatedModal();
EOT;

$content_js["raw"][] = <<<"EOT"

	function animatedM() {
		$("a[name='demo01']").animatedModal();
		$("button[name='demo01']").animatedModal();
	}
	
	function del_add_{$template->getId()}(id){	
	
		if(window.confirm('削除します。よろしいですか？')){
			$("#" + id).remove();
		
			//最大枚数以下の場合は
			chk_droparea_{$template->getId()}('{$template->getId()}');
		}
			
	}
		
	function chk_droparea_{$template->getId()}(id){
		block_childrens = $("#" + id + "--output").children();
		if({$template->getMaxNumber()} > block_childrens.length){
			$("#" + id + "--droparea").show();
		}else{
			$("#" + id + "--droparea").hide();
		}
	}
EOT;

$content_js["raw"][] = <<<"EOT"
	var dropArea_{$template->getId()} = document.getElementById('{$template->getId()}--droparea');
	var output_{$template->getId()} = document.getElementById('{$template->getId()}--output');
	// 画像の最大ファイルサイズ
	var maxSize_{$template->getId()} = {$template->getOneMaxCapacity()} * 1024 * 1024;
	
	// ドロップされたファイルの整理
	function organizeFiles_{$template->getId()}(files) {
		var id = "{$template->getId()}";
		var name = "{$template->getName()}";
		var length = files.length;
		var i = 0;
		var file;
		
		//枚数制限
		var now_count = document.getElementById('{$template->getId()}--output').childElementCount;
	
		for (; i < length; i++) {

			if(now_count >= {$template->getMaxNumber()}){
				alert("添付可能枚数({$template->getMaxNumber()}枚)になりました。これ以上添付できません。");
				return;
			}
		
			// file には Fileオブジェクト というローカルのファイル情報を含むオブジェクトが入る
			file = files[i];

			// 画像以外は無視
			if (!file || file.type.indexOf('image/') < 0) {
				alert("「" + file.name + "」は画像ファイルではない為添付できません。(対応ファイル:JPGファイル、GIFファイル、PNGファイル)");
				continue;
			}

			// 指定したサイズを超える画像は無視
			if (file.size > maxSize_{$template->getId()}) {
				alert("「" + file.name + "」はファイルサイズが{$template->getOneMaxCapacity()}MByteを超えている為添付できませんでした。");
				continue;
			}

			// 画像出力処理へ進む
			outputImage_{$template->getId()}(id, name, now_count, file);
			now_count++;
			
		}
		
	}

	// 画像の出力
	function outputImage_{$template->getId()}(id, name, num, blob) {

		// 画像要素の生成
		var image = new Image();
		// File/BlobオブジェクトにアクセスできるURLを生成
		var blobURL = URL.createObjectURL(blob);
		image.src = blobURL;
	
		var base64 = "";
		var height = "";
		var width = "";
	
		// 画像読み込み完了後
		image.addEventListener('load', function () {
			
			height = image.height;
			width = image.width;
	
			if(base64 != "" && height != "" && width != ""){
				template_image_add_{$template->getId()}(id, name, num, output_{$template->getId()}, base64, blob["name"], blob["size"].toLocaleString(), height, width);
				chk_droparea_{$template->getId()}('{$template->getId()}');
			
				// File/BlobオブジェクトにアクセスできるURLを開放
				URL.revokeObjectURL(blobURL);
			}
			
		});
	
		var reader = new FileReader();
		reader.readAsDataURL(blob);
		reader.onload = function () {
			base64 = reader.result;
			
			if(base64 != "" && height != "" && width != ""){
				template_image_add_{$template->getId()}(id, name, num, output_{$template->getID()}, base64, blob["name"], blob["size"].toLocaleString(), height, width);
				chk_droparea_{$template->getID()}('{$template->getID()}');
			
				// File/BlobオブジェクトにアクセスできるURLを開放
				URL.revokeObjectURL(blobURL);
			}
		};
		
	}
	
	//外部化
	function template_image_add_{$template->getID()}(id, name, num, output_{$template->getID()}, base64, filename, filesize, height, width) {

		//テンプレート取得
		var t = document.querySelector('#template_image_add_{$template->getID()}');
		var clone = document.importNode(t.content, true);

		var ele;
		ele = clone.querySelector('#box_id');
		ele.id = id + "_" + num;

		ele = clone.querySelector('button[name="del_button"]');
		ele.onclick= function() { // onclick には関数を入れる
			del_add_{$template->getID()}(id + "_" + num);//id + "_" + num
		};
	
		ele = clone.querySelector('div.box-body img');
		ele.src = base64;

		ele = clone.querySelector('input[name="uniq_id"]');
		ele.id = id + "_" + num + "_filename";
		ele.name = name + "[filename][]";

		ele = clone.querySelector('img[name="image_id"]');
		ele.id = id + "_" + num + "_image";
		ele.name = name + "[image][]";
			
		ele = clone.querySelector('input[name="preview_id"]');
		ele.id = id + "_" + num + "_preview";
		ele.name = name + "[preview][]";
			
		ele = clone.querySelector('#dispname_id');
		ele.id = id + "_" + num + "_dispname";
		ele.name = name + "[dispname][]";
		ele.value = filename.split('.')[0];

		//ファイルサイズ
		ele = clone.querySelector('span.filesize');
		ele.innerHTML = filesize.toLocaleString();
		
		//縦px
		ele = clone.querySelector('span.size_height');
		ele.innerHTML = height;
		
		//横px
		ele = clone.querySelector('span.size_width');
		ele.innerHTML = width;
		
		ele = clone.querySelector('input[name="alt_id"]');
		if(null !== ele) {
			ele.id = id + "_" + num + "_alt";
			ele.name = name + "[alt][]";
		}
			
		ele = clone.querySelector('input[name="caption_id"]');
		if(null !== ele) {
			ele.id = id + "_" + num + "_caption";
			ele.name = name + "[caption][]";
		}
		
		ele = clone.querySelector('input[name="url_id"]');
		if(null !== ele) {
			ele.id = id + "_" + num + "_url";
			ele.name = name + "[url][]";
		}
		
		output_{$template->getID()}.appendChild(clone);

	}
	
	// ドラッグ中の要素がドロップ要素に重なった時
	dropArea_{$template->getID()}.addEventListener('dragover', function (ev) {
		ev.preventDefault();

		// ファイルのコピーを渡すようにする
		ev.dataTransfer.dropEffect = 'copy';
		dropArea_{$template->getID()}.classList.add('dragover');
	});

	// ドラッグ中の要素がドロップ要素から外れた時
	dropArea_{$template->getID()}.addEventListener('dragleave', function () {
		dropArea_{$template->getID()}.classList.remove('dragover');
	});

	// ドロップ要素にドロップされた時
	dropArea_{$template->getID()}.addEventListener('drop', function (ev) {
		ev.preventDefault();

		dropArea_{$template->getID()}.classList.remove('dragover');
		//output_{$template->getID()}.textContent = '';

		// ev.dataTransfer.files に複数のファイルのリストが入っている
		organizeFiles_{$template->getID()}(ev.dataTransfer.files);
	});

	// #dropArea_{$template->getID()} がクリックされた時
	dropArea_{$template->getID()}.addEventListener('click', function () {
		{$template->getID()}_fileInput.click();
	});

	// ファイル参照で画像を追加した場合
	{$template->getID()}_fileInput.addEventListener('change', function (ev) {
		//output_{$template->getID()}.textContent = '';

		// ev.target.files に複数のファイルのリストが入っている
		organizeFiles_{$template->getID()}(ev.target.files);

		// 値のリセット
		{$template->getID()}_fileInput.value = '';
	});
EOT;
