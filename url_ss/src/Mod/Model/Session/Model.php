<?php
namespace src\Mod\Model\Session;

class Model extends SessionModel {

    protected $_session = [];
    protected static $instance;

    public function getInstance()
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
    }

    protected function getSession($key)
    {
        return $this->_session[$key];
    }
}
?>