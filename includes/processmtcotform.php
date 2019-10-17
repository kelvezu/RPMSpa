<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD Rating
if(isset($_POST['save'])){    
    
    $rater_id = $_POST['rater_id'];
    $date = date("Y/m/d");
    $user_id = $_POST['mtobserved'];
    $subject = $_POST['mtsubject'];
    $gradelvltaught = $_POST['mtgradelvltaught'];
    $obs_period = $_POST['mtobs'];
    $indicator_id = $_POST['mtindicator_id'];
    $mtcotrating = $_POST['mtrating'];
    $comment = $_POST['mtcot_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];

    for($count = 0; $count < count($indicator_id); $count++){
       $query =  $conn->query('INSERT INTO mtcotrating_tbl(rater_id,`date`,user_id,`subject`,gradelvltaught,obs_period,indicator_id,mtcotrating,comment,sy,school_id) VALUES("'.$rater_id.'","'.$date.'","'.$user_id.'","'.$subject.'","'.$gradelvltaught.'","'.$obs_period.'","'.$indicator_id[$count].'","'.$mtcotrating[$count].'","'.$comment.'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);
    }
    header('location:../mtcotform.php');
}   
