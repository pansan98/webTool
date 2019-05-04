<?php
namespace src\Mod\Model\Capture;

use src\Mod\Model\Base\BaseModel;
use src\App\AppHelper\Model\ModelHelper;

class CaptureModel extends BaseModel{
    protected static $instance;

    protected $_statement;
    protected $_where = [];

    protected $_modelHelper;

    protected $_db_table = 'applications_capture';

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance();
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof CaptureModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isRunSaves(array $wheres)
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setSQLStatement(WEB_TOOL__SQL__STATEMENT_INSERT);
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