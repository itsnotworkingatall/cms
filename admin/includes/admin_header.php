<?php include "../includes/db.php" ?>
<?php include "functions.php" ?>
<?php ob_start(); ?>
<?php session_start(); ?>

<?php

if (!isset($_SESSION['userrole']) || $_SESSION['userrole'] != 1 || $_SESSION['userstatus'] != 'Enabled') {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function deleteConfirmation(delId) {
            var did = delId;
            var del = confirm("Click this link again to delete the post");
            if (del == true) {
                did = location.href='?delete='+did;
            } else {
                del = "Don't delete";
            }
            document.getElementById(did).innerHTML = del;
        }
    </script>
<!--    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ii4qlq3tayu4k4x1khavro7uyhzghyljbkh41u4h2wxdu85r"></script>-->

</head>

<body>
