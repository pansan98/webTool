<?php
namespace src\App\Form;

use src\App\Form\ValidateHelper;
use src\App\Message\MessageHelper;

class FormHelper {
    protected static $instanceHelper;
    protected $_validateHelper;
    protected $_messageHelper;

    protected $_init = [];

    private function __construct()
    {
        $this->_validateHelper = ValidateHelper::getInstance();
    }

    public static function getInstance()
    {
        if(!self::$instanceHelper instanceof FormHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    /**
     * @param $key
     * @param $name
     * @param array $validateKey ['require', 'sample']
     */
    public function setValidate($key, $name,  array $validateKey, $len = "")
    {
        $this->_validateHelper->setValidate($key, $name, $validateKey, $len);

        return $this;
    }

    public function getValidate($key)
    {
        return $this->_validateHelper->getValidate($key);
    }

    public function setFormFactory(array $factory)
    {
        $validateError = [];
        foreach ($factory as $key => $val) {
            $validate =[];
            $validate = $this->getValidate($key);
            if(!is_null($validate[$key])) {
                for($i = 0; $i < count($validate[$key]); $i++) {
                    switch($validate[$key][$i]) {
                        case 'require':
                            if($this->_validateHelper->factoryRequire($val)) {
                                if(!isset($validateError['error'][$key])) {
                                    $validateError['error'][$key] = $validate['name'].'の'.$this->_messageHelper->getEngineFactory()->getMessageFactory($validate[$key][$i]);
                                }
                            }
                            break;
                        case 'length':
                            if($this->_validateHelper->factoryLength($val, $validate['length'])) {
                                if(!isset($validateError['error'][$key])) {
                                    $validateError['error'][$key] = $validate['name'].'は'.$validate['length'].$this->_messageHelper->getEngineFactory()->getMessageFactory($validate[$key][$i]);
                                }
                            }
                            break;
                        case 'character':
                            if($this->_validateHelper->factoryRomanCharacter($val)) {
                                if(!isset($validateError['error'][$key])) {
                                    $validateError['error'][$key] = $validate['name'].'は'.$this->_messageHelper->getEngineFactory()->getMessageFactory($validate[$key][$i]);
                                }
                            }
                            break;
                        case 'numeric':
                            if($this->_validateHelper->factoryNumeric($val)) {
                                if(!isset($validateError['error'][$key])) {
                                    $validateError['error'][$key] = $validate['name'].'は'.$this->_messageHelper->getEngineFactory()->getMessageFactory($validate[$key][$i]);
                                }
                            }
                            break;
                    }
                }
            }
        }

        return $validateError;
    }


    public function createMessageFactory($engine)
    {
        $this->_messageHelper = MessageHelper::getEngine($engine);
        $this->_messageHelper->getEngineFactory()->createMessageFactory();
    }



}
?>