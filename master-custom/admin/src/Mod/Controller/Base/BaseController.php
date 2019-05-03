<?php
namespace src\Mod\Controller\Base;

use src\Mod\Controller\Controller;
use src\App\AppHelper\Controller\ControllerHelper;

class BaseController extends Controller {
    private $_actionName;
    private $_renderView;
    private $_displayName;

    protected function setActionName($name)
    {
        $this->_actionName = $name;
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
        $ControllerHelper = ControllerHelper::getInstance('applications_capture', WEB_TOOL__SQL__STATEMENT_SELECT);
        $this->_displayName =$ControllerHelper->getDisplayname();
    }

    protected function getDisplayName()
    {
        return $this->_displayName;
    }

    public function getController()
    {

    }
}
?>