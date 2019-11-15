<?php
session_start();

include 'conn.inc.php';
include '../libraries/func.lib.php';
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
    $obs_period = $_POST['obs'];
    $indicator_id = $_POST['indicator_id'];
    $tcotrating = $_POST['rating'];
    $comment = $_POST['ioaf_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];
    $status = "Active";



    for ($count = 0; $count < count($indicator_id); $count++) {
        $qry = mysqli_query($conn, 'INSERT INTO `a_tioafrating_tbl`(`rater_id1`, rater_id2, rater_id3, `date`, `user_id`, `obs_period`, `indicator_id`, `tioafrating`, `sy`, `school_id`,`status`) VALUES (' . $rater_id . ',' . $rater_id2 . ', ' . $rater_id3 . '," ' . $date . '", ' . $user_id . ', ' . $obs_period . ', ' . $indicator_id[$count] . ', ' . $tcotrating[$count] . ', ' . $sy_id . ', ' . $school_id . ',"' . $status . '")') or die($conn->error);
    }
    $query2 = mysqli_query($conn, 'INSERT INTO b_tioafrating_tbl(`rater_id1`,`rater_id2`,`rater_id3`,`date`,`user_id`,`subject_id`,`gradelvltaught_id`,`obs_period`,`comment`,`sy`,`school_id`,`status`) VALUES("' . $rater_id . '",' . $rater_id2 . ' , ' . $rater_id3 . ' ,"' . $date . '","' . $user_id . '","' . $subject . '","' . $gradelvltaught . '","' . $obs_period . '","' . $comment . '","' . $sy_id . '","' . $school_id . '", "' . $status . '")') or die($conn->error . 'qry2');

    header('location:../tioafform.php');
}
