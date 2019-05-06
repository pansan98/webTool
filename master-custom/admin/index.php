<?php
session_start();
include dirname(__FILE__).'/../bootstrap.php';

use src\Mod\Controller\Base\BaseController as Controller;

$baseController = new Controller();
$actionController = $baseController->setActionName('User')->getController();
if($actionController->getIsLoggedIn()) {
    $actionController->getRedirect();
}
include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.'Admin/Parts/head.php';

?>
<script src="<?php echo WEB_TOOL__MASTER_CUSTOM__ROOT_PATH; ?>admin/vendors/jquery/dist/jquery.min.js"></script>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <?php
        include $actionController->setDisplayName()->setRenderView('index.html.php')->getRenderView();
        ?>
    </div>
</body>