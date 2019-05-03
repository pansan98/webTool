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
					<div class="form-group search_box">
						<div class="">
							<div style="float:right">
								<button style="cursor:pointer;" onclick="obj = document.getElementById('csv').style;obj.display = (obj.display == 'none') ? 'block' : 'none';return false;">CSV▼</button>
							</div>
							<div>
								絞込：<input type="text" id="search_freeword" name="search_freeword" style="width:50%" placeholder="文字入力後、エンター 又は 検索ボタンを押してください" onkeypress="enter_search();" />
								<button onclick="search(); return false;">検索</button>
								<button style="cursor:pointer;" onclick="obj = document.getElementById('open').style;obj.display = (obj.display == 'none') ? 'block' : 'none';return false;">詳細検索▼</button>
							</div>
							<div id="open" style="display:none;clear:both;">
								<table class="table table-bordered">
									<col width="110px">
									<tr>
										<th>画像</th>
										<td>
											<label><input type="radio" name="search_is_image" value="yes">「登録済み」のみ</label>
											<label><input type="radio" name="search_is_image" value="no">「未登録」のみ</label>
											<label><input type="radio" name="search_is_image" value="all" checked> 全て</label>
										</td>
									</tr>
									<tr>
										<th>雇用形態</th>
										<td>
											<?php foreach ($datas["search"]["employ"] as $code => $name): ?>
											<label><input type="checkbox" name="search_employment" value="<?php echo $code; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<th>職種</th>
										<td>
											<?php foreach ($datas["search"]["business"] as $code => $name): ?>
											<label><input type="checkbox" name="search_job" value="<?php echo $code; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<th>施設形態</th>
										<td>
											<?php foreach ($datas["search"]["facilities"] as $code => $name): ?>
											<label><input type="checkbox" name="search_facility_type" value="<?php echo $code; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<th>特徴</th>
										<td>
											<?php foreach ($datas["search"]["characteristic"] as $code => $name): ?>
											<label><input type="checkbox" name="search_appeal_point" value="<?php echo $code; ?>"> <?php echo $name; ?></label>
											<?php endforeach; ?>
										</td>
									</tr>
								</table>
							</div>
							<div id="csv" style="display:none;clear:both;text-align: right;">
								<form id="import_form" name="import_form" action="import" method="POST" enctype="multipart/form-data">
									<table class="table">
										<tr>
											<td>
												<span id="import_processing" style="display: none;">取り込み中...<i class="fa fa-spinner fa-fw fa-spin"></i></span>
												<input type="file" id="fileCheck" name="file" accept=".csv,text/csv" />
												<button type="button" id="fileCheckBtn" name="fileCheckBtn" onClick="start_import()">取込</button>
											</td>
										</tr>
									</table>
								</form>
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
	
	function enter_search() {
		//エンターキー押下なら
		if(13 === event.keyCode) {
			search();
		}
	}
		
	function inputCheck() {
		//inputフィールドの文字数を取得
		fileCheck = $("#fileCheck").val().length;
		$("#import_processing").css('visibility', 'hidden');
		//値が無ければボタンを非表示
		if (fileCheck == 0) {
			$("#fileCheckBtn").attr("disabled", "disabled");
		} else {
			$("#fileCheckBtn").attr("disabled", false);
		}
	}
		
	function start_import(){
		
		//取り込み開始
		$("#fileCheckBtn").attr('disabled', 'disabled');
		$("#import_processing").css('display', 'block');
		
		$("#import_form").submit();
		
		$("#fileCheck").attr('disabled', 'disabled');
	}
		
	function search() {
		
		var word = $("#search_freeword").val();
		var is_image = $('input[name=search_is_image]:checked').val();
		var employment = $('input[name=search_employment]:checked').map(function () {
				return $(this).val();
			}).get();
		var job = $('input[name=search_job]:checked').map(function () {
				return $(this).val();
			}).get();
		var facility_type = $('input[name=search_facility_type]:checked').map(function () {
				return $(this).val();
			}).get();
		var appeal_point = $('input[name=search_appeal_point]:checked').map(function () {
				return $(this).val();
			}).get();
		
		var search_data = {};
		search_data["freeword"] = word;
		search_data["is_image"] = is_image;
		search_data["employment_code"] = employment;
		search_data["job_code"] = job;
		search_data["facility_type_code"] = facility_type;
		search_data["appeal_point_code"] = appeal_point;
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
			
	function start_import(){
		
		//取り込み開始
		$("#fileCheckBtn").attr('disabled', 'disabled');
		$("#import_processing").css('display', 'block');
		
		$("#import_form").submit();
		
		$("#fileCheck").attr('disabled', 'disabled');
	}
			
	$("#fileCheck").change(function () {
		inputCheck();
	});
	
EOT;

$root_path = THREES__WEB_ROOT_PATH;
$content_js["init"][] = <<<"EOT"

	inputCheck();
			
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
		columnDefs: [{
			orderable: false,
			targets: 0
		}],
		dom: '<"top"Blip>rt<"bottom"ip><"clear">',
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
			{sTitle: "求人ID", mData: "recruit_id", width: "60px", "sClass": "center",
				"render": function (data, type, row) {
					return '<a href="{$root_path}' + row["recruit_url"] + '" target="_blank">' + data + "</a>";
				}
			},
			{sTitle: "画像", mData: "image", width: "60px", "sClass": "center",
				"render": function (data, type, row) {
					image_path = "";
					image_alt = "";
					if ("undefined" == data || "" == data || "undefined" == row['image'][0]['filename']) {
						image_path = "{$root_path}images/common/no_photo.jpg";
						image_alt = "NoPhoto";
					}else{
						image_path = "{$root_path}datas/thumbnail_" + data[0]['filename'];
						image_alt = data[0]['alt'];
					}
					return '<img src="' + image_path + '" width="100%" alt="' + image_alt + '">';
				}
			},
			{sTitle: '<p style="font-size:0.7em">ふりがな</p><p>施設名</p>', mData: "facility_kana",
				"render": function (data, type, row) {
					return '<p style="font-size:0.7em">' + data + '</p><p>' + row['facility_name'] + '</p>';
				}
			},
			{sTitle: "最寄駅", mData: "closest_station"},
			{sTitle: "HRBC更新日", mData: "last_update_date", "sClass": "center"},
			{sTitle: "", mData: "id", width: "45px", "sClass": "center",
				"render": function (data, type, row) {
					return '<button onClick="item_edit(' + "'{$meta["page"]["path"]}'" + ' ,' + data + ')">編集</button>';
				}
			},
		]
	});
	$('input[name=search_is_image]').on('change', function () {
		search();
	});
	$('input[name=search_employment]').on('change', function () {
		search();
	});
	$('input[name=search_job]').on('change', function () {
		search();
	});
	$('input[name=search_facility_type]').on('change', function () {
		search();
	});
	$('input[name=search_appeal_point]').on('change', function () {
		search();
	});
EOT;
