<!-- iCheck -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/select2/dist/css/select2.min.css">
<!-- 画像 -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/cropper/dist/cropper.min.css" rel="stylesheet">
<!-- Dropzone.js -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/dropzone/dist/dropzone.css" rel="stylesheet">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/AdminLTE.min.css">

<!-- AdminLTE Skins. Choose a skin from the css/skins
	 folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/skins/_all-skins.min.css">

<!-- Custom Theme Style -->
<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/custom.css" rel="stylesheet">

<style>
	label{
		/*margin-right: 30px;*/
		cursor: pointer;
	}
	ul {
		padding-left: 0px;
	}
	ul, ol {
		list-style:none;
	}
	dl dd ul.txt,
	dl dd ul.txt_sort{
		overflow: hidden;
	}
	dl dd .txt li.active,
	dl dd .txt_sort li.active{
		background: none repeat scroll 0 0 #40819b;
		float:left;
		border-radius: 8px;
		color: #fff;
		font-size: 100%;
		font-weight: normal;
		margin: 0 10px 10px 0 !important;
		padding: 5px 10px 5px 7px;
		height:30px;
	}
	dl dd .txt li.no_active,
	dl dd .txt_sort li.no_active{
		background: none repeat scroll 0 0 #ddd;
		float:left;
		border-radius: 8px;
		color: #444;
		font-size: 90%;
		font-weight: bold;
		margin: 0 10px 10px 0 !important;
		padding: 5px 10px 5px 7px;
		height:30px;
	}
	img {
		max-width: 100%; /* This rule is very important, please do not ignore this! */
	}
	.dropzone {
		min-height: 300px;
		border: 1px solid #e5e5e5
	}
	div.droparea {
		overflow: hidden;
		padding: 40px 10px;
		background: #ddd;
		border: 3px #777 dashed;
		color: #999;
		font-size: 1.2em;
		font-weight: bold;
		text-align: center;
	}

	div.droparea:hover {
		cursor: pointer;
		background: #eee;
		border-color: #999;
		color: #aaa;
	}
	div.droparea.dragover,
	div.droparea.dropArea1:active {
		background: #eee;
		border-color: #999;
		color: #aaa;
	}

	input.droparea{
		display: none;
	}
	/*
	#fileInput {
		display: none;
	}
	*/

	.example-modal .modal {
		position: relative;
		top: auto;
		bottom: auto;
		right: auto;
		left: auto;
		display: block;
		z-index: 1;
    }

	.example-modal .modal {
		background: transparent !important;
    }
</style>
<style>
	.squareBox {
		position: relative;

		display: block;
		content: '';
		padding-top: 100%;
		background-color: #ECECEC;
		background-image: -webkit-gradient(linear, 0 0, 100% 100%,color-stop(.25, #F9F9F9), color-stop(.25, transparent),color-stop(.5, transparent), color-stop(.5, #F9F9F9),color-stop(.75, #F9F9F9), color-stop(.75, transparent),to(transparent));
		-webkit-background-size: 7px 7px;
	}
	.content2 {
		position: absolute;
		top: 0;
		width: 100%;
		height: 100%;
		box-sizing: border-box;
		/* 画像がエリアからはみ出さないようにする */
		overflow: hidden;
	}									
	.thumb {
		width: 100%;
		height: auto;
	}
	.centerTable {
		display: table;
		/* ID display: table, table-cell 内で max-width が効かないバグを回避する */
		table-layout: fixed;
		text-align: center;
		width: 100%;
		height: 100%;
	}
	.tableCell {
		display: table-cell;
		vertical-align: middle;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">

	<h1><?php echo $meta["page"]["title"]; ?><small></small></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> ...</li>
		<li><a href="<?php echo $meta["breadcrumbs"]["parent"]["path"]; ?>"><i class="fa fa-dashboard"></i> <?php echo $meta["breadcrumbs"]["parent"]["title"]; ?></a></li>
		<li class="active"><?php echo $meta["breadcrumbs"]["current"]["title"]; ?></li>
	</ol>


</section>

<!-- Main content -->
<section class="content">
	<!--
	<div class="callout callout-danger">
		<h4>Error!</h4>
		<p>- エラーが発生しました。</p>
	</div>
	-->
	<div class="row">
		<form method="POST" name="post_form" id="post_form" action="<?php echo $meta["page"]["path"]; ?>" enctype="multipart/form-data">
			<!--
			<div class="callout callout-info">
				<h4>Info!</h4>
				<p>- お知らせ</p>
			</div>
			<div class="callout callout-success">
				<h4>Success!</h4>
				<p>- 保存しました</p>
			</div>
			<div class="callout callout-warning">
				<h4>Warning!</h4>
				<p>- XXXXXの警告</p>
			</div>
			-->

			<div class="col-sm-12 col-lg-8">
				<?php if (isset($document)) : ?>
					<?php foreach ($document->blocks->getList() as $block) : ?>
						<!-- Start <?php echo $block->getTitle(); ?> -->
						<div class="box box-info">
							<div class="box-header" style="border-bottom: 1px solid #d2d6de;">
								<p><?php echo $block->getTitle(); ?></p>
							</div>
							<?php if (!Empty($block->getHeaderComment())): ?>
								<div class="box-body pad header"><?php echo $block->getHeaderComment(); ?></div>
							<?php endif; ?>
							<?php
							foreach ($block->templates->getList() as $template) :
								//テンプレート設定
								include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/" . $template->getPath() . ".php";
							endforeach;
							?>
							<?php if (!Empty($block->getFooterComment())): ?>
								<div class="box-body pad footer"><?php echo $block->getFooterComment(); ?></div>
							<?php endif; ?>
						</div>
						<!-- End <?php echo $block->getTitle(); ?> -->
					<?php endforeach; ?>
				<?php endif; ?>
				
			</div>
			<div class="col-sm-12 col-lg-4">
				<?php if($document->usePublicStatus()): ?>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">公開ステータス</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<?php $public_list=["1" => "公開", "9" => "非公開"]; ?>
								<select class="form-control" name="doc_public_status">
									<?php foreach ($public_list as $key => $val): ?>
									<option value="<?php echo $key; ?>" <?php echo $key==$document->getPublicStatus()?"selected":""; ?>><?php echo $val; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<?php endif; ?>
				<?php if($document->usePublicRange()): ?>
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">公開期間</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-12 col-xs-12">年月日</label>
							<div class="input-group date" id="myDatepicker_start_date">
								<input type="text" class="form-control" name="doc_public_start_date" value="<?php echo $document->getPublicStartDate(); ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-12 col-xs-12">時分</label>
							<div class="input-group date" id="myDatepicker_start_time">
								<input type="text" class="form-control" name="doc_public_start_time" value="<?php echo $document->getPublicStartTime(); ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="text-center">〜</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-12 col-xs-12">年月日</label>
							<div class="input-group date" id="myDatepicker_end_date">
								<input type="text" class="form-control" name="doc_public_end_date" value="<?php echo $document->getPublicEndDate(); ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-12 col-xs-12">時分</label>
							<div class="input-group date" id="myDatepicker_end_time">
								<input type="text" class="form-control" name="doc_public_end_time" value="<?php echo $document->getPublicEndTime(); ?>">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="box">
					<div class="box-body text-center">
						<button type="button" class="btn btn-info">プレビュー</button>
						<button type="submit" class="btn btn-primary" onclick="form_submit();return false;">登録</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<!-- /.content -->

<?php /*
  <script>

  function init_cropper() {

  if (typeof ($.fn.cropper) === 'undefined') {
  return;
  }
  console.log('init_cropper');

  var $image = $('#image');
  //var $download = $('#download');
  var $dataX = $('#dataX');
  var $dataY = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');
  var options = {
  aspectRatio: 16 / 9,
  preview: '.img-preview',
  crop: function (e) {
  $dataX.val(Math.round(e.x));
  $dataY.val(Math.round(e.y));
  $dataHeight.val(Math.round(e.height));
  $dataWidth.val(Math.round(e.width));
  $dataRotate.val(e.rotate);
  $dataScaleX.val(e.scaleX);
  $dataScaleY.val(e.scaleY);
  }
  };


  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();


  // Cropper
  $image.on({
  'build.cropper': function (e) {
  console.log(e.type);
  },
  'built.cropper': function (e) {
  console.log(e.type);
  },
  'cropstart.cropper': function (e) {
  console.log(e.type, e.action);
  },
  'cropmove.cropper': function (e) {
  console.log(e.type, e.action);
  },
  'cropend.cropper': function (e) {
  console.log(e.type, e.action);
  },
  'crop.cropper': function (e) {
  console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
  },
  'zoom.cropper': function (e) {
  console.log(e.type, e.ratio);
  }
  }).cropper(options);


  // Buttons
  if (!$.isFunction(document.createElement('canvas').getContext)) {
  $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }

  if (typeof document.createElement('cropper').style.transition === 'undefined') {
  $('button[data-method="rotate"]').prop('disabled', true);
  $('button[data-method="scale"]').prop('disabled', true);
  }


  // Download
  //if (typeof $download[0].download === 'undefined') {
  //	$download.addClass('disabled');
  //}


  // Options
  $('.docs-toggles').on('change', 'input', function () {
  var $this = $(this);
  var name = $this.attr('name');
  var type = $this.prop('type');
  var cropBoxData;
  var canvasData;

  if (!$image.data('cropper')) {
  return;
  }

  if (type === 'checkbox') {
  options[name] = $this.prop('checked');
  cropBoxData = $image.cropper('getCropBoxData');
  canvasData = $image.cropper('getCanvasData');

  options.built = function () {
  $image.cropper('setCropBoxData', cropBoxData);
  $image.cropper('setCanvasData', canvasData);
  };
  } else if (type === 'radio') {
  options[name] = $this.val();
  }

  $image.cropper('destroy').cropper(options);
  });


  // Methods
  $('.docs-buttons').on('click', '[data-method]', function () {
  var $this = $(this);
  var data = $this.data();
  var $target;
  var result;

  if ($this.prop('disabled') || $this.hasClass('disabled')) {
  return;
  }

  if ($image.data('cropper') && data.method) {
  data = $.extend({}, data); // Clone a new one

  if (typeof data.target !== 'undefined') {
  $target = $(data.target);

  if (typeof data.option === 'undefined') {
  try {
  data.option = JSON.parse($target.val());
  } catch (e) {
  console.log(e.message);
  }
  }
  }

  result = $image.cropper(data.method, data.option, data.secondOption);

  switch (data.method) {
  case 'scaleX':
  case 'scaleY':
  $(this).data('option', -data.option);
  break;

  case 'getCroppedCanvas':
  if (result) {

  // Bootstrap's Modal
  $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

  if (!$download.hasClass('disabled')) {
  $download.attr('href', result.toDataURL());
  }
  }

  break;
  }

  if ($.isPlainObject(result) && $target) {
  try {
  $target.val(JSON.stringify(result));
  } catch (e) {
  console.log(e.message);
  }
  }

  }
  });

  // Keyboard
  $(document.body).on('keydown', function (e) {
  if (!$image.data('cropper') || this.scrollTop > 300) {
  return;
  }

  switch (e.which) {
  case 37:
  e.preventDefault();
  $image.cropper('move', -1, 0);
  break;

  case 38:
  e.preventDefault();
  $image.cropper('move', 0, -1);
  break;

  case 39:
  e.preventDefault();
  $image.cropper('move', 1, 0);
  break;

  case 40:
  e.preventDefault();
  $image.cropper('move', 0, 1);
  break;
  }
  });

  // Import image
  var $inputImage = $('#inputImage');
  var URL = window.URL || window.webkitURL;
  var blobURL;

  if (URL) {
  $inputImage.change(function () {
  var files = this.files;
  var file;

  if (!$image.data('cropper')) {
  return;
  }

  if (files && files.length) {
  file = files[0];

  if (/^image\/\w+$/.test(file.type)) {
  blobURL = URL.createObjectURL(file);
  $image.one('built.cropper', function () {

  // Revoke when load complete
  URL.revokeObjectURL(blobURL);
  }).cropper('reset').cropper('replace', blobURL);
  $inputImage.val('');
  } else {
  window.alert('Please choose an image file.');
  }
  }
  });
  } else {
  $inputImage.prop('disabled', true).parent().addClass('disabled');
  }
  };
  </script>
 */ ?>
<?php /*
  <template id="template_image_add">
  <?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php"; ?>
  </template>
 */ /* ?>
  <template id="template_image_add">
  <?php {
  ob_start();
  include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/image_add.php";
  $ret = ob_get_contents();
  ob_end_clean();
  echo $ret;
  } ?>
  </template>
 * 
 */ ?>
<?php
//Select2
//$template_js["file"][] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/select2/dist/js/select2.full.min.js"></script>';
//Cropper
//$template_js["file"][] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/vendors/cropper/dist/cropper.min.js"></script>';
//Custom
//$template_js["file"][] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/js/custom2.js"></script>';
$content_js["file"][] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/js/custom3.js"></script>';
