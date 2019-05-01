<?php

use src\Controller\CaptureController\CaptureController as controller;

if(isset($_POST['url'])) {
    $CaptureController = new controller();
    $CaptureController->setActionName('Capture')->setSsUrl($_POST['url']);
    return $CaptureController->getCapture();
}
?>
