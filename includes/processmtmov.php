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

    $validate = mysqli_query($conn,"SELECT * FROM mtmov_tbl WHERE kra_id = '$kra_id' AND mtobj_id = '$tobj_id' AND main_mov = '$main_mov' AND supp_mov = '$supp_mov'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../displaymtmov.php?notif=taken");
        exit();
    }elseif((ctype_space($main_mov)) || (ctype_space($supp_mov))){
        header("location:../displaymtmov.php?notif=whitespace");
        exit();
    }elseif((strlen($main_mov)) < 5 || (strlen($supp_mov)) < 5){
        header("location:../displaymtmov.php?notif=charNumber");
        exit();
    }else{

    $query = "INSERT INTO mtmov_tbl(kra_id,mtobj_id,main_mov,supp_mov) VALUES('$kra_id','$mtobj_id','$main_mov','$supp_mov')";
    $query_run = mysqli_query($conn,$query);

        header('location:../displaymtmov.php?notif=success');
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

         if((ctype_space($main_mov)) || (ctype_space($supp_mov))){
            header("location:../displaymtmov.php?notif=updatewhitespace");
            exit();
        }elseif((strlen($main_mov)) < 5 || (strlen($supp_mov)) < 5){
                header("location:../displaymtmov.php?notif=updatecharNumber");
                exit();
        }else{
     
        $query = "UPDATE mtmov_tbl SET mtmov_id='$mtmov_id', kra_id='$kra_id', mtobj_id='$mtobj_id', main_mov='$main_mov', supp_mov='$supp_mov' WHERE mtmov_id='$mtmov_id'";
        $query_run = mysqli_query($conn,$query);
            header('location:../displaymtmov.php?notif=updatesuccess');
        }
    }  
