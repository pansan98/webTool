<?php
namespace src\Mod\Model\Capture;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\Capture\Model;
use src\App\AppHelper\Model\ModelHelper;
use src\Mod\Model\Session\SessionModel;

class CaptureModel extends BaseModel{
    protected static $instance;

    private $_model;
    private $_sessionModel;

    protected $_statement;

    // テーブル名
    protected $_db_table = 'applications_capture';

    public function __construct()
    {
        parent::__construct();
        // セッションモデルセット
        $this->_sessionModel = SessionModel::getInstance();
        $this->_sessionModel->setGlobalSessionKey('user');
    }
    
    /**
     * Get an instance
     * @return CaptureModel
     */
    public static function getInstance()
    {
        if(!self::$instance instanceof CaptureModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }
    
    /**
     * @param array $wheres
     */
    public function isRunSaves(array $wheres)
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_INSERT);
        foreach ($wheres as $keyWhere => $valWhere) {
            $this->_modelHelper->setAddWhere($keyWhere, $valWhere);
        }

        $this->setDbSaveWhere($this->_modelHelper->getWhere());
    }
    
    /**
     * データベース操作
     * @param array $where
     * @return array
     */
    protected function setDbSaveWhere(array $where)
    {
        if($this->_modelHelper->getSqlStatus()) {
            return parent::setDbSaveWhere($where);
        }
        parent::setDbSaveWhere($where);
    }
    
    /**
     * データの取得
     * @return array
     */
    public function getData()
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_SELECT);
        // where and order
        $this->_modelHelper->setAddWhere('user_id', $this->_sessionModel->getSession('user_id'))->setOrder(['capture_created' => 'DESC', 'id' => 'DESC']);

        $data = $this->setDbSaveWhere($this->_modelHelper->getWhere());
        $ret = [];
        if(isset($data) AND count($data) > 0) {
            for($i = 0; $i < count($data);$i++) {
                // モデルをセット
                $this->setModel();
                foreach ($data[$i] as $functionKey => $functionValue) {
                    $functionCreate = "";
                    // キーに応じてメソッドを自動作成
                    // キャメルケースに応じてメッソドを作成、キーを合わせる必要あり
                    $functionCreate = "set".$this->_modelHelper->createCamelCase($functionKey);
                    if(method_exists($this->_model, $functionCreate)) {
                        // 各プロパティにセット
                        $this->_model->$functionCreate($functionValue);
                    }
                }
                // 格納したオブジェクトを取得
                $ret[$i] = $this->_model->getModel();
            }
        }
        return $ret;
    }
    
    /**
     * モデルのセット
     */
    protected function setModel()
    {
        if(isset($this->_model)) {
            unset($this->_model);
        }

        $this->_model = new Model();
    }
}
?>