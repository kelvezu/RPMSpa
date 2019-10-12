<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD Rating
if(isset($_POST['save'])){    
    
    $rater_id = $_POST['rater_id'];
    $rater_id2 = $_POST['observer2'];
    $rater_id3 = $_POST['observer3'];
    $date = date("Y/m/d");
    $user_id = $_POST['tobserved'];
    $subject = $_POST['tsubject'];
    $gradelvltaught = $_POST['tgradelvltaught'];
    $obs_period = $_POST['obsperiod'];
    $indicator_id = $_POST['indicator_id'];
    $tcotrating = $_POST['rating'];
    $comment = $_POST['ioaf_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];

    for($count = 0; $count < count($indicator_id); $count++){
       $query =  $conn->query('INSERT INTO tioafrating_tbl(rater_id1,rater_id2,rater_id3,`date`,user_id,`subject`,gradelvltaught,obs_period,indicator_id,tioafrating,comment,sy,school_id) VALUES("'.$rater_id.'","'.$rater_id2.'","'.$rater_id3.'","'.$date.'","'.$user_id.'","'.$subject.'","'.$gradelvltaught.'","'.$obs_period.'","'.$indicator_id[$count].'","'.$tcotrating[$count].'","'.$comment.'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);
    }
    header('location:../tioafform.php');
}   
