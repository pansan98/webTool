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
            <a href="<?php echo $meta["page"]["path"]; ?>new" class="btn btn-primary"><i class="fa fa-plus-square"></i> 新規作成</a>
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
			order: [[ 0, 'asc' ]],
			orderCellsTop: true,
			columnDefs: [{
				orderable: false,
				targets: []
			}],
			dom: '<"top"lip>rt<"bottom"i><"clear">',
			ajax: {
				url: '{$meta["base"]["path"]}json',
				dataSrc: 'data'
			},
			aoColumns: [
				{sTitle: "名前", mData: "name"},
				{sTitle: "表示名", mData: "display_name"},
                {sTitle: "", mData: "id", width: "45px",
                    "render": function (data, type, row) {
                        return '<button><a href="{$meta["page"]["path"]}' + data + '">変更</a></button>';
                    }
                },
                {sTitle: "", mData: "id", width: "45px", "sClass": "center",
                    "render": function (data, type, row) {
                        return '<button onclick="item_delete(' + "'{$meta["page"]["path"]}delete'" + ' ,' + data + ')">削除</button>';
                    }
                },
			],
			/**
	         * レスポンシブWebデザイン
		     */
			responsive: true
		})

EOT;
