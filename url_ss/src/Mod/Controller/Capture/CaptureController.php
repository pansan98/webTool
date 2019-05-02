<?php
namespace src\Mod\Controller\Capture;

use src\Mod\Controller\Base\BaseController;
use src\App\Helper\Capture\CaptureHelper;
use JonnyW\PhantomJs\Client;

class CaptureController extends BaseController {
    protected $_ssUrl;

    private $_helper;

    protected $_isSize = false;
    protected $_size = [];

    private $_client;
    private $_request;
    private $_response;

    public function __construct()
    {
        define('CAPTURE_ROOT_VIEW', CAPTURE__ROOT_DIR__MOD.'View/');
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

    public function getRenderView()
    {
        $view = parent::getRenderView();
        return CAPTURE_ROOT_VIEW.$this->getActionName().'/'.$view;
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
        $this->_client->getEngine()->setPath(CAPTURE__ROOT_DIR.'/bin/phantomjs');
        $this->_request = $this->_client->getMessageFactory()->createCaptureRequest($this->_ssUrl, 'GET');
        $this->_response = $this->_client->getMessageFactory()->createResponse();
        $this->setHelper();

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

        $file = CAPTURE__ROOT_DIR__SCREEN_SHOT.$this->_helper->getRandomText().'.jpg';
        $this->_request->setOutputFile($file);

        $this->_client->send($this->_request, $this->_response);

        return true;
    }

    protected function setHelper()
    {
        $this->_helper = CaptureHelper::getInstance();
        $this->_helper->setInit('length', 20)->setInit('date', date('Ymd'));
    }
}
?>