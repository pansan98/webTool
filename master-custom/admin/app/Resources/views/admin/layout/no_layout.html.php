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
	<body class="hold-transition skin-blue fixed sidebar-mini" style="background-color: #F0F0F0;">
		<!-- Site wrapper -->
		<div class="">
			<div class="">
                <?php if ($view['slots']->has('content')): ?>
					<?php $view['slots']->output('content') ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- ./wrapper -->
		<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/template_tags.php'; ?>
		<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/javascript.php'; ?>
	</body>
	
</html>