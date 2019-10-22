<?php
include_once 'conn.inc.php';
include_once '../libraries/db.library.php';

//ADD RATER TO THE TEACHER 

if (isset($_POST['btn-t'])) :
    $user_id = $_POST['user_id'];
    $teacher = $_POST['teacher'];

    for ($count = 0; $count < count($teacher); $count++) {
        $query = "UPDATE account_tbl SET rater = '$user_id' WHERE user_id = '$teacher[$count]'";
        $query_run = updateAll($conn, $query);
    }
    if ($query_run) :
        header('location:selectTratee.php');
        exit();
    else :
        header('location:../selectTratee.php');
        exit();
    endif;
endif;

if (isset($_POST['remove'])) :
    $remove_user = $_POST['remove_user'];

    $query = 'UPDATE account_tbl SET rater = null WHERE user_id = "' . $remove_user . '"  ';
    $remove_query_run = updateAll($conn, $query);

    if ($remove_query_run) :
        header('location:selectTratee.php?nasend');
        exit();
    else :
        header('location:../selectTratee.php');
        exit();
    endif;

else :
    echo 'Failed to remove teacher.';

endif;





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
