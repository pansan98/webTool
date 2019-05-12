<?php

use src\Mod\Controller\Base\BaseController as controller;
session_start();
if(isset($_POST['user_form_status'])) {
    include_once dirname(__FILE__).'/../../../../bootstrap.php';
    $baseController = new controller();
    $actionController = $baseController->setActionName('User')->getController();
    $actionController->getLogout();
    echo $actionController->redirectShowLoginScreen(0);
}
?>
