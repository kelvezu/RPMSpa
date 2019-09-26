<?php
session_start();
 
include 'conn.inc.php';


if(isset($_POST['save'])){
    $kra_id  = $_POST['kra_name'];
    $tobj_id  = $_POST['tobj_name'];
    $qet  = $_POST['qet'];
    $level_no  = $_POST['level_no'];
    $indicator_name  = $_POST['indicator_name'];
    $desc_name = $_POST['desc_name'];
    
    $conn->query("INSERT INTO perftindicator_tbl(kra_id,tobj_id,qet,level_no,indicator_name,desc_name) VALUES ('$kra_id','$tobj_id','$qet','$level_no','$indicator_name','$desc_name')") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been saved!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displayperftindicator.php");
     
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM perftindicator_tbl WHERE perftindicator_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displayperftindicator.php");
}

if(isset($_POST['update'])){

    
    $perftindicator_id = $_POST['perftindicator_id'];
    $kra_id  = $_POST['kra_name'];
    $tobj_id  = $_POST['tobj_name'];
    $qet  = $_POST['qet'];
    $level_no  = $_POST['level_no'];
    $indicator_name  = $_POST['indicator_name'];
    $desc_name = $_POST['desc_name'];

    $qrySJ = mysqli_query($conn,"UPDATE perftindicator_tbl SET perftindicator_id='$perftindicator_id',kra_id='$kra_id',tobj_id='$tobj_id', qet='$qet', level_no='$level_no', indicator_name='$indicator_name', desc_name='$desc_name' WHERE perftindicator_id='$perftindicator_id' ");
    if($qrySJ){
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displayperftindicator.php");
    }   
    
}

?>
  