<?php
namespace src\Mod\Controller\Delete;

use src\Mod\Controller\Base\BaseController;
use src\App\AppHelper\Controller\ControllerHelper;

class DeleteController extends BaseController {
    public static $instance;
    
    public $_helper;
    protected $_model;
    
    protected $_arrDelete = [];
    
    public function __construct()
    {
        $this->setHelper();
    }
    
    public static function getInstance()
    {
        if(!self::$instance instanceof DeleteController) {
            self::$instance = new static();
        }
        
        return self::$instance;
    }
    
    protected function setHelper()
    {
        if(!$this->_helper instanceof ControllerHelper) {
            $this->_helper = ControllerHelper::getInstance();
        }
    }
    
    public function getHelper()
    {
        return $this->_helper;
    }
    
    /**
     * decide which axis to delete
     * @param $key
     * @param $value
     */
    public function setDelete($key, $value)
    {
        $this->_arrDelete[$key] = $value;
    }
    
    public function isRunDelete()
    {
    
    }
}