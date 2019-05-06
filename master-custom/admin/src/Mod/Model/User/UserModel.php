<?php
namespace src\Mod\Model\User;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\User\Model as Model;
use src\App\AppHelper\Model\ModelHelper;
use src\Mod\Model\Session\SessionModel;

class UserModel extends BaseModel{
    public static $instance;

    protected $_modelHelper;
    protected $_userModel;
    protected $_sessionModel;

    protected $_isLogged = false;

    protected $_db_table = 'applications_user';

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance();
        //$this->_userModel = new Model();
        $this->_sessionModel = SessionModel::getInstance();
        if($this->_sessionModel->getSession('user_id') != "") {
            $this->_isLogged = true;
        }
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof UserModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isLogged()
    {
        if(!$this->_isLogged) {
            $this->redirectShowLoginScreen();
        }
    }

    public function getIsLoggedIn()
    {
        return $this->_isLogged;
    }

    public function redirectShowLoginScreen()
    {
        header('Location:'.WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/');
        exit;
    }

    public function getRedirect()
    {
        if(WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/' === $this->_sessionModel->getRedirect()) {
            $redirectUrl = WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/production/';
        } else {
            $redirectUrl = $this->_sessionModel->getRedirect();
        }
        header('Location:'.$redirectUrl);
        exit;
    }
}
?>