<?php $view->extend('::admin/layout/base.html.php') ?>

<?php $view['slots']->start('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		一覧 - アカウント管理
		<small> - Account List - </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo THREES__ADMIN_PATH; ?>facility/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> システム管理</li>
		<li class="active">アカウント管理</li>
	</ol>
</section>

<section class="content">
    <div class="box box-default">
	    <?php echo $view['form']->start($form) ?>
	    <?php $view['form']->setTheme($form, array(':form/default', ':form/admin'));?>
        <div class="box-header with-border">
            <h3 class="box-title">パスワード変更</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
            <?php echo $view['form']->row($form['current_password']); ?>
            </div>

            <div class="form-group">
	            <?php echo $view['form']->label($form['plainPassword']['first'], null, ['label_attr' => ['class' => '']]) ?>
	            <?php echo $view['form']->widget($form['plainPassword']['first'], ['attr' => ['class' => 'form-control']]) ?>
	            <?php echo $view['form']->errors($form['plainPassword']['first'], ['attr' => ['class' => 'text-danger']]); ?>
            </div>

            <div class="form-group">
		        <?php echo $view['form']->label($form['plainPassword']['second'], null, ['label_attr' => ['class' => '']]) ?>
		        <?php echo $view['form']->widget($form['plainPassword']['second'], ['attr' => ['class' => 'form-control']]) ?>
		        <?php echo $view['form']->errors($form['plainPassword']['second'], ['attr' => ['class' => 'text-danger']]); ?>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">保存する</button>
        </div>
	    <?php echo $view['form']->end($form) ?>
    </div>
</section>
<?php $view['slots']->stop() ?>