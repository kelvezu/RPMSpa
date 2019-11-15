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

if (isset($_POST['update'])) :
    $id = $_POST['upd_id'];
    $upd_subj = $_POST['subject'];
    $upd_title = $_POST['title'];
    $upd_message = $_POST['message'];

    $qry = "UPDATE `announcement_tbl` SET subject = '$upd_subj', `title`= '$upd_title', `message` = '$upd_message' WHERE id = '$id' ";
    $sql_conn = mysqli_query($conn, $qry) or die($conn->error);

    if ($sql_conn) {
        header('location:../settings/announcement_settings.php?notif=success');
        exit();
    } else {
        header('location:../settings/announcement_settings.php?notif=error');
    }
endif;

if (isset($_POST['remove'])) :
    $del_id = $_POST['del_id'];
    $qry = "UPDATE `announcement_tbl` SET `status` = 'Inactive' WHERE id = '$del_id' ";
    $remove = mysqli_query($conn, $qry);
    if ($remove) {
        header('location:../settings/announcement_settings.php?notif=removed');
        exit();
    } else {
        header('location:../settings/announcement_settings.php?notif=error');
    }
endif;

if (isset($_POST['unremove'])) :
    $active_id = $_POST['active_id'];
    $qry = "UPDATE `announcement_tbl` SET `status` = 'Active' WHERE id = '$active_id' ";
    $remove = mysqli_query($conn, $qry);
    if ($remove) {
        header('location:../settings/announcement_settings.php?notif=unremoved');
        exit();
    } else {
        header('location:../settings/announcement_settings.php?notif=error');
    }
endif;
