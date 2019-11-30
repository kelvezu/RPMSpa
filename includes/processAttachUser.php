<?php
// SET TO INACTIVE
include 'conn.inc.php';
if (isset($_GET['attach_mov_id'])) :
    $attach_id = $_GET['attach_mov_id'];


    // $qry = "UPDATE mov_b_mt_attach_tbl SET `status` = 'Inactive' WHERE `mov_id` = '$mov_id' AND `mov_type` = '$mov_type' AND obj_id = '$obj_id' AND `user_id` = $user AND school_id = $school AND sy_id = '$sy'";
    $qry = "DELETE FROM mov_b_mt_attach_tbl WHERE attach_mov_id = $attach_id";

    $result =  mysqli_query($conn, $qry) or die($conn->error . $qry);

    if ($result) {
        header('location:../viewattachment.usermt.php?notif=removesuccess&attach_id=' . $attach_id);
    }
endif;
