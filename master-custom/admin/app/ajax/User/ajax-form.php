<?php

use src\Mod\Controller\Base\BaseController as controller;
session_start();
if(isset($_POST['user_form_status'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $actionController = $baseController->setActionName('User')->getController();
    if($_POST['user_form_status']) {
        $status = $actionController->setDbUserSaves($_POST);
        if(isset($status['error'])){
            $form = $status;
            include $actionController->setDisplayName()->setRenderView($form['display'].'.html.php')->getRenderView();
        } else {
            echo true;
        }
    }
}
?>
