<?php
include 'conn.inc.php';

if (!empty('remove')) :
    $user_id = $_POST['remove_user'];


    mysqli_query($conn, 'UPDATE account_tbl SET `status` = "For Transfer", school_id = NULL WHERE `user_id`="' . $user_id . '" ')  or die($conn->error);
    header('location:../selectteacher.php?success');
    exit();
endif;


if (isset($_POST['btn-t'])) :
    $user_id = $_POST['user_id'];
    $teacher = $_POST['teacher'];
    $school_id = $_POST['school_id'];

    for ($count = 0; $count < count($teacher); $count++) {
        $query = "UPDATE account_tbl SET school_id = null, `status` = 'For Transfer'  WHERE `user_id` = '$teacher[$count]'";
        $query_run = mysqli_query($conn, $query);
    }
    if ($query_run) :
        header('location:../selectteacher.php');
        exit();
    endif;
endif;
