<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
		<?php echo $meta["page"]["title"]; ?><small></small>
    </h1>
    <ol class="breadcrumb hidden-sm hidden-xs">
        <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li> チェーンTOP</li>
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
$content_js["file"]["datatables"] = '<script src="'.THREES__WEB_ROOT_PATH.'admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>';
$content_js["file"]["datatables2"] = '<script src="https://take-lab.com/datatables/js/dataTables.responsive_complex.js"></script>';
$content_js["file"]["datatables-bs"] = '<script src="'.THREES__WEB_ROOT_PATH.'admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>';
$content_js["file"]["datatables-buttons"] = '<script src="'.THREES__WEB_ROOT_PATH.'admin/vendors/datatables.buttons/js/dataTables.buttons.js"></script>';
$content_js["file"]["datatables-buttons-html5"] = '<script src="'.THREES__WEB_ROOT_PATH.'admin/vendors/datatables.buttons/js/buttons.html5.min.js"></script>';
$content_js["raw"][] = <<<"EOT"
	var table;
	function table_resize(){
		parent = $('#table_id_processing').parents('.box');
		$("#table_id_processing").width(parent.width());
		$("#table_id_processing").height(parent.height());
	}
EOT;

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
			infoEmpty: " 表示可能なデータが存在しませんでした",
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
		//sScrollX: true,
		autoWidth: false,
		bStateSave: true,
		bProcessing: true,
		bServerSide: true,
		ordering: true,
		order: [[ 1, 'asc' ]],
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
			{sTitle: "No", mData: "id", visible: false},
			{sTitle: "件名", mData: "subject"},
			{sTitle: "種類", mData: "template_type"
				, render: function (data, type, row) {
				    switch(data){
				        case 10:
				            return '予約完了メール';
                        case 20:
                            return '予約直前メール';
                        case 30:
                            return 'お礼メール';
                        default:
                            return '(不明)';
				    }
				}
			},
			{sTitle: "", mData: "id", width: "45px",
				"render": function (data, type, row) {
					return '<button><a href="{$meta["page"]["path"]}' + data + '">変更</a></button>';
				}
			},
		]
		, createdRow: function( row, data, dataIndex ) {
			if ( data["public_status"] == "9" ) {
				$(row).addClass( 'gray02' );
			}
		}
		/**
         * レスポンシブWebデザイン
	     */
		//responsive: true
	})
	table.on( 'draw', function () {
		table_resize();
	});
	$(window).on('load resize', function(){
			table_resize();
		});
EOT;
