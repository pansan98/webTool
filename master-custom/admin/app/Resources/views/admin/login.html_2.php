<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Login Form | <?php echo THREES__SITE_TITLE ?></title>

		<!-- Bootstrap -->
		<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/animate.css/animate.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/css/custom.css" rel="stylesheet">
	</head>

	<body class="login">
		<div>
			<?php /*<a class="hiddenanchor" id="signup"></a> */ ?>
			<?php /*<a class="hiddenanchor" id="signin"></a> */ ?>

			<div class="login_wrapper">
				<div class="animate form login_form">
					<?php /*{% trans_default_domain 'FOSUserBundle' %}*/ ?>
					<?php if(isset($error)): ?>
					<div>
			            <?php echo e($view['translator']->trans($error->getMessage(), [], 'security')); ?>
		            </div>
					<?php endif; ?>
					<section class="login_content">
						<form action="<?php echo $view['router']->path('admin_master_login_check') ?>" method="post">
							<?php if(isset($csrf_token)): ?>
							<input type="hidden" name="_csrf_token" value="<?php echo $csrf_token; ?>" />
							<?php endif; ?>
							<h1>Login Form</h1>
							<div>
								<input type="text" class="form-control" placeholder="Username" required="required" id="username" name="_username" value="<?php echo $last_username; ?>"  />
							</div>
							<div>
								<input type="password" class="form-control" placeholder="Password" required="required" id="password" name="_password"  />
							</div>
							<div>
								<?php /*<a class="btn btn-default submit" href="index.html">ログイン</a> */ ?>
								<button type="submit" id="_submit" name="_submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
							</div>
							<div style="margin-top:15px;">
								<a class="reset_pass" href="#">パスワードを忘れましたか？</a>		
							</div>
							<div class="clearfix"></div>

							<div class="separator">
								<?php
								/*
								  <p class="change_link">New to site?
								  <a href="#signup" class="to_register"> Create Account </a>
								  </p>
								 */
								?>
								<div class="clearfix"></div>
								<br />

								<div>
									<h1><img src="https://placehold.jp/20/3d4070/473636/50x50.png?text=SSS&css=%7B%22background%22%3A%22%20-webkit-gradient(linear%2C%20left%20top%2C%20left%20bottom%2C%20from(%23E0E0E0)%2C%20to(%23F0F0F0))%22%7D" style="margin:0px 5px;" /><?php echo THREES__SITE_TITLE; ?></h1>
									<p>©<?php echo THREES__COPYRIGHT_YEAR; ?> All Rights Reserved. <a href="<?php echo THREES__COPYRIGHT_COMPANY_URL; ?>" target="_blank"><?php echo THREES__COPYRIGHT_COMPANY; ?></a></p>
								</div>
							</div>
						</form>
					</section>
				</div>

				<?php
				/*
				  <div id="register" class="animate form registration_form">
				  <section class="login_content">
				  <form>
				  <h1>Create Account</h1>
				  <div>
				  <input type="text" class="form-control" placeholder="Username" required="" />
				  </div>
				  <div>
				  <input type="email" class="form-control" placeholder="Email" required="" />
				  </div>
				  <div>
				  <input type="password" class="form-control" placeholder="Password" required="" />
				  </div>
				  <div>
				  <a class="btn btn-default submit" href="index.html">Submit</a>
				  </div>

				  <div class="clearfix"></div>

				  <div class="separator">
				  <p class="change_link">Already a member ?
				  <a href="#signin" class="to_register"> Log in </a>
				  </p>

				  <div class="clearfix"></div>
				  <br />

				  <div>
				  <h1><i class="fa fa-paw"></i> <?php echo THREES__SITE_TITLE; ?></h1>
				  <p>©<?php echo THREES__COPYRIGHT_YEAR; ?> All Rights Reserved. <a href="<?php echo THREES__COPYRIGHT_COMPANY_URL; ?>" target="_blank"><?php echo THREES__COPYRIGHT_COMPANY; ?></a></p>
				  </div>
				  </div>
				  </form>
				  </section>
				  </div>
				 */
				?>
			</div>
		</div>
	</body>
</html>
