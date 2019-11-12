<!DOCTYPE html>
<html lang="en">

<?php

use Dashboard\Dashboard;


session_start();
include_once 'includes/security.php';
include_once 'includes/conn.inc.php';
include_once 'includes/constants.inc.php';
include_once 'includes/classautoloader.inc.php';
include_once 'libraries/db.library.php';
include_once 'libraries/func.lib.php';
include_once 'includes/security.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $_SESSION['position']; ?> Dashboard</title>
    <link rel="stylesheet" href="bootstrap4/b4css/main.css">
    <link rel="stylesheet" href="bootstrap4/b4css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="bootstrap4/font_awesome/css/all.css">



</head>

<body class="mb-5 bg-light">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <a class="navbar-brand">
            <img src="img/depeds.png" width="50" height="50" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">

                <!-- <a class="" data-toggle="collapse" data-target="#navBar" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-angle-double-right text-light "></i>
                </a> -->

                <!-- NavBar Collapse -->
                <div class="col" id="navBar">
                    <?= Dashboard::navbarView() ?>
                </div>
                <!-- End of NavBar Collapse -->

            </ul>
            <div class="my-2 my-md-0">
                <h6 class="text-white">Welcome, <?= $_SESSION['position'] ?></h6>
            </div>
            <div class="ml-2"><a class="text-decoration-none"> <i data-target="#LogoutModal" data-toggle="modal" class="fas fa-power-off text-danger"></i></a></div>
        </div>
    </nav>