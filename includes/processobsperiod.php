<?php
session_start();
include 'conn.inc.php';
include '../libraries/func.lib.php';

if (isset($_POST['submit'])) :
    $created_by = $_POST['created_by'];
    $current_year = ($_POST['current_year']);
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $status = "Active";

    $first_month = $_POST['first_month'];
    $first_day = $_POST['first_day'];
    echo $firstdate = formatDate($current_year, $first_month, $first_day);

    $second_month = $_POST['second_month'];
    $second_day = $_POST['second_day'];
    echo $seconddate = formatDate($current_year, $second_month, $second_day);

    $third_month = $_POST['third_month'];
    $third_day = $_POST['third_day'];
    echo $thirddate = formatDate($current_year, $third_month, $third_day);

    $final_month = $_POST['final_month'];
    $final_day = $_POST['final_day'];
    echo $finaldate = formatDate($current_year, $final_month, $final_day);

    $qry = 'INSERT INTO `obs_period_tbl`( `first_period`, `second_period`, `third_period`, `fourth_period`, `sy`, `school`, `status`,  `created_by`) VALUES ("' . $firstdate . '","' . $seconddate . '","' . $thirddate . '","' . $finaldate . '","' . $sy . '","' . $school . '","' . $status . '","' . $created_by . '")';
    $result = mysqli_query($conn, $qry) or die(mysqli_error($conn));

endif;
