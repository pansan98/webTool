<?php
if ( !isset($_SESSION['user'])) {
    header('Location: '.LOCATION);
    exit();
} else {
    $url = basename((empty($_SERVER['HTTPS']) ? 'http://':'https://').$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
    if ( (empty($_SERVER['HTTPS']) ? 'http://':'https://').$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'] === LOCATION.'/'.$url) {
        header('Location: '.LOCATION.'/production/');
        exit();
    } else {
        $obj = new Dbassign();
        $user = $obj->getSession();
    }
}
?>