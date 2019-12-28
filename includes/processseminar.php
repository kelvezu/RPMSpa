<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

    //ADD SEMINAR
if(isset($_POST['save'])){    
    
    $semstart_date = $_POST['start_date'];
    $semend_date = $_POST['end_date'];
    $seminar_name= $_POST['seminar_name'];

    $validate = mysqli_query($conn,"SELECT * FROM seminar_tbl WHERE semstart_date = '$semstart_date' AND semend_date = '$semend_date' AND seminar_name = '$seminar_name' ") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

     if($count_result > 0){
            header("location:../displayseminar.php?notif=taken");
            exit();
        }elseif((ctype_space($seminar_name))){
            header("location:../displayseminar.php?notif=whitespace");
            exit();
        }elseif((strlen($seminar_name)) < 10){
            header("location:../displayseminar.php?notif=charNumber");
            exit();
        }else{

    $query = "INSERT INTO seminar_tbl(semstart_date,semend_date,seminar_name) VALUES('$semstart_date','$semend_date','$seminar_name')";
    $query_run = mysqli_query($conn,$query);
        header('location:../displayseminar.php?notif=success');
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

        if((ctype_space($seminar_name))){
            header("location:../displayseminar.php?notif=updatewhitespace");
            exit();
        }elseif((strlen($seminar_name)) < 10){
            header("location:../displayseminar.php?notif=updatecharNumber");
            exit();
        }else{
    
        $query = "UPDATE seminar_tbl SET seminar_id='$seminar_id', semstart_date='$semstart_date', semend_date='$semend_date', seminar_name='$seminar_name' WHERE seminar_id='$seminar_id'";
        $query_run = mysqli_query($conn,$query);
    
            header('location:../displayseminar.php?notif=updatesuccess');
        }
    }  
