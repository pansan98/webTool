<?php
namespace src\Mod\Model\CaptureModel;

use src\Mod\Model\BaseModel\BaseModel;

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

    protected function setDbSaveWhere(array $where = [])
    {
        parent::setDbSaveWhere($where);
    }
}
?>