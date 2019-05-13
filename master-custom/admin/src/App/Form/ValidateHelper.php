<?php
namespace src\App\Form;

use src\App\Message\MessageHelper;

class ValidateHelper {
    protected static $instanceHelper;

    protected $_validate;

    protected $_init = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if(!self::$instanceHelper instanceof ValidateHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    /**
     * @param string $key
     * @param string $name multi-byte
     * @param array $validateKey ['require', 'sample']
     * @param integer $len
     */
    public function setValidate($key, $name, array $validateKey, $len)
    {
        $this->_validate[$key][$key] = $validateKey;
        $this->_validate[$key]['name'] = $name;
        $this->_validate[$key]['length'] = $len;

        return $this;
    }

    public function getValidate($key)
    {
        if(isset($this->_validate[$key])) {
            return $this->_validate[$key];
        }

        return null;
    }

    public function setFormFactory(array $factory)
    {
        foreach ($factory as $key => $validate) {
            $this->setValidate($key, $factory[$key]['name'], $validate);
        }
    }

    public function factoryRequire($require)
    {
        $error = false;
        if($require == "") {
            $error = true;
        }

        return $error;
    }

    public function factoryLength($string, $len)
    {
        $error = false;
        if($string != "") {
            if(mb_strlen($string, 'UTF-8') > $len) {
                $error = true;
            }
        }

        return $error;
    }

    public function factoryRomanCharacter($character)
    {
        $error = false;
        if ($character != "") {
            $pattern = "/^[a-zA-Z0-9_-]+$/";
            if(!preg_match($pattern, $character)) {
                $error = true;
            }
        }

        return $error;
    }

    public function factoryNumeric($num)
    {
        $error = false;
        if($num != "") {
            if(!is_numeric($num)) {
                $error = true;
            }
        }

        return $error;
    }

    public function factoryUrl($url)
    {
        $error = false;
        if ($url != "") {
            $pattern = '/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i';
            if(!preg_match($pattern, $url)) {
                $error = true;
            }
        }

        return $error;
    }
}
?>