<?php
namespace src\Mod\Model\Session;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\Session\Model;

//session_start();

class SessionModel extends Model{

    protected static $sessionInstance;
    protected static $sessionModelInstance;

    public function __construct($session)
    {
        $this->setModelInstance();
        self::$sessionModelInstance->setAllSession($session);
        $this->setRedirect();
    }

    public static function getInstance()
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

    public function setAllSession(array $session)
    {
        self::$sessionModelInstance->setAllSession($session);

        return self::$sessionInstance;
    }

    protected function getAllSession()
    {
        return self::$sessionModelInstance->getAllSession();
    }

    public function setSession($key, $value)
    {
        self::$sessionModelInstance->setSession($key, $value);

        return self::$sessionInstance;
    }

    public function getSession($key)
    {
        return self::$sessionModelInstance->getSession($key);
    }

    public function getRedirect()
    {
        return $this->getSession('redirect_url');
    }

    protected function setRedirect()
    {
        if(isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/production/';
        }

        $this->setSession('redirect_url', $referer);
    }

}
?>