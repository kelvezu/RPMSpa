<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD Rating
if(isset($_POST['save'])){    
    
    $rater_id = $_POST['rater_id'];
    $date = date("Y/m/d");
    $user_id = $_POST['tobserved'];
    $subject = $_POST['tsubject'];
    $gradelvltaught = $_POST['tgradelvltaught'];
    $obs_period = $_POST['obs'];
    $indicator_id = $_POST['indicator_id'];
    $tcotrating = $_POST['rating'];
    $comment = $_POST['cot_comment'];
    $sy_id = $_POST['sy'];
    $school_id = $_POST['school_id'];

    for($count = 0; $count < count($indicator_id); $count++){
       $query1 =  $conn->query('INSERT INTO a_tcotrating_tbl(rater_id,`date`,user_id,obs_period,indicator_id,tcotrating,sy,school_id) VALUES("'.$rater_id.'","'.$date.'","'.$user_id.'","'.$obs_period.'","'.$indicator_id[$count].'","'.$tcotrating[$count].'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);
       
    }
    $query2 = $conn->query('INSERT INTO b_tcotrating_tbl(rater_id,`date`,user_id,subject_id,gradelvltaught_id,obs_period,comment,sy,school_id) VALUES ("'.$rater_id.'","'.$date.'","'.$user_id.'","'.$subject.'","'.$gradelvltaught.'","'.$obs_period.'","'.$comment.'","'.$sy_id.'","'.$school_id.'")') or die($conn->error);


    header('location:../tcotform.php');
}   
