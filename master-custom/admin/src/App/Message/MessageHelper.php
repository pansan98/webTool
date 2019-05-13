<?php
namespace src\App\Message;


use src\App\Doctrine\Doctrine;

class MessageHelper {
    protected static $instanceHelper;

    protected $_engine;

    private function __construct($engine)
    {
        $engine = "src\\App\\Message\\".$engine;
        $this->_engine = $engine::getFactory();
        //$this->_engine = User::getFactory();
    }

    protected static function getInstance($engine)
    {
        if(!self::$instanceHelper instanceof MessageHelper) {
            self::$instanceHelper = new static($engine);
        }

        return self::$instanceHelper;
    }

    public static function getEngine($engine)
    {
        return self::getInstance($engine);
    }

    public function getEngineFactory()
    {
        return $this->_engine;
    }

}
?>