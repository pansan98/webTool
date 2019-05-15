<?php
namespace src\App\Repository;


class Repository {
    public static $instance;

    private function __construct()
    {

    }

    public function getRepository($repository)
    {
        return $repository::getInstance();
    }

    protected static function getInstance()
    {
        if(!self::$instance instanceof Repository) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
?>