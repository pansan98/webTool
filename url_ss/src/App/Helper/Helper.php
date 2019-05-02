<?php
namespace src\App\Helper;

abstract class Helper {
    protected static $Helper;

    private function __construct()
    {

    }

    abstract public static function getInstance();


}
?>