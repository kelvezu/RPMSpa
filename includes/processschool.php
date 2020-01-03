<?php
session_start();

include 'conn.inc.php';
include '../libraries/func.lib.php';
$conn = mysqli_connect("localhost", "root", "", "rpms");

//ADD MOV


if(isset($_POST['save'])){    
    
    $school_grade_lvl = $_POST['sgl'];
    $school_curriclass =  $_POST['school_curri'];
    $school_no = $_POST['school_no'];
    $school_name = $_POST['school_name'];
    $tel_no = $_POST['tel_no'];
    $tel_no2 = $_POST['tel_no2'] ?? "NULL";
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'] ?? "NULL";

    $validate = mysqli_query($conn,"SELECT * FROM school_tbl WHERE school_no = '$school_no'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../school.php?notif=taken");
        exit();
    }elseif(ctype_space($school_no) || ctype_space($school_name) || ctype_space($tel_no) || ctype_space($tel_no2)){
        header("location:../school.php?notif=whitespace");
        exit();
    }elseif($tel_no == $tel_no2){
        header("location:../school.php?notif=duplicate");
        exit();
    }elseif((strlen($school_no)) < 7 || (strlen($school_name)) < 5) {
        header("location:../school.php?notif=charNumber");
        exit();
    }else{

    $query = "INSERT INTO school_tbl(school_grade_lvl,school_curriclass,school_no,school_name,tel_no,tel_no2,reg_id,div_id,muni_id) VALUES('$school_grade_lvl','$school_curriclass','$school_no','$school_name','$tel_no','$tel_no2','$reg_id','$div_id','$muni_id')" or die ($conn->error);
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        header('location:../school.php?notif=success');
    } else {
      
        header('location:../school.php?notif=error');
    }
        
    }
}

//DELETE MOV
if (isset($_GET['delete'])) {
    $school_id = $_GET['delete'];
    $conn->query("DELETE FROM school_tbl WHERE school_id=$school_id") or die($conn->error);
    $_SESSION['message'] = 'School has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../school.php");
}
//Update MOV

if (isset($_POST['update'])) {
    $school_id = $_POST['school_id'];
    $school_name = $_POST['school_name'];
    $school_grade_lvl = $_POST['sgl'];
    $school_curriclass =  $_POST['school_curri'];
    $school_no = $_POST['school_no'];
    $tel_no = $_POST['tel_no'];
    $tel_no2 = $_POST['tel_no2'];
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'];

    if(ctype_space($school_no) || ctype_space($school_name) || ctype_space($tel_no) || ctype_space($tel_no2)){
        header("location:../school.php?notif=updatewhitespace");
        exit();
    }elseif($tel_no == $tel_no2){
        header("location:../school.php?notif=updateduplicate");
        exit();
    }elseif((strlen($school_no)) < 8 || (strlen($school_name)) < 8) {
        header("location:../school.php?notif=updatecharNumber");
        exit();
    }else{

    $query = "UPDATE school_tbl SET school_id='$school_id', school_name='$school_name', school_grade_lvl='$school_grade_lvl', school_curriclass = '$school_curriclass' ,school_no='$school_no', tel_no='$tel_no', reg_id='$reg_id', div_id='$div_id', muni_id='$muni_id' WHERE school_id='$school_id'";
    $query_run = mysqli_query($conn, $query) or die($conn->error);
        header('location:../school.php?notif=updatesuccess');
    }
}
