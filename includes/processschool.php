<?php
session_start();

include 'conn.inc.php';
include '../libraries/func.lib.php';
$conn = mysqli_connect("localhost", "root", "", "rpms");

//ADD MOV
if (isset($_POST['save'])) {
    $school_grade_lvl = $_POST['sgl'];
    $school_curriclass =  $_POST['school_curri'];
    $school_no = $_POST['school_no'];
    $school_name = $_POST['school_name'];
    $tel_no = $_POST['tel_no'];
    $tel_no2 = $_POST['tel_no2'] ?? "NULL";
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'] ?? "NULL";

   
    $validate = $conn->query("SELECT * FROM school_tbl");
        while($row = $validate->fetch_assoc()){
            $exist_school_no = $row['school_no'];
            $exist_school_name = $row['school_name'];
            $exist_tel_no = $row['tel_no'];
            $exist_tel_no2 = $row['tel_no2'];
        
        
    if(($school_no == $exist_school_no) || ($school_name == $exist_school_name) || ($tel_no == $exist_tel_no) || ($tel_no2 == $exist_tel_no2) ){
        header("location:../school.php?notif=taken");
        exit();
    }elseif(ctype_space($school_no) || ctype_space($school_name) || ctype_space($tel_no) || ctype_space($tel_no2)){
        header("location:../school.php?notif=whitespace");
        exit();
    }elseif($tel_no == $tel_no2){
        header("location:../school.php?notif=duplicate");
        exit();
    }elseif((strlen($school_no)) < 8 || (strlen($school_name)) < 8) {
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
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'];

    $query = "UPDATE school_tbl SET school_id='$school_id', school_name='$school_name', school_grade_lvl='$school_grade_lvl', school_curriclass = '$school_curriclass' ,school_no='$school_no', tel_no='$tel_no', reg_id='$reg_id', div_id='$div_id', muni_id='$muni_id' WHERE school_id='$school_id'";
    $query_run = mysqli_query($conn, $query) or die($conn->error);

    if ($query_run) {
        $_SESSION['message'] = "School Successfully Updated!";
        $_SESSION['msg_type'] = "success";
        header('location:../school.php');
    } else {
        $_SESSION['message'] = "School Update Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../school.php');
    }
}
