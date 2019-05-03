<?php
namespace src\App\AppHelper\Model;

use src\App\AppHelper\AppHelper;

class ModelHelper extends AppHelper{
    protected static $instanceHelper;

    protected $_where = [];
    protected $_db_table;

    private function __construct($dbTable, $statement)
    {
        $this->_db_table = $dbTable;
        $status = $this->getSQLStatement($statement);
        $this->_where['statement'] = $status;
    }

    public static function getInstance($dbTable, $statement = WEB_TOOL__SQL__STATEMENT_SELECT)
    {
        if(!self::$instanceHelper instanceof ModelHelper) {
            self::$instanceHelper = new static($dbTable, $statement);
        }

        return self::$instanceHelper;
    }

    // 生成したSQLに置き換える
    public function setWhere(array $where)
    {
        $this->_where = $where;

        return $this;
    }

    public function setAddWhere($key, $value)
    {
        $this->_where['where'][$key] = $value;

        return $this;
    }

    public function getWhere()
    {
        return $this->_where;
    }

    private function getSQLStatement($statement)
    {
        $sql = "";
        switch($statement) {
            case WEB_TOOL__SQL__STATEMENT_SELECT:
                $sql = "SELECT * FROM ".$this->_db_table;
                break;
            case WEB_TOOL__SQL__STATEMENT_UPDATE:
                $sql = "UPDATE SET".$this->_db_table;
                break;
            case WEB_TOOL__SQL__STATEMENT_INSERT:
                $sql = "INSERT INTO ".$this->_db_table." (";
                break;
            case WEB_TOOL__SQL__STATEMENT_DELETE:
                $sql = "DELETE FROM ".$this->_db_table;
                break;
        }

        return $sql;
    }

}
?>