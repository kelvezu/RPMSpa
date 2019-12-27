<?php
session_start();
//UPDATE for CBC INDICATOR
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

if(isset($_POST['updateIND'])){
    $cbc_ind_id = $_POST['cbc_ind_id'];
    $cbc_id = $_POST['cbc_id'];
    $indicator = $_POST['indicator'];

    if(ctype_space($indicator)){
            header("location:../displaycbc.php?notif=updatewhitespace");
            exit();

        }elseif(strlen($indicator) < 2){
            header("location:../displaycbc.php?notif=updatecharNumber");
            exit();
        }else{

    mysqli_query($conn,"UPDATE cbc_indicators_tbl SET cbc_ind_id = '$cbc_ind_id', cbc_id = '$cbc_id', indicator = '$indicator' WHERE cbc_ind_id = '$cbc_ind_id' ");   
    header("location:../displaycbc.php?notif=updatesuccess");
}
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

if (isset($_POST['addcbc'])) {
  
    $add_cbc = $_POST['add_cbc'];
    $addindicator = $_POST['addindicator'];

        $validate = mysqli_query($conn,"SELECT * FROM cbc_indicators_tbl WHERE indicator = '$addindicator'") or die($conn->error);
        $count_result = mysqli_num_rows($validate);
        
        if($count_result > 0){
            header("location:../displaycbc.php?notif=taken");
            exit();
        }elseif(ctype_space($addindicator)){
            header("location:../displaycbc.php?notif=whitespace");
            exit();

        }elseif(strlen($addindicator) < 2){
            header("location:../displaycbc.php?notif=charNumber");
            exit();
        }else{

            
        $query = "INSERT INTO cbc_indicators_tbl(cbc_id,indicator) VALUES('$add_cbc','$addindicator')";
        $query_run = mysqli_query($conn,$query);
            header('location:../displaycbc.php?notif=success');
        }                 

}