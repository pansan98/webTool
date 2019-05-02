<?php
namespace src\Mod\Model;

include_once dirname(__FILE__).'/../../App/bootstrapRootModel.php';

/**
 * Class Model
 * @package src\Mod\Model
 * 基本接続のみ
 */
class Model {
    // DB接続情報
    private $_db_name;
    private $_db_host;
    private $_db_port;
    private $_db_user;
    private $_db_password;

    private $_db;

    protected function __construct()
    {
        $this->init();
    }

    protected function init()
    {
        $dbSetting = [];
        $dbSetting = $this->getDbSetting();
        $this->setDb($dbSetting);
    }

    private function getDbSetting()
    {
        $serverHost = $_SERVER['HTTP_HOST'];
        $dbSetting = [];
        switch($serverHost) {
            case 'localhost':
            case '127.0.0.1':
                $dbSetting = array(
                    'db_name' => 'applications',
                    'db_host' => 'localhost',
                    'port' => '3306',
                    'user_name' => 'root',
                    'user_password' => ''
                );
                break;
            default:
                $dbSetting = array(
                    'db_name' => '',
                    'db_host' => '',
                    'port' => '',
                    'user_name' => '',
                    'user_password' => ''
                );
                break;
        }

        return $dbSetting;
    }

    private function setDb($setting)
    {
        $this->_db_name = $setting['db_name'];
        $this->_db_host = $setting['db_host'];
        $this->_db_port = $setting['port'];
        $this->_db_user = $setting['user_name'];
        $this->_db_password = $setting['user_password'];
    }

    protected function setDbConnect()
    {
        $this->_db = new PDO("mysql:dbname={$this->_db_name}; host={$this->_db_host}; port={$this->_db_port}; charset=utf8", $this->_db_user, $this->_db_password);
    }

    protected function getDbConnect()
    {
        return $this->_db;
    }

    public function __destruct()
    {
        unset($this->_db);
    }
}
?>