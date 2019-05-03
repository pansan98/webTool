<?php include './../Parts/head.php'; ?>

<?php
require_once dirname(__FILE__) . '/../../app/model/Data/DataController.php';
$dataObj = new DataController();
$allData = array();
$allData = $dataObj->selectQueryUserData($user['user_id']);
//記事idとユーザーidが被るので記事データだけ取得
$individualData = $dataObj->getIndividualData($user['user_id']);
$cateData = $dataObj->getCategoryDataFromHorizontal($user['user_id'], 'create_user_id');
//現在のURLを保持
$request = new Request();
$request->setHoldRequestUrl();
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
                <h3>Datas </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" value="" placeholder="Search for title">
                    <span class="input-group-btn">
                      <button onclick="return searchVal();" class="btn btn-default" type="button">Search</button>
                    </span>
                      <span class="input-group-btn">
                      <button onclick="return input();" class="btn btn-default" type="button">新規作成</button>
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
                    <h2>Data design <small>Custom design</small></h2>
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
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Title </th>
                            <th class="column-title">Category </th>
                            <th class="column-title">photo </th>
                            <th class="column-title">Recommend </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">More </th>
<!--                            <th class="column-title no-link last"><span class="nobr">Action</span>-->
<!--                            </th>-->
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php $cnt = 0; ?>
                        <?php foreach ($individualData as $key => $val): ?>
                            <?php
                                if ($val['is_recommend'] == 1) {
                                    $recommendCheckStatus = 'checked';
                                } else {
                                    $recommendCheckStatus = '';
                                }
                                if ($val['is_secret'] == 1) {
                                    $openCheckStatus = 'checked';
                                } else {
                                    $openCheckStatus = '';
                                }
                            ?>
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?php echo $val['name']; ?></td>
                            <td class=" "><?php echo $cateData[$val['category_id']]['category_name']; ?></td>
                            <td style="width: 15%;" class=" ">
                            <?php if($val['image'] != '') : ?><img style="width: 50%;" src="<?php echo LOCATION_FRONT.'/upload/'.$user['user_id'].'/'.$val['image']; ?>"><?php endif; ?>
                            </td>
                            <td class=" ">
                                <p class="is_recommend_display<?php echo $cnt; ?>"><?php echo ( ($val['is_recommend'] == 1) ?'おすすめ表示してる':'おすすめ表示してない'); ?></p>
                                <label>
                                    <input type="checkbox" class="is_recommend recommend_msg_data<?php echo $cnt; ?>" name="is_recommend" value="<?php echo $val['id']; ?>" <?php echo $recommendCheckStatus; ?>>
                                    <span>おすすめ表示</span>
                                </label>
                            </td>
                              <td class=" ">
                                  <p class="is_secret_display<?php echo $cnt; ?>"><?php echo '現在、' . ( ($val['is_secret'] == 1) ? '公開中' : '非公開中') ;?></p>
                                  <label>
                                      <input type="checkbox" class="is_secret secret_msg_data<?php echo $cnt; ?>" name="is_secret" value="<?php echo $val['id'] ;?>" <?php echo $openCheckStatus; ?>>
                                      <span>公開状況</span>
                                  </label>
                              </td>
                            <td class=" last"><a href="<?php echo $val['id']; ?>">View</a>
                            </td>
                          </tr>
                        <?php $cnt++; ?>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
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
      $(function() {

          //ユーザーネーム
          var _userName;


          $(window).on('load', function() {
              setUserName('<?php echo $user['nickname']; ?>');
          });

          var _dataLen = $('.is_recommend').length;

          //初回時のdisable設定
          for (cnt = 0; cnt<_dataLen; cnt++) {
              var changeNo = cnt;
              recommendEnabled(changeNo);
          }

          $('.is_recommend').change(function() {
              for (cntReco = 0; cntReco<_dataLen; cntReco++) {
                  if ($(this).hasClass('recommend_msg_data'+cntReco)) {
                      var changeRow = cntReco;
                  }
              }
              var columnName = $(this).attr('name');
              var is_recommendId = $(this).val();
              var is_recommendCheck = $(this).is(':checked');
              if (is_recommendCheck) {
                  var is_recommendChange = 1;
              } else {
                  var is_recommendChange = 9;
              }
              $.ajax({
                  url : "<?php echo LOCATION; ?>/app/core/Request/AjaxQuery.php",
                  type : "POST",
                  data :{"id": is_recommendId, "is_value": is_recommendChange, "name": columnName, "nameWhenSend": "checkbox"}
              }).done(function(response){
                  if (is_recommendChange == 1) {
                      console.log(response);
                      msg = 'おすすめ表示してる';
                  } else {
                      msg = 'おすすめ表示してない';
                  }
                  $('.is_recommend_display'+changeRow).html(msg);
              }).fail(function(xhr, textStatus, errorThrow){
                  alert('データの変更に失敗しました。<br>システムエラー：'+errorThrow);
                  console.log(textStatus);
              });
          });

          $('.is_secret').change(function() {
              var columnName = $(this).attr('name');
              for (cntStat = 0; cntStat<_dataLen; cntStat++) {
                  if( $(this).hasClass('secret_msg_data'+cntStat)) {
                      var changeRow = cntStat;
                  }
              }
              var is_secretId = $(this).val();
              var is_secretCheck = $(this).is(':checked');
              if (is_secretCheck) {
                  var is_secretChange = 1;
              } else {
                  var is_secretChange = 9;
              }
              $.ajax({
                  url : "<?php echo LOCATION ;?>/app/core/Request/AjaxQuery.php",
                  type : "POST",
                  data :{"id":is_secretId, "is_value":is_secretChange, "name":columnName, "nameWhenSend": "checkbox"}
              }).done(function(response) {
                  if (is_secretChange == 1) {
                      msg = '公開中';
                  } else {
                      msg = '非公開中';
                  }
                  if ($('.recommend_msg_data' + changeRow).is(':checked') === true) {
                      $('.recommend_msg_data' + changeRow).trigger('click');
                  }
                  recommendEnabled(changeRow);
                  $('.is_secret_display' + changeRow).html('現在、' + msg);
              }).fail(function(xhr,textStatus, errorThrow) {
                  alert('データの変更に失敗しました。<br>システムエラー：'+errorThrow);
                  console.log(textStatus);
                  document.write('システムエラー文を管理者に送信しました。');
              });
          });

      });

      function recommendEnabled(change) {
          if ($('.secret_msg_data'+change).is(':checked') === true) {
              $('.recommend_msg_data'+change).prop('disabled', false);
          } else {
              $('.recommend_msg_data'+change).prop('disabled', true);
          }
      }

      function setUserName(userName) {
          this._userName = userName;
      }

      function getUserName() {
          return this._userName;
      }

      function searchVal() {
          if ($('.form-control').val() != '') {
              searchValue = $('.search-val').val();
              console.log(searchValue);
          } else {
              alert('検索するタイトルを入力してください。');
          }
      }

      function input() {
          window.location.href = './input.php';
          return false;
      }
  </script>
  </body>
</html>