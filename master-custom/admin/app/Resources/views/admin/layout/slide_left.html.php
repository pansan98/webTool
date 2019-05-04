<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section menu_section_first">
		<h3>メニュー</h3>
		<ul class="nav side-menu">
			<li><a href="<?php echo e($view['router']->path('admin_master_facilities')); ?>"><i class="fa fa-home"></i> Home </a>
			</li>
			<li><a><i class="fa fa-edit"></i> スライドダウン <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form.html">General Form</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_advanced.html">Advanced Components</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_validation.html">Form Validation</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_wizards.html">Form Wizard</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_upload.html">Form Upload</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_buttons.html">Form Buttons</a></li>
				</ul>
			</li>
			</li>
			<li><a><i class="fa fa-edit"></i> デモ <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form.html">デモ1</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_advanced.html">デモ2</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_validation.html">デモ3</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Forms/form_wizards.html">デモ4</a></li>
				</ul>
			</li>
			<li><a href="<?php echo e($view['router']->path('admin_master_facilities')); ?>"><i class="fa fa-home"></i> 単発系1 </a>
			</li>
			<li><a href="<?php echo e($view['router']->path('admin_master_facilities')); ?>"><i class="fa fa-home"></i> 単発系2 </a>
			</li>
		</ul>
	</div>
	<div class="menu_section">
		<h3>Live On</h3>
		<ul class="nav side-menu">
			<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/e_commerce.html">E-commerce</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/projects.html">Projects</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/project_detail.html">Project Detail</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/contacts.html">Contacts</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/profile.html">Profile</a></li>
				</ul>
			</li>
			<li><a><i class="fa fa-bug"></i> 管理 <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/e_commerce.html">アカウント</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/projects.html">設定</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/project_detail.html">追加</a></li>
					<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/Additional/contacts.html">作成</a></li>
				</ul>
			</li>
			<li class="coming_soon"><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
		</ul>
	</div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
	<a data-toggle="tooltip" data-placement="top" title="Versions">
		<span class="glyphicon" aria-hidden="true">ver<?php echo THREES__VERSION; ?></span>
	</a>
</div>
<!-- /menu footer buttons -->
