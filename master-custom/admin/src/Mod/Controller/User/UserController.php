<?php
namespace src\Mod\Controller\User;


use src\Mod\Controller\Base\BaseController;
use src\Mod\Model\User\UserModel;
use src\App\AppHelper\Controller\ControllerHelper;
use src\App\Form\FormHelper;
use src\App\Message\MessageHelper;

class UserController extends BaseController {
    public static $instance;

    protected $_helper;
    protected $_model;
    protected $_form;

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
        return $this->_model->getRedirect();
    }

    public function redirectShowLoginScreen($status = 1)
    {
        if($status == 0) {
            return $this->_model->redirectShowLoginScreen($status);
        }
        $this->_model->redirectShowLoginScreen($status);
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

    protected function setHelper()
    {
        $this->_helper = ControllerHelper::getInstance();

        return $this;
    }

    public function getDisplayName()
    {
        return parent::getDisplayName();
    }

    public function setDbUserSaves($post)
    {
        $this->createFormFactory();
        $formData = array_merge($this->setHelper()->_helper->getForm($post), $this->_form->setFormFactory($this->setHelper()->_helper->getForm($post)));
        if(isset($formData['error'])) {
            return $formData;
        }

        if($formData['display'] == 'create') {
            return $this->_model->setDbUserSaves($formData);
        } elseif($formData['display'] == 'login') {
            $login = $this->_model->setLogin($formData)->getLogin();
            if(isset($login['error'])) {
                $login = array_merge($login, $formData);
                return $login;
            } else {
                return true;
            }
        }
    }

    protected function createFormFactory()
    {
        if(!$this->_form instanceof FormHelper) {
            $this->_form = FormHelper::getInstance();
        }

        $this->_form->setValidate('user_id', 'ユーザーID', ['require', 'length', 'character'], 100)
            ->setValidate('user_password', 'ユーザーパスワード', ['require', 'character'])
            ->setValidate('user_name', 'ユーザーネーム', ['require']);

        $this->_form->createMessageFactory('User');
    }

    public function getLogout()
    {
        $this->_model->getLogout();

        return $this;
    }
}
?>