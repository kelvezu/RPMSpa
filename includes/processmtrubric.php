<?php
session_start();
$rubric_lvl = $level_name = $rubric_description = "";
$rubric_id = 0;

$conn = new mysqli('localhost', 'root', '' ,'rpms') or die(mysqli_error($conn));

if(isset($_POST['save'])){
    $rubric_lvl  = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];


    $conn->query("INSERT INTO mtrubric_tbl(rubric_lvl,level_name,rubric_description) VALUES ('$rubric_lvl','$level_name','$rubric_description')") or die($conn->error);
    $_SESSION['message'] = 'Rubric has been saved!';
    $_SESSION['msg_type'] = 'success';
    header('location:../displaymtRubric.php');
    
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM mtrubric_tbl WHERE rubric_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Rubric has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header('location:../displaymtRubric.php');
}

if(isset($_POST['update'])){
    $rubric_id = $_POST['rubric_id'];
    $rubric_lvl = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];

    mysqli_query($conn,"UPDATE mtrubric_tbl SET rubric_lvl = '$rubric_lvl', level_name = '$level_name', rubric_description = '$rubric_description' WHERE rubric_id = '$rubric_id' ");
    $_SESSION['message'] = 'Rubric has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaymtRubric.php");

}

?>
  