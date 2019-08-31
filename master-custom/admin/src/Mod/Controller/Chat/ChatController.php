<?php
namespace src\Mod\Controller\Chat;

use src\Mod\Controller\Base\BaseController;
use src\Mod\Model\Chat\ChatModel;
use src\App\AppHelper\Controller\Capture\CaptureHelper;
use src\App\Form\FormHelper;

class ChatController extends BaseController {
    public static $instance;

    protected $_ssUrl;
    protected $_fileName;
    protected $_fileDir;

    private $_helper;
    private $_model;
    private $_form;

    protected $_isSize = false;
    protected $_size = [];

    private $_client;
    private $_request;
    private $_response;

    public function __construct()
    {
        parent::setDisplayName();
        $this->setActionName('Chat');
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof ChatController) {
            self::$instance = new static();
        }

        return self::$instance;
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

    public function setRenderView($view)
    {
        parent::setRenderView($view);

        return $this;
    }

    public function getRenderView($data = array())
    {
        $view = parent::getRenderView();
        extract($data);
        ob_start();
        include WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR.$this->getDisplayName().'/'.$this->getActionName().'/'.$view;
        $render = ob_get_contents();
        ob_clean();
        return $render;
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


    public function setHelper()
    {
        if(!$this->_helper instanceof CaptureHelper) {
            $this->_helper = CaptureHelper::getInstance();
        }

        return $this;
    }

    public function getPostQueryParam($key)
    {
        $this->createFormFactory();
        $form = $this->_form->setFormFactory([$key => $this->_helper->getPostQueryParam($key)]);
        if(isset($form['error'])) {
            return $form;
        }

        return $this->_helper->getPostQueryParam($key);
    }

    public function setRunSaves()
    {
        if(!$this->_model instanceof ChatModel) {
            $this->_model = ChatModel::getInstance();
        }

        return $this;
    }


    public function getData()
    {
        $this->setRunSaves();
        return $this->_model->getData();
    }


    protected function createFormFactory()
    {
        if(!$this->_form instanceof FormHelper) {
            $this->_form = FormHelper::getInstance();
        }

        $this->_form->setValidate('capture_url', 'キャプチャーURL', ['require', 'length', 'url']);

        $this->_form->createMessageFactory('Capture');
    }

}
?>