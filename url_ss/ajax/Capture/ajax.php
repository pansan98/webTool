<?php

use src\Mod\Controller\Capture\CaptureController as controller;

if(isset($_POST['url'])) {
    require_once '../../vendor/autoload.php';
    $CaptureController = new controller();
    $CaptureController->setActionName('Capture')->setSsUrl($_POST['url']);
    return $CaptureController->getCapture();
}
?>
