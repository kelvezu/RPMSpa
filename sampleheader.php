<!DOCTYPE html>
<html lang="en">

<?php

// use Mpdf\Mpdf;
use Dashboard\Dashboard;


session_start();
// include_once 'vendor/autoload.php';
include_once 'includes/security.php';
include_once 'includes/conn.inc.php';
include_once 'includes/constants.inc.php';
include_once 'includes/classautoloader.inc.php';
include_once 'libraries/db.library.php';
include_once 'libraries/func.lib.php';
include_once 'includes/security.php';
include_once 'libraries/queries.library.php';
activeobsperiod($conn);

// if (!empty($_SESSION['active_sy_id'])) :
//     endSchoolYear($conn, $_SESSION['active_sy_id']);
// endif;
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


    <!-- Script for Dynamic Dropdown -->
    <script src="bootstrap4/scripts/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <!-- Script for Dynamic Dropdown -->

    <!-- Script for Charts  -->
    <script src="bootstrap4/scripts/googlechart.js"></script>
    <script src="bootstrap4/scripts/jquery3.min.js"></script>
    <script>
        // this will enable the tooltip in bootstrap 4
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- For Charts -->
    <script>



    </script>

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
                <div id="navBar">
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

    <?php if (empty($_SESSION['active_sy_id'])) :
        if ($_SESSION['position'] == "Admin") : ?>
            <p class="red-notif-border m-5">
                School year is not set. Click <a href="sy.php">here</a> to set the School Year.
            </p>
        <?php else : ?>

            <p class="red-notif-border">
                School year is not set.
            </p>
<?php endif;
    endif; ?>

    <?php if(empty($_SESSION['first_period']) || empty($_SESSION['second_period']) || empty($_SESSION['third_period']) || empty($_SESSION['final_period'])):
        if($_SESSION['position'] == "Principal") :?>
            <p class="red-notif-border m-5">
                Classroom Observation period is not set. Click <a href="setobsperiod.php">here</a> to set the Classroom Observation Period.
            </p>
        <?php elseif(($_SESSION['position'] == "School Head") || ($_SESSION['position'] == "Asst Superintendent") || ($_SESSION['position'] == "Master Teacher IV") || ($_SESSION['position'] == "Master Teacher III") || ($_SESSION['position'] == "Master Teacher II") || ($_SESSION['position'] == "Master Teacher I") || ($_SESSION['position'] == "Teacher III") || ($_SESSION['position'] == "Teacher II") || ($_SESSION['position'] == "Teacher I")) : ?>

             <p class="red-notif-border">
                Classroom Observation Period is not set.
            </p>
        <?php else: false; ?>   
<?php endif;
    endif; ?>