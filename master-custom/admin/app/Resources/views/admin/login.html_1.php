<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Login | <?php echo THREES__SITE_TITLE?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/AdminLTE.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/iCheck/skins/square/blue.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
			html, body {
				height: inherit;
			}
		</style>
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<!--<img src="<?php echo THREES__WEB_ROOT_PATH; ?>images/header/img_logo_h.png" alt="<?php echo THREES__SITE_TITLE?>" width="100%" />-->
				<span><?php echo THREES__SITE_TITLE?></span>
			</div>
			
			<!-- /.login-logo -->
			<div class="login-box-body">
				<?php /*{% trans_default_domain 'FOSUserBundle' %}*/ ?>

				<?php if(isset($error)): ?>
				<div>
                    <?php echo e($view['translator']->trans($error->getMessage(), [], 'security')); ?>
                </div>
				<?php endif; ?>
				<form action="<?php echo $view['router']->path('admin_master_login_check') ?>" method="post">
					<?php if(isset($csrf_token)): ?>
					<input type="hidden" name="_csrf_token" value="<?php echo $csrf_token; ?>" />
					<?php endif; ?>
					<div class="form-group has-feedback">
						<input type="text" id="username" name="_username" value="<?php echo $last_username; ?>" required="required" class="form-control" placeholder="ユーザー名" />
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" id="password" name="_password" required="required" class="form-control" placeholder="パスワード" />
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<!-- /.col -->
						<div class="col-xs-12">
							<button type="submit" id="_submit" name="_submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->
		<script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jquery/dist/jquery.min.js"></script>

		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/iCheck/icheck.min.js"></script>
		<script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
		</script>
	</body>
</html>
