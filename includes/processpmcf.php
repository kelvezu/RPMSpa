<?php
session_start();
//UPDATE for PMCF
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

if(isset($_POST['update'])){
    $pmcf_id = $_POST['pmcf_id'];
    $tdate = $_POST['tdate'];
    $cid= $_POST['cid'];
    $toutput= $_POST['toutput'];
    $actionplan= $_POST['actionplan'];
    $rater= $_POST['rater'];
    $ratee= $_POST['ratee'];
    mysqli_query($conn,"UPDATE pmcf_tbl SET pmcf_id = '$pmcf_id', tdate = '$tdate', cid = '$cid', toutput = '$toutput', actionplan = '$actionplan', rater = '$rater', ratee = '$ratee' WHERE pmcf_id = '$pmcf_id' ");   
    $_SESSION['message'] = 'PMCF has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../pmcf.php");
}
else{
    echo "failed to save";
}

//DELETE PMCF
if(isset($_GET['delete'])){
    $pmcf_id = $_GET['delete'];
    $conn->query("DELETE FROM pmcf_tbl WHERE pmcf_id=$pmcf_id") or die($conn->error);
    $_SESSION['message'] = 'PMCF has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../pmcf.php");
    
}

//ADD PMCF
if(isset($_POST['addpmcf'])){
    $tdate = $_POST['tdate'];
    $cid = $_POST['cid'];
    $toutput = $_POST['toutput'];
    $actionplan = $_POST['actionplan'];
    $rater = $_POST['rater'];
    $ratee = $_POST['ratee'];

    $query = "INSERT INTO pmcf_tbl(tdate,cid,toutput,actionplan,rater,ratee) VALUES('$tdate','$cid','$toutput','$actionplan','$rater','$ratee')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "PMCF Successfully Inserted!";
        $_SESSION['msg_type'] = "success";
        header('location:../pmcf.php');
    }
    else{
        $_SESSION['message'] = "Indicator Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../pmcf.php');
    }
}