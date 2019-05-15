<?php
namespace src\App\Doctrine;


use src\App\Repository\Repository;

class Doctrine extends Repository {
    public static $instance;

    private function __construct()
    {

    }


    public static function getDoctrine()
    {
        return self::getInstance();
    }
}
?>