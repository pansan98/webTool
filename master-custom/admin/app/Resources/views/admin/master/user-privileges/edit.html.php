
<!-- Content Header (Page header) -->
<section class="content-header">
	<a href="./" class="btn btn-left">一覧へ戻る</a>
	<h1><?php echo $meta["page"]["title"]; ?><small></small></h1>
	<ol class="breadcrumb hidden-sm hidden-xs">
		<li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li> ...</li>
		<li><a href="<?php echo $meta["breadcrumbs"]["parent"]["path"]; ?>"><i class="fa fa-dashboard"></i> <?php echo $meta["breadcrumbs"]["parent"]["title"]; ?></a></li>
		<li class="active"><?php echo $meta["breadcrumbs"]["current"]["title"]; ?></li>
	</ol>


</section>

<!-- Main content -->
<section class="content">
	<!--
	<div class="callout callout-danger">
		<h4>Error!</h4>
		<p>- エラーが発生しました。</p>
	</div>
	-->
	<div class="row">
		<form method="POST" name="post_form" id="post_form" action="<?php echo $meta["page"]["path"]; ?>" enctype="multipart/form-data">

			<div class="col-sm-12 col-lg-8">
				<?php if (isset($document)) : ?>
					<?php foreach ($document->blocks->getList() as $block) : ?>
						<!-- Start <?php echo $block->getTitle(); ?> -->
						<?php if (is_null($block->getTitle())): ?>
							<?php
							foreach ($block->templates->getList() as $template) :
								//テンプレート設定
								include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/" . $template->getPath() . ".php";
							endforeach;
							?>
						<?php else: ?>
							<div class="box box-info">
								<div class="box-header" style="border-bottom: 1px solid #d2d6de;">
									<p><?php echo $block->getTitle(); ?></p>
								</div>
								<?php if (!Empty($block->getHeaderComment())): ?>
									<div class="box-body pad header"><?php echo $block->getHeaderComment(); ?></div>
								<?php endif; ?>
								<?php
								foreach ($block->templates->getList() as $template) :
									//テンプレート設定
									include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/" . $template->getPath() . ".php";
								endforeach;
								?>
								<?php if (!Empty($block->getFooterComment())): ?>
									<div class="box-body pad footer"><?php echo $block->getFooterComment(); ?></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<!-- End <?php echo $block->getTitle(); ?> -->
					<?php endforeach; ?>
				<?php endif; ?>

			</div>
			<div class="col-sm-12 col-lg-4">
				<?php if ($document->usePublicStatus()): ?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">公開ステータス</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<?php $public_list = ["1" => "公開", "9" => "非公開"]; ?>
									<select class="form-control" name="public_status">
										<?php foreach ($public_list as $key => $val): ?>
											<option value="<?php echo $key; ?>" <?php echo $key == $document->getPublicStatus() ? "selected" : ""; ?>><?php echo $val; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				<?php endif; ?>
				<?php if ($document->usePublicRange()): ?>
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">公開期間</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
									<i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-12 col-xs-12">年月日</label>
								<div class="input-group date" id="myDatepicker_start_date">
									<input type="text" class="form-control date" name="public_start_date" id="public_start_date" value="<?php echo $document->getPublicStartDate(); ?>">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-12 col-xs-12">時分</label>
								<div class="input-group date" id="myDatepicker_start_time">
									<input type="text" class="form-control time" name="public_start_time" id="public_start_time" value="<?php echo $document->getPublicStartTime(); ?>">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time timepicker"></span>
									</span>
								</div>
							</div>
							<div class="text-center">〜</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-12 col-xs-12">年月日</label>
								<div class="input-group date" id="myDatepicker_end_date">
									<input type="text" class="form-control date" name="public_end_date" id="public_end_date" value="<?php echo $document->getPublicEndDate(); ?>">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="form-group ">
								<label class="control-label col-md-3 col-sm-12 col-xs-12">時分</label>
								<div class="input-group bootstrap-timepicker" id="myDatepicker_end_time">
									<input type="text" class="form-control time" name="public_end_time" id="public_end_time" value="<?php echo $document->getPublicEndTime(); ?>">
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
							
						</div>
					</div>
				
				<?php endif; ?>
				<div class="box">
					<div class="box-body center">
						<a href="javascript:void(0);" class="btn btn-block" onclick="form_submit();" style="width: inherit;">登録</a>
						<!--<button type="button" class="btn btn-info">プレビュー</button>
						<button type="submit" class="btn btn-primary"return false;">登録</button>-->
					</div>
				</div>
				
			</div>
		</form>
	</div>
</section>
<!-- /.content -->

<?php
$content_js["init"][] = "$('input.date').datetimepicker({locale: 'ja',format : 'YYYY-MM-DD'});";
$content_js["init"][] = "$('input.time').datetimepicker({locale: 'ja',format : 'HH:mm'});";
?>
