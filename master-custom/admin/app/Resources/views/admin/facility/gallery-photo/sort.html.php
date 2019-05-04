<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
		<?php echo $meta["page"]["title"]; ?>
        <small></small>
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
                    <a href="<?php echo $meta["page"]["path"]; ?>" class="btn btn-primary"><i class="fa  fa-reply"></i>
                        一覧へ戻る</a>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="<?php echo $meta["page"]["path"]; ?>update-order">
        <div>
            <button class="btn btn-primary" type="submit">順番を保存する</button>
        </div>

        <div class="container-fluid">
            <div class="row">
                　
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
                                <div class="box-header with-border">
                        <span class="sortable-handle">
                            <i class="fa fa-arrows" aria-hidden="true"></i> 移動
                        </span>
                                </div>
                                <div class="box-body">
                                    <div class="square-thumb-preview"
                                         style="background-image: url(<?php echo e(THREES__WEB_ROOT_PATH . $thumbFile); ?>)"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">順番を保存する</button>
        </div>

        <input id="sort-order" type="hidden" name="order" value="">
    </form>
</section>
<!-- /.content -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('sortable-items');
        var order = document.getElementById('sort-order');
        var sortable = Sortable.create(el, {
            animation: 150,
            dataIdAttr: 'data-id',
            onUpdate: function (evt) {
                order.value = this.toArray();
                console.log(this.toArray());
            }
        });
    });
</script>