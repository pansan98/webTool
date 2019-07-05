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
    
    /**
     * @param $key
     * @return array|null
     */
    public function getValidate($key)
    {
        if(isset($this->_validate[$key])) {
            return $this->_validate[$key];
        }

        return null;
    }
    
    /**
     * @param array $factory
     */
    public function setFormFactory(array $factory)
    {
        foreach ($factory as $key => $validate) {
            $this->setValidate($key, $factory[$key]['name'], $validate, 9999);
        }
    }
    
    /**
     * @param $require
     * @return bool
     */
    public function factoryRequire($require)
    {
        $error = false;
        if($require == "") {
            $error = true;
        }

        return $error;
    }
    
    /**
     * @param $string
     * @param $len
     * @return bool
     */
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
    
    /**
     * @param $character
     * @return bool
     */
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
    
    /**
     * @param $num
     * @return bool
     */
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
    
    /**
     * @param $url
     * @return bool
     */
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