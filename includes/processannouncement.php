<?php
include 'conn.inc.php';
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
