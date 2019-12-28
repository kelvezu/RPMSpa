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

    $validate = mysqli_query($conn,"SELECT * FROM tmov_tbl WHERE kra_id = '$kra_id' AND tobj_id = '$tobj_id' AND main_mov = '$main_mov' AND supp_mov = '$supp_mov'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../displaytmov.php?notif=taken");
        exit();
    }elseif((ctype_space($main_mov)) || (ctype_space($supp_mov))){
        header("location:../displaytmov.php?notif=whitespace");
        exit();
    }elseif((strlen($main_mov)) < 5 || (strlen($supp_mov)) < 5){
        header("location:../displaytmov.php?notif=charNumber");
        exit();
    }else{
    $query = "INSERT INTO tmov_tbl(kra_id,tobj_id,main_mov,supp_mov) VALUES('$kra_id','$tobj_id','$main_mov','$supp_mov')";
    $query_run = mysqli_query($conn,$query);
    header('location:../displaytmov.php?notif=success');
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

        if((ctype_space($main_mov)) || (ctype_space($supp_mov))){
            header("location:../displaytmov.php?notif=updatewhitespace");
            exit();
        }elseif((strlen($main_mov)) < 5 || (strlen($supp_mov)) < 5){
                header("location:../displaytmov.php?notif=updatecharNumber");
                exit();
        }else{
        $query = "UPDATE tmov_tbl SET tmov_id='$tmov_id', kra_id='$kra_id', tobj_id='$tobj_id', main_mov='$main_mov', supp_mov='$supp_mov' WHERE tmov_id='$tmov_id'";
        $query_run = mysqli_query($conn,$query);
            header('location:../displaytmov.php?notif=success');
        }
    }  
