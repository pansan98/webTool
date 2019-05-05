<?php

use src\Mod\Controller\Capture\CaptureController as controller;

if(isset($_POST['url'])) {
    include_once dirname(__FILE__).'/../../../master-custom/bootstrap.php';
    $CaptureController = new controller();
    $CaptureController->setActionName('Capture')->setSsUrl($_POST['url']);
    if($CaptureController->setCapture()->getCaptureShot()) {
        $CaptureController->setRunSaves()->isRunSaves();
    }
}
?>
