<?php

class Dbassign extends Db {

    protected $_start = '';
    protected $_end = '';

    private $_objDbChild;

    public function __construct()
    {
        parent::__construct();
        if(is_null($this->_pdo) || empty($this->_pdo)) {
            $this->setPdo();
        }
        $this->_objDbChild = new Db();
        if (!empty($_SESSION['user'])) {
            $this->_objDbChild->setSession($_SESSION['user']);
        }
    }

    public function getParam($param) {
        return $_REQUEST[$param];
    }

    public function allQuery($id = null, $insert = array(), $update = array())
    {
        try{
            if(is_null($id)) {
                //新規作成処理
                $result = $this->allInsertQuery($insert);
                return $result;
            } else {
                //更新処理
                $update = $this->cleen($update);
                $result = $this->allUpdateQuery($id, $update);
                return $result;
            }
        } catch (Exception $e) {
            exit('接続失敗:'.$e->getMessage());
        }
    }

    protected function allInsertQuery($data)
    {
        //扱いやすい形に
        $typeHanding = array();
        foreach ($data as $val) {
            $typeHanding = $val;
        }
        $user_id = $typeHanding['user_id'];
        $name = $typeHanding['name'];
        $price = $typeHanding['price'];
        $file = $typeHanding['file'];
        $is_recommend = $typeHanding['is_recommend'];
        $description = $typeHanding['description'];
        $is_secret = $typeHanding['is_secret'];
//        $sqlTmp = array();
//        foreach ($data as $key => $val) {
//            $sqlTmp[$key] = $val;
//        }
//        $tmpSql = array();
//        $tmpSql = $this->_pdo->prepare("INSERT INTO {$this->_db_table} (";
//        foreach ($sqlTmp as $key => $val) {
//            $tmpSql .= implode($val, ',');
//        }
//        $tmpSql .= ") VALUES (";
//        foreach ($sqlTmp as $keyItem => $valItem) {
//            $tmpSql .= implode($valItem, ',');
//        }
//        $tmpSql .= ")";
        $insertQuery = "INSERT INTO {$this->_db_table} (user_id, name, price, image, description, is_recommend, is_secret) VALUES ('$user_id','$name','$price','$file','$description','$is_recommend','$is_secret')";
        $result = $this->myQuery($insertQuery,$this->_pdo);
        return $result;
    }

    protected function allUpdateQuery($id,$data)
    {
        if( count($data) > 0) {
            $name = $data['name'];
            $price = $data['price'];
            $file = $data['file'];
        }
        $updateQuery = "UPDATE {$this->_db_table} SET name='$name', price='$price', image='$file' WHERE id={$id}";
        $result = $this->myQuery($updateQuery, $this->_pdo);
        return $result;
    }


    public function allQueryUser()
    {
        exit();
    }

    public function insertQueryUser($name, $pass, $nickname, $comment)
    {
        if(!empty($name) && !empty($pass) && !empty($nickname)) {
            $name = $this->cleen($name);
            $pass = serialize($this->cleen($pass));
            $nickname = $this->cleen($nickname);
            if(!empty($comment)) {
                $comment = $this->cleen($comment);
            }
            try {
                if(isset($_SESSION['user'])) {
                    unset($_SESSION['user']);
                }
                //重複チェック
                $checkerQueryUser = $this->_pdo->prepare("SELECT * FROM {$this->_db_user_table} where name=?");
                $checkerQueryUser->execute([$name]);
                if(empty($checkerQueryUser->fetchAll())) {
                    $insertQueryUser = $this->_pdo->prepare("INSERT INTO {$this->_db_user_table} value (null, ?, ?, ?, ?, ?)");
                    @mysql_query('set names utf8');
                    $insertQueryUser->execute([
                        $name,
                        $pass,
                        $nickname,
                        $comment,
                        null
                    ]);
                    //アカウントの作成後、ログイン処理
                    $this->selectQueryLogin($name,$pass);
                    return true;
                } else {
                    return false;
                }
            } catch(Exception $e) {
                exit('接続失敗：'.$e->getMessage());
            }
        }
        return false;
    }


    //select処理
    public function selectQuery($id = null, $name = null, $page = null)
    {
        try {
            if ( $id != '' ) {
                $id = trim($this->cleen($id));
                $selectQuery = "SELECT * FROM {$this->_db_table} WHERE id={$id}";
            } elseif ($name != '') {
                $name = trim($this->cleen($name));
                if(!empty($name)) {
                    $selectQuery = "SELECT * FROM {$this->_db_table} WHERE name LIKE '%{$name}%'";
                } else {
                    return false;
                    //怪しい検索が入った場合メールだけ送る
                    //$this->sendMail($name);
                    //return $msg;
                }
            } elseif ( $page != '') {
                $page = trim($this->cleen($page));
                $this->pageSet();
                $this->_start = $this->_end * ($page - 1);
                $selectQuery = $this->pageQuery($this->_start, $this->_end);
            } else {
                $selectQuery = $this->pageQuery();
            }
            $row = $this->myQuery($selectQuery, $this->_pdo);
        } catch(Exception $e) {
            exit('接続失敗:'.$e->getMessage());
        }
        return $row;
    }


    //マイページ用の処理
    public function getIndividualData($user_id)
    {
        try {
            $user_id = trim($this->cleen($user_id));
            $selectQuery = "SELECT * FROM {$this->_db_table} WHERE user_id={$user_id} ORDER BY id DESC";
            $row = $this->myQuery($selectQuery, $this->_pdo);
        } catch(Exception $e) {
            exit('接続失敗'.$e->getMassage());
        }
        return $row;
    }


    public function countQuery()
    {
        try{
            //データ件数取得
            $count = $this->_pdo->prepare("SELECT COUNT(*) as cnt FROM {$this->_db_table} WHERE is_secret='1'");
            $count->execute();
            $row = $count->fetch();
            //1Pに表示する件数からページ数の取得
            $max_page = floor($row['cnt'] / 10) + 1;
        } catch(Exception $e) {
            exit('接続失敗：'.$e->getMessage());
        }
        return $max_page;
    }

    protected function pageQuery($start = '',$end = '')
    {
        //ページング振り分け
        if ( $start != '' && $end != '') {
            return "SELECT * FROM {$this->_db_table} WHERE is_secret='1' ORDER BY id DESC LIMIT {$start}, {$end}";
        } else {
            $this->pageSet();
            return "SELECT * FROM {$this->_db_table} WHERE is_secret='1' ORDER BY id DESC LIMIT 0, {$this->_end}";
        }
    }

    protected function pageSet()
    {
        //ページ表示件数（もっと動的にする）
        $this->_end = 10;
    }

    public function sortQuery($sort = null, $under = null, $up = null)
    {
        try {
            //綺麗にする処理
            if(!empty($sort) && is_numeric($sort) && !is_null($sort)) {
                $sort = $this->cleen($sort);
                $sortQuery = "SELECT * FROM {$this->_db_table} WHERE is_secret='1' ORDER BY id DESC LIMIT {$sort}";
            }
            if (!empty($under) && is_numeric($under) && !is_null($under)) {
                $under = $this->cleen($under);
                $sortQuery = "SELECT * FROM {$this->_db_table} WHERE is_secret='1' ORDER BY LPAD(price, 100,0) ASC LIMIT {$under}";
            }
            if(!empty($up) && is_numeric($up) && !is_null($up)) {
                $up = $this->cleen($up);
                $sortQuery = "SELECT * FROM {$this->_db_table} WHERE is_secret='1' ORDER BY CAST(name AS CHAR) ASC LIMIT {$up}";
            }
            $row = $this->myQuery($sortQuery, $this->_pdo);
        } catch(Exception $e) {
            exit('接続失敗：'.$e->getMessage());
        }
        return $row;
    }

    //delete処理
    public function deleteQuery($params)
    {
        if( !empty($params) ) {
            if( is_numeric($params) ) {
                try {
                    $param = $this->cleen($params);
                    $deleteQuery = "DELETE FROM {$this->_db_table} WHERE id={$param}";
                    $this->myQuery($deleteQuery, $this->_pdo);
                } catch (Exception $e) {
                    exit('接続失敗:'.$e->getMessage());
                }
                return true;
            } else {
                $err = 'パラーメーターがおかしい。';
                return $err;
                header('Location:./list.php');
                exit();
            }
        } else {
            $err = 'パラーメーターがない';
            return $err;
            header('Location:./list.php');
            exit();
        }
    }


    //update処理
    public function updateQuery($id, $name, $price, $image = '')
    {
        if (!empty($id)) {
            $id = $this->cleen($id);
            if(!empty($name)) {
                $name = $this->cleen($name);
            }
            if(!empty($price)) {
                $price = $this->cleen($price);
            }
            try{
                $updateQuery = "UPDATE {$this->_db_table} SET name='$name', price='$price', image='$image' WHERE id={$id}";
                $result = $this->myQuery($updateQuery,$this->_pdo);
            } catch(Exception $e) {
                exit('接続失敗：'.$e->getMessage());
            }
            return $result;
        }
    }


    public function selectQueryUserData($user_id)
    {
        if(!empty($user_id) && is_numeric($user_id)) {
            $user_id = $this->cleen($user_id);
            try{
                $selectQueryUserData = "SELECT * FROM {$this->_db_table}, {$this->_db_user_table} WHERE {$this->_db_user_table}.id={$user_id} and {$this->_db_table}.user_id={$user_id}";
                $result = $this->myQuery($selectQueryUserData, $this->_pdo);
                if(!empty($result)) {
                    return $result;
                } else {
                    //データが取得できない場合、ユーザーのデータだけ取得
                    $result = '';
                    $result = $this->selectQueryUserDetailData($user_id);
                    return $result;
                }
            } catch(Exception $e) {
                exit('接続遮断：'.$e->getMessage());
            }
        } else {
            return false;
        }
    }

    public function selectQueryRequestUserData($user_id)
    {
        if(!empty($user_id) && is_numeric($user_id)) {
            $user_id = $this->cleen($user_id);
            try{
                $selectQueryUserData = "SELECT * FROM {$this->_db_table} WHERE {$this->_db_user_table}.id={$user_id} and {$this->_db_table}.user_id={$user_id}";
                $result = $this->myQuery($selectQueryUserData, $this->_pdo);
                if(!empty($result)) {
                    return $result;
                } else {
                    //データが取得できない場合、ユーザーのデータだけ取得
                    $result = '';
                    $result = $this->selectQueryUserDetailData($user_id);
                    return $result;
                }
            } catch(Exception $e) {
                exit('接続遮断：'.$e->getMessage());
            }
        } else {
            return false;
        }
    }


    public function selectQueryUserDetailData($user_id)
    {
        if(!empty($user_id) && $user_id != '') {
            try {
                $selectQueryUserDetailData = "SELECT * FROM {$this->_db_user_table} WHERE id={$user_id}";
                $result = $this->myQuery($selectQueryUserDetailData, $this->_pdo);
                return $result;
            }
            catch(Exception $e) {
                exit('接続遮断：'.$e->getMessage());
            }
        } else {
            return false;
        }
    }

    public function loginAction($login_id, $login_pass)
    {
        if (!empty($login_id) && !empty($login_pass)) {
            $loginPass = serialize($login_pass);
            $this->selectQueryLogin($login_id, $loginPass);
        }
    }

    private function selectQueryLogin($login_id, $login_pass)
    {
        if(!empty($login_id) && !empty($login_pass)) {
            try {
                $login_id = $this->cleen($login_id);
                $login_pass = $this->cleen($login_pass);
                unset($_SESSION['user']);
                if(!isset($_SESSION['user'])) {
                    $selectQueryLogin = $this->_pdo->prepare("SELECT * FROM {$this->_db_user_table} WHERE name=? and password=?");
                    $selectQueryLogin->execute([$login_id, $login_pass]);
                    foreach ($selectQueryLogin->fetchAll() as $row) {
                        $_SESSION['user'] = [
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'nickname' => $row['nickname'],
                            'comment' => $row['comment'],
                            'follows' => $row['follows_id']
                        ];
                    }
                    if (!empty($_SESSION['user'])) {
                        $this->_objDbChild->setSession($_SESSION['user']);
                    }
                } else {
                    $logout_link = '<a href="' . dirname(__FILE__) . '/../user/logout.php">ログアウトしますか？</a>';
                    $msg = '現在ログインされています。'. $logout_link;
                    return $msg;
                }
            } catch(Exception $e) {
                exit('接続失敗：'.$e->getMessage());
            }
        } else {
            return false;
        }
    }

    protected function setPdo()
    {
        $this->_pdo = $this->_objDb->dbConnect();
    }

    //セッション情報をセット
    public function getSession()
    {
        if(!empty($_SESSION['user'])) {
            return array(
                'user_id' => $this->_objDbChild->_user_id,
                'user_name' => $this->_objDbChild->_user_name,
                'user_nickname' => $this->_objDbChild->_user_nickname,
                'user_comment' => $this->_objDbChild->_user_comment,
                'user_follows' => $this->_objDbChild->_user_follows
            );
        }
    }

    //ユーザー情報の再セット
    private function reloadSetSession($reloadUserId)
    {
        //再セットのためセッションを一度破棄
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        parent::reloadSetSessionParent($reloadUserId);
    }



    //マイページ変更処理
    //おすすめ、公開等
    public function myPageIsAjax($id, $is_value, $name)
    {
        $this->_objDbChild->myPageIsAjaxParent($id, $is_value, $name);
    }

    //フォロー処理
    public function myPageIsFollow($userId, $requestUserId, $followStatus)
    {
        if (!empty($requestUserId)) {
            //ユーザーのフォロー状況を確認
            $requestUserData = $this->selectQueryUserData($requestUserId);
            if ( !empty($requestUserData[0]['follows_id'])) {
                $userFollowData = array();
                //1人でもフォローしていたら配列に変換
                $userFollowData = explode(',', $requestUserData[0]['follows_id']);
                if ($followStatus == 1) {
                    //フォローの追加
                    $countFollowingCount = count($userFollowData);
                    $userFollowData[$countFollowingCount] = $userId;
                    $this->_objDbChild->myPageIsFollowParent($requestUserId, $userFollowData);
                } else {
                    //フォローの除去
                    $deleteDatas = array_diff($userFollowData, array($userId));
                    $deletedDatas = array_values($deleteDatas);
                    $this->_objDbChild->myPageIsFollowParent($requestUserId, $deletedDatas);
                }
            } else {
                $userFollowData = array();
                $userFollowData['follows'][0] = $userId;
                $this->_objDbChild->myPageIsFollowParent($requestUserId, $userFollowData['follows']);
            }
            //セッション情報のロード
            $this->reloadSetSession($requestUserId);
        }
    }

    //ユーザーフォロー情報取得
    public function getFollowData($userFollows) {
        $userFollowData = array();
        $userFollowData = explode(',', $userFollows);
        if (count($userFollowData) > 0) {
            $allData = array();
            $userData = array();
            foreach ($userFollowData as $key => $valId) {
                $allData[] = $this->selectQueryUserData($valId);
                $userData[$key]['nickname'] = $allData[$key][0]['nickname'];
                $userData[$key]['comment'] = $allData[$key][0]['comment'];
                $userData[$key]['user_id'] = $allData[$key][0]['user_id'];
                if ($allData[$key][0]['follows_id'] != '') {
                    $userData[$key]['follows'] = explode(',', $allData[$key][0]['follows_id']);
                }
            }
            return $userData;
        } else {
            return $userData = 0;
        }
    }


    //おすすめ表示用
    public function selectRecommendQuery($userId, $isRecom = null)
    {
        if (is_null($isRecom)) {
            return $this->_objDb->selectRecommendQueryParent($userId);
        } else {
            try {
                $selectRecommendQuery = $this->_pdo->prepare("SELECT * FROM {$this->_db_table} WHERE user_id=?, is_secret=? AND is_recommend=? ORDER BY id DESC");
                $selectRecommendQuery->execute([$userId, 1, $isRecom]);
                return $selectRecommendQuery->fetchAll();
            } catch(Exception $e) {
                exit('接続失敗'.$e->getMassage());
            }
        }
    }



    //カテゴリデータ
    public function insertQueryCategory($formName, $data)
    {
        try {
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
            $arrSqlKey = implode(',', $arrTmpSqlKey);
            $arrSqlVal = implode('\',\'', $arrValue);
            $this->setPdo();
            $insertSql = "INSERT INTO {$formName} ({$arrSqlKey}) VALUES ('{$arrSqlVal}')";
            $this->myQuery($insertSql, $this->_pdo);
        } catch(Exception $e) {
            exit($e->getMessage());
        }
    }

    //カテゴリデータ取得
    public function getCategoryData($userId, $searchData) {
        if ( !empty($userId) ) {
            return $this->_objDbChild->getCategoryDataParent($userId, $searchData);
        }
    }

}
?>