<!DOCTYPE html>
<html lang="en">

<?php
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
    <link rel="stylesheet" href="bootstrap4/b4css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bootstrap4/font_awesome/css/all.css">
</head>

<body class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
        <a class="navbar-brand">
            <img src="img/depeds.png" width="50" height="50" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <div class="my-2 my-md-0">
                <h6 class="text-white"><?= $_SESSION['fullname'] ?></h6>
            </div>
            <div class="ml-2"><a class="text-decoration-none"> <i data-target="#LogoutModal" data-toggle="modal" class="fas fa-power-off text-danger"></i></a></div>
        </div>
    </nav>