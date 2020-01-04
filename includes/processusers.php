<?php
session_start();

$surname = $firstname = $middlename =  $email =  $contact =  $username = "";
$user_id = 0;

$conn = new mysqli('localhost', 'root', '' ,'rpms') or die(mysqli_error($conn));



if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM account_tbl WHERE user_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Account has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../testdisplayusers.php");
    
}

if(isset($_POST['update'])){
    $user_id = $_POST['user_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $position = $_POST['position'];

    mysqli_query($conn,"UPDATE account_tbl SET user_id = '$user_id', surname = '$surname', firstname = '$firstname', middlename = '$middlename',email = '$email',contact = '$contact',username = '$username',position = '$position' WHERE user_id = '$user_id' ");
    
    $_SESSION['message'] = 'Account has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../testdisplayusers.php");
}

?>
  