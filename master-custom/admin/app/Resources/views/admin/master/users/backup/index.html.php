<?php $view->extend('::admin/layout/base.html.php') ?>

<?php $view['slots']->start('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		一覧 - アカウント管理
		<small> - Account List - </small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo e($view['router']->path('admin_master')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> システム管理</li>
		<li class="active">アカウント管理</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<p><a class="btn btn-primary" href="<?php echo e($view['router']->path('admin_master_users_register')) ?>">新規作成</a></p>
	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border"></div>
		<div class="box-body">
			<table class="table table-striped table-bordered">
			<tr>
				<th>No</th>
                <th>アカウント名</th>
                <th>メールアドレス</th>
                <th>ロール</th>
                <th>最終ログイン</th>
                <th>操作</th>
			</tr>
			<?php foreach ($users as $user) : ?>
			<tr>
				<td><?php echo $user->getId(); ?></td>
				<td><?php echo $user->getUserName(); ?></td>
				<td><?php echo $user->getEMail(); ?></td>
				<td><?php echo implode(", ", $user->getRoles()); ?></td>
				<td><?php echo is_null($lastLoginDate = $user->getLastLogin()) ? "[No Login]" : $lastLoginDate->format('Y-m-d H:i'); ?></td>
				<td>
					<form action="<?php echo $view['router']->path('admin_master_users_edit', ['account' => $user->getUserName()]); ?>" method="GET">
						<input type="submit" value="編集">
					</form>
					<form action="<?php echo $view['router']->path('admin_master_users_change_password', ['account' => $user->getUserName()]); ?>" method="GET">
						<input type="submit" value="パスワード変更">
					</form>
					<form action="<?php echo $view['router']->path('admin_master_users_delete', ['account' => $user->getUserName()]); ?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
						<input type="submit" value="削除">
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			
		</div>
		<!-- /.box-footer-->
	</div>
	<!-- /.box -->

</section>
<!-- /.content -->
<?php $view['slots']->stop() ?>
