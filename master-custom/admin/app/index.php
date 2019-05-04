<?php
session_start();
include './../production/config/config.php';
if(!empty($_POST['submit'])) {
    require_once dirname(__FILE__) . '/core/Db/Base/obj.php';
    $request = new Request();
    $login = array();
    $login = $request->getPostLogin($_POST);
    if(isset($login)) {
        $obj = new Dbassign();
        $obj->loginAction($login['login'], $login['pass']);
        $user = array();
        $user = $obj->getSession();
        if(isset($user) && $user !== false) {
            header('Location: '. LOCATION.'/production/');
            exit();
        } else {
            $msg = '<p>ログインに失敗しました。再度ログインし直してください。<a href="'.LOCATION.'">ログイン画面に戻る</a></p>';
            echo $msg;
        }
    } else {
        $msg = 'エラー';
    }
} else {
    $msg = 'エラー';
}
?>