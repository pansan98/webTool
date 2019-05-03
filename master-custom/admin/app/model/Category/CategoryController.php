<?php

class CategoryController extends Db {

    protected $_start = '';
    protected $_end = '';

    private $_objModel;

    public function __construct()
    {
        parent::__construct();
        $this->_objModel = new Db();
    }



    //カテゴリデータ
    public function insertQueryCategory($formName, $data)
    {
        $formName = $this->cleen($formName);
        $arrData = array_diff($data, array($data['submit']));
        $arrTmpSqlKey = array();
        $arrTmpSqlVal = array();
        $arrValue = array();
        foreach ($arrData as $key => $val) {
            $arrTmpSqlKey[] = $key;
            $arrTmpSqlVal[] = $val;
            foreach ($arrTmpSqlVal as $value) {
                if (!is_null($value[$key])) {
                    $arrValue[] = $value[$key];
                }
            }
        }
        try {
            $arrSqlKey = implode(',', $arrTmpSqlKey);
            $arrSqlVal = implode('\',\'', $arrValue);
            //$this->setPdo();
            $insertSql = "INSERT INTO {$formName} ({$arrSqlKey}) VALUES ('{$arrSqlVal}')";
            $this->myQuery($insertSql, $this->_pdo);
        } catch(Exception $e) {
            exit($e->getMessage());
        }
    }

    //カテゴリデータ取得
    public function getCategoryData($userId, $searchData) {
        if (!empty($userId) ) {
            return $this->_objModel->getCategoryDataParent($userId, $searchData);
        }
    }

}
?>