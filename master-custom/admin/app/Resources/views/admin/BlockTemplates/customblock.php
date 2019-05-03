<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<?php $custom_block = $template; ?>
<div class="box-body pad" id="block_area">
	<?php
	foreach ($custom_block->getValue() as $num => $template):
		include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/frame.php";
	endforeach;
	$num = NULL;
	?>
</div>
<div class="box-body pad">
	<div class="form-group">
		<select class="form-control select2" id="template_list">
			<option value="" selected="selected">追加したいレイアウトを選択して下さい</option>
			<?php foreach ($custom_block->_list_data as $template): ?>
				<option value="<?php echo $template->getId(); ?>">
					<?php echo $template->getListTitle(); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<button type="button" class="btn btn-primary" onclick="add_block();return false;">追加</button>
</div>
<div class="box-footer"></div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>

<template id="template_frame">
	<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/frame.php"; ?>
</template>
<?php /* foreach ($custom_block->_list_data as $template): ?>
  <template id="template_<?php echo $template->getId(); ?>">
  <?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/{$template->getPath()}.php"; ?>
  </template>
  <?php endforeach; */ ?>
<?php
$root_path = THREES__WEB_ROOT_PATH;
$content_js["raw"][] = <<<"EOT"

    function del_block(id) {
		
		if(window.confirm('削除します。よろしいですか？')){
			$("#" + id).remove();
		}
		
	}
	function del_block2(id) {
		
		if(window.confirm('削除します。よろしいですか？')){
			$("#" + id).remove();
			re_sort ();
		}
		
	}	
	function re_sort() {
		//並び順書換
		var block_childrens = $('#block_area').children();
		var length = block_childrens.length;
		var block;
		
		for (i = 1; i <= block_childrens.length; i++) {
			block = block_childrens[i-1];
			block_id = block.id;
			id = block_id.split("-")[0];

			$('#' + id + '-sortno').children().remove();
		
			ele = block.querySelector('#' + id + '-sortno');
			for(j = 1; j <= block_childrens.length; j++) {
				var option = document.createElement('option');
				option.setAttribute('value', j);
				option.innerHTML = 'No.' + j;
				if (i === j) {
					option.setAttribute('selected', "selected");
				}
				ele.append(option);
			}
		}
	}
		
	function add_block() {
		
		var block_id = "customblock";
		
		//選択されたテンプレートをブロック要素の最後に追加
		var template_name = $("#template_list").val();

		//枠を読み込む
		var frame = document.querySelector('#template_frame');
		var clone_frame = document.importNode(frame.content, true);

		//サーバからIDを取得
		var new_block_id = create_block_id(template_name);

		//id
		var ele;
		ele = clone_frame.querySelector('#block_id');
		ele.id = new_block_id + "-row";

		//Title
		ele = clone_frame.querySelector('div.box-header .box-title');
		ele.innerHTML = $("#template_list option:selected").text();

		//delete
		ele = clone_frame.querySelector('button[name="del_block"]');
		ele.onclick= function() { // onclick には関数を入れる
			del_block(new_block_id + "-row");//id + "-" + num
		};
			
		//並び順生成
		ele = clone_frame.querySelector('#block_id_sortno');
		ele.id = new_block_id + "-sortno";
		var block_childrens = $('#block_area').children();
		for (i = 1; i <= block_childrens.length + 1; i++) {
			var option = document.createElement('option');
			option.setAttribute('value', i);
			option.innerHTML = 'No.' + i;
			if (i === (block_childrens.length + 1)) {
				option.setAttribute('selected', "selected");
			}
			ele.append(option);
		}

		//----------------------------------
		// body部分はAjax化しサーバから取得
		block = create_block(block_id, new_block_id, template_name);
		
		//内容を読み込む
		//var body = document.querySelector('#template_' + template_name);
		
		//alert(body.content);
		
		//内容の挿入用クローン作成
		//var clone_body = document.importNode(body.content, true);
		
		//内容のid,nameを書き換え
		//ele = clone_body.querySelector('#' + template_name);
		//alert(ele);
		//alert(ele.id);
		//alert(ele.name);
		//ele.id = ele.id + "__" + new_block_id;
		//ele.name = ele.name + "[]";
		
		//----------------------------------
		
		//内容をフレームに適用
		//clone_frame.querySelector('.box-header').after(clone_body);
		
		//ele = clone_frame.querySelector('.box-info');
		//document.createTextNode('just some text')
		//ele.appendHTML(block);
		
		//ユニークIDやソート番号などを設定
		//各子ブロックのソートリストに追加
		var block_area = document.getElementById('block_area');
		block_area.appendChild(clone_frame);

		//ブロック要素を追加
		$("#" + new_block_id + "-row div.box-success").append(block);
		
		//既存要素に並び順を追加
		var add_option = document.createElement('option');
		var children_count = block_childrens.length + 1;
		for (i = 0; i < block_childrens.length; i++) {
			block_id = (block_childrens[i].id).split("-")[0];
			$("#" + block_id + "-sortno").append($('<option>').html("No." + children_count).val(children_count));
		}
	}

	function create_block_id() {
		var fd = new FormData();
		var new_block_id = "";
		fd.append("auth_key", "2TrVBQZApkdCZHjMTh7L9ZfhuFyHBJnx");
		$.ajax({
			url: "{$root_path}api/block/new",
			type: "POST",
			data: fd,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json"
		})
		.done(function (data, textStatus, jqXHR) {
			if (data["STATUS"] === "SUCCESS") {
				new_block_id = data["DATAS"]["BLOCK_ID"];
			}
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			alert(textStatus);
			alert(errorThrown);
		});
		return new_block_id;
	}
		
	function create_block(block_id, uid, template_name) {
		var fd = new FormData();
		var new_block = "";
		fd.append("syspath", "{$document->getDocumentPath()}");
		fd.append("block_id", block_id);
		fd.append("uid", uid);
		fd.append("template_name", template_name);
		$.ajax({
			url: "{$root_path}api/block/add",
			type: "POST",
			data: fd,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "html"
		})
		.done(function (data, textStatus, jqXHR) {
			new_block = data;
			//if (data["STATUS"] === "SUCCESS") {
			//	new_block_id = data["DATAS"]["BLOCK_ID"];
			//}
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			alert(textStatus);
			alert(errorThrown);
		});
		return new_block;
	}

	function block_sort(block_id, obj) {

		var move_num = parseInt(obj.value);

		block_id = (obj.id).split("-")[0];
		//ブロックを取得
		
		var move_block = document.getElementById(block_id + "-row");
		
		//ブロック全体
		var block_childrens;
		var current_num = 0;
		block_childrens = $('#block_area').children();
		for (i = 0; i < block_childrens.length; i++) {
			if (block_childrens[i].id == block_id + "-row") {
				current_num = i;
				break;
			}
		}

		//指定位置取得
		var target_block = document.getElementById(block_childrens[move_num - 1].id);
		
		if (current_num >= move_num) {
			//上に挿入
			document.getElementById('block_area').insertBefore(move_block, target_block);
		} else {
			//下に挿入
			document.getElementById('block_area').insertBefore(move_block, target_block.nextElementSibling);
		}
		//ckeditor復元
		ckeditors = $("#" + move_block.id + " textarea.editor");
		for(let i = 0; i < ckeditors.length; i++) {
			CKEDITOR.instances[ckeditors[i].id].destroy();
			CKEDITOR.replace(ckeditors[i].id);
		}
		
		//並び順書換
		block_childrens = $('#block_area').children();
		for (i = 0; i < block_childrens.length; i++) {
			block_id = (block_childrens[i].id).split("-")[0];
			$("#" + block_id + "-sortno").val(i + 1);
		}
	}
EOT;
