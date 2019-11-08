<?php
session_start();

require_once 'conn.inc.php';
$conn = mysqli_connect("localhost", "root", "", "rpms");

//ADD MOV
if (isset($_POST['save'])) {
    $school_grade_lvl = $_POST['sgl'];
    $school_no = $_POST['school_no'];
    $school_name = $_POST['school_name'];
    $tel_no = $_POST['tel_no'];
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'];

    $query = "INSERT INTO school_tbl(school_grade_lvl,school_no,school_name,tel_no,reg_id,div_id,muni_id) VALUES('$school_grade_lvl','$school_no','$school_name','$tel_no','$reg_id','$div_id','$muni_id')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "School Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../school.php');
    } else {
        $_SESSION['message'] = "Adding School Information Failed! ";
        $_SESSION['msg_type'] = "danger";
        header('location:../school.php');
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
    $school_no = $_POST['school_no'];
    $tel_no = $_POST['tel_no'];
    $reg_id = $_POST['region'];
    $div_id = $_POST['division'];
    $muni_id = $_POST['municipality'];

    $query = "UPDATE school_tbl SET school_id='$school_id', school_name='$school_name', school_grade_lvl='$school_grade_lvl', school_no='$school_no', tel_no='$tel_no', reg_id='$reg_id', div_id='$div_id', muni_id='$muni_id' WHERE school_id='$school_id'";
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
