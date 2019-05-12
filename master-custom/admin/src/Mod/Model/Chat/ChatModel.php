<?php
namespace src\Mod\Model\Capture;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\Chat\Model;
use src\App\AppHelper\Model\ModelHelper;

class ChatModel extends BaseModel{
    protected static $instance;

    private $_model;

    protected $_statement;
    protected $_where = [];

    // テーブル名
    protected $_db_table = 'applications_chat';

    public function __construct()
    {
        // Modelヘルパー取得
        $this->getHelper();
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof ChatModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isRunSaves(array $wheres)
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_INSERT);
        foreach ($wheres as $keyWhere => $valWhere) {
            $this->_modelHelper->setAddWhere($keyWhere, $valWhere);
        }

        $this->_where = $this->_modelHelper->getWhere();
        $this->setDbSaveWhere($this->_where);
    }

    protected function setDbSaveWhere(array $where)
    {
        if($this->_modelHelper->getSqlStatus()) {
            return parent::setDbSaveWhere($where);
        }
        parent::setDbSaveWhere($where);
    }

    public function getData()
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_SELECT);
        $this->_modelHelper->setAddWhere('user_id', 1);

        $this->_where = $this->_modelHelper->getWhere();
        $data = $this->setDbSaveWhere($this->_where);
        $ret = [];
        if(isset($data)) {
            // モデルをセット
            $this->setModel();
            for($i = 0; $i < count($data);$i++) {
                foreach ($data[$i] as $functionKey => $functionValue) {
                    $functionCreate = "";
                    $functionCreate = "set".$this->_modelHelper->createCamelCase($functionKey);
                    // 各プロパティにセット
                    if(method_exists($this->_model, $functionCreate)) {
                        $this->_model->$functionCreate($functionValue);
                    }
                }
                // 格納したオブジェクトを取得
                $ret[$i] = $this->_model->getModel();
            }
        }
        return $ret;
    }

    protected function setModel()
    {
        $this->_model = new Model();
    }
}
?>