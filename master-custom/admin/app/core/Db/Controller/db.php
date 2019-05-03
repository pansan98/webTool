<?php

require_once dirname(__FILE__) . './../DataBase/DataBase.php';


class Db {

    //DB
    protected $_objDb;
    protected $_pdo;

    protected $_db_table;
    protected $_db_user_table;
    protected $_db_category_table;


    //ユーザー情報
    protected $_user_id;
    protected $_user_name;
    protected $_user_nickname;
    protected $_user_comment;
    protected $_user_follows;

    protected function __construct()
    {
        $this->_objDb = new DataBase();
        $this->_pdo = $this->_objDb->dbConnect();
        $this->setDbTable();
    }


    protected function setDbTable()
    {
        $this->_db_table = $this->_objDb->getDbTable();
        $this->_db_user_table = $this->_objDb->getDbUserTable();
        $this->_db_category_table = $this->_objDb->getDbCategoryTable();
    }


    // sql処理
    protected function myQuery($sql, $pdo)
    {
        $db = $pdo->prepare($sql);
        $db->execute();
        return $db->fetchAll(PDO::FETCH_ASSOC);
    }


    //クリーン
    protected function cleen($cleen = array())
    {
        if(is_array($cleen)) {
            $row = array();
            foreach ($cleen as $key => $val) {
                $row = $val;
            }
            return $row;
        } else {
            $row = htmlspecialchars(strip_tags(preg_replace("/(| )/", "",$cleen)));
            return $row;
        }
    }


    //マイページ処理
    protected function myPageIsAjaxParent($id, $is_value, $name) {
        try {
            $myPageisAjaxQuery = "UPDATE {$this->_db_table} SET {$name}={$is_value} WHERE id={$id}";
            $this->myQuery($myPageisAjaxQuery, $this->_pdo);
        } catch(Exception $e) {
            exit('エラー'.$e->getMessage());
        }
    }


    //おすすめ表示用持ち主の場合
    protected function selectRecommendQueryParent($userId)
    {
        try {
            $selectRecommendQueryParent = "SELECT * FROM {$this->_db_table} WHERE user_id={$userId} AND is_recommend='1' ORDER BY id DESC";
            $result = $this->myQuery($selectRecommendQueryParent, $this->_pdo);
            return $result;
        } catch(Exception $e) {
            exit('接続エラー'.$e->getMassage());
        }
    }


    //フォロー追加処理
    protected function myPageIsFollowParent($requestUserId, $requestUserIdFollow)
    {
        $requestFollow = implode(',', $requestUserIdFollow);
        try {
            $myPageisFollowQuery = "UPDATE {$this->_db_user_table} SET follows_id='$requestFollow' WHERE id={$requestUserId}";
            $this->myQuery($myPageisFollowQuery, $this->_pdo);
        }catch (Exception $e) {
            exit('エラー：'.$e->getMessage());
        }
    }

    //カテゴリデータ取得
    protected function getCategoryDataParent($userId, $searchData) {
        $Category = array();
        try {
            $getCategory = "SELECT * FROM {$this->_db_category_table} WHERE {$searchData}={$userId} ORDER BY id DESC";
            $Category = $this->myQuery($getCategory, $this->_pdo);
            return $Category;
        } catch (Exception $e) {
            exit('エラー'.$e->getMessage());
        }
    }


    //セッション情報再セット
    protected function reloadSetSessionParent($reloadUserId)
    {
        try {
            $reloadQuery = $this->_pdo->prepare("SELECT * FROM {$this->_db_user_table} WHERE id=?");
            $reloadQuery->execute([$reloadUserId]);
            foreach ($reloadQuery->fetchAll() as $row) {
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'nickname' => $row['nickname'],
                    'comment' => $row['comment'],
                    'follows' => $row['follows_id']
                ];
            }
            if (!empty($_SESSION['user'])) {
                $this->setSession($_SESSION['user']);
            }
        } catch(Exception $e) {
            unset($_SESSION);
            exit('エラーが発生しました。一度ログアウトします。'.$e->getMessage());
        }
    }

    //パラメータ取得
    public function getParam($param) {
        return $_REQUEST[$param];
    }


    //セッション情報をセット
    protected function setSession($session)
    {
        $this->_user_id = $session['id'];
        $this->_user_name = $session['name'];
        $this->_user_nickname = $session['nickname'];
        $this->_user_comment = $session['comment'];
        $this->_user_follows = $session['follows'];
    }
}
?>
