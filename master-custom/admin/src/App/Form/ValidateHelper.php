<?php
namespace src\App\Form;

use src\App\AppHelper\Controller\ControllerHelper;

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
     * @param $key
     * @param array $validateKey ['require', 'sample']
     */
    public function setValidate($key, array $validateKey)
    {
        $this->_validate[$key] = $validateKey;

        return $this;
    }

    protected function getValidate()
    {
        return $this->_validate;
    }

    public function setFormFactory(array $factory)
    {
        foreach ($factory as $key => $validate) {
            $this->setValidate($key, $validate);
        }
    }

}
?>