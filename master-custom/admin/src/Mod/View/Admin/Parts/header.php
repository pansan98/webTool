<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
        <ul class="nav_hd">
            <li><a href="javascript:void(0);"><span>トップページ</span></a></li>
            <li><a href="javascript:void(0);"><span>ボタン</span></a></li>
            <li><a href="javascript:void(0);"><span>B</span></a></li>
        </ul>

      <p class="symbol"><span>Unknown</span></p>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php echo $user['user_nickname']; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:void(0);">authority</a></li>
            <li><a href="javascript:;">profile</a></li>
            <li><a href="<?php echo LOCATION; ?>/app/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->