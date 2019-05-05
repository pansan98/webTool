<?php
namespace src\App\AppHelper;

abstract class AppModelHelper {
    protected static $Helper;

    /**
     * @return mixed
     * get create instance
     */
    abstract public static function getInstance();

}
?>