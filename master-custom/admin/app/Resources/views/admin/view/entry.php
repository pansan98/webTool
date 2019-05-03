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
			<!-- Default box -->
			<div class="box notop">
				<!--<div class="box-header"></div>-->
				<div class="box-body">
					<div class="form-group search_box">
						<form action="./export" method="POST" name="entry_search" id="entry_search">
							<input type="hidden" id="ids" name="ids" value="" />

							<div class="search_box">絞込：<input type="text" id="search_freeword" name="search_freeword" style="width:50%" placeholder="文字入力後、エンター 又は 検索ボタンを押してください" />
								<button onclick="search();
										return false;">検索</button>
								<button style="cursor:pointer;" onclick="obj = document.getElementById('open').style;
										obj.display = (obj.display == 'none') ? 'block' : 'none';
										return false;">詳細検索▼</button>
							</div>

							<div id="open" style="display:none;clear:both;">

								<table class="table table-bordered">
									<col width="110px"/>
									<tr>
										<th>CSV出力</th>
										<td>
											<label><input type="radio" name="search_is_output" value="yes">「済」のみ</label>
											<label><input type="radio" name="search_is_output" value="no">「未」のみ</label>
											<label><input type="radio" name="search_is_output" value="all" checked>全て</label>
										</td>
									</tr>
									<tr>
										<th>資格</th>
										<td>
											<?php foreach ($datas["search"]["job"] as $code => $name): ?>
											<label><input type="checkbox" name="search_job" value="<?php echo $name; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<th>雇用形態</th>
										<td>
											<?php foreach ($datas["search"]["employ"] as $code => $name): ?>
											<label><input type="checkbox" name="search_employment" value="<?php echo $name; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
								</table>
							</div>
						</form>
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
	
	function table_resize(){
		parent = $('#table_id_processing').parents('.box');
		$("#table_id_processing").width(parent.width());
		$("#table_id_processing").height(parent.height());
	}
			
	function search() {

		var word = $("#search_freeword").val();
		var is_output = $('input[name=search_is_output]:checked').val();
		var job = $('input[name=search_job]:checked').map(function () {
				return $(this).val();
			}).get();
		var employment = $('input[name=search_employment]:checked').map(function () {
				return $(this).val();
			}).get();

		var search_data = {};
		search_data["freeword"] = word;
		search_data["is_output"] = is_output;
		search_data["job"] = job;
		search_data["employment"] = employment;

		search_json = JSON.stringify(search_data);
		table.search(search_json).draw();
	}

	function allckeck() {
		if ($('#cAll').is(':checked')) {
			$('input[name="cId"]').prop('checked', true);
		} else {
			$('input[name="cId"]').prop('checked', false);
		}
	}

	function entry_delete() {

		var ids = getSelectId();
		ids = ids.join(",");

		var message;
		if (ids == "") {
			message = "削除したいエントリーにチェックを入れてください。";
		} else {
			message = "選択されたエントリーを「削除」します。よろしいですか？";
		}
		
		var ret = confirm(message);
		if (ret != true) {
			return 0;
		}

		$.ajax({
			url: "./delete",
			type: 'POST',
			dataType: 'json',
			data: {ids: ids},
			timeout: 10000,
		}).done(function (data) {
			search();
		}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
			alert("通信エラーが発生しました。しばらく時間をおいてから再度お試しください。通信エラーが解消しない場合はシステム提供会社へご連絡下さい。");
		});
	}
	
	function getSelectId() {
		
		var ids = $('input[name=cId]:checked').map(function () {
				return $(this).val();
			}).get();
		return ids;
	}

	function csv_export() {

		var ids = getSelectId();
		ids = ids.join(",");

		$("#ids").val(ids);
		var message;
		if (ids == "") {
			message = "全てのエントリーを「CSV形式」で出力します。よろしいですか？";
		} else {
			message = "選択されたエントリーを「CSV形式」で出力します。よろしいですか？";
		}

		var ret = confirm(message);
		if (ret != true) {
			return 0;
		}

		$("#entry_search")[0].submit();
		//function (e) {
		//	$("#message").html("ダウンロード中...");
		//	setInterval(function () {
		//		if ($.cookie("exported_entry_csv")) {
		//			$("#message").html("ダウンロード完了");
		//			$.removeCookie("exported_entry_csv", {path: "/"});
		//		}
		//	}, 1000);
		//});
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
				text: 'CSV出力',
					action: function (e, dt, node, config) {
						csv_export();
					}
			},
			{
				text: '削除',
					action: function (e, dt, node, config) {
						entry_delete();
					}
			}
		],
		ajax: {
			url: '{$meta["base"]["path"]}json',
			dataSrc: 'data'
		},
		aoColumns: [
			{sTitle: '<input type="checkbox" name="cAll" id="cAll" onchange="allckeck()">', mData: "id", width: "15px",
				"render": function (data, type, row) {
					return '<input type="checkbox" name="cId" value="' + data + '">';
				}
			},
			{sTitle: "出力", mData: "export_flag", width: "30px", align: "center",
				"render": function (data, type, row) {
					if (data == 1) {
						return '<p>済</p>';
					} else {
						return '<p>未</p>';
					}
				}
			},
			{sTitle: "応募日時", mData: "entry_date", width: "160px"},
			{sTitle: '<p style="font-size:0.7em">求人ID</p><p>施設名</p>', mData: "recruit_id", width: "140px",
				"render": function (data, type, row) {
					if (data == 0) {
						return '<p style="font-size:0.7em">指定なし</p>';
						} else {
						return '<p style="font-size:0.7em">' + data + '</p><p>' + row['facility_name'] + '</p>';
					}
				}
			},
			{sTitle: '<p style="font-size:0.7em">ふりがな</p><p>名前</p>', mData: "kana", width: "140px",
				"render": function (data, type, row) {
					return '<p style="font-size:0.7em">' + data + '</p><p>' + row['name'] + '</p>';
				}
			},
			{sTitle: "電話番号", mData: "tel", "width": "120px"},
			{sTitle: "住所", mData: "address"},
			{sTitle: "メールアドレス", mData: "mail"},
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
			
	$('input[name=search_is_output]').on('change', function () {
		search();
	});
	$('input[name=search_job]').on('change', function () {
		search();
	});
	$('input[name=search_employment]').on('change', function () {
		search();
	});
EOT;
