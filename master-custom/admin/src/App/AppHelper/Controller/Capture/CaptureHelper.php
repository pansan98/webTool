<?php
namespace src\App\AppHelper\Controller\Capture;

use src\App\AppHelper\Controller\ControllerHelper;

class CaptureHelper extends ControllerHelper{
    protected static $instanceHelper;

    protected $_init = [];

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(!self::$instanceHelper instanceof CaptureHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    public function getQuery()
    {
        return parent::getQuery();
    }

    public function getQueryParam($key)
    {
        return parent::getQueryParam($key);
    }

    public function getGetQuery()
    {
        return parent::getGetQuery();
    }

    public function getGetQueryParam($key)
    {
        return parent::getGetQueryParam($key);
    }

    public function getPostQuery()
    {
        return parent::getPostQuery();
    }

    public function getPostQueryParam($key)
    {
        return parent::getPostQueryParam($key);
    }

    public function setInit($key, $value)
    {
        $this->_init[$key] = $value;
        return $this;
    }

    protected function getInit($key)
    {
        return $this->_init[$key];
    }

    public function getRandomText()
    {
        $str = array_merge(range('a', 'z'), range('A', 'Z'));
        $randomText = null;
        for($i = 0; $i <= $this->getInit('length'); $i++) {
            $randomText .= $str[rand(0, count($str) - 1)];
        }

        return $this->getInit('date').'_'.$randomText;
    }

}
?>