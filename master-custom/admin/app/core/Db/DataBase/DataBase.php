<?php


class DataBase {
    private $_db_host;
    private $_db_port;
    private $_db_name;
    private $_db_account;
    private $_db_password;

    protected $_db_table;
    protected $_db_user_table;
    protected $_db_category_table;


    public function __construct()
    {
        $this->setDbSetting();
    }

    //DB接続
    public function dbConnect()
    {
        $pdo = new PDO("mysql:dbname=".$this->_db_name."; host=".$this->_db_host."; port=".$this->_db_port."; charset=utf8",$this->_db_account,$this->_db_password);
        return $pdo;
    }

    //DB情報セット
    private function setDbSetting() {
        $this->_db_host = 'localhost';
        $this->_db_port = '80';
        $this->_db_name = 'cake_test';
        $this->_db_account = 'root';
        $this->_db_password = 'root';
        $this->_db_table = 'yamada';
        $this->_db_user_table = 'user';
        $this->_db_category_table = 'category';
    }

    //テーブル
    public function getDbTable()
    {
        return $this->_db_table;
    }

    //ユーザーテーブル
    public function getDbUserTable()
    {
        return $this->_db_user_table;
    }

    //カテゴリーテーブル
    public function getDbCategoryTable()
    {
        return $this->_db_category_table;
    }


    //DB遮断
    public function dbUnset($pdo)
    {
        if( isset($pdo) ) {
            unset($pdo);
        }
        return false;
    }

}
?>
