<?php

class FollowController extends Db {

    protected $_start = '';
    protected $_end = '';

    private $_objModel;

    public function __construct()
    {
        parent::__construct();
        $this->_objModel = new Db();
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


    //ユーザー情報の取得
    protected function selectQueryUserData($user_id)
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


    //ユーザー詳細情報取得
    protected function selectQueryUserDetailData($user_id)
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
}
?>