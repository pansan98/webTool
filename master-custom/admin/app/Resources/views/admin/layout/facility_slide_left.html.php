<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- search form -->
		<!--
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		-->
		
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<div id="left-sidebar-menu" class="sidebar-menu">
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">メニュー</li>

                <!--
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>予約</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>メッセージ</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>カレンダー</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>レビュー</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>プラン</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				-->

                <li>
                    <a href="<?php echo e($view['router']->path('admin_facility_news')); ?>">
                        <i class="fa fa-th"></i> 新着情報管理
                    </a>
                </li>
                <li>
                    <a href="<?php echo e($view['router']->path('admin_facility_blog')); ?>">
                        <i class="fa fa-th"></i> ブログ管理
                    </a>
                </li>
                <li>
                    <a href="<?php echo e($view['router']->path('admin_facility_faq')); ?>">
                        <i class="fa fa-th"></i> FAQ管理
                    </a>
                </li>
                <li>
                    <a href="<?php echo e($view['router']->path('admin_facility_gallery_photo')); ?>">
                        <i class="fa fa-th"></i> ギャラリー管理
                    </a>
                </li>
				
				<li class="header">マスター管理</li>


                <li>
                    <a href="<?php echo e($view['router']->path('admin_facility_users')); ?>">
                        <i class="fa fa-th"></i> ユーザー管理
                    </a>
                </li>
				<!--
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>備品管理</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> 一覧</a></li>
					</ul>
				</li>
				-->

				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>サイト管理</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
                        <li>
                            <a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/facility/information/">
                                <i class="fa fa-circle-o"></i> <span>施設情報</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($view['router']->path('admin_facility_mail_form')); ?>">
                                <i class="fa fa-th"></i> お問い合わせフォーム
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e($view['router']->path('admin_facility_mail_template')); ?>">
                                <i class="fa fa-circle-o"></i> <span>メールテンプレート</span>
                            </a>
                        </li>
						<li><a href="#"><i class="fa fa-circle-o"></i> 契約者情報</a></li>
						<li><a href="#"><i class="fa fa-circle-o"></i> お支払い状況</a></li>
					</ul>
				</li>

                <!--
				<li class="treeview">
					<a href="">
						<i class="fa fa-dashboard"></i> <span>サポート</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="fa fa-circle-o"></i> サポート窓口</a></li>
						<li><a href="#"><i class="fa fa-circle-o"></i> マニュアル</a></li>
					</ul>
				</li>
				
				<li class="header">システム管理</li>
				-->
			</ul>
		</div>

	</section>
	<!-- /.sidebar -->
</aside>