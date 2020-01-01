<?php

include 'conn.inc.php';
include '../libraries/func.lib.php';

if (isset($_POST['sy_set'])) :

    $sy_id = $_POST['sy_id'];

    $query2 = 'UPDATE sy_tbl SET `status` = "Inactive"';
    $query = "UPDATE sy_tbl SET `status` = 'Active' WHERE sy_id = '$sy_id'";
    if (mysqli_query($conn, $query2)) :
        mysqli_query($conn, $query) or die($conn->error);
        session_start();
        session_unset();
        session_destroy();
        header("Location:../loginpage.php?notif=successset");
    else :
        header("Location:../sy.php?errorset");
    endif;

endif;

$syresult = $conn->query('SELECT * FROM sy_tbl WHERE status = "Active"')  or die($conn->error);
while ($syrow = $syresult->fetch_assoc()) :
    $end_date = $syrow['end_date'];
    $start_date = $syrow['startDate'];
    $sy_desc = $syrow['sy_desc'];
    $sy_id = $syrow['sy_id'];
endwhile;


// if (mysqli_query($conn, $query)) {
//    
//     header("Location:../loginpage.php?notif=loggedout");
// } else {
//     echo "Error: " . mysqli_error($conn);
// }
