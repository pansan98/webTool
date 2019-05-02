<?php
namespace src\App\AppHelper;

abstract class AppHelper {
    protected static $Helper;

    private function __construct()
    {

    }

    abstract public static function getInstance();


}
?>