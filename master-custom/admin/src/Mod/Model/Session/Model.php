<?php
namespace src\Mod\Model\Session;

class Model {

    protected $_session = [];
    protected static $instance;

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
        foreach ($session as $key => $val) {
            $this->_session[$key] = $val;
        }
    }

    protected function getAllSession()
    {
        return $this->_session;
    }

    protected function setSession($key, $value)
    {
        if(isset($this->_session[$key])) {
            unset($this->_session[$key]);
        }
        $this->_session[$key] = $value;
        $this->setGlobalSession($key, $value);
    }

    public function getSession($key)
    {
        if(isset($this->_session[$key])) {
            return $this->_session[$key];
        } else {
            return "";
        }
    }

    private function setGlobalSession($key, $value)
    {
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        $_SESSION[$key] = $value;
    }
}
?>