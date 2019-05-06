<?php
namespace src\Mod\Controller\Base;

use src\Mod\Controller\Controller;
use src\Mod\Controller\Capture\CaptureController;
use src\Mod\Controller\User\UserController;
use src\App\AppHelper\Controller\ControllerHelper;

class BaseController extends Controller {
    private $_actionName;
    private $_renderView;
    private $_displayName;

    private $_actionController;

    public function setActionName($name)
    {
        $this->_actionName = $name;

        return $this;
    }

    protected function setRenderView($view)
    {
        $this->_renderView = $view;
    }

    protected function getActionName()
    {
        return $this->_actionName;
    }

    protected function getRenderView()
    {
        return $this->_renderView;
    }

    protected function setDisplayName()
    {
        $ControllerHelper = ControllerHelper::getInstance();
        $this->_displayName = $ControllerHelper->getDisplayname();
    }

    protected function getDisplayName()
    {
        return $this->_displayName;
    }

    public function getController()
    {
        if(is_null($this->_actionController)) {
            $this->_actionController = "src\\Mod\\Controller\\".$this->getActionName()."\\".$this->getActionName()."Controller";
        }

        return $this->_actionController::getInstance();
    }
}
?>