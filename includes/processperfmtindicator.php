<?php
session_start();

include 'conn.inc.php';


if (isset($_POST['save'])) {
    $kra_id  = $_POST['kra_name'];
    $mtobj_id  = $_POST['mtobj_name'];
    $qet  = $_POST['qet'];
    $level_no  = $_POST['level_no'];
    $indicator_name  = $_POST['indicator_name'];
    $desc_name = filter_var(trim($_POST['desc_name']), FILTER_SANITIZE_STRING);

    $conn->query("INSERT INTO perfmtindicator_tbl(kra_id,mtobj_id,qet,level_no,indicator_name,desc_name) VALUES ('$kra_id','$mtobj_id','$qet','$level_no','$indicator_name','$desc_name')") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been saved!';
    $_SESSION['msg_type'] = 'success';
    header("location:../displayperfmtindicator.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM perfmtindicator_tbl WHERE perfmtindicator_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Indicator has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../displayperfmtindicator.php");
}

if (isset($_POST['update'])) {

    $perfmtindicator_id = $_POST['perfmtindicator_id'];
    $kra_id  = $_POST['kra_name'];
    $mtobj_id  = $_POST['mtobj_name'];
    $qet  = $_POST['qet'];
    $level_no  = $_POST['level_no'];
    $indicator_name  = $_POST['indicator_name'];
    $desc_name = $_POST['desc_name'];

    $qrySJ = mysqli_query($conn, "UPDATE perfmtindicator_tbl SET perfmtindicator_id='$perfmtindicator_id',kra_id='$kra_id',mtobj_id='$mtobj_id', qet='$qet', level_no='$level_no', indicator_name='$indicator_name', desc_name='$desc_name' WHERE perfmtindicator_id='$perfmtindicator_id' ");
    if ($qrySJ) {
        $_SESSION['message'] = 'Indicator has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../displayperfmtindicator.php");
    }
}
