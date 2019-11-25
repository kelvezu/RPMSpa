<?php

if (isset($_POST["add"])) {
    include_once "conn.inc.php";
    include_once '../libraries/func.lib.php';


    $startMonth = $_POST["start-month"];
    $startDay = implode(",", $_POST["start-day"]);
    $endMonth = $_POST["end-month"];
    $endDay =  implode(",", $_POST["end-day"]);

    $sdate = getStartYear() . "/" . $startMonth . "/" . $startDay;
    $edate = getEndYear() . "/" . $endMonth . "/" . $endDay;
    $sy_desc = getStartYear() . "-" . getEndYear();


    
    $query = "INSERT INTO sy_tbl(startDate,end_date,sy_desc,`status`) VALUES ('$sdate','$edate','$sy_desc','Inactive')";
    if(mysqli_query($conn, $query)):
        header("Location:../sy.php?successadd");
    else: die ($conn->error);
        header("Location:../sy.php?erroradd");
    endif;


    $syresult = $conn->query('SELECT * FROM sy_tbl WHERE status = "Active"')  or die($conn->error);
    while ($syrow = $syresult->fetch_assoc()) :
        $end_date = $syrow['end_date'];
        $start_date = $syrow['startDate'];
        $sy_desc = $syrow['sy_desc'];
        $sy_id = $syrow['sy_id'];
    endwhile;

    //CHECK IF THE SCHOOL YEAR IS SET   
    // if (!empty($sy_desc)) :
    //     echo $_SESSION['sy'] = $sy_desc;
    //     echo $_SESSION['sy_id'] = $sy_id;
    // endif;


    // if (mysqli_query($conn, $query)) {
    //     header("location:../dbAdmin.php");
    // } else {
    //     echo "Error: " . mysqli_error($conn);
    }