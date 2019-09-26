<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD SEMINAR
if(isset($_POST['save'])){    
    
    $semstart_date = $_POST['start_date'];
    $semend_date = $_POST['end_date'];
    $seminar_name= $_POST['seminar_name'];

    $query = "INSERT INTO seminar_tbl(semstart_date,semend_date,seminar_name) VALUES('$semstart_date','$semend_date','$seminar_name')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "Seminar Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displayseminar.php');
    }
    else{
        $_SESSION['message'] = "Seminar Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displayseminar.php');
    }
}    
    //DELETE SEMINAR
    if(isset($_GET['delete'])){
        $seminar_id = $_GET['delete'];
        $conn->query("DELETE FROM seminar_tbl WHERE seminar_id=$seminar_id") or die($conn->error);
        $_SESSION['message'] = 'Seminar has been deleted!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displayseminar.php");
        
    } 
    //Update MOV

    if(isset($_POST['update'])){    
        $seminar_id = $_POST['seminar_id'];
        $semstart_date = $_POST['semstart_date'];
        $semend_date= $_POST['semend_date'];
        $seminar_name= $_POST['seminar_name'];
    
        $query = "UPDATE seminar_tbl SET seminar_id='$seminar_id', semstart_date='$semstart_date', semend_date='$semend_date', seminar_name='$seminar_name' WHERE seminar_id='$seminar_id'";
        $query_run = mysqli_query($conn,$query);
    
        if($query_run){
            $_SESSION['message'] = "Seminar Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../displayseminar.php');
        }
        else{
            $_SESSION['message'] = "Seminar Update Failed";
            $_SESSION['msg_type'] = "danger";
            header('location:../displayseminar.php');
        }
    }  
