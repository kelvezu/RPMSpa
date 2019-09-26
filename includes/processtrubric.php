<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");


if(isset($_POST['save'])){
    $rubric_lvl  = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];


    $conn->query("INSERT INTO trubric_tbl(rubric_lvl,level_name,rubric_description) VALUES ('$rubric_lvl','$level_name','$rubric_description')") or die($conn->error);
    $_SESSION['message'] = 'Rubric has been saved!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaytRubric.php");
     
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM trubric_tbl WHERE rubric_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Rubric has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaytRubric.php");
}

if(isset($_POST['update'])){
    $rubric_id = $_POST['rubric_id'];
    $rubric_lvl = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];

    mysqli_query($conn,"UPDATE trubric_tbl SET rubric_lvl = '$rubric_lvl', level_name = '$level_name', rubric_description = '$rubric_description' WHERE rubric_id = '$rubric_id' ");

    $_SESSION['message'] = 'Rubric has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaytRubric.php");

}

?>
  