<?php

use src\Mod\Controller\Base\BaseController as controller;
session_start();
if(isset($_POST['user_form_status'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $actionController = $baseController->setActionName('User')->getController();
    if($_POST['user_form_status']) {
        if($_POST["display"] == "create") {
            $status = $actionController->setDbUserSaves($_POST);
            if(isset($status['error'])){
                $form = $status;
                include $actionController->setDisplayName()->setRenderView($_POST['display'].'.html.php')->getRenderView();
            } else {
                $actionController->getRedirect();
            }
        } elseif($_POST["display"] == "login") {
            $status = $actionController->setDbUserSaves($_POST);
            if(isset($status['error'])){
                $form = $status;
                include $actionController->setDisplayName()->setRenderView($_POST['display'].'.html.php')->getRenderView();
            } else {
                $actionController->getRedirect();
            }
        }
    }
}
?>
