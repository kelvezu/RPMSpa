<?php
session_start();
//UPDATE for CBC INDICATOR
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");
 
if(isset($_POST['updatetOBJ'])){
    $tobj_id = $_POST['tobj_id'];
    $kraid = $_POST['kraid'];
    $tobj_name = $_POST['newtobj_name'];
    mysqli_query($conn,"UPDATE tobj_tbl SET tobj_id = '$tobj_id', kra_id = '$kraid', tobj_name = '$tobj_name' WHERE tobj_id = '$tobj_id' ");   
    $_SESSION['message'] = 'Objective has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaytkramov.php");
}
else{
    echo "failed to save";
}

//DELETE TOTAL YEAR
if(isset($_GET['delete'])){
    $tobj_id = $_GET['delete'];
    $conn->query("DELETE FROM tobj_tbl WHERE tobj_id=$tobj_id") or die($conn->error);
    $_SESSION['message'] = 'Objective has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaytkramov.php");
    
}

//ADD OBJECTIVE
if(isset($_POST['addobj'])){    
    $select_kra = $_POST['select_kra'];
    $addobjname = $_POST['addobjname'];

    $query = "INSERT INTO tobj_tbl(kra_id,tobj_name) VALUES('$select_kra','$addobjname')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "Objective Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaytkramov.php');
    }
    else{
        $_SESSION['message'] = "Objective Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaytkramov.php');
    }
}

    //ADD KRA
if(isset($_POST['kraadd'])){    
    
    $kra_name = $_POST['addkra_name'];

    $query = "INSERT INTO kra_tbl(kra_name) VALUES('$kra_name')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "KRA Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaytkramov.php');
    }
    else{
        $_SESSION['message'] = "KRA Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaytkramov.php');
    }
}    
    //DELETE KRA
    if(isset($_GET['deletekra'])){
        $kra_id = $_GET['deletekra'];
        $conn->query("DELETE FROM kra_tbl WHERE kra_id=$kra_id") or die($conn->error);
        $_SESSION['message'] = 'KRA has been deleted!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displaytkramov.php");
        
    }

    if(isset($_POST['updatetKRA'])){
        $kra_id = $_POST['kra_id'];
        $kra_name = $_POST['newkra_name'];
        mysqli_query($conn,"UPDATE kra_tbl SET kra_id = '$kra_id', kra_name = '$kra_name' WHERE kra_id = '$kra_id' ");   
        $_SESSION['message'] = 'KRA has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaytkramov.php");
    }
    else{
        echo "failed to save";
    }