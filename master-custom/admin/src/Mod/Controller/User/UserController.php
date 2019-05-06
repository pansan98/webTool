<?php
namespace src\Mod\Controller\User;


use src\Mod\Controller\Base\BaseController;
use src\Mod\Model\User\UserModel;

class UserController extends BaseController {
    public static $instance;

    protected $_helper;
    protected $_model;

    public function __construct()
    {
        $this->_model = UserModel::getInstance();
        $this->setActionName('User');
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof UserController) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isLoggedIn()
    {
        $this->_model->isLoggedIn();
    }

    public function getIsLoggedIn()
    {
        return $this->_model->getIsLoggedIn();
    }

    public function getRedirect()
    {
        $this->_model->getRedirect();
    }

    public function redirectShowLoginScreen()
    {
        $this->_model->redirectShowLoginScreen();
    }

    public function setActionName($name)
    {
        parent::setActionName($name);

        return $this;
    }

    public function getActionName()
    {
        return parent::getActionName();
    }

    public function setRenderView($name)
    {
        parent::setRenderView($name);

        return $this;
    }

    public function getRenderView()
    {
        $view = parent::getRenderView();
        return WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.$this->getDisplayName().'/'.$this->getActionName().'/'.$view;
    }

    public function setDisplayName()
    {
        parent::setDisplayName();

        return $this;
    }

    public function getDisplayName()
    {
        return parent::getDisplayName();
    }
}
?>