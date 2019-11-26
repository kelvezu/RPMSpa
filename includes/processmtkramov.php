<?php
session_start();
//UPDATE for CBC INDICATOR
include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

if(isset($_POST['updatetOBJ'])){
    $mtobj_id = $_POST['mtobj_id'];
    $kraid = $_POST['kraid'];
    $mtobj_name = $_POST['newtobj_name'];
    mysqli_query($conn,"UPDATE mtobj_tbl SET mtobj_id = '$mtobj_id', kra_id = '$kraid', mtobj_name = '$mtobj_name' WHERE mtobj_id = '$mtobj_id' ");   
    $_SESSION['message'] = 'Objective has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displaymtkramov.php");
}
else{
    echo "failed to save";
}

//DELETE TOTAL YEAR
if(isset($_GET['delete'])){
    $mtobj_id = $_GET['delete'];
    $conn->query("UPDATE mtobj_tbl SET `status`='Inactive' WHERE mtobj_id=$mtobj_id") or die($conn->error);
    $_SESSION['message'] = 'Objective has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displaymtkramov.php");
    
}

//ADD OBJECTIVE
if(isset($_POST['addobj'])){    
    $select_kra = $_POST['select_kra'];
    $addobjname = $_POST['addobjname'];

    $query = "INSERT INTO mtobj_tbl(kra_id,mtobj_name) VALUES('$select_kra','$addobjname')";
    $query_run = mysqli_query($conn,$query);

    if($query_run){
        $_SESSION['message'] = "Objective Successfully Added!";
        $_SESSION['msg_type'] = "success";
        header('location:../displaymtkramov.php');
    }
    else{
        $_SESSION['message'] = "Objective Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaymtkramov.php');
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
        header('location:../displaymtkramov.php');
    }
    else{
        $_SESSION['message'] = "KRA Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../displaymtkramov.php');
    }
}    
    //DELETE KRA
    if(isset($_GET['deletekra'])){
        $kra_id = $_GET['deletekra'];
        $conn->query("UPDATE kra_tbl SET `status` = 'Inactive' WHERE kra_id = $kra_id") or die($conn->error);
        $_SESSION['message'] = 'KRA has been deleted!';
        $_SESSION['msg_type'] = 'danger';
        header("location:../displaymtkramov.php");
        
    }

    if(isset($_POST['updatetKRA'])){
        $kra_id = $_POST['kra_id'];
        $kra_name = $_POST['newkra_name'];
        mysqli_query($conn,"UPDATE kra_tbl SET kra_id = '$kra_id', kra_name = '$kra_name' WHERE kra_id = '$kra_id' ");   
        $_SESSION['message'] = 'KRA has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displaymtkramov.php");
    }
    else{
        echo "failed to save";
    }