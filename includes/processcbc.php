<?php
session_start();
//UPDATE for CBC INDICATOR
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

if(isset($_POST['updateIND'])){
    $cbc_ind_id = $_POST['cbc_ind_id'];
    $cbc_id = $_POST['cbc_id'];
    $indicator = $_POST['indicator'];
    mysqli_query($conn,"UPDATE cbc_indicators_tbl SET cbc_ind_id = '$cbc_ind_id', cbc_id = '$cbc_id', indicator = '$indicator' WHERE cbc_ind_id = '$cbc_ind_id' ");   
    $_SESSION['message'] = 'Indicator has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaycbc.php");
}
else{
    echo "failed to save";
}

//DELETE TOTAL YEAR
if(isset($_GET['delete'])){
    $cbc_ind_id = $_GET['delete'];
    $conn->query("DELETE FROM cbc_indicators_tbl WHERE cbc_ind_id=$cbc_ind_id") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaycbc.php");
    
}

//ADD CBC INDICATOR 
if(isset($_POST['addcbc'])){
    $add_cbc = $_POST['add_cbc'];
    $addindicator = $_POST['addindicator'];

    $query = "INSERT INTO cbc_indicators_tbl(cbc_id,indicator) VALUES('$add_cbc','$addindicator')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "Indicator Successfully Inserted!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaycbc.php');
    }
    else{
        $_SESSION['message'] = "Indicator Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaycbc.php');
    }
}