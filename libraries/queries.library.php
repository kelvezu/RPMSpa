<?php
/* Queries for Development Plan */
//$dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
include '../includes/conn.inc.php';



// $form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '" AND school =  "' . $_SESSION['school_id'] . '"';
// $esatForm3results = fetchAll($dbcon, $form3query);

/*------------------------------------------------------------------------------------------------------------------------------------------------*/

$teacherCount = 'SELECT COUNT(`user_id`) as Total_Count_Teacher FROM account_tbl WHERE position like "Teacher%"
AND school_id= "' . $_SESSION['school_id'] . '"';
$teacherTotal = mysqli_query($conn, $teacherCount);

$masterteacherCount = 'SELECT COUNT(`user_id`) as Total_Count_MasterTeacher FROM account_tbl WHERE position like "Master Teacher%" AND school_id= "' . $_SESSION['school_id'] . '"';
$masterteacherTotal = mysqli_query($conn, $masterteacherCount);

$schoolheadCount = 'SELECT COUNT(`user_id`) as Total_Count_SchoolHead FROM account_tbl WHERE position="School Head" AND school_id= "' . $_SESSION['school_id'] . '"';
$schoolheadTotal = mysqli_query($conn, $schoolheadCount);

$teacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position like "Teacher%"';
$teacherMasterlist_results = mysqli_query($conn, $teacherMasterlist);

$masterteacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position like "Master Teacher%"';
$masterteacherMasterlist_results = mysqli_query($conn, $masterteacherMasterlist);

$schoolheadMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position="School Head"';
$schoolheadMasterlist_results = mysqli_query($conn, $schoolheadMasterlist);

/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
// Query for selectratee.php



/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
