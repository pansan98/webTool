<?php
namespace src\App\AppHelper\Controller;

use src\App\AppHelper\AppControllerHelper;

class ControllerHelper extends AppControllerHelper{
    protected static $instanceHelper;

    private $_displayName = [];

    private $_arrParam = [
        "user_id" => "ユーザーID",
        "user_password" => "ユーザーパスワード",
        "user_name" => "ユーザーネーム"
    ];

    private function __construct()
    {
        $this->_displayName = ["Admin", "Front"];
    }

    public static function getInstance()
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
        if(strpos($_SERVER['SCRIPT_NAME'], 'admin') !== false) {
            $paramInt = 0;
        } else {
            $paramInt = 1;
        }
        return $this->_displayName[$paramInt];
    }

    public function getForm($post)
    {
        $arrPost = [];
        foreach ($post as $key => $val) {
            if($val == "") {
                $arrPost['error'][$key] = $this->getAddParam($key).'の入力をしてください。';
            }
            if(is_array($val)) {
                $this->getForm($val);
            } else {
                $arrPost[$key] = htmlspecialchars(strip_tags(mb_convert_encoding($val, 'UTF-8', 'auto')));
            }
        }

        return $arrPost;
    }

    protected function getAddParam($key)
    {
        return $this->_arrParam[$key];
    }
}
?>