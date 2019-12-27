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

    $validate = mysqli_query($conn,"SELECT * FROM tindicator_tbl WHERE indicator_no = '$indicator_no' OR indicator_name = '$indicator_name' ") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

     if($count_result > 0){
            header("location:../displaytindicator.php?notif=taken");
            exit();
        }elseif((ctype_space($indicator_no)) || (ctype_space($indicator_name))){
            header("location:../displaytindicator.php?notif=whitespace");
            exit();
        }elseif((strlen($indicator_no)) < 0 || (strlen($indicator_name)) < 5){
            header("location:../displaytindicator.php?notif=charNumber");
            exit();
        }else{
    
    mysqli_query($conn,"INSERT INTO tindicator_tbl(indicator_no,indicator_name,period1,period2,period3,period4) VALUES ('$indicator_no','$indicator_name','$obs1_period','$obs2_period','$obs3_period','$obs4_period')") or die($conn->error);
    header("location:../displaytindicator.php?notif=success");
     
}
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

    if((ctype_space($newindicator_no)) || (ctype_space($newindicator_name))){
            header("location:../displaytindicator.php?notif=updatewhitespace");
            exit();
    }elseif((strlen($newindicator_no)) < 0 || (strlen($newindicator_name)) < 5){
            header("location:../displaytindicator.php?notif=updatecharNumber");
            exit();
    }else{

    $qrySJ = mysqli_query($conn,"UPDATE tindicator_tbl SET indicator_id='$indicator_id', indicator_no='$newindicator_no', indicator_name='$newindicator_name', period1='$newobs1_period',period2='$newobs2_period', period3='$newobs3_period',period4='$newobs4_period' WHERE indicator_id='$indicator_id' ");
        header("location:../displaytindicator.php?notif=updatesuccess");
    }   
    
}

?>
  