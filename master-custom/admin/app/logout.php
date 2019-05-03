<?php
session_start();
include './../production/config/config.php';
if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    header('Location: ' . LOCATION);
    exit();
} else {
    echo 'すでにログアウトしています。<a href="'.LOCATION_FRONT.'">トップに戻る</a>';
}

?>

