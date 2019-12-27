<?php
session_start();
//UPDATE for CBC INDICATOR
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");
 
if(isset($_POST['updatetOBJ'])){
    $tobj_id = $_POST['tobj_id'];
    $kraid = $_POST['kraid'];
    $tobj_name = $_POST['newtobj_name'];

    if((ctype_space($tobj_name))){
        header("location:../displaytkramov.php?notif=updatewhitespace");
        exit();
    }elseif((strlen($tobj_name)) < 5){
        header("location:../displaytkramov.php?notif=updatecharNumber");
        exit();
    }else{

    mysqli_query($conn,"UPDATE tobj_tbl SET tobj_id = '$tobj_id', kra_id = '$kraid', tobj_name = '$tobj_name' WHERE tobj_id = '$tobj_id' ");   
    header("location:../displaytkramov.php?notif=updatesuccess");
}
}

//DELETE TOTAL YEAR
if(isset($_GET['delete'])){
    $tobj_id = $_GET['delete'];
    $conn->query("UPDATE tobj_tbl SET `status`= 'Inactive' WHERE tobj_id=$tobj_id") or die($conn->error);
    $_SESSION['message'] = 'Objective has been removed from the selection!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaytkramov.php");
    
} 

//ADD OBJECTIVE
if(isset($_POST['addobj'])){    
    $select_kra = $_POST['select_kra'];
    $addobjname = $_POST['addobjname'];

    $validate = mysqli_query($conn,"SELECT * FROM tobj_tbl WHERE tobj_name = '$addobjname'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../displaytkramov.php?notif=taken");
        exit();
    }elseif((ctype_space($addobjname))){
        header("location:../displaytkramov.php?notif=whitespace");
        exit();
    }elseif((strlen($addobjname)) < 5){
        header("location:../displaytkramov.php?notif=charNumber");
        exit();
    }else{
    $query = "INSERT INTO tobj_tbl(kra_id,tobj_name) VALUES('$select_kra','$addobjname')";
    $query_run = mysqli_query($conn,$query);
    header('location:../displaytkramov.php?notif=success');
    }
}

    //ADD KRA
if(isset($_POST['kraadd'])){    
    
    $kra_name = $_POST['addkra_name'];

    $validate = mysqli_query($conn,"SELECT * FROM kra_tbl WHERE kra_name = '$kra_name'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../displaytkramov.php?notif=taken");
        exit();
    }elseif((ctype_space($kra_name))){
        header("location:../displaytkramov.php?notif=whitespace");
        exit();
    }elseif((strlen($kra_name)) < 5){
        header("location:../displaytkramov.php?notif=charNumber");
        exit();
    }else{
    $query = "INSERT INTO kra_tbl(kra_name) VALUES('$kra_name')";
    $query_run = mysqli_query($conn,$query);
    header('location:../displaytkramov.php?notif=success');
}    
}
    //DELETE KRA
    if(isset($_GET['deletekra'])){
        $kra_id = $_GET['deletekra'];
        $conn->query("UPDATE kra_tbl SET `status` = 'Inactive' WHERE kra_id=$kra_id") or die($conn->error);
        $_SESSION['message'] = 'KRA has been removed!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displaytkramov.php");
        
    }

    if(isset($_POST['updatetKRA'])){
        $kra_id = $_POST['kra_id'];
        $kra_name = $_POST['newkra_name'];

    if((ctype_space($kra_name))){
        header("location:../displaytkramov.php?notif=updatewhitespace");
        exit();
    }elseif((strlen($kra_name)) < 5){
        header("location:../displaytkramov.php?notif=updatecharNumber");
        exit();
    }else{
        mysqli_query($conn,"UPDATE kra_tbl SET kra_id = '$kra_id', kra_name = '$kra_name' WHERE kra_id = '$kra_id' ");   
        header("location:../displaytkramov.php?updatesuccess");
    }
}