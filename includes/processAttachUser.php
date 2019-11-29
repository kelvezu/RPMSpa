<?php
// SET TO INACTIVE
include 'conn.inc.php';
if (isset($_POST['remove_mt_attach'])) :
    $user = $_POST['user_id'];
    $sy = $_POST['sy_id'];
    $school = $_POST['school_id'];
    $mov_id = $_POST['mov_id'];
    $obj_id = $_POST['obj_id'];
    $mov_type = $_POST['mov_type'];

    $qry = "UPDATE mov_b_mt_attach_tbl SET `status` = 'Inactive' WHERE `mov_id` = '$mov_id' AND `mov_type` = '$mov_type' AND obj_id = '$obj_id' AND `user_id` = $user AND school_id = $school AND sy_id = $sy   ";

    $result =  mysqli_query($conn, $qry) or die($conn->error . $qry);

    if ($result) {
        header('location:../viewattachment.usermt.php');
    }
endif;
