<?php
namespace src\Mod\Controller\Base;

use src\Mod\Controller\Controller;
use src\Mod\Controller\Capture\CaptureController;
use src\Mod\Controller\User\UserController;
use src\App\AppHelper\Controller\ControllerHelper;
use src\App\Form\FormHelper;

class BaseController extends Controller {
    private $_actionName;
    private $_renderView;
    private $_displayName;

    private $_actionController;
    
    /**
     * 実行するコントローラー名をセット
     * @param $name
     * @return $this
     */
    public function setActionName($name)
    {
        $this->_actionName = $name;

        return $this;
    }
    
    /**
     * 実行するコントローラー名を取得
     * @return mixed
     */
    protected function getActionName()
    {
        return $this->_actionName;
    }
    
    /**
     * ビューファイル
     * @param $view
     */
    protected function setRenderView($view)
    {
        $this->_renderView = $view;
    }
    
    /**
     * ビューファイルの取得
     * @return mixed
     */
    protected function getRenderView()
    {
        return $this->_renderView;
    }
    
    /**
     * 表示画面フォルダのセット
     */
    protected function setDisplayName()
    {
        $ControllerHelper = ControllerHelper::getInstance();
        $this->_displayName = $ControllerHelper->getDisplayname();
    }
    
    /**
     * 表示画面フォルダを取得
     * @return mixed
     */
    protected function getDisplayName()
    {
        return $this->_displayName;
    }
    
    /**
     * 実行するコントローラーを取得
     * @return mixed
     */
    public function getController()
    {
        if(is_null($this->_actionController)) {
            $this->_actionController = "src\\Mod\\Controller\\".$this->getActionName()."\\".$this->getActionName()."Controller";
        } else {
            $this->_actionController = null;
            $this->getController();
        }

        return $this->_actionController::getInstance();
    }

}
?>