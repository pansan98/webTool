<?php
$template_css = [];
$template_js = [];
$content_template_tags = [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="ja">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>CMS | <?php echo THREES__SITE_TITLE?></title>
	<?php echo $view->render('admin/layout/stylesheet.html.php'); ?>
	<?php
	if ($view['slots']->has('styles')){
		$view['slots']->output('styles');
	}
	?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php echo $view->render('admin/layout/header.html.php'); ?>
	<!-- Left side column. contains the sidebar -->
	<?php echo $view->render('admin/layout/slide_left.html.php'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<?php if ($view['slots']->has('content')): ?>
			<?php $view['slots']->output('content') ?>
		<?php endif; ?>
	</div>
	<!-- /.content-wrapper -->
	<?php echo $view->render('admin/layout/footer.html.php'); ?>
	<!-- Control Sidebar -->
	<?php echo $view->render('admin/layout/slide_right.html.php'); ?>
	<!-- /.control-sidebar -->
	<div class="control-sidebar-bg"></div>
</div>

<?php /*
		<div id="croppic"></div>
		<?php
$content_js["raw"][] = <<<"EOT"
		var cropperOptions = {
			modal:true
			, loaderHtml:'<img class="loader" src="/datas/thumbnail_ca0131936f1282622e0449f037cbc10c.jpg" >'
		}
		var cropperHeader = new Croppic('croppic', cropperOptions);
EOT;
		?>
		 */ ?>
<!-- Modal -->

<div id="animatedModal" style="z-index: -9999; width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; background-color: rgb(241, 241, 241); overflow-y: auto; opacity: 1;">
	<!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
	<div style="height:42px; background-color: #f1f1f1; border: 1px solid #b5aeae">

		<div class="pull-left box-tools" style="margin:5px 10px;">
			<h4>画像切り抜き</h4>
		</div>
		<div class="pull-right box-tools" style="margin:5px;">
			<button name="curopper_button" type="button" class="btn btn-danger btn-sm close-animatedModal" data-toggle="tooltip" title="" onclick="modal_close();">
				<i class="fa fa-times" style="font-size: 1.4em"></i>
			</button>
		</div>
	</div>

    <div class="modal-content">
		<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/cropper.php'; ?>
    </div>
</div>

<?php
if ($view['slots']->has('modal_contents')){
	$view['slots']->output('modal_contents');
}
?>

<!-- ./wrapper -->
<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/template_tags.php'; ?>
<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/javascript.php'; ?>
<?php
if ($view['slots']->has('scripts')){
	$view['slots']->output('scripts');
}
?>

</body>

</html>