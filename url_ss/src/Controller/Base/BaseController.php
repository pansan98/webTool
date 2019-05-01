<?php
namespace src\Controller\Base;

use src\Controller\Controller;

class BaseController extends Controller {
    private $_actionName;
    private $_renderView;

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
}
?>