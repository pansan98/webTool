<?php
namespace src\Mod\Model\BaseModel;

use src\Mod\Model\Model;

class BaseModel extends Model {
    protected $_where = [];


    protected function init()
    {
        parent::init();
    }

    protected function setDbSaveWhere($where = [])
    {
        $dbWhere = [];
        foreach ($where as $key => $val) {
            $dbWhere['bindKey'][] = $key.' = ?';
            $dbWhere['bindValue'][] = $val;
        }

        $this->_where[] = $dbWhere;
    }
}
?>