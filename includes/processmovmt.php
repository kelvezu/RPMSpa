<?php
include 'conn.inc.php';

if (isset($_GET['main_attach_id'])) :
    $attach_id = $_GET['main_attach_id'];
    $method = $_GET['method'];
    $user = $_GET['uid'];
    $date = 'null';
    $mov = $_GET['movfile'];

    switch ($method) {
        case 'approve':
            $method = 'Approved';
            $date = date("Y/m/d");
            $m = 'approve';
            break;

        case 'revision':
            $method = 'For Revision';
            $m = 'revision';
            break;

        case 'disapprove':
            $method = 'Disapproved';
            $m = 'disapproved';
            break;

        case 'cancel':
            $method = 'For Approval';
            $m = 'approval';
            break;

        default:
            die('error');
            break;
    }

    $qry = 'UPDATE `mov_main_mt_attach_tbl` SET doc_status = "' . $method . '",date_approved =  "' . $date . '" WHERE attach_mov_id = ' . $attach_id . '';
    $result = mysqli_query($conn, $qry);

    if ($result) :
        header('location:../viewattachment.ratermt.php?notif=' . $m . '&user=' . $user . '&mov_id=' . $mov);
    endif;
endif;
