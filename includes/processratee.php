<?php
include_once 'conn.inc.php';
include_once '../libraries/db.library.php';

//ESAT FORM 1

if (isset($_POST['btn'])) :
    $user_id = $_POST['user_id'];
    $teacher = $_POST['teacher'];

    for ($count = 0; $count < count($teacher); $count++) {
        // $query = "UPDATE account_tbl SET rater = '$user_id' WHERE user_id = '$teacher[$count]'";
        $query = "UPDATE account_tbl SET rater = null";
        $query_run = updateAll($conn, $query);
    }

    if ($query_run) :
        header('location:selectratee.php?nasend');
    else :

        header('location:../selectratee.php?error=');

    endif;

else :
    echo 'error';

endif;
