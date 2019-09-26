<?php
session_start();
$policy_title = $policy_content = "";
$policy_id = 0;

$conn = new mysqli('localhost', 'root', '' ,'rpms') or die(mysqli_error($conn));

if(isset($_POST['save'])){
    $policy_title = $_POST['policytitle'];
    $policy_content = $_POST['policycontent'];

    $conn->query("INSERT INTO policy_tbl(policy_title,policy_content) VALUES ('$policy_title','$policy_content')") or die($conn->error);
    $_SESSION['message'] = 'Policy has been added!';
    $_SESSION['msg_type'] = 'success';
    header('location:../displaypolicy.php');
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM policy_tbl WHERE policy_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Policy has been deleted!';
    $_SESSION['msg_type'] = 'success';
    header('location:../displaypolicy.php');
}

if(isset($_POST['update'])){
    $policy_id = $_POST['policy_id'];
    $policy_title = $_POST['policy_title'];
    $policy_content = $_POST['policy_content'];

    mysqli_query($conn,"UPDATE policy_tbl SET policy_title = '$policy_title', policy_content = '$policy_content' WHERE policy_id = '$policy_id' ");
    $_SESSION['message'] = 'Policy has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaypolicy.php");

}


