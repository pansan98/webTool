<?php
namespace src\App\AppHelper\Model\User;

use src\App\AppHelper\Model\ModelHelper;

class UserHelper extends ModelHelper{
    protected static $instanceHelper;

    protected $_sqlStatementStatus;
    protected $_where = [];
    protected $_db_table;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if(!self::$instanceHelper instanceof UserHelper) {
            self::$instanceHelper = new static();
        }

        return self::$instanceHelper;
    }

    public function setDbTableName($name)
    {
        $this->_db_table = $name;

        return $this;
    }

    public function setSQLStatement($statement)
    {
        $this->_sqlStatementStatus = $statement;
        $this->_where['statement'] = $this->getSQLStatement($statement);

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
    
    /**
     * @param $statement
     * @return mixed|string
     */
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