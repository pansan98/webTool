<?php
namespace src\Mod\Model\Base;

use src\Mod\Model\Model;
use src\App\AppHelper\Model\ModelHelper;
use \PDO;

class BaseModel extends Model {
    protected $_pdo;
    protected $_result = [];

    protected $_modelHelper;

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance();
    }

    protected function init()
    {
        parent::init();
    }
    

    protected function cleanQueryBuilder()
    {
        $this->_modelHelper->cleanQueryBuilder();
    }

    protected function setDbSaveWhere(array $where)
    {
        $this->init();
        // データーベース接続
        if($this->setDbConnect()) {
            $this->_pdo = $this->getDbConnect();
            if($this->_modelHelper->getSqlStatus()) {
                return $this->runDbSave($where);
            }
            $this->runDbSave($where);
        } else {
            // 失敗時はエラーを返す
            $error = $this->getDbConnect();
            var_dump($error['error']);
            exit('DB接続に失敗しました。');
        }
    }
    
    /**
     * @param $where
     * @return array
     */
    private function runDbSave($where)
    {
        $sqlStmt = "";
        $sqlStmt = $this->_modelHelper->getSqlStatement();
        $bindValue = "(";
        if($this->_modelHelper->getSqlStatus() === WEB_TOOL__SQL__STATEMENT_INSERT) {
            $whereCnt = 1;
            $whereLimit = count($where['where']);
            foreach ($where['where'] as $keys => $value) {
                if($whereCnt == $whereLimit) {
                    $sqlStmt .= $keys.')';
                    $bindValue .= ':'.$keys.')';
                } else {
                    $sqlStmt .= $keys.', ';
                    $bindValue .= ':'.$keys.', ';
                }
                $whereCnt++;
            }

            $stmtString = $sqlStmt.'VALUES'.$bindValue;
        } elseif($this->_modelHelper->getSqlStatus()) {
            if(isset($where['where'])) {
                $sqlStmt .= " WHERE ";
                // last where set count
                $whereCnt = 1;
                $whereLimit = count($where['where']);
                foreach ($where['where'] as $keys => $value) {
                    if($whereCnt == $whereLimit) {
                        $sqlStmt .= $keys.' = :'.$keys;
                    } else {
                        $sqlStmt .= $keys.' = :'.$keys.' AND ';
                    }
                    $whereCnt++;
                }
            }
            $stmtString = $sqlStmt;
            // TODO ORDER BYの実装
            if(count($this->_modelHelper->getOrder()) > 0) {
                $stmtString .= ' ORDER BY';
                $orders = $this->_modelHelper->getOrder();
                // last order set count
                $orderCnt = 1;
                $orderLimit = count($orders);
                foreach($orders as $order => $sort) {
                    if($orderCnt == $orderLimit) {
                        $stmtString .= $order.' '.$sort;
                    } else {
                        $stmtString .= ' '.$order.' '.$sort.',';
                    }
                    $orderCnt++;
                }
            }
            //$where['where'] = [];
        }

        try {
            $stmt = $this->_pdo->prepare($stmtString);
            $stmt->execute($where['where']);
            if($this->_modelHelper->getSqlStatus()) {
                $this->_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // クエリの初期化
                $this->_modelHelper->cleanQueryBuilder();
                return $this->_result;
            }
            // クエリの初期化
            $this->_modelHelper->cleanQueryBuilder();
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit('SQL実行中にエラーが発生しました。'.PHP_EOL.'処理を中断します。');
        }
    }
}
?>