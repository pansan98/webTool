<?php
namespace src\App\AppHelper\Controller;

use src\App\AppHelper\AppHelper;

class ControllerHelper extends AppHelper{
    protected static $instanceHelper;

    private $_arrDisplayName = [];

    private function __construct()
    {
        $this->_arrDisplayName = ["Admin", "Front"];
    }

    public static function getInstance($dbTable, $statement)
    {
        if(!self::$instanceHelper instanceof ControllerHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    public function getQueryParam($key)
    {
        $param = "";
        if(isset($_GET[$key]) || isset($_POST[$key]) || isset($_REQUEST[$key])) {
            if(isset($_GET[$key])) {
                $param = $_GET[$key];
            } elseif(isset($_POST[$key])) {
                $param = $_POST[$key];
            } elseif(isset($_REQUEST[$key])) {
                $param = $_REQUEST[$key];
            }
        }

        return $param;
    }

    public function getQuery()
    {
        $requestQuery = $_REQUEST;
        return $requestQuery;
    }

    public function getGetQuery()
    {
        $getQuery = $_GET;
        return $getQuery;
    }

    public function getGetQueryParam($key)
    {
        $getQuery = "";
        if(isset($_GET[$key])) {
            $getQuery = $_GET[$key];
        }

        return $getQuery;
    }

    public function getPostQuery()
    {
        $postQuery = $_POST;
        return $postQuery;
    }

    public function getPostQueryParam($key)
    {
        $postQuery = "";
        if(isset($_POST[$key])) {
            $postQuery = $_POST[$key];
        }

        return $postQuery;
    }

    public function getDisplayName()
    {
        $paramInt = 1;
        if(strpos($_SERVER['REQUEST_URI'], 'admin') !== false) {
            $paramInt = 1;
        } else {
            $paramInt = 0;
        }
        return $this->_arrDisplayName[$paramInt];
    }
}
?>