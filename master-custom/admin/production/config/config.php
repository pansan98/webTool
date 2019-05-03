<?php

$parentDir = 'stu_sql/cakes';
$mainPath = '/master-custom/admin';

define('LOCATION', (empty($_SERVER['HTTPS'])? 'http://': 'https://').$_SERVER['HTTP_HOST'].'/'.$parentDir.$mainPath, true);

define('LOCATION_FRONT', (empty($_SERVER['HTTPS'])? 'http://': 'https://').$_SERVER['HTTP_HOST'].'/'.$parentDir, true);

define('LOCATION_FILE', (empty($_SERVER['HTTPS'])? 'http://': 'https://').$_SERVER['HTTP_HOST'].'/'.$parentDir.$mainPath.'/build', true);

define('LOCATION_HEAD', (empty($_SERVER['HTTPS'])? 'http://': 'https://').$_SERVER['HTTP_HOST'].'/'.$parentDir.$mainPath.'/vendors', true);

define('SYSTEM_VERSION', '0.0.4', true);

define('COPY_RIGHT', date('Y').' ©︎ copyRight All Reserved', true);

require_once dirname(__FILE__) . '/../../app/core/Db/Base/obj.php';

?>