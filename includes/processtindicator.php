<?php
session_start();
 
include 'conn.inc.php';


if(isset($_POST['save'])){
    $indicator_no  = $_POST['indicator_no'];
    $indicator_name = $_POST['indicator_name'];
    $obs1_period = $_POST['obs1'];
    $obs2_period = $_POST['obs2'];
    $obs3_period = $_POST['obs3'];
    $obs4_period = $_POST['obs4'];
    
    $conn->query("INSERT INTO tindicator_tbl(indicator_no,indicator_name,period1,period2,period3,period4) VALUES ('$indicator_no','$indicator_name','$obs1_period','$obs2_period','$obs3_period','$obs4_period')") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been saved!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaytindicator.php");
     
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM tindicator_tbl WHERE indicator_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaytindicator.php");
}

if(isset($_POST['update'])){

    $indicator_id = $_POST['indicator_id'];
    $newindicator_no = $_POST['newindicator_no'];
    $newindicator_name = $_POST['newindicator_name'];
    $newobs1_period = $_POST['new_obs1'];
    $newobs2_period = $_POST['new_obs2'];
    $newobs3_period = $_POST['new_obs3'];
    $newobs4_period = $_POST['new_obs4'];

    $qrySJ = mysqli_query($conn,"UPDATE tindicator_tbl SET indicator_id='$indicator_id', indicator_no='$newindicator_no', indicator_name='$newindicator_name', period1='$newobs1_period',period2='$newobs2_period', period3='$newobs3_period',period4='$newobs4_period' WHERE indicator_id='$indicator_id' ");
    if($qrySJ){
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaytindicator.php");
    }   
    
}

?>
  