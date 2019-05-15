<?php
include __DIR__.'/../../bootstrap.php';
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

 <script type="text/javascript">
     function sendLogOut() {

     }
 </script>
  </body>
</html>