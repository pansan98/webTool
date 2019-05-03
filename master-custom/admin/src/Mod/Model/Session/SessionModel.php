<?php
namespace src\Mod\Model\Session;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\Session\Model;

session_start();

class SessionModel extends BaseModel{

    protected static $sessionInstance;
    protected static $sessionModelInstance;

    protected function __construct($session)
    {
        $this->setModelInstance();
        self::$sessionModelInstance->setAllSession($session);
    }

    public function getInstance()
    {
        if(!self::$sessionInstance instanceof SessionModel) {
            self::$sessionInstance = new static($_SESSION);
        }

        return self::$sessionInstance;
    }

    private function setModelInstance()
    {
        if(!self::$sessionModelInstance instanceof Model) {
            self::$sessionModelInstance = Model::getInstance();
        }
    }

    protected function setAllSession(array $session)
    {
        self::$sessionModelInstance->setAllSession($session);

        return self::$sessionInstance;
    }

    protected function getAllSession()
    {
        return self::$sessionModelInstance->getAllSession();
    }

    protected function setSession($key, $value)
    {
        self::$sessionModelInstance->setSession($key, $value);

        return self::$sessionInstance;
    }

    protected function getSession($key)
    {
        return self::$sessionModelInstance->getSession($key);
    }

}
?>