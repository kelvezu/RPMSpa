<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD Rating
if(isset($_POST['save'])){    
    
    $rater_id = $_POST['rater_id'];
    $rater_id2 = $_POST['observer2'] ?? null;
    $rater_id3 = $_POST['observer3'] ?? null;
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

    for($count = 0; $count < count($indicator_id); $count++){
       $query1 =  $conn->query('INSERT INTO a_tioafrating_tbl(rater_id1,rater_id2,rater_id3,`date`,`user_id`,obs_period,indicator_id,tioafrating,sy,school_id) VALUES("'.$rater_id.'","'.$rater_id2.'","'.$rater_id3.'","'.$date.'","'.$user_id.'","'.$obs_period.'","'.$indicator_id[$count].'","'.$tcotrating[$count].'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);
    }
    $query2 =  $conn->query('INSERT INTO b_tioafrating_tbl(rater_id1,rater_id2,rater_id3,`date`,user_id,subject_id,gradelvltaught_id,obs_period,comment,sy,school_id) VALUES("'.$rater_id.'","'.$rater_id2.'","'.$rater_id3.'","'.$date.'","'.$user_id.'","'.$subject.'","'.$gradelvltaught.'","'.$obs_period.'","'.$comment.'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);

    header('location:../tioafform.php');
}   
