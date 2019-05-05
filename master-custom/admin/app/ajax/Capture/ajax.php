<?php

use src\Mod\Controller\Base\BaseController as controller;

if(isset($_POST['capture_url'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $actionController = $baseController->setActionName('Capture')->getController();
    $actionController->setSsUrl($actionController->setHelper()->getPostQueryParam('capture_url'));
    if($actionController->setCapture()->getCaptureShot()) {
        $actionController->setRunSaves()->isRunSaves();
    }
}
?>
