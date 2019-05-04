<?php
session_start();
if (!empty($_POST)) {
    require_once dirname(__FILE__) . '/../Db/Base/obj.php';
    require_once dirname(__FILE__) . '/../../model/Data/DataController.php';
    require_once dirname(__FILE__) . '/request_mypage.php';
    $Request = new MypageUpdate();
    $Request->setPostData($_POST);
    $changeValue = $Request->getPostData();
    if (!empty($changeValue)) {
        $ajaxObj = new DataController();
        if ($changeValue['sendName'] == 'checkbox') {
            $ajaxObj->myPageIsAjax($changeValue['id'], $changeValue['is_value'], $changeValue['name']);
        } elseif ($changeValue['sendName'] == 'actionWhenFollowed') {
            $ajaxObj->myPageIsFollow($changeValue['userId'], $changeValue['requestUserId'], $changeValue['status']);
        }
    }
}
?>