<?php
namespace src\Mod\Controller\Capture;

use src\Mod\Controller\Base\BaseController;
use JonnyW\PhantomJs\Client;

class CaptureController extends BaseController {
    protected $_ssUrl;

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

    public function getCapture()
    {
        $this->setCaptureInit();
        $this->getCaptureShot();
    }

    protected function setCaptureInit()
    {
        $this->_client = Client::getInstance();
        $this->_client->getEngine()->setPath(CAPTURE__ROOT_DIR.'/bin/phantomjs');
        $this->_request = $this->_client->getMessageFactory()->createCaptureRequest($this->_ssUrl, 'GET');
        $this->_response = $this->_client->getMessageFactory()->createResponse();

    }

    protected function getCaptureShot()
    {
        $file = CAPTURE__ROOT_DIR__SCREEN_SHOT.'ss.jpg';
        $this->_request->setOutputFile($file);

        $this->_client->send($this->_request, $this->_response);

        return true;
    }
}
?>