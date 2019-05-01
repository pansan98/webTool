<?php
namespace src\Controller\Capture;

use src\Controller\Base\BaseController;
use JonnyW\PhantomJs\Client;

class CaptureController extends BaseController {
    protected $_ssUrl;

    private $_client;
    private $_request;
    private $_response;

    public function __construct()
    {
        define('CAPTURE_ROOT_VIEW', realpath(dirname(__FILE__).'/../../View').'/');
        define('CAPTURE_ROOT_DIR', realpath(dirname(__FILE__).'/../../../ss_file').'/');
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
        return CAPTURE_ROOT_VIEW.$this->getActionName().'/'.parent::getRenderView();
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
        $this->_request = $this->_client->getMessageFactory()->createCaptureRequest($this->_ssUrl);
        $this->_response = $this->_client->getMessageFactory()->createResponse();

        if(!file_exists(CAPTURE_ROOT_DIR)) {
            mkdir(CAPTURE_ROOT_DIR);
        }
    }

    protected function getCaptureShot()
    {
        $file = CAPTURE_ROOT_DIR.'ss.jpg';
        $this->_request->setOutputFile($file);

        $this->_client->send($this->_request, $this->_response);

        return true;
    }
}
?>