<?php include './../../Parts/head.php'; ?>
<?php
require_once dirname(__FILE__) . '/../../../app/model/Data/DataController.php';
$dataObj = new DataController();
$recommendData = $dataObj->selectRecommendQuery($user['user_id']);
$cateData = $dataObj->getCategoryDataFromHorizontal($user['user_id'], 'create_user_id');
?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include './../../Parts/nav.php'; ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div> -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include './../../Parts/side.php'; ?>

            <!-- /menu footer buttons -->
            <?php include './../../Parts/side_footer.php'; ?>
          </div>
        </div>

        <!-- top navigation -->
        <?php include './../../Parts/header.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
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
                    <h2>Follows <small>Users</small></h2>
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
                    <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <?php if(count($recommendData) > 0): ?>
                      <thead>
                        <tr>
                            <th class="column-title">Title </th>
                            <th class="column-title">Category </th>
                            <th class="column-title">photo </th>
                            <th class="column-title">Description </th>
                            <th class="column-title">Date </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($recommendData as $key => $val) : ?>
                            <tr>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $cateData[$val['category_id']]['category_name']; ?></td>
                                <td style="width:15%;"><img style="width:50%;" src="<?php echo LOCATION_FRONT.'/upload/'.$user['user_id'].'/'.$val['image']; ?>"</td>
                                <td><?php echo $val['description']; ?></td>
                                <td><?php echo date($val['data_range']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <?php else: ?>
                          <p>現在おすすめ表示してるデータはありません。</p>
                      <?php endif; ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include './../../Parts/footer.php'; ?>
      </div>
    </div>

    <?php include './../../Parts/common_js.php'; ?>

  </body>
</html>