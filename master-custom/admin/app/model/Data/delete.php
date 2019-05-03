<?php
session_start();
include dirname(__FILE__) . '/../../../production/config/config.php';
//削除用
require_once dirname(__FILE__) . '/DataController.php';
$dataObj = new DataController();
$requestObj = new Request();
$paramId = $dataObj->getParam('id');
if (!empty($paramId)) {
    $paramData = $dataObj->getParam('data');
    $result = $dataObj->deleteQuery($paramId, $paramData);
    if($result === true) {
        $redirectUrl = $requestObj->getHoldRequestUrl();
        header('Location: '. $redirectUrl);
        exit();
    } else {
        $msg = array();
        $msg[] = $result;
        $msg[] = '<p>削除に失敗しました。</p><a href="./list.php">一覧に戻る</a>';
    }
} else {
    $msg = '<a href="./list.php">残念失敗：戻る用</a>';
}
if (!empty($msg)) {
    if (is_array($msg) ) {
        foreach ($msg as $err) {
            echo $err;
        }
    } else {
        echo $msg;
    }
}
?>