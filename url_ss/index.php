<?php
require_once "vendor/autoload.php";

use src\Mod\Controller\Capture\CaptureController as controller;

$controller = new controller();
$controller->setActionName('Capture')->setRenderView('index.html.php');
include dirname(__FILE__) . '/src/Mod/View/'.$controller->getActionName().'/template/head.html.php';
include $controller->getRenderView();
?>
