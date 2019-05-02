<?php
namespace src\Mod\Model\Base;

use src\Mod\Model\Model;

class BaseModel extends Model {
    protected $_pdo;

    protected $_where = [];

    protected function init()
    {
        parent::init();
    }

    protected function setDbConnet()
    {
        parent::setDbConnet();
    }

    protected function getDbConnect()
    {
        return parent::getDbConnect();
    }

    protected function setDbSaveWhere(array $where)
    {
        $this->init();
        $this->setDbConnet();
        $this->_pdo = $this->getDbConnect();
        $this->runDbSave($where);
        $dbWhere = [];
        foreach ($where as $key => $val) {
            $dbWhere['bindKey'][] = $key.' = :'.$key;
            $dbWhere['bindValue'][$key] = $val;
        }

        $this->_where[] = $dbWhere;
    }

    private function runDbSave($where)
    {
        $sqlStmt = "";
        $sqlStmt = $where['statement'];
        foreach ($where['where'] as $keys => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            if($value === end($where['where'])) {
                $sqlStmt .= ':'.$keys.')';
            } else {
                $sqlStmt .= ':'.$keys.', ';
            }
        }

        try {
            $stmt = $this->_pdo->prepare($where['statement'].$sqlStmt);
            foreach ($where['where'] as $key => $val) {
                $stmt->bindValue(':'.$key, $val);
            }
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>