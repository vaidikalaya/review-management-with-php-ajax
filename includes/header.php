<?php 
    $realPath=$_SERVER['PHP_SELF'];
    $mainPath=substr($realPath, 0, strpos($realPath, "review-management")).'review-management/';
    define('SITE_URL',"http://".$_SERVER["SERVER_NAME"].$mainPath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Management</title>

    <!--Jquery-->
    <script src="<?= SITE_URL ?>assets/jquery/jquery-3.6.4.min.js"></script>

    <!--Bootstrap-->
    <link href="<?= SITE_URL ?>assets/bootstrap/bootstrap.min.css" rel="stylesheet">

    <!--Sweetalert-->
    <script src="<?= SITE_URL ?>assets/sweetalert/sweetalert2.all.min.js"></script>

    <!--DATA TABLES-->
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>assets/datatables/jquery.dataTables.css">

    <!--Custom Css-->
    <link href="<?= SITE_URL ?>assets/style.css" rel="stylesheet">
</head>
<body>
    
