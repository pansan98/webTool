<?php
namespace src\Mod\Controller\Capture;

use src\Mod\Controller\Base\BaseController;
use src\Mod\Model\Capture\CaptureModel;
use src\App\AppHelper\Controller\Capture\CaptureHelper;
use src\App\Form\FormHelper;
use JonnyW\PhantomJs\Client;

class CaptureController extends BaseController {
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
        $this->setActionName('Capture');
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof CaptureController) {
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

    public function setSsUrl($url)
    {
        $this->_ssUrl = $url;
        return $this;
    }

    public function getSsUrl()
    {
        return $this->_ssUrl;
    }

    public function setCapture()
    {
        // キャプチャー初期設定
        $this->setCaptureInit();
        return $this;
    }

    protected function setCaptureInit()
    {
        $this->_client = Client::getInstance();
        $this->_client->getEngine()->setPath(WEB_TOOL__MASTER_CUSTOM__ROOT_DIR.'admin/bin/phantomjs');
        $this->_request = $this->_client->getMessageFactory()->createCaptureRequest($this->_ssUrl, 'GET');
        $this->_response = $this->_client->getMessageFactory()->createResponse();
        $this->setHelper();
        $this->_helper->setInit('length', 20)->setInit('date', date('Ymd'));

    }
    public function setCaptureSize(array $size)
    {
        foreach ($size as $kSize => $vSize) {
            $this->_size[$kSize] = $vSize;
        }

        $this->_isSize = true;
    }

    public function getCaptureShot()
    {
        if($this->_isSize){
            $this->_request->setViewportSize($this->_size['width'], $this->_size['height'], $this->_size['top'], $this->_size['left']);
        }

        $this->_fileName = $this->_helper->getRandomText().'.jpg';
        $this->_fileDir = WEB_TOOL__ROOT_DATAS_DIR.$this->getActionName().'/'.$this->_fileName;
        
        if(!file_exists($this->_fileDir)) {
            touch($this->_fileDir);
        }
        
        $this->_request->setOutputFile($this->_fileDir);

        $this->_client->send($this->_request, $this->_response);

        return true;
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
        if(!$this->_model instanceof CaptureModel) {
            $this->_model = CaptureModel::getInstance();
        }

        return $this;
    }

    public function isRunSaves()
    {
        $saves = [];
        $fileUrl = "";
        $fileUrl = str_replace(WEB_TOOL__DIR, '', $this->_fileDir);
        $saves =
            [
                'capture_url' => $fileUrl,
                'capture_copy' => $this->_ssUrl,
                'capture_filename' => $this->_fileName,
                'user_id' => $this->_helper->getPostQueryParam('user_id'),
                'capture_created' => date('Y-m-d H:i:s')
            ];

        $this->_model->isRunSaves($saves);
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

        $this->_form->setValidate('capture_url', 'キャプチャーURL', ['require', 'url']);

        $this->_form->createMessageFactory('Capture');
    }

}
?>