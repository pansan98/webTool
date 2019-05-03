<?php session_start(); ?>
<?php include dirname(__FILE__) . '/../config/config.php'; ?>
<?php require_once dirname(__FILE__).'/../../app/core/LoginCheck.php'; ?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Custom Admin | YMD</title>


    <!-- Bootstrap -->
    <link href="<?php echo LOCATION_HEAD; ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo LOCATION_HEAD; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo LOCATION_HEAD; ?>/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo LOCATION_HEAD; ?>/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo LOCATION_HEAD; ?>/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo LOCATION_HEAD; ?>/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo LOCATION_HEAD; ?>/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo LOCATION_FILE; ?>/css/custom.css" rel="stylesheet">
  </head>
