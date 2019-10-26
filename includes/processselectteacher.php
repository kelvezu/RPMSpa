<?php
include 'conn.inc.php';

if (!empty('remove')) :
    $user_id = $_POST['remove_user'];
    mysqli_query($conn, 'UPDATE account_tbl SET `status` = "For Transfer" WHERE `user_id`="' . $user_id . '" ');


else :
    header('location:../selectteacher.php?error');
    exit();
endif;
