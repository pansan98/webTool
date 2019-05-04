<?php
$template_css = [];
$template_js = [];
$content_template_tags = [];
?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title><?php echo THREES__SITE_TITLE ?></title>
	<?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/stylesheet.html.php'; ?>

</head>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
                <a href="<?php echo THREES__WEB_ROOT_PATH; ?>production/" class="site_title"><img src="https://placehold.jp/20/3d4070/473636/50x50.png?text=SSS&css=%7B%22background%22%3A%22%20-webkit-gradient(linear%2C%20left%20top%2C%20left%20bottom%2C%20from(%23E0E0E0)%2C%20to(%23F0F0F0))%22%7D" class="small_menu" /><span><img src="https://placehold.jp/20/3d4070/473636/50x50.png?text=SSS&css=%7B%22background%22%3A%22%20-webkit-gradient(linear%2C%20left%20top%2C%20left%20bottom%2C%20from(%23E0E0E0)%2C%20to(%23F0F0F0))%22%7D" style="margin:0px 5px;" /><?php echo THREES__SITE_TITLE; ?></span></a>
            </div>

            <div class="clearfix"></div>
            <!-- Left side column. contains the sidebar -->
            <?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/slide_left.html.php'; ?>
            </div>
        </div>
        <!-- top navigation -->
            <?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/header.html.php'; ?>
            <?php //include_once THREES__APP_ROOT_DIR . '/app/Resources/views/admin/layout/slide_right.html.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="right_col" role="main">
                <?php //include THREES__APP_ROOT_DIR . "/app/Resources/views/" . $contents_view; ?>
            </div>
            <!-- footer content -->
                <?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/footer.html.php'; ?>
            <!-- /footer content -->
        </div>
    </div>

    <?php /*
    <div id="croppic"></div>
    <?php
$content_js["raw"][] = <<<"EOT"
    var cropperOptions = {
        modal:true
        , loaderHtml:'<img class="loader" src="/datas/thumbnail_ca0131936f1282622e0449f037cbc10c.jpg" >'
    }
    var cropperHeader = new Croppic('croppic', cropperOptions);
EOT;
    ?>
     */ ?>
    <!-- Modal -->

    <!-- ./wrapper -->
    <?php //include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/template_tags.php'; ?>
    <?php include_once THREES__APP_ROOT_DIR  . '/app/Resources/views/admin/layout/javascript.php'; ?>

</body>

</html>
