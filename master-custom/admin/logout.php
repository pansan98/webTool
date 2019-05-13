<?php
include dirname(__FILE__).'/../bootstrap.php';

use src\Mod\Controller\Base\BaseController as Controller;

$baseController = new Controller();
$actionController = $baseController->setActionName('User')->getController();
$actionController->getLogout()->redirectShowLoginScreen();