<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD MOV
if(isset($_POST['save'])){    
    
    $kra_id = $_POST['kra_name'];
    $tobj_id = $_POST['tobj_name'];
    $main_mov= filter_var($_POST['main_mov'], FILTER_SANITIZE_STRING);
    $supp_mov= filter_var($_POST['supp_mov'], FILTER_SANITIZE_STRING);

    $query = "INSERT INTO tmov_tbl(kra_id,tobj_id,main_mov,supp_mov) VALUES('$kra_id','$tobj_id','$main_mov','$supp_mov')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "MOV Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaytmov.php');
    }
    else{
        $_SESSION['message'] = "MOV Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaytmov.php');
    }
}    
    //DELETE MOV
    if(isset($_GET['delete'])){
        $tmov_id = $_GET['delete'];
        $conn->query("DELETE FROM tmov_tbl WHERE tmov_id=$tmov_id") or die($conn->error);
        $_SESSION['message'] = 'MOV has been deleted!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displaytmov.php");
        
    } 
    //Update MOV

    if(isset($_POST['update'])){    
        $tmov_id = $_POST['tmov_id'];
        $kra_id = $_POST['kraid'];
        $tobj_id = $_POST['tobj_name'];
        $main_mov= filter_var($_POST['main_mov'], FILTER_SANITIZE_STRING);
        $supp_mov= filter_var($_POST['supp_mov'], FILTER_SANITIZE_STRING);
    
        $query = "UPDATE tmov_tbl SET tmov_id='$tmov_id', kra_id='$kra_id', tobj_id='$tobj_id', main_mov='$main_mov', supp_mov='$supp_mov' WHERE tmov_id='$tmov_id'";
        $query_run = mysqli_query($conn,$query);
    
        if($query_run){
            $_SESSION['message'] = "MOV Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../displaytmov.php');
        }
        else{
            $_SESSION['message'] = "MOV Update Failed";
            $_SESSION['msg_type'] = "danger";
            header('location:../displaytmov.php');
        }
    }  
