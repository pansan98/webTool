<!-- iCheck -->
<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- bootstrap-progressbar -->
<!--<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">-->
<!-- JQVMap -->
<!--<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>-->
<!-- bootstrap-daterangepicker -->
<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/custom.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/datatables.net-bs/css/dataTables.bootstrap.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.2.1/dt-1.10.16/r-2.2.0/datatables.min.css">-->



<style>
	label {
		font-weight : normal;
		margin-right: 10px; 
	}
	div.list_btns {
		margin-bottom: 0px !important;
	}
	form {
		margin-bottom: 0px;
	}
	.table {
		margin-bottom: 0px;
	}
	.table th {
		background-color: white;
	}
	.table td {
		background-color: white;
	}
	.top .dataTables_length {
		text-align: right;
	}
	.top {
		padding-top: 5px;
	}
	.top .dataTables_info {
		float:left;
		padding-left: 5px;
		padding-right: 5px;
	}
	.top .dataTables_paginate {
		float:right;
		padding-left: 5px;
		padding-right: 5px;
	}

	.bottom {
		height: 40px;
	}
	.bottom .dataTables_info {
		float:left;
		padding-left: 5px;
		padding-right: 5px;
	}
	.bottom .dataTables_paginate {
		float:right;
		padding-left: 5px;
		padding-right: 5px;
	}
	.con_list div.search_box {
		color: #444;
		background: #fff;
		border-top: 5px solid #008200; 
		padding: 5px 15px;
	}
	button[disabled]{
		color:#9e9e9e;
	}
</style>

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
	
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
			<?php if(isset($meta["category"]) AND $meta["category"] === true): ?>
			<a href="<?php echo $meta["page"]["path"]; ?>category/">カテゴリ</a>
			<?php endif; ?>
		</div>
		<div class="box-body">
			<table id="table_id" class="table table-bordered table-hover"></table>
		</div>
		<!-- /.box-body -->
		<div class="box-footer"></div>
		<!-- /.box-footer-->
	</div>
	<!-- /.box -->
</section>

<!-- /.content -->
<?php
// DataTables
$content_js["file"]["datatables"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>';
//$content_js["file"]["datatables"] = '<script src="https://cdn.datatables.net/v/dt/jq-3.2.1/dt-1.10.16/datatables.min.js"></script>';
$content_js["file"]["datatables2"] = '<script src="https://take-lab.com/datatables/js/dataTables.responsive_complex.js"></script>';

$content_js["file"]["datatables-bs"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
$content_js["raw"][] = <<<"EOT"
	var table;
EOT;

$content_js["init"][] = <<<"EOT"

		$.extend($.fn.dataTable.defaults, {
			language: {url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"}
		});
		
		table = $('#table_id').DataTable({
			language: {
				processing: "データ取得中...",
				lengthMenu: "表示件数 : _MENU_件",
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
			searching: false,
			autoWidth: false,
			bStateSave: true,
			bProcessing: true,
			bServerSide: true, //ソート&ページング維持
			ordering: true,
			order: [[ 0, 'desc' ]],
			orderCellsTop: true,
			columnDefs: [{
				orderable: false,
				targets: [-1]
			}],
			dom: '<"top"lip>rt<"bottom"i><"clear">',
			ajax: {
				url: '{$meta["base"]["path"]}json',
				dataSrc: 'data'
			},
			aoColumns: [
				{sTitle: "No", mData: "id"},
				{sTitle: "タイトル", mData: "title"},
				{sTitle: "更新日", mData: "updated"},
				{sTitle: "更新日", mData: "updated"},
				{sTitle: "公開", mData: "public_status"},
				{sTitle: "ディレクトリ", mData: "path"},
				{sTitle: "", mData: "path", width: "45px",
					"render": function (data, type, row) {
						return '<button><a href="{$meta["page"]["path"]}' + data + '/">移動</a></button>';
					}
				},
			],
			/**
	         * レスポンシブWebデザイン
		     */
			responsive: true
		})

EOT;
