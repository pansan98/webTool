<?php $view->extend('::admin/layout/base.html.php') ?>

<?php $view['slots']->start('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		新規 - アカウント管理
		<small> - Account List - </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> システム管理</li>
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/users/">アカウント管理</a></li>
		<li class="active">新規作成</li>
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



<?php /*
<!-- Main content -->
<section class="content">
	
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border"></div>
		<div class="box-body">
			
<?php echo $view['form']->start($form) ?>
<?php echo $view['form']->widget($form) ?>
	<div>
        <input type="submit" value="送信" />
    </div>
<?php echo $view['form']->end($form) ?>
			
			<!-- Form Start -->
			<?php //echo $view['form']->form($form) ?>
			<!-- Form End -->
			<!--
			<table class="table table-striped table-bordered">
				<?php //foreach ($form as $field): ?>
				<tr>
					<th>
						<?php //echo $field->renderLabel() ?>
						<?php //echo $field->render() ?>
					</th>
				</tr>
				 <?php //endforeach; ?>
			</table>
			</form>
			-->
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			
		</div>
		<!-- /.box-footer-->
	</div>
	<!-- /.box -->

</section>
<!-- /.content -->
*/ ?>