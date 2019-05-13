<?php
namespace src\Mod\Model\Base;

use src\Mod\Model\Model;
use src\App\AppHelper\Model\ModelHelper;
use \PDO;

class BaseModel extends Model {
    protected $_pdo;
    protected $_result = [];

    protected $_modelHelper;

    protected $_where = [];

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance();
    }

    protected function init()
    {
        parent::init();
    }

    protected function setDbConnect()
    {
        return parent::setDbConnect();
    }

    protected function getDbConnect()
    {
        return parent::getDbConnect();
    }

    protected function cleanQueryBuilder()
    {
        $this->_modelHelper->cleanQueryBuilder();
    }

    protected function setDbSaveWhere(array $where)
    {
        $this->init();
        if($this->setDbConnect()) {
            $this->_pdo = $this->getDbConnect();
            if($this->_modelHelper->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_SELECT) {
                return $this->runDbSave($where);
            }
            $this->runDbSave($where);
        } else {
            $error = $this->getDbConnect();
            var_dump($error['error']);
            exit('DB接続に失敗しました。');
        }
    }

    /**
     * @param $where
     * execute SQL
     */
    private function runDbSave($where)
    {
        $sqlStmt = "";
        $sqlStmt = $where['statement'];
        $bindValue = "(";
        if($this->_modelHelper->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_INSERT) {
            foreach ($where['where'] as $keys => $value) {
                if($value === end($where['where'])) {
                    $sqlStmt .= $keys.')';
                    $bindValue .= ':'.$keys.')';
                } else {
                    $sqlStmt .= $keys.', ';
                    $bindValue .= ':'.$keys.', ';
                }
            }

            $stmtString = $sqlStmt.'VALUES'.$bindValue;
        } elseif($this->_modelHelper->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_SELECT) {
            if(isset($where['where'])) {
                $sqlStmt .= " WHERE ";
                foreach ($where['where'] as $keys => $value) {
                    if($value === end($where['where'])) {
                        $sqlStmt .= $keys.'= :'.$keys;
                    } else {
                        $sqlStmt .= $keys.'= :'.$keys.' AND ';
                    }
                }
            }
            $stmtString = $sqlStmt;
            //$where['where'] = [];
        }

        try {
            $stmt = $this->_pdo->prepare($stmtString);
            $stmt->execute($where['where']);
            if($this->_modelHelper->getSQLStatementStatus() === WEB_TOOL__SQL__STATEMENT_SELECT) {
                $this->_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $this->_result;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit('SQL実行中にエラーが発生しました。'.PHP_EOL.'処理を中断します。');
        }
    }
}
?>