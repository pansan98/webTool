<?php include './../Parts/head.php'; ?>
<?php
require_once dirname(__FILE__) . '/../../app/model/Data/DataController.php';
$dataObj = new DataController();
$cateData = $dataObj->getCategoryDataFromHorizontal($user['user_id'], 'create_user_id');
?>

<link rel="stylesheet" type="text/css" href="<?php echo LOCATION_FILE; ?>/css/common.css">
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php include './../Parts/nav.php'; ?>

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
            <?php include './../Parts/side.php'; ?>

            <!-- /menu footer buttons -->
            <?php include './../Parts/side_footer.php'; ?>
          </div>
        </div>

        <!-- top navigation -->
        <?php include './../Parts/header.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Create <span>Data</span></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data design <small>Custom design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Pattern 1</a>
                          </li>
                          <li><a href="#">Pattern 2</a>
                          </li>
                            <li><a href="javascript:void(0);">coming soon</a></li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>

                    <div class="table-responsive">
                      <form action="<?php echo LOCATION; ?>/production/Additional/additional.php" name="createData" method="post" enctype="multipart/form-data" class="form">
                      <input type="hidden" name="form_name" value="yamada">
                      <input type="hidden" name="user_id[user_id]" value="<?php echo $user['user_id']; ?>">
                      <table class="table table-striped jambo_table bulk_action">
                          <tr class="headings">
                            <th class="column-title" style="width: 20%;">タイトル </th>
                            <td class=" "><input type="text" name="name[name]" value="" size="80"></td>
                          </tr>
                          <tr>
                            <th class="column-title">値段 </th>
                            <td class=" "><input type="text" name="price[price]" value=""></td>
                          </tr>
                          <tr>
                            <th class="column-title">画像 </th>
                              <td><input type="file" name="file" value=""></td>
                          </tr>
                          <?php if(count($cateData) > 0): ?>
                              <tr>
                                  <th class="column-title">カテゴリ </th>
                                  <td>
                                    <?php foreach ($cateData as $key => $val): ?>
                                    <label>
                                        <input type="radio" name="category_id[category_id]" value="<?php echo $key; ?>"><?php echo $val['category_name']; ?>
                                    </label>
                                    <?php endforeach; ?>
                                  </td>
                              </tr>
                          <?php endif; ?>
                          <tr>
                            <th class="column-title">コメント </th>
                              <td><textarea name="description[description]" rows="10" cols="150" value="" style="width: 100%;"></textarea></td>
                          </tr>
                          <tr>
                            <th class="column-title">おすすめ表示/非表示 </th>
                              <td>
                                  <label>
                                      <input type="radio" name="is_recommend[is_recommend]" value="1">
                                      おすすめ表示する
                                  </label>
                                  <label>
                                      <input type="radio" name="is_recommend[is_recommend]" value="9" checked>
                                      おすすめ表示しない
                                  </label>
                              </td>
                          </tr>
                          <tr>
                            <th class="column-title">公開/非公開 </th>
                              <td>
                                  <label>
                                      <input type="radio" name="is_secret[is_secret]" value="1" checked>
                                      公開にする
                                  </label>
                                  <label>
                                      <input type="radio" name="is_secret[is_secret]" value="9">
                                      非公開にする
                                  </label>
                              </td>
                          </tr>
                      </table>
                      </form>
                        <p><a onclick="sendData();" href="javascript:void(0);">作成</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include './../Parts/footer.php'; ?>
      </div>
    </div>

    <?php include './../Parts/common_js.php'; ?>
  <script type="text/javascript">
      function sendData() {
          form = $('.form');
          form.submit();
      }
  </script>
  </body>
</html>