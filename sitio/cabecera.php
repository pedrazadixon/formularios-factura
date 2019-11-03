<?php defined('BASE_URL_') or define('BASE_URL_', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . basename(dirname(__DIR__)) . '/'); ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Facturas UCC</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo BASE_URL_ ?>assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo BASE_URL_ ?>assets/sb-admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo BASE_URL_ ?>assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="<?php echo BASE_URL_ ?>">Facturas UCC</a>
    </nav>

    <div id="wrapper">

        <?php include_once 'menu.php'; ?>

        <div id="content-wrapper">

            <div class="container-fluid">