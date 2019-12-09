<?php
// SET TO INACTIVE
include 'conn.inc.php';
if (isset($_GET['attach_mov_id']) or isset($_GET['type'])) :
    $attach_id = $_GET['attach_mov_id'];
    $type = $_GET['type'];

    if ($type == "supp") {
        $qry = "DELETE FROM mov_supp_mt_attach_tbl WHERE attach_mov_id = $attach_id";
        $result =  mysqli_query($conn, $qry) or die($conn->error . $qry);

        if ($result) {
            header('location:../viewattachment.usermt.php?notif=removesuccess&attach_id=' . $attach_id);
        } else {
            header('location:../viewattachment.usermt.php?notif=removefailed&attach_id=' . $attach_id);
        }
    } elseif ($type == "main") {
        $qry = "DELETE FROM mov_main_mt_attach_tbl WHERE attach_mov_id = $attach_id";
        $result =  mysqli_query($conn, $qry) or die($conn->error . $qry);

        if ($result) {
            header('location:../viewattachment.usermt.php?notif=removesuccess&attach_id=' . $attach_id);
        }
    }



// $qry = "UPDATE mov_b_mt_attach_tbl SET `status` = 'Inactive' WHERE `mov_id` = '$mov_id' AND `mov_type` = '$mov_type' AND obj_id = '$obj_id' AND `user_id` = $user AND school_id = $school AND sy_id = '$sy'";



endif;
