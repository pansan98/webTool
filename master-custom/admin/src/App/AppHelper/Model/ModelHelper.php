<?php
namespace src\App\AppHelper\Model;

use src\App\AppHelper\AppModelHelper;

class ModelHelper extends AppModelHelper{
    protected static $instanceHelper;

    protected $_sqlStatementStatus;
    protected $_where = [];
    protected $_select = [];
    protected $_order = [];
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

    /**
     * 実行するテーブルセット
     * @param $name
     * @return $this
     */
    public function setDbTableName($name)
    {
        $this->_db_table = $name;

        return $this;
    }

    /**
     * SQLステートメントをセット
     * @param $statement
     * @return $this
     */
    public function setQueryBuilder($statement)
    {
        $this->_sqlStatementStatus = $statement;
        $this->_where['statement'] = $this->getQueryBuilder($statement);

        return $this;
    }

    /**
     * SQLのステータスを取得
     * @return mixed
     */
    public function getSQLStatementStatus()
    {
        return $this->_sqlStatementStatus;
    }

    /**
     * 生成したSQL文に置換する
     * @param array $where
     * @return $this
     */
    public function setWhere(array $where)
    {
        $this->_where = $where;

        return $this;
    }

    /**
     * where文の追加
     * @param $key
     * @param $value
     * @return $this
     */
    public function setAddWhere($key, $value)
    {
        $this->_where['where'][$key] = $value;

        return $this;
    }

    /**
     * 生成したwhere文を取得
     * @return array
     */
    public function getWhere()
    {
        return $this->_where;
    }

    /**
     * select文の追加
     * @param $select
     * @return $this
     */
    public function setSelect($select)
    {
        $this->_select[] = $select;

        return $this;
    }

    /**
     * 生成したselect文を取得
     * @return array
     */
    public function getSelect()
    {
        return $this->_select;
    }
    
    /**
     * ORDERの追加
     * @param $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->_order[] = $order;
        
        return $this;
    }
    
    /**
     * 生成したorderを取得
     * @return array
     */
    public function getOrder()
    {
        return $this->_order;
    }
    
    
    /**
     * 生成したSQLを初期化する
     */
    public function cleanQueryBuilder()
    {
        $this->_where = [];
        $this->_select = [];
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

    /**
     * データを取得するbool値
     * @return bool
     */
    public function getSqlStatus()
    {
        if($this->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_SELECT) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * キャメルケース生成
     * @param $snakeCase
     * @return string
     */
    public function createCamelCase($snakeCase)
    {
        return ucfirst(lcfirst(strtr(ucwords(strtr($snakeCase, ['_' => ' '])), [' ' => ''])));
    }
}
?>