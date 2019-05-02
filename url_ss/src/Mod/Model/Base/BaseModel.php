<?php
namespace src\Mod\Model\Base;

use src\Mod\Model\Model;

class BaseModel extends Model {
    protected $_pdo;
    protected $_result;

    protected $_where = [];

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

    protected function setDbSaveWhere(array $where)
    {
        $this->init();
        if($this->setDbConnect()) {
            $this->_pdo = $this->getDbConnect();
            $this->runDbSave($where);
            $dbWhere = [];
            foreach ($where as $key => $val) {
                $dbWhere['bindKey'][] = $key.' = :'.$key;
                $dbWhere['bindValue'][$key] = $val;
            }

            $this->_where[] = $dbWhere;
        } else {
            $error = $this->getDbConnect();
            var_dump($error['error']);
            exit('DB接続に失敗しました。');
        }
    }

    private function runDbSave($where)
    {
        $sqlStmt = "";
        $sqlStmt = $where['statement'];
        $bindValue = "(";
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

        try {
            $stmt = $this->_pdo->prepare($stmtString);
            $stmt->execute($where['where']);
        } catch(PDOException $e) {
            echo $e->getMessage();
            eixt('SQL実行中にエラーが発生しました。'.PHP_EOL.'処理を中断します。');
        }
    }
}
?>