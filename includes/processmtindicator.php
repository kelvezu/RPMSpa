<?php
session_start();
 
include 'conn.inc.php';


if(isset($_POST['save'])){
    $mtindicator_no  = $_POST['mtindicator_no'];
    $mtindicator_name = $_POST['mtindicator_name'];
    $obs1_period = $_POST['obs1'];
    $obs2_period = $_POST['obs2'];
    $obs3_period = $_POST['obs3'];
    $obs4_period = $_POST['obs4'];
    
    $conn->query("INSERT INTO mtindicator_tbl(mtindicator_no,mtindicator_name,period1,period2,period3,period4) VALUES ('$mtindicator_no','$mtindicator_name','$obs1_period','$obs2_period','$obs3_period','$obs4_period')") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been saved!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaymtindicator.php");
     
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM mtindicator_tbl WHERE mtindicator_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been deleted!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaymtindicator.php");
}

if(isset($_POST['update'])){

    $mtindicator_id = $_POST['mtindicator_id'];
    $newmtindicator_no = $_POST['newmtindicator_no'];
    $newmtindicator_name = $_POST['newmtindicator_name'];
    $newobs1_period = $_POST['new_obs1'];
    $newobs2_period = $_POST['new_obs2'];
    $newobs3_period = $_POST['new_obs3'];
    $newobs4_period = $_POST['new_obs4'];

    $qrySJ = mysqli_query($conn,"UPDATE mtindicator_tbl SET mtindicator_id='$mtindicator_id', mtindicator_no='$newmtindicator_no', mtindicator_name='$newmtindicator_name', period1='$newobs1_period',period2='$newobs2_period', period3='$newobs3_period',period4='$newobs4_period' WHERE mtindicator_id='$mtindicator_id' ");
    if($qrySJ){
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaymtindicator.php");
    }   
    
}

?>
  