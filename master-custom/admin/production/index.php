
<?php
include dirname(__FILE__).'/../../bootstrap.php';
include WEB_TOOL__MASTER_CUSTOM_ROOT_MOD__VIEW_DIR.'Admin/Parts/head.php';
?>
<?php
//require_once dirname(__FILE__) . '/../../app/model/Category/CategoryController.php';
//$cateObj = new CategoryCOntroller();
//$cateData = $cateObj->getCategoryData($user['user_id'], 'create_user_id');
//$request = new Request();
//$request->setHoldRequestUrl();
?>
 <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

              <?php include './../Parts/nav.php'; ?>
              <div class="clearfix"></div>

              <!-- top navigation -->
              <?php include './../Parts/side.php'; ?>

              <?php include './../Parts/side_footer.php'; ?>

          </div>
        </div>

          <?php include './../Parts/header.php'; ?>

        <!-- page content -->
          <div class="right_col" role="main">
              <div class="">
                  <div class="page-title">
                      <div class="title_left">
                          <h3>Category <small>Data</small></h3>
                      </div>
                      <div class="title_left">
                          <h3><a href="<?php echo LOCATION_FRONT; ?>/user/category/">新規作成</a></h3>
                      </div>

                      <div class="title_right">
                          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                              <div class="input-group">
                                  <input type="text" class="form-control" value="" placeholder="Search for title">
                                  <span class="input-group-btn">
                      <button onclick="return searchVal();" class="btn btn-default" type="button">Search</button>
                    </span>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="clearfix"></div>

                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_title">
                                  <h2>Category Data <small>Custom design</small></h2>
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
                                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                                      </li>
                                  </ul>
                                  <div class="clearfix"></div>
                              </div>

                              <div class="x_content">

                                  <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>

                                  <div class="table-responsive">
                                      <?php if (count($cateData) > 0): ?>
                                      <table class="table table-striped jambo_table bulk_action">
                                          <thead>
                                          <tr class="headings">
                                              <th>
                                                  <input type="checkbox" id="check-all" class="flat">
                                              </th>
                                              <th class="column-title">Category Name </th>
                                              <th class="column-title">Create Date </th>
                                              <th class="column-title">Edit</th>
                                              <th class="column-title">delete</th>
                                          </tr>
                                          </thead>

                                          <tbody>
                                          <?php foreach ($cateData as $key => $val): ?>
                                              <tr class="even pointer">
                                                  <td class="a-center ">
                                                      <input type="checkbox" class="flat" name="table_records">
                                                  </td>
                                                  <td class=" "><?php echo $val['category_name']; ?></td>
                                                  <td class=" "><?php echo date($val['create_date']); ?></td>
                                                  <td class=" "><a href="javascript:void(0);" onclick="editCategory(<?php echo $val['id']; ?>, 'category');">編集</a></td>
                                                  <td class=" "><a onclick="deleteCategory(<?php echo $val['id']; ?>, 'category');" href="javascript:void(0);">削除</a></td>
                                              </tr>
                                          <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                      <?php else: ?>
                                          <p>現在作成したカテゴリはありません。</p>
                                      <?php endif; ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /page content -->
        <!-- /page content -->

        <!-- footer content -->
        <?php include './../Parts/footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>

    <?php include './../Parts/common_js.php'; ?>

    <script type="text/javascript">
        function deleteCategory(id, data) {
            conf = confirm('削除します。よろしいですか？');
            if (conf == true) {
                window.location.href = '../../app/model/Data/delete.php?id='+id+'&data='+data;
            } else {
                return false;
            }
        }
    </script>
  </body>
</html>