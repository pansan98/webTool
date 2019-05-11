<?php
namespace src\App\Message;

use src\App\Message\User;

class MessageHelper {
    protected static $instanceHelper;

    protected $_engine;

    private function __construct($engine)
    {
        $this->_engine = $engine::getEngine();
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