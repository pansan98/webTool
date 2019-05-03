<?php $view->extend('::admin/layout/base.html.php') ?>

<?php $view['slots']->start('content') ?>

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
					<a href="<?php echo $meta["page"]["path"]; ?>" class="btn btn-primary"><i class="fa  fa-reply"></i> 一覧へ戻る</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Default box -->
	<div class="row">
		<div class="col-md-12">
			<div class="box notop">
				<form action="./sort" method="POST">
					<div class="box-header">
						<div>
							<p style="color:red">※ドラッグ&ドロップで並び替えが可能です。並び替え後は「並び替えを保存する」のボタンをクリックしてください。</p>
							<button type="submit" class="btn btn-primary">並び替えを保存する</button>
						</div>
					</div>
					<div class="box-body">
						<table id="table_id" class="table table-bordered table-hover"></table>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div>
							<button type="submit" class="btn btn-primary">並び替えを保存する</button>
							<p style="color:red">※ドラッグ&ドロップで並び替えが可能です。並び替え後は「並び替えを保存する」のボタンをクリックしてください。</p>
						</div>
					</div>
					<!-- /.box-footer-->
				</div>
			</form>
		</div>
		<!-- /.box -->

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
		paging: false,
		info: true,
		stateSave: true,
		lengthChange: false,
		displayLength: 10,
		searching: true,
		sScrollX: false,
		autoWidth: false,
		bStateSave: true,
		bProcessing: true,
		bServerSide: true, //ソート&ページング維持
		ordering: false,
		orderCellsTop: true,
		columnDefs: [{
		}],
		dom: '<"top"l>rt<"clear">',
		ajax: {
			url: '{$meta["base"]["path"]}json',
			dataSrc: 'data'
		},
		aoColumns: [
			{sTitle: "No", mData: "id", visible: false},
			{sTitle: "並び順", mData: "sort_no"
				, "render": function (data, type, row) {
					return data + '<input type="hidden" name="id[]" value="' + row["id"] + '">';
				}
			},
			{sTitle: "カテゴリ名", mData: "title"},
			{sTitle: "公開", mData: "public_status"
				, "render": function (data, type, row) {
					if("1" == data){
						return "公開中";
					}else if("9" == data){
						return "非公開";
					}else{
						return "不明";
					}
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
		$('#table_id tbody').sortable();
		$("#table_id tbody").css("cursor","move");
	});
	$(window).on('load resize', function(){
		table_resize();
	});
EOT;
?>

<?php $view['slots']->stop() ?>
