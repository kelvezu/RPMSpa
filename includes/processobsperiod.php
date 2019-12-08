<?php
session_start();
include 'conn.inc.php';
include '../libraries/func.lib.php';



if (isset($_POST['submit_obs'])) :
    pre_r($_POST);
    $created_by = $_POST['created_by'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $status = "Active";

    $first_period = $_POST['first_period'];
    $second_period = $_POST['second_period'];
    $third_period = $_POST['third_period'];
    $fourth_period = $_POST['fourth_period'];

    $qry1 = $conn->query('UPDATE obs_period_tbl SET `status` = "Inactive" WHERE school = ' . $school . ' ');

    $qry = 'INSERT INTO `obs_period_tbl`( `first_period`, `second_period`, `third_period`, `fourth_period`, `sy`, `school`, `status`,  `created_by`) VALUES ("' . $first_period . '","' . $second_period . '","' . $third_period . '","' . $fourth_period . '","' . $sy . '","' . $school . '","' . $status . '","' . $created_by . '")';
    $result = mysqli_query($conn, $qry) or die(mysqli_error($conn));

    if ($result) :
        header('location:../setobsperiod.php?notif=success');
        exit();
    endif;
else : header('location:../setobsperiod.php?notif=error');
endif;
