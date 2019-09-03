<?php

use src\Mod\Controller\Base\BaseController as controller;

if(isset($_POST['capture_url'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $userController = $baseController->setActionName('User')->getController();
    $actionController = $baseController->setActionName('Capture')->getController();
    $status = $actionController->setHelper()->getPostQueryParam('capture_url');
    if(isset($status['error'])) {
        $form = $status;
        echo $actionController->setRenderView('edit.html.php')->setDisplayName()->getRenderView(compact("form", "userController"));
    } else {
        $actionController->setSsUrl($status);
        if($actionController->setCapture()->getCaptureShot()) {
            $actionController->setRunSaves()->isRunSaves();
            echo "SUCCESS";
        }
    }
}
?>
