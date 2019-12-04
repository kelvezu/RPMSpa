<?php
include 'conn.inc.php';
$attach_id = '';
$table = '';

if (isset($_GET['mov_type'])) :
    $movtype = $_GET['mov_type'];

    if ($movtype == "main") :
        $attach_id = $_GET['attach_id'];
        $table = 'mov_main_mt_attach_tbl';

    elseif ($movtype == "supp") :
        $attach_id = $_GET['attach_id'];
        $table = 'mov_supp_mt_attach_tbl';
    else : die('error');
    endif;

    // $attach_id;
    // $table;
    $method = $_GET['method'];
    $user = $_GET['uid'];
    $date = 'NULL';
    $mov = $_GET['movfile'];

    switch ($method) {
        case 'approve':
            $method = 'Approved';
            $date =  date("Y-m-d h:i:sa");
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
    $qry = 'UPDATE ' . $table . ' SET doc_status = "' . $method . '",date_approved =  "' . $date . '" WHERE attach_mov_id = ' . $attach_id . '';
    $result = mysqli_query($conn, $qry);

    if ($result) :
        header('location:../viewattachment.ratermt.php?movtype=' . $movtype . '&notif=' . $m . '&user=' . $user . '&mov_id=' . $mov);
    endif;
endif;
