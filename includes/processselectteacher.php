<?php
//include 'conn.inc.php';



// if (!empty('remove')) :
//     $user_id = $_POST['remove_user'];


//     mysqli_query($conn, 'UPDATE account_tbl SET `status` = "For Transfer", school_id = NULL WHERE `user_id`="' . $user_id . '" ')  or die($conn->error);
//     header('location:../selectteacher.php?success');
//     exit();
// endif;


// if (isset($_POST['btn-t'])) :
//     $user_id = $_POST['user_id'];
//     $teacher = $_POST['teacher'];
//     $school_id = $_POST['school_id'];

//     for ($count = 0; $count < count($teacher); $count++) {
//         $query = "UPDATE account_tbl SET school_id = " . $school_id . " , `status` = 'For Transfer'  WHERE `user_id` = '$user_id[$count]'";
//         $query_run = mysqli_query($conn, $query);
//     }


//     if ($query_run) :
//         header('location:../selectteacher.php');
//         exit();
//     endif;
// endif;


//ADD RATER TO THE MASTER TEACHER
// if (isset($_POST['btn-mt'])) :
//     $user_id = $_POST['user_id'];
//     $teacher = $_POST['teacher'];

//     for ($count = 0; $count < count($teacher); $count++) {
//         $query = "UPDATE account_tbl SET rater = '$user_id' WHERE user_id = '$teacher[$count]'";
//         $query_run = updateAll($conn, $query);
//     }
//     if ($query_run) :
//         header('location:selectMTratee.php?nasend');
//     else :
//         header('location:../selectMTratee.php?error=');

//     endif;
// else :
//     echo 'error';

// endif;

include_once 'conn.inc.php';
include_once '../libraries/db.library.php';

//ADD RATER TO THE TEACHER 

if (isset($_POST['btn-t'])) :
    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $teacher = $_POST['teacher'];


    for ($count = 0; $count < count($teacher); $count++) {
        $query = "UPDATE account_tbl SET school_id = " . $school_id[$count] . ",`status` = 'Active' WHERE `user_id` = '$teacher[$count]'";
        $query_run = mysqli_query($conn, $query) or die($conn->error . $query);
    }
    if ($query_run) :
        header('location:../selectteacher.php');
        exit();
    else :
        header('location:../selectteacher.php');
        exit();
    endif;
endif;

if (isset($_POST['remove'])) :
    $remove_user = $_POST['remove_user'];

    $query = 'UPDATE account_tbl SET school_id = null , `status` = "For Transfer" WHERE `user_id` = "' . $remove_user . '"  ';
    $remove_query_run = mysqli_query($conn, $query) or die($conn->error . 'remove');

    if ($remove_query_run) :
        header('location:../selectteacher.php');
        exit();
    else :
        header('location:../selectteacher.php');
        exit();
    endif;


endif;
