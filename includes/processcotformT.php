<?php
session_start();

use RPMSdb\RPMSdb;

include 'conn.inc.php';
include '../libraries/func.lib.php';
include '../classes/rpmsdb/rpmsdb.class.php';



$conn = mysqli_connect("localhost", "root", "", "rpms");

//ADD Rating
if (isset($_POST['save'])) {

    if (empty($_POST['observer2'])) {
        $rater_id2 = "NULL";
    } else {
        $rater_id2 =  $_POST['observer2'];
    }

    if (empty($_POST['observer3'])) {
        $rater_id3 = "NULL";
    } else {
        $rater_id3 =  $_POST['observer3'];
    }

    $rater_id = $_POST['rater_id'];
    $date = date("Y/m/d");
    $user_id = $_POST['tobserved'];
    $subject = $_POST['tsubject'];
    $gradelvltaught = $_POST['tgradelvltaught'];
    $obs_period = intval($_POST['obs']);
    $indicator_id = $_POST['indicator_id'];
    $tcotrating = $_POST['rating'];
    $comment = $_POST['ioaf_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];
    $status = "Active";

    pre_r($_POST);

    $checkCOTqry = "SELECT * FROM cot_t_rating_a_tbl WHERE sy = $sy_id AND obs_period = '$obs_period' AND school_id= $school_id AND `user_id` = '$user_id'";
    $cotquery = mysqli_query($conn, $checkCOTqry) or die($conn->error);
    $resultcount = mysqli_num_rows($cotquery);

    if ($resultcount > 0) {
        header('location:../cotformT.php?notif=recordexist');
        exit();
    }


    for ($count = 0; $count < count($indicator_id); $count++) {
        $qry = mysqli_query($conn, 'INSERT INTO `cot_t_rating_a_tbl`(`rater_id1`, rater_id2, rater_id3, `date`, `user_id`, `obs_period`, `indicator_id`, `rating`, `sy`, `school_id`,`status`) VALUES (' . $rater_id . ',' . $rater_id2 . ', ' . $rater_id3 . '," ' . $date . '", ' . $user_id . ', ' . $obs_period . ', ' . $indicator_id[$count] . ', ' . $tcotrating[$count] . ', ' . $sy_id . ', ' . $school_id . ',"' . $status . '")') or die($conn->error);
    }
    $query2 = mysqli_query($conn, 'INSERT INTO cot_t_rating_b_tbl(`rater_id1`,`rater_id2`,`rater_id3`,`date`,`user_id`,`subject_id`,`gradelvltaught_id`,`obs_period`,`comment`,`sy`,`school_id`,`status`) VALUES(' . $rater_id . ',' . $rater_id2 . ', ' . $rater_id3 . ' ,"' . $date . '","' . $user_id . '","' . $subject . '","' . $gradelvltaught . '","' . $obs_period . '","' . $comment . '","' . $sy_id . '","' . $school_id . '", "' . $status . '")') or die($conn->error . 'qry2');

    header('location:../cotformT.php?notif=success');
    // rpmsdb::generateCOTindicatorAVG($conn, $sy);
    exit();
}
