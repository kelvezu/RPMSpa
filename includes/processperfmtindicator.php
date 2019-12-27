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

    $validate = mysqli_query($conn,"SELECT * FROM perfmtindicator_tbl WHERE level_no = '$level_no' AND indicator_name = '$indicator_name' AND desc_name = '$desc_name'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if($count_result > 0){
        header("location:../displayperfmtindicator.php?notif=taken");
        exit();
    }elseif((ctype_space($indicator_name)) || (ctype_space($desc_name))){
        header("location:../displayperfmtindicator.php?notif=whitespace");
        exit();
    }elseif((strlen($indicator_name)) < 5 || (strlen($desc_name)) < 5){
        header("location:../displayperfmtindicator.php?notif=charNumber");
        exit();
    }else{

    mysqli_query($conn,"INSERT INTO perfmtindicator_tbl(kra_id,mtobj_id,qet,level_no,indicator_name,desc_name) VALUES ('$kra_id','$mtobj_id','$qet','$level_no','$indicator_name','$desc_name')") or die($conn->error);
    header("location:../displayperfmtindicator.php?notif=success
    ");
}
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

    if((ctype_space($indicator_name)) || (ctype_space($desc_name))){
            header("location:../displayperfmtindicator.php?notif=updatewhitespace");
            exit();
    }elseif((strlen($indicator_name)) < 5 || (strlen($desc_name)) < 5){
            header("location:../displayperfmtindicator.php?notif=updatecharNumber");
            exit();
    }else{

    $qrySJ = mysqli_query($conn, "UPDATE perfmtindicator_tbl SET perfmtindicator_id='$perfmtindicator_id',kra_id='$kra_id',mtobj_id='$mtobj_id', qet='$qet', level_no='$level_no', indicator_name='$indicator_name', desc_name='$desc_name' WHERE perfmtindicator_id='$perfmtindicator_id' ");
        header("location:../displayperfmtindicator.php?notif=updatesuccess");
    }
}
