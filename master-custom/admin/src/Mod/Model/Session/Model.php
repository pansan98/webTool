<?php
namespace src\Mod\Model\Session;


class Model {

    protected $_session = [];
    protected static $instance;

    private static $_globalSessionKey;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof SessionModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param array $session
     * @return $this
     * [$key => $value]
     */
    protected function setAllSession(array $session)
    {
        $this->_session = $session;
    }

    protected function getAllSession()
    {
        return $this->_session;
    }

    protected function setSession($key, $value)
    {
        if(isset($this->_session[$this->getGlobalSessionKey()][$key])) {
            unset($this->_session[$this->getGlobalSessionKey()][$key]);
        }
        $this->_session[$this->getGlobalSessionKey()][$key] = $value;
        $this->setGlobalSession($key, $value);
    }

    public function getSession($key)
    {
        if(isset($this->_session[$this->getGlobalSessionKey()][$key])) {
            return $this->_session[$this->getGlobalSessionKey()][$key];
        }

        return "";
    }

    private function setGlobalSession($key, $value)
    {
        if(isset($_SESSION[$this->getGlobalSessionKey()][$key])) {
            unset($_SESSION[$this->getGlobalSessionKey()][$key]);
        }

        $_SESSION[$this->getGlobalSessionKey()][$key] = $value;
    }

    protected function setGlobalSessionKey($key)
    {
        self::$_globalSessionKey = $key;
    }

    private function getGlobalSessionKey()
    {
        return self::$_globalSessionKey;
    }

    public function getLogout()
    {
        unset($_SESSION['user']);
    }
}
?>