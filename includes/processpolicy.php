<?php
session_start();
$policy_title = $policy_content = "";
$policy_id = 0;

$conn = new mysqli('localhost', 'root', '' ,'rpms') or die(mysqli_error($conn));

if(isset($_POST['save'])){
    $policy_title = $_POST['policytitle'];
    $policy_content = $_POST['policycontent'];

      $validate = $conn->query("SELECT * FROM policy_tbl");
        while($row = $validate->fetch_assoc()){
            $exist_policy_title = $row['policy_title'];
            $exist_policy_content = $row['policy_content'];
        
        if(($policy_title == $exist_policy_title) || ($policy_content == $exist_policy_content)){
            header("location:../displaypolicy.php?notif=taken");
            exit();
        }elseif((ctype_space($policy_title)) || (ctype_space($policy_content))){
            header("location:../displaypolicy.php?notif=whitespace");
            exit();
        }elseif((strlen($policy_title)) < 10 || (strlen($policy_content)) < 10){
            header("location:../displaypolicy.php?notif=charNumber");
            exit();
        }else{
    mysqli_query($conn,"INSERT INTO policy_tbl(policy_title,policy_content) VALUES ('$policy_title','$policy_content')") or die($conn->error);

    header('location:../displaypolicy.php?notif=success');
}
}
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

    if((ctype_space($policy_title)) || (ctype_space($policy_content))){
            header("location:../displaypolicy.php?notif=updatewhitespace");
            exit();
        }elseif((strlen($policy_title)) < 10 || (strlen($policy_content)) < 10){
            header("location:../displaypolicy.php?notif=updatecharNumber");
            exit();
        }else{

    mysqli_query($conn,"UPDATE policy_tbl SET policy_title = '$policy_title', policy_content = '$policy_content' WHERE policy_id = '$policy_id' ");
    header("location:../displaypolicy.php?notif=updatesuccess");

}
}

