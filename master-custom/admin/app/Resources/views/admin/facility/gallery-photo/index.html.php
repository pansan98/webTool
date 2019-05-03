<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		<?php echo $meta["page"]["title"]; ?><small></small>
	</h1>
	<ol class="breadcrumb hidden-sm hidden-xs">
		<li><a href="<?php echo THREES__WEB_ROOT_PATH; ?>admin/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo $meta["breadcrumbs"]["current"]["title"]; ?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">


    <div class="row">
        <div class="col-md-12">
            <div class="box notop">
                <div class="box-body">
                    <ul class="list-inline mb-0" style="margin-bottom: 0;">
                        <li>
                            <a href="<?php echo $meta["page"]["path"]; ?>photo-tags" class="btn btn-primary">タグ一覧</a>
                        </li>
                        <li>
                            <a href="<?php echo $meta["page"]["path"]; ?>sort" class="btn btn-primary"><i class="fa fa-sort"></i> 表示順変更</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
        <form method="POST" name="post_form" id="post_form" action="<?php echo $meta["page"]["path"]; ?>" enctype="multipart/form-data">

        <div class="col-md-12">
			<!-- Default box -->
			<div class="box notop">
				<!--<div class="box-header"></div>-->
				<div class="box-body">
					<?php foreach ($document->blocks->getList() as $block) : ?>
                        <!-- Start <?php echo $block->getTitle(); ?> -->
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
                        <!-- End <?php echo $block->getTitle(); ?> -->
					<?php endforeach; ?>

                    <button class="btn btn-primary" onclick="form_submit();">アップロード</button>
				</div>
				<!-- /.box-body -->
				<!-- /.box-footer-->
			</div>
			<!-- /.box -->
		</div>
        </form>
	</div>


    <div>
        <form method="get" action="<?php echo $meta["page"]["path"]; ?>">
            表示件数:
            <select class="form-control" onchange="this.form.submit()" style="display: inline; width: auto;" name="limit">
				<?php
				$limit = (int)$app->getRequest()->get('limit');
				foreach([12, 60, 120] as $value):
					$selected = ($limit == $value) ? ' selected="selected"' : '';
					?>
                    <option value="<?php echo $view->escape($value); ?>"<?php echo $selected; ?>><?php echo $view->escape($value); ?>件</option>
				<?php endforeach; ?>
            </select>
        </form>
    </div>

	<?php echo $view->render('admin/elements/pagination.html.php', [
		'paginator' => $items
	]); ?>

    <div class="container-fluid">
        <div class="row">
    　       <form>
                <div id="sortable-items">
                <?php
                $basePath = '/datas/';
                foreach($items as $item):
                    $imageData = (array)unserialize($item->image);
                    $imgFile = isset($imageData[0]['filename']) ? $basePath . $imageData[0]['filename'] : '';
	                $thumbFile = isset($imageData[0]['filename']) ? $basePath . 'thumbnail_' . $imageData[0]['filename'] : '';
                ?>
                <div class="col-xs-6 col-sm-4 col-md-3" data-id="<?php echo e($item->getId()); ?>">

                    <div class="box box-default">
                        <div class="box-body">
                            <a href="<?php echo $view->escape($view['router']->path('admin_facility_gallery_photo_detail', ['id' => $item->getId()])); ?>" class="square-thumb-preview" style="background-image: url(<?php echo e(THREES__WEB_ROOT_PATH . $thumbFile); ?>)"></a>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a class="btn btn-default" href="<?php echo $view->escape($view['router']->path('admin_facility_gallery_photo_detail', ['id' => $item->getId()])); ?>">編集</a>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger" onclick="item_delete('<?php echo $meta["page"]["path"];?>delete', <?php echo $item->getId(); ?>)">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            </form>
        </div>
    </div>

	<?php echo $view->render('admin/elements/pagination.html.php', [
		'paginator' => $items
	]); ?>
</section>
<!-- /.content -->
