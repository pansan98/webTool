<?php

class DataController extends Db {

    protected $_start = '';
    protected $_end = '';

    private $_objModel;

    public function __construct()
    {
        parent::__construct();
        $this->_objModel = new Db();
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


    //delete処理
    public function deleteQuery($params, $tableData)
    {
        if( !empty($params) ) {
            if( is_numeric($params) ) {
                try {
                    $param = $this->cleen($params);
                    $deleteQuery = "DELETE FROM {$tableData} WHERE id={$param}";
                    $this->myQuery($deleteQuery, $this->_pdo);
                } catch (Exception $e) {
                    exit('接続失敗:'.$e->getMessage());
                }
                return true;
            } else {
                $err = 'パラーメーターがおかしい。';
                return $err;
            }
        } else {
            $err = 'パラーメーターがない';
            return $err;
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


    //セッション情報を取得
    public function getSession()
    {
        if(!empty($_SESSION['user'])) {
            return array(
                'user_id' => $this->_objModel->_user_id,
                'user_name' => $this->_objModel->_user_name,
                'user_nickname' => $this->_objModel->_user_nickname,
                'user_comment' => $this->_objModel->_user_comment,
                'user_follows' => $this->_objModel->_user_follows
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
        $this->_objModel->myPageIsAjaxParent($id, $is_value, $name);
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
                    $this->_objModel->myPageIsFollowParent($requestUserId, $userFollowData);
                } else {
                    //フォローの除去
                    $deleteDatas = array_diff($userFollowData, array($userId));
                    $deletedDatas = array_values($deleteDatas);
                    $this->_objModel->myPageIsFollowParent($requestUserId, $deletedDatas);
                }
            } else {
                $userFollowData = array();
                $userFollowData['follows'][0] = $userId;
                $this->_objModel->myPageIsFollowParent($requestUserId, $userFollowData['follows']);
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
            return $this->_objModel->selectRecommendQueryParent($userId);
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

    //カテゴリデータ取得
    public function getCategoryDataFromHorizontal($userId, $searchData)
    {
        if ( !empty($userId) ) {
            $arrCateTmp = array();
            $arrCateTmp = $this->_objModel->getCategoryDataParent($userId, $searchData);
            if (count($arrCateTmp) > 0) {
                $cateData = array();
                foreach ($arrCateTmp as $key => $val) {
                    $cateData[$val['id']]['category_name'] = $val['category_name'];
                }
                return $cateData;
            }
        }
    }


    //データ追加
    public function insertQueryData($formName, $data)
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

}
?>