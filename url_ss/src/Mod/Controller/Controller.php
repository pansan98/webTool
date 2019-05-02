<?php
namespace src\Mod\Controller;

include_once dirname(__FILE__).'/../../App/bootstrapRootController.php';

class Controller {
    public function getHelloWorld()
    {
        echo 'Hello world';
    }
}
?>