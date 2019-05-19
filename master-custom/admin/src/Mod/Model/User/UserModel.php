<?php
namespace src\Mod\Model\User;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\User\Model as Model;
use src\App\AppHelper\Model\ModelHelper;
use src\Mod\Model\Session\SessionModel;

class UserModel extends BaseModel{
    public static $instance;

    protected $_modelHelper;
    protected $_userModel;
    protected $_sessionModel;

    protected $_isLogged = false;

    protected $_db_table = 'applications_user';

    protected $_where = [];

    private $_form = [];
    private $_createFormPassword;

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance();
        //$this->_userModel = new Model();
        $this->_sessionModel = SessionModel::getInstance();
        // グローバルキーを設定
        $this->_sessionModel->setGlobalSessionKey('user');
        $this->_sessionModel->setRedirect();
        if($this->_sessionModel->getSession('user_id') != "") {
            $this->_isLogged = true;
        }
    }

    public static function getInstance()
    {
        if(!self::$instance instanceof UserModel) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isLogged()
    {
        if(!$this->_isLogged) {
            $this->redirectShowLoginScreen(1);
        }
    }

    public function getIsLoggedIn()
    {
        return $this->_isLogged;
    }

    public function redirectShowLoginScreen($status)
    {
        if($status == 0) {
            return WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/';
        }
        header('Location:'.WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/');
        exit;
    }

    public function getRedirect()
    {
        if(WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/' === $this->_sessionModel->getRedirect() || $this->_sessionModel->getRedirect() == "") {
            $redirectUrl = WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/production/';
        } else {
            $redirectUrl = $this->_sessionModel->getRedirect();
        }
        header('Location: '.$redirectUrl);
        exit;
    }

    /**
     * フォームから値を受け取った後、エラーがなければSQL準備
     *
     * @param $formData
     * @return array|bool
     */
    public function setDbUserSaves($formData)
    {
        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_INSERT);
        foreach ($formData as $keyForm => $valForm) {
            if($keyForm == "user_password") {
                $this->_createFormPassword = $valForm;
                $valForm = password_hash($valForm, PASSWORD_DEFAULT);
            }
            if($keyForm != "user_form_status" && $keyForm != "display") {
                $this->_modelHelper->setAddWhere($keyForm, $valForm);
            }
            $this->_form[$keyForm] = $valForm;
        }
        $this->_modelHelper->setAddWhere('user_created', date('Y-m-d H:i:s'));

        return $this->setDbSaveWhere($this->_modelHelper->getWhere());
    }

    protected function setDbSaveWhere(array $where)
    {
        if($this->_modelHelper->getSqlStatus()) {
            return parent::setDbSaveWhere($where);
        }
        parent::setDbSaveWhere($where);

        // 新規登録後ログイン処理
        $this->getLogin();
        return true;
    }

    public function getLogin()
    {

        // add select
        $this->_modelHelper->setSelect('user_id')
            ->setSelect('user_password')
            ->setSelect('user_name')
            ->setSelect('user_room_id')
            ->setSelect('user_last_login');

        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_SELECT);

        // add where
        $this->_modelHelper->setAddWhere('user_id', $this->_form['user_id'])
            ->setAddWhere('user_deleted', 0);

        $data = $this->setDbSaveWhere($this->_modelHelper->getWhere());
        $ret = [];
        if(isset($data) AND count($data) > 0) {
            // モデルをセット
            $this->setModel();
            for($i = 0; $i < count($data);$i++) {
                foreach ($data[$i] as $functionKey => $functionValue) {
                    $functionCreate = "";
                    $functionCreate = "set".$this->_modelHelper->createCamelCase($functionKey);
                    // 各プロパティにセット
                    if(method_exists($this->_userModel, $functionCreate)) {
                        $this->_userModel->$functionCreate($functionValue);
                    }
                }
            }
            if(isset($this->_createFormPassword)) {
                $this->_form['user_password'] = $this->_createFormPassword;
            }
            if(password_verify($this->_form['user_password'], $this->_userModel->getUserPassword())) {
                // 最低限ユーザー情報をセッションに保存
                $this->_sessionModel->setGlobalSessionKey('user');
                $this->_sessionModel->setSession('user_id', $this->_userModel->getUserId())
                    ->setSession('user_name', $this->_userModel->getUserName())
                    ->setSession('user_last_login', $this->_userModel->getUserLastLogin())
                    ->setSession('user_room_id', $this->_userModel->getUserRoomId());

            } else {
                $ret['error']['user_password'] = 'パスワードが間違っています。';
            }
        } else {
            $ret['error']['user_id'] = 'ユーザーIDが存在しません。';
        }
        return $ret;
    }

    protected function setModel()
    {
        $this->_userModel = new Model();
    }

    public function setLogin(array $form)
    {
        foreach ($form as $keyForm => $valForm) {
            $this->_form[$keyForm] = $valForm;
        }

        return $this;
    }

    /**
     * @return bool
     * true => 登録なし
     * ['error'] => すでに登録済みID
     */
    public function getAlreadyRegister()
    {
        $this->_modelHelper->setSelect('user_id')
            ->setSelect('user_deleted', 0);

        $this->_modelHelper->setDbTableName($this->_db_table)->setQueryBuilder(WEB_TOOL__SQL__STATEMENT_SELECT);

        // add where
        $this->_modelHelper->setAddWhere('user_id', $this->_form['user_id'])
            ->setAddWhere('user_deleted', 0);

        $this->_where = $this->_modelHelper->getWhere();
        $data = $this->setDbSaveWhere($this->_where);

        // クエリの初期化
        $this->cleanQueryBuilder();
        if(isset($data) AND count($data) > 0) {
            $data = [];
            $data['error']['user_id'] = 'すでに登録済みのIDです。他のIDを入力してください。';
            return $data;
        }

        return true;
    }

    public function getLogout()
    {
        $this->_sessionModel->getLogout();
    }

    public function getUser($key)
    {
        $this->_sessionModel->setGlobalSessionKey('user');
        return $this->_sessionModel->getSession($key);
    }
}
?>