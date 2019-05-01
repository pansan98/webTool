<?php
namespace src\Mod\Controller;

include_once dirname(__FILE__).'/../../App/bootstrapRoot.php';

class Controller {
    public function getHelloWorld()
    {
        echo 'Hello world';
    }
}
?>