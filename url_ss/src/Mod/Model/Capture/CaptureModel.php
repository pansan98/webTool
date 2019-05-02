<?php
namespace src\Mod\Model\Capture;

use src\Mod\Model\Base\BaseModel;
use src\App\AppHelper\Model\ModelHelper;

class CaptureModel extends BaseModel{
    protected $_statement;
    protected $_where = [];

    protected $_modelHelper;

    protected $_db_table = 'applications_capture';

    public function isRunSaves(array $wheres)
    {
        $this->_modelHelper = ModelHelper::getInstance($this->_db_table, SQL__STATEMENT_INSERT);
        foreach ($wheres as $keyWhere => $valWhere) {
            $this->_modelHelper->setAddWhere($keyWhere, $valWhere);
        }

        $this->_where = $this->_modelHelper->getWhere();
        $this->setDbSaveWhere($this->_where);
    }

    protected function setDbSaveWhere(array $where)
    {
        parent::setDbSaveWhere($where);
    }
}
?>