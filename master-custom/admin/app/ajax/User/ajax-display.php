<?php

use src\Mod\Controller\Base\BaseController as controller;
session_start();
if(isset($_POST['display'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $actionController = $baseController->setActionName('User')->getController();
    include $actionController->setDisplayName()->setRenderView($_POST['display'].'.html.php')->getRenderView();
}
?>
