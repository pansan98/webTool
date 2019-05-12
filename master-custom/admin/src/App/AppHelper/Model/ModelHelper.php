<?php
namespace src\App\AppHelper\Model;

use src\App\AppHelper\AppModelHelper;

class ModelHelper extends AppModelHelper{
    protected static $instanceHelper;

    protected $_sqlStatementStatus;
    protected $_where = [];
    protected $_select = [];
    protected $_db_table;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(!self::$instanceHelper instanceof ModelHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    public function setDbTableName($name)
    {
        $this->_db_table = $name;

        return $this;
    }

    public function setQueryBuilder($statement)
    {
        $this->_sqlStatementStatus = $statement;
        $this->_where['statement'] = $this->getQueryBuilder($statement);

        return $this;
    }

    public function getSQLStatementStatus()
    {
        return $this->_sqlStatementStatus;
    }

    // 生成したSQLに置換する
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

    public function setSelect($select)
    {
        $this->_select[] = $select;

        return $this;
    }

    public function getSelect()
    {
        return $this->_select;
    }

    // Add first if you want to select
    private function getQueryBuilder($statement)
    {
        $sql = "";
        switch($statement) {
            case WEB_TOOL__SQL__STATEMENT_SELECT:
                if(isset($this->_select) AND count($this->_select)) {
                    $selectSql = implode(',', $this->getSelect());
                    $sql = "SELECT ".$selectSql." FROM ".$this->_db_table;
                } else {
                    $sql = "SELECT * FROM ".$this->_db_table;
                }
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

    public function getSqlStatus()
    {
        if($this->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_SELECT) {
            return true;
        } else {
            return false;
        }
    }


    public function createCamelCase($snakeCase)
    {
        return ucfirst(lcfirst(strtr(ucwords(strtr($snakeCase, ['_' => ' '])), [' ' => ''])));
    }
}
?>