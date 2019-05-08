<?php
namespace src\Mod\Model\User;

/**
 * Class Model
 * @package src\Mod\Model\User
 * コメントはDB参照
 */
class Model extends UserModel {

    /**
     * user id
     */
    protected $_user_id;

    /**
     * user name
     */
    protected $_user_name;

    /**
     * user created
     */
    protected $_user_created;

    /**
     * user deleted
     */
    protected $_user_deleted;

    /**
     * user updated
     */
    protected $_user_update;

    /**
     * user room id
     */
    protected $_user_room_id;

    /**
     * user last login
     */
    protected $_user_last_login;

    public function __toString()
    {
        return $this->_user_name;
    }

    public function getModel()
    {
        return $this;
    }

    protected function setUserId($id)
    {
        $this->_user_id = $id;

        return $this;
    }

    protected function getUserId()
    {
        return $this->_user_id;
    }

    protected function setUserName($name)
    {
        $this->_user_name = $name;

        return $this;
    }

    protected function getUserName()
    {
        return $this->_user_name;
    }

    protected function setUserCreated($created)
    {
        $this->_user_created = $created;

        return $this;
    }

    protected function getUserCreated()
    {
        return $this->_user_created;
    }

    protected function setUserDeleted($deleted)
    {
        $this->_user_deleted = $deleted;

        return $this;
    }

    protected function getUserDeleted()
    {
        return $this->_user_deleted;
    }

    protected function setUserRoomId(array $roomId)
    {
        $this->_user_room_id = $roomId;

        return $this;
    }

    protected function getUserRoomId()
    {
        return $this->_user_room_id;
    }

    protected function setUserLastLogin($lastLogin)
    {
        $this->_user_last_login = $lastLogin;

        return $this;
    }

    protected function getUserLastLogin()
    {
        return $this->_user_last_login;
    }
}
?>