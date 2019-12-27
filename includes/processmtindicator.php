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

    $validate = mysqli_query($conn,"SELECT * FROM mtindicator_tbl WHERE mtindicator_no = '$mtindicator_no' OR mtindicator_name = '$mtindicator_name' ") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

     if($count_result > 0){
            header("location:../displaymtindicator.php?notif=taken");
            exit();
        }elseif((ctype_space($mtindicator_no)) || (ctype_space($mtindicator_name))){
            header("location:../displaymtindicator.php?notif=whitespace");
            exit();
        }elseif((strlen($mtindicator_no)) < 0 || (strlen($mtindicator_name)) < 5){
            header("location:../displaymtindicator.php?notif=charNumber");
            exit();
        }else{
    
    mysqli_query($conn,"INSERT INTO mtindicator_tbl(mtindicator_no,mtindicator_name,period1,period2,period3,period4) VALUES ('$mtindicator_no','$mtindicator_name','$obs1_period','$obs2_period','$obs3_period','$obs4_period')") or die($conn->error);
    header("location:../displaymtindicator.php?notif=success");
     
}
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

    if((ctype_space($newmtindicator_no)) || (ctype_space($newmtindicator_name))){
            header("location:../displaymtindicator.php?notif=updatewhitespace");
            exit();
        }elseif((strlen($newmtindicator_no)) < 0 || (strlen($newmtindicator_name)) < 5){
            header("location:../displaymtindicator.php?notif=updatecharNumber");
            exit();
        }else{

    $qrySJ = mysqli_query($conn,"UPDATE mtindicator_tbl SET mtindicator_id='$mtindicator_id', mtindicator_no='$newmtindicator_no', mtindicator_name='$newmtindicator_name', period1='$newobs1_period',period2='$newobs2_period', period3='$newobs3_period',period4='$newobs4_period' WHERE mtindicator_id='$mtindicator_id' ");
        header("location:../displaymtindicator.php?notif=updatesuccess");
    }   
    
}

?>
  