<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $meta["page"]["title"]; ?><small></small>
	</h1>
	<ol class="breadcrumb hidden-sm hidden-xs">
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo $meta["breadcrumbs"]["current"]["title"]; ?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box notop">
				<div class="box-body">
					<a href="<?php echo $meta["page"]["path"]; ?>new" class="btn btn-primary"><i class="fa fa-plus-square"></i> 新規作成</a>
					<?php if (isset($meta["category"]) AND $meta["category"] === true): ?>
						<a href="<?php echo $meta["page"]["path"]; ?>category/" class="btn btn-success" style="float:right;"><i class="fa fa-tags"></i> カテゴリ</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- Default box -->
			<div class="box notop">
				<!--<div class="box-header"></div>-->
				<div class="box-body">
					<div class="form-group search_box">
						<label class="control-label text-right" style="float: left;">カテゴリ選択：</label>
						<div class="input-group">
							<select name="search_category" class="form-control">
								<?php foreach ($datas["category"] as $key => $category): ?>
									<option value="<?php echo $key; ?>"><?php echo $category["title"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<hr>
					<table id="table_id" class="table table-hover"></table>
				</div>
				<!-- /.box-body -->
				<!--<div class="box-footer"></div>-->
				<!-- /.box-footer-->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<!-- /.content -->

<?php
// DataTables
$content_js["file"]["datatables"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>';
$content_js["file"]["datatables2"] = '<script src="https://take-lab.com/datatables/js/dataTables.responsive_complex.js"></script>';
$content_js["file"]["datatables-bs"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
$content_js["file"]["datatables-buttons"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.buttons/js/dataTables.buttons.js"></script>';
$content_js["file"]["datatables-buttons-html5"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.buttons/js/buttons.html5.min.js"></script>';

$content_js["raw"][] = <<<"EOT"
	var table;
	
	function search() {
		var category = $('select[name=search_category] option:selected').val();
						
		var search_data = {};
		search_data["category"] = category;
						
		search_json = JSON.stringify(search_data);
		table.search(search_json).draw();
	}
	
	function copy(id) {
		var myRet = confirm("複製します。よろしいですか？");
		if(myRet){
			location.href = "{$meta["page"]["path"]}new?copy=" + id;
		}
	}
	function table_resize(){
		parent = $('#table_id_processing').parents('.box');
		$("#table_id_processing").width(parent.width());
		$("#table_id_processing").height(parent.height());
	}
EOT;
$root_path = THREES__WEB_ROOT_PATH;
$content_js["init"][] = <<<"EOT"

	$.extend($.fn.dataTable.defaults, {
		language: {url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"}
	});
		
	table = $('#table_id').DataTable({
		language: {
			processing: '<span>データ取得中...<i class="fa fa-spinner fa-pulse"></i></span>',
			lengthMenu: "表示件数 : _MENU_",
			zeroRecords: "データ無し",
			info: " _TOTAL_ 件中 _START_ 件から _END_ 件まで表示",
			infoEmpty: " 表示するデータがありません",
			infoFiltered: "（全 _MAX_ 件より抽出）",
			infoPostFix: "",
			search: "検索:",
			url: "",
			paginate: {
				first: "先頭",
				previous: "前へ",
				next: "次へ",
				last: "最終"
			},
		},
		paging: true,
		info: true,
		stateSave: true,
		lengthChange: true,
		lengthMenu: [
			[3, 5, 10, 25, 50, 75, 100, 250, 500], 
			["3件", "5件", "10件", "25件", "50件", "75件", "100件", "250件", "500件"]
		],
		displayLength: 10,
		searching: true,
		//sScrollX: true,
		autoWidth: false,
		bStateSave: true,
		bProcessing: true,
		bServerSide: true, //ソート&ページング維持
		ordering: true,
		order: [[ 2, 'desc' ]],
		orderCellsTop: true,
		columnDefs: [{
			orderable: false,
			targets: [0, 1, 3, 4, -1, -2]
		}],
		dom: '<"top"Blip>rt<"bottom"i><"clear">',
		buttons: [
			{
				text: '<i class="fa fa-refresh"></i> データ再取得',
					action: function (e, dt, node, config) {
						search();
					}
			},
		],
		ajax: {
			url: '{$meta["base"]["path"]}json',
			dataSrc: 'data'
		},
		aoColumns: [
			{sTitle: "No", mData: "id"},
			{sTitle: "", mData: "id", width: "45px"
				, "render": function (data, type, row) {
					return '<button><a href="{$meta["page"]["path"]}new?copy=' + data + '">複製</a></button>';
				}
			},
			{sTitle: "公開日", mData: "public_date", width:"85px", "sClass": "center"},
			{sTitle: "カテゴリ名", mData: "category", width:"150px"
				, "render": function (data, type, row) {
					return row["category_name"];
				}
			},
			{sTitle: "カテゴリ名", mData: "category_name", visible: false},
			{sTitle: "タイトル", mData: "title"
				, "render": function (data, type, row) {
					if("1" == row["detail_type"]){
						html = '<strong>' + data + '</strong><br>{$root_path}special/' + row["id"] + '/ <a href="{$root_path}special/' + row["id"] + '/" target="_blank"><i class="fa fa-external-link"></i></a>';
					}else if("9" == row["detail_type"]){
						html = '<strong>' + data + '</strong><br><small>[リンクのみ]</small> ' + row["thumbnail_link"]["link"]["url"] + ' <a href="' + row["thumbnail_link"]["link"]["url"] + '" target="_blank"><i class="fa fa-external-link"></i></a>';
					}
					return html;
				}
			},
			{sTitle: "公開", mData: "public_status", width:"100px",
				"render": function (data, type, row) {
					if("1" == data){
						return "公開";
					}else if("9" == data){
						return "非公開";
					}else{
						return "不明";
					}
				}
			},
			{sTitle: "", mData: "id", width: "45px", "sClass": "center",
				"render": function (data, type, row) {
					return '<button onClick="item_edit(' + "'{$meta["page"]["path"]}'" + ' ,' + data + ')">編集</button>';
				}
			},
			{sTitle: "", mData: "id", width: "45px", "sClass": "center",
				"render": function (data, type, row) {
					return '<button onclick="item_delete(' + "'{$meta["page"]["path"]}delete'" + ' ,' + data + ')">削除</button>';
				}
			},
		]
		, createdRow: function( row, data, dataIndex ) {
		    if ( data["public_status"] == "9" ) {
		      $(row).addClass( 'gray02' );
		    }
		}
		, drawCallback: function(setting) {
			table_resize();
		}
		/**
	     * レスポンシブWebデザイン
		 */
		//, responsive: true
	});
	search_str = table.search();
	if(null == search_str || "" == search_str){
		$("select[name=search_category]:first").attr('selected','selected');
		search();
		search_str = table.search();
	}
	search_str = JSON.parse(search_str);
	$('select[name=search_category]').val(search_str["category"]);
	search();
	$('select[name=search_category]').on('change', function () {
		search();
	});
	table.on( 'draw', function () {
		table_resize();
	});
	$(window).on('load resize', function(){
		table_resize();
	});
EOT;
