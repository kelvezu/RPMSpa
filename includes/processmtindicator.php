<?php
session_start();
 
include 'conn.inc.php';


if(isset($_POST['save'])){
    $mtindicator_no  = $_POST['mtindicator_no'];
    $mtindicator_name = $_POST['mtindicator_name'];
    
    $conn->query("INSERT INTO mtindicator_tbl(mtindicator_no,mtindicator_name) VALUES ('$mtindicator_no','$mtindicator_name')") or die($conn->error);
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

    $qrySJ = mysqli_query($conn,"UPDATE mtindicator_tbl SET mtindicator_id='$mtindicator_id', mtindicator_no='$newmtindicator_no', mtindicator_name='$newmtindicator_name' WHERE mtindicator_id='$mtindicator_id' ");
    if($qrySJ){
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaymtindicator.php");
    }   
    
}

?>
  