<?php

include 'conn.inc.php';
include '../libraries/func.lib.php';
    
    if(isset($_POST['sy_set'])):

        $sy_id = $_POST['sy_id'];
    
        $query2 = 'UPDATE sy_tbl SET `status` = "Inactive"';
        $query = "UPDATE sy_tbl SET `status` = 'Active' WHERE sy_id = '$sy_id'";
        if(mysqli_query($conn,$query2)or die($conn->error)) :
            mysqli_query($conn,$query) or die($conn->error);
            header("Location:../sy.php?successset");
        else: 
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

    // CHECK IF THE SCHOOL YEAR IS SET   
    // if (!empty($sy_desc)) :
    //     echo $_SESSION['sy'] = $sy_desc;
    //     echo $_SESSION['sy_id'] = $sy_id;
    // endif;


    if (mysqli_query($conn, $query)) {
        header("location:../dbAdmin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

