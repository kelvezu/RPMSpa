<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD MOV
if(isset($_POST['save'])){    
    
    $kra_id = $_POST['kra_name'];
    $mtobj_id = $_POST['mtobj_name'];
    $main_mov= filter_var($_POST['main_mov'], FILTER_SANITIZE_STRING);
    $supp_mov= filter_var($_POST['supp_mov'], FILTER_SANITIZE_STRING);

    $query = "INSERT INTO mtmov_tbl(kra_id,mtobj_id,main_mov,supp_mov) VALUES('$kra_id','$mtobj_id','$main_mov','$supp_mov')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "MOV Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaymtmov.php');
    }
    else{
        $_SESSION['message'] = "MOV Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaymtmov.php');
    }
}    
    //DELETE MOV
    if(isset($_GET['delete'])){
        $mtmov_id = $_GET['delete'];
        $conn->query("DELETE FROM mtmov_tbl WHERE mtmov_id=$mtmov_id") or die($conn->error);
        $_SESSION['message'] = 'MOV has been deleted!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displaymtmov.php");
        
    } 
    //Update MOV

    if(isset($_POST['update'])){    
        $mtmov_id = $_POST['mtmov_id'];
        $kra_id = $_POST['kra_name'];
        $mtobj_id = $_POST['mtobj_name'];
        $main_mov= filter_var($_POST['main_mov'], FILTER_SANITIZE_STRING);
        $supp_mov= filter_var($_POST['supp_mov'], FILTER_SANITIZE_STRING);
     
        $query = "UPDATE mtmov_tbl SET mtmov_id='$mtmov_id', kra_id='$kra_id', mtobj_id='$mtobj_id', main_mov='$main_mov', supp_mov='$supp_mov' WHERE mtmov_id='$mtmov_id'";
        $query_run = mysqli_query($conn,$query);
    
        if($query_run){
            $_SESSION['message'] = "MOV Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../displaymtmov.php');
        }
        else{
            $_SESSION['message'] = "MOV Update Failed";
            $_SESSION['msg_type'] = "danger";
            header('location:../displaymtmov.php');
        }
    }  
