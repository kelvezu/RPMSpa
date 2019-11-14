<?php
session_start();

include 'conn.inc.php';
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
    $user_id = $_POST['mtobserved'];
    $subject = $_POST['mtsubject'];
    $gradelvltaught = $_POST['mtgradelvltaught'];
    $obs_period = $_POST['mtobs'];
    $indicator_id = $_POST['mtindicator_id'];
    $tcotrating = $_POST['mtrating'];
    $comment = $_POST['mtioaf_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];
    $status = "Active";

    for ($count = 0; $count < count($indicator_id); $count++) {
        $qry = 'INSERT INTO `a_mtioafrating_tbl`(`rater_id1`, `rater_id2`, `rater_id3`, `date`, `user_id`, `obs_period`, `mtindicator_id`, `tioafrating`, `sy`, `school_id`,`status`) VALUES (' . $rater_id . ',' . $rater_id2 . ', ' . $rater_id3 . ', "' . $date . '", ' . $user_id . ', ' . $obs_period . ', ' . $indicator_id[$count] . ', ' . $tcotrating[$count] . ', ' . $sy_id . ', ' . $school_id . ',"' . $status . '")';

        mysqli_query($conn, $qry) or die($conn->error . ' qry1');
    }
    $query2 = mysqli_query($conn, 'INSERT INTO b_mtioafrating_tbl(`rater_id1`,`rater_id2`,`rater_id3`,`date`,`user_id`,`subject_id`,`gradelvltaught_id`,`obs_period`,`comment`,`sy`,`school_id`) VALUES("' . $rater_id . '",' . $rater_id2 . ' , ' . $rater_id3 . ' ,"' . $date . '","' . $user_id . '","' . $subject . '","' . $gradelvltaught . '","' . $obs_period . '","' . $comment . '","' . $sy_id . '","' . $school_id . '","' . $status . '" )') or die($conn->error . 'qry2');

    header('location:../mtioafform.php');
}
