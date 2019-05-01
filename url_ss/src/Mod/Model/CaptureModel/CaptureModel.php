<?php
namespace src\Model\CaptureModel;

use src\Model\BaseModel;

class CaptureModel extends BaseModel{
    protected $_ssUrl;
    protected $_saveDir;
    protected $_saveFileName;

    protected $_where = [];

    public function init()
    {
        parent::init();
    }

    public function setSsUrl($url)
    {
        $this->_ssUrl = $url;
        return $this;
    }

    public function setSaveDir($dir)
    {
        if(!file_exists(CAPTURE_ROOT_DIR.$dir)) {
            mkdir(CAPTURE_ROOT_DIR.$dir);
        }

        $this->_saveDir = CAPTURE_ROOT_DIR.$dir;
        return $this;
    }

    protected function setDbSaveWhere($where = [])
    {
        parent::setDbSaveWhere($where);
    }
}
?>