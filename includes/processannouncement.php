<?php
include 'conn.inc.php';
include '../libraries/func.lib.php';

if (isset($_POST['user_id'])) :
    $user_id = $_POST['user_id'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $position = $_POST['position'];
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $status = "Active";

    $qry = 'INSERT INTO `announcement_tbl`( `subject`, `title`, `message`, `status`, `user_id`, `position`, `sy_id`, `school_id`) VALUES ("' . $subject . '","' . $title . '","' . $message . '","' . $status . '","' . $user_id . '","' . $position . '","' . $sy . '","' . $school . '")';

    $result = mysqli_query($conn, $qry) or die($conn->error);

    if (!$result) :
        return false;
    endif;
endif;

if (isset($_POST['upd_id'])) :
    $id = $_POST['upd_id'];
    $upd_subj = $_POST['subject'];
    $upd_title = $_POST['title'];
    $upd_message = $_POST['message'];

    $qry = "UPDATE `announcement_tbl` SET subject = '$upd_subj', `title`= '$upd_title', `message` = '$upd_message' WHERE id = '$id' ";
    $sql_conn = mysqli_query($conn, $qry) or die($conn->error);
   
endif;
