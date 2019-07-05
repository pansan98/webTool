<?php
// parent dir name
if(!defined('WEB_TOOL__DIR')) {
    define('WEB_TOOL__DIR', realpath(dirname(__FILE__).'/../../../'));
}

// parent path name
if(!defined('WEB_TOOL__PATH')) {
    define('WEB_TOOL__PATH', (empty($_SERVER['HTTPS'])?'http://':'https://').$_SERVER['HTTP_HOST'].'/webtool');
}


// master-custom dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_DIR', WEB_TOOL__DIR.'/master-custom/');
}

// master-custom path name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_PATH')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_PATH', WEB_TOOL__PATH.'/master-custom/');
}


// datas dir name
if(!defined('WEB_TOOL__ROOT_DATAS_DIR')) {
    define('WEB_TOOL__ROOT_DATAS_DIR', WEB_TOOL__DIR.'/datas/');
}

// datas path name
if(!defined('WEB_TOOL__ROOT_DATAS_PATH')) {
    define('WEB_TOOL__ROOT_DATAS_PATH', WEB_TOOL__PATH.'/datas/');
}


// Mod dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_DIR', WEB_TOOL__MASTER_CUSTOM__ROOT_DIR.'admin/src/Mod/');
}

// Mod path name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_PATH')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_PATH', WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/src/Mod/');
}


// Mod Controller dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__CONTROLLER_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__CONTROLLER_DIR', WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_DIR.'Controller/');
}


//Mod Model dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__MODEL_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__MODEL_DIR', WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_DIR.'Model/');
}


//Mod View dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_MOD__VIEW_DIR', WEB_TOOL__MASTER_CUSTOM__ROOT_MOD_DIR.'View/');
}


// App dir name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_APP_DIR')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_APP_DIR', WEB_TOOL__MASTER_CUSTOM__ROOT_DIR.'admin/src/App/');
}

// App path name
if(!defined('WEB_TOOL__MASTER_CUSTOM__ROOT_APP_PATH')) {
    define('WEB_TOOL__MASTER_CUSTOM__ROOT_APP_PATH', WEB_TOOL__MASTER_CUSTOM__ROOT_PATH.'admin/src/App/');
}

define('aaaae', 'aa');


echo 'aaa';
?>
