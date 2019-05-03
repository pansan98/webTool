<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo $view['router']->path('admin_master') ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><?php echo THREES__SITE_TITLE_SHORT; ?></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><?php echo THREES__SITE_TITLE; ?></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<!--
		<div style="float:left;" class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="user-menu">
					<a href="" class="">TOP</a>
				</li>
				<li class="user-menu">
					<a href="" class="">予約</a>
				</li>
				<li class="user-menu">
					<a href="" class="">メッセージ</a>
				</li>
				<li class="user-menu">
					<a href="" class="">カレンダー</a>
				</li>
				<li class="user-menu">
					<a href="" class="">サポート</a>
				</li>
			</ul>
		</div>
		-->

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown">
						<!--<img src="https://placehold.jp/16/e1e2ed/030303/50x50.jpg?text=%E7%94%BB%E5%83%8F" class="user-image" alt="User Image">-->
						<i class="fa fa-user" style="margin-right: 0px; font-size: 1.3em"></i><span class="hidden-xs"> <?php echo e($app->getUser()->getUsername()); ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<!-- Menu Body -->
						<!--
						<li class="user-body">
							<div class="row">
								<div class="col-xs-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
							</div>
						</li>
						-->
						<!-- Menu Footer-->
						<li class="user-footer">
							<!--
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">プロフィール</a>
							</div>
							-->
							<div class="pull-right">
								<a href="<?php echo $view['router']->path('admin_facility_logout') ?>" class="btn btn-default btn-flat">ログアウト</a>
							</div>
						</li>

					</ul>
				</li>
				<!-- Control Sidebar Toggle Button -->
				<li class="user-menu">
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</header>