<?php
session_start();
if (!empty($_POST)) {
    include './../config/config.php';
    $requestObj = new Request();
    $requestObj->setPostInsertData($_POST);
    if (isset($_FILES) && isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = array();
        $file = $requestObj->setFile($_FILES, $_POST['user_id']['user_id']);
        if ($file === false) {
            $msg = 'ファイルのアップロードに失敗しました。';
        }
    }
    $postsData = array();
    $postsData = $requestObj->getPostInsertData();
    if (!empty($postsData) ) {
        require_once dirname(__FILE__) . '/../../app/model/Data/DataController.php';
        $dataObj = new DataController();
        $arrDifData = array_diff($postsData, array($postsData['form_name']));
        if (!empty($file)) {
            $arrDifData['image'] = $file['filename'];
        }
        $dataObj->insertQueryData($postsData['form_name'], $arrDifData);
        header('Location: '.$requestObj->getHoldRequestUrl());
        exit();
    }
} else {
    require_once dirname(__FILE__) . '/../../app/core/Db/Base/obj.php';
    $requestObj = new Request();
    header('Location: '.$requestObj->getHoldRequestUrl());
    exit();
}
?>