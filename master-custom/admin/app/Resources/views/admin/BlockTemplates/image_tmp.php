<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<?php if($template->isTitle()): ?>
	<p><?php echo $template->getTitle(); ?></p>
	<?php endif; ?>
	<div class="row">
		<div id="<?php echo $template->getID(); ?>--output" class="col-xs-12 output">
		<?php foreach($template->getValue() as $image_num => $image_value): ?>
			<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php"; ?>
		<?php endforeach;
		$image_num = $image_value = NULL;
		?>
		</div>
		<div class="col-xs-12">
			<div id="<?php echo $template->getID(); ?>--droparea" class="droparea"><p>ここにファイルをドロップ</p><p>または</p><p>領域内をクリック</p></div>
			<input id="<?php echo $template->getID(); ?>_fileInput" class="droparea" name="<?php echo $template->getName(); ?>_fileInput[]" type="file" accept="image/*" multiple>
		</div>
		<?php if($template->useExplanation()): ?>
		<div class="col-xs-12">
			<table class="table table-responsive">
				<col width="30%"/>
				<tr><th>添付可能枚数</th><td>最大<?php echo $template->getMaxNumber() ?>枚まで添付可能です。</td></tr>
				<tr><th>ファイル容量</th><td>1枚あたり<?php echo $template->getOneMaxCapacity() ?>MByte以内のファイルを添付できます。</td></tr>
				<tr><th>最大ピクセル数</th><td>縦横どちらか長い辺の最大が2,000px以内のものをアップしてください。</td></tr>
				<tr><th>ファイルの種類</th><td>JPGファイル、GIFファイル、PNGファイルがアップ出来ます。<br />※PNGファイルの場合、透過が正しく処理されない場合がございます。<br />※アニメーションGIFは対応しておりません。</td></tr>
			</table>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>

<?php {
	ob_start();
	include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php";
	$ret = ob_get_contents();
	ob_end_clean();
	$content_template_tags["image_add"] = <<< "EOT"
	<template id="template_image_add">
		{$ret}
	</template>
EOT;
} ?>
<?php

$content_js["init"][] = <<<"EOT"
EOT;

$content_js["raw"][] = <<<"EOT"
	function del_add(id){
		$("#" + id).remove();
		
		//最大枚数以下の場合は
		chk_droparea('{$template->getID()}');
	}
		
	function chk_droparea(id){
		block_childrens = $("#" + id + "--output").children();
		if({$template->getMaxNumber()} > block_childrens.length){
			$("#" + id + "--droparea").show();
		}else{
			$("#" + id + "--droparea").hide();
		}
	}
EOT;
		
$content_js["raw"][] = <<<"EOT"
document.addEventListener('DOMContentLoaded', function () {
	var dropArea = document.getElementById('{$template->getID()}--droparea');
	var output = document.getElementById('{$template->getID()}--output');
	// 画像の最大ファイルサイズ
	var maxSize = {$template->getOneMaxCapacity()} * 1024 * 1024;
	
	// ドロップされたファイルの整理
	function organizeFiles(files) {
		var id = "{$template->getID()}";
		var length = files.length;
		var i = 0;
		var file;
		
		//枚数制限
		var now_count = document.getElementById('{$template->getID()}--output').childElementCount;
	
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
			if (file.size > maxSize) {
				alert("「" + file.name + "」はファイルサイズが{$template->getOneMaxCapacity()}MByteを超えている為添付できませんでした。");
				continue;
			}

			// 画像出力処理へ進む
			outputImage(id, now_count, file);
			now_count++;
			
		}
		
	}

	// 画像の出力
	function outputImage(id, num, blob) {

		// 画像要素の生成
		var image = new Image();
		// File/BlobオブジェクトにアクセスできるURLを生成
		var blobURL = URL.createObjectURL(blob);
		var reader = new FileReader();
		reader.readAsDataURL(blob);
		reader.onload = function () {
			template_image_add(id, num, output, reader.result, blob);
			chk_droparea('{$template->getID()}');
		};
		
	}
	
	//外部化
	function template_image_add(id, num, output, base64, blob) {

		//テンプレート取得
		var t = document.querySelector('#template_image_add');
		var clone = document.importNode(t.content, true);

		var ele;
		ele = clone.querySelector('#box_id');
		ele.id = id + "_" + num;

		ele = clone.querySelector('button[name="del_button"]');
		ele.onclick= function() { // onclick には関数を入れる
			del_add(id + "_" + num);
		};
	
		ele = clone.querySelector('div.box-body img');
		ele.src = base64;

		ele = clone.querySelector('input[name="uniq_id"]');
		ele.id = id + "_" + num + "_filename";
		ele.name = id + "[" + num + "][filename]";

		ele = clone.querySelector('#dispname_id');
		ele.id = id + "_" + num + "_dispname";
		ele.name = id + "[" + num + "][dispname]";
		ele.value = blob["name"].split('.')[0];

		ele = clone.querySelector('span.filesize');
		ele.innerHTML = blob["size"].toLocaleString();

		//ele = clone.querySelector('input[name="caption_id"]');
		//ele.id = id + "_" + num + "_caption";
		//ele.name = id + "[" + num + "][caption]";

		ele = clone.querySelector('input[name="alt_id"]');
		ele.id = id + "_" + num + "_alt";
		ele.name = id + "[" + num + "][alt]";

		output.appendChild(clone);

	}
	
	// ドラッグ中の要素がドロップ要素に重なった時
	dropArea.addEventListener('dragover', function (ev) {
		ev.preventDefault();

		// ファイルのコピーを渡すようにする
		ev.dataTransfer.dropEffect = 'copy';
		dropArea.classList.add('dragover');
	});

	// ドラッグ中の要素がドロップ要素から外れた時
	dropArea.addEventListener('dragleave', function () {
		dropArea.classList.remove('dragover');
	});

	// ドロップ要素にドロップされた時
	dropArea.addEventListener('drop', function (ev) {
		ev.preventDefault();

		dropArea.classList.remove('dragover');
		//output.textContent = '';

		// ev.dataTransfer.files に複数のファイルのリストが入っている
		organizeFiles(ev.dataTransfer.files);
	});

	// #dropArea がクリックされた時
	dropArea.addEventListener('click', function () {
		{$template->getID()}_fileInput.click();
	});

	// ファイル参照で画像を追加した場合
	{$template->getID()}_fileInput.addEventListener('change', function (ev) {
		//output.textContent = '';

		// ev.target.files に複数のファイルのリストが入っている
		organizeFiles(ev.target.files);

		// 値のリセット
		{$template->getID()}_fileInput.value = '';
	});
});
EOT;
