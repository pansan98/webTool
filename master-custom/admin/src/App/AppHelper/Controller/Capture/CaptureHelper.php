<?php
namespace src\App\AppHelper\Controller\Capture;

use src\App\AppHelper\AppHelper;

class CaptureHelper extends AppHelper{
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