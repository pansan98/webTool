<?php
include dirname(__FILE__).'/../../../../bootstrap.php';

use src\Mod\Controller\Base\BaseController as Controller;

$baseController = new Controller();
$actionController = $baseController->setActionName('Capture')->getController();
include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/head.php';
?>
 <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

              <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/nav.php'; ?>
              <div class="clearfix"></div>

              <!-- top navigation -->
              <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/side.php'; ?>

              <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/side_footer.php'; ?>

          </div>
        </div>

          <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/header.php'; ?>

        <!-- page content -->
          <div class="right_col" role="main">
              <div class="">
                  <div class="page-title">
                      <div class="title_left">
                          <h3><?php echo $actionController->getActionName(); ?></h3>
                      </div>
                      <div class="title_left">
                          <h3><a href="<?php //echo LOCATION_FRONT; ?>/user/category/">新規作成</a></h3>
                      </div>
                  </div>

                  <div class="clearfix"></div>

                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_title">
                                  <h2><?php echo $actionController->getActionName(); ?> Shot <small>Custom design</small></h2>
                                  <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>
                                      <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                          <ul class="dropdown-menu" role="menu">
                                              <li><a href="#">Settings 1</a>
                                              </li>
                                              <li><a href="#">Settings 2</a>
                                              </li>
                                          </ul>
                                      </li>
                                      <!--<li><a class="close-link"><i class="fa fa-close"></i></a>-->
                                      </li>
                                  </ul>
                                  <div class="clearfix"></div>
                              </div>

                              <?php
                                include $actionController->setRenderView('edit.html.php')->setDisplayName()->getRenderView();
                              ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /page content -->
        <!-- /page content -->

        <!-- footer content -->
        <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>

    <?php include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/common_js.php'; ?>
  </body>
</html>