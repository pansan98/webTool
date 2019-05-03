<?php $view->extend('::admin/layout/base.html.php') ?>

<?php $view['slots']->start('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		一覧 - アカウント管理
		<small> - Account List - </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> システム管理</li>
		<li class="active">アカウント管理</li>
	</ol>
</section>

<section class="content">
	<?php echo $view['form']->start($form) ?>
	<?php $view['form']->setTheme($form, array(':form/default', ':form/admin'));?>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">ユーザー作成</h3>
        </div>
        <div class="box-body">
            <?php echo $view['form']->widget($form) ?>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary" type="submit">保存する</button>
        </div>
    </div>
	<?php echo $view['form']->end($form) ?>
</section>
<?php $view['slots']->stop() ?>
