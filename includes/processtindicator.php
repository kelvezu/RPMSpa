<?php
session_start();
 
include 'conn.inc.php';


if(isset($_POST['save'])){
    $indicator_no  = $_POST['indicator_no'];
    $indicator_name = $_POST['indicator_name'];
    
    $conn->query("INSERT INTO tindicator_tbl(indicator_no,indicator_name) VALUES ('$indicator_no','$indicator_name')") or die($conn->error);
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

    $qrySJ = mysqli_query($conn,"UPDATE tindicator_tbl SET indicator_id='$indicator_id', indicator_no='$newindicator_no', indicator_name='$newindicator_name' WHERE indicator_id='$indicator_id' ");
    if($qrySJ){
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaytindicator.php");
    }   
    
}

?>
  