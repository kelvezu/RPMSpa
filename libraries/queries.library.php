<?php
/* Queries for Development Plan */
$dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);



// $form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '" AND school =  "' . $_SESSION['school_id'] . '"';
// $esatForm3results = fetchAll($dbcon, $form3query);

/*------------------------------------------------------------------------------------------------------------------------------------------------*/

// $teacherCount = 'SELECT COUNT(user_id) as Total_Count_Teacher FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III")';
// $teacherTotal = fetchAll($dbcon, $teacherCount);

// $masterteacherCount = 'SELECT COUNT(user_id) as Total_Count_MasterTeacher FROM account_tbl WHERE position IN ("Master Teacher I","Master Teacher II","Master Teacher III","Master Teacher IV")';
// $masterteacherTotal = fetchAll($dbcon, $masterteacherCount);

// $schoolheadCount = 'SELECT COUNT(user_id) as Total_Count_SchoolHead FROM account_tbl WHERE position="School Head" AND school_id= "' . $_SESSION['school_id'] . '"';
// $schoolheadTotal = fetchAll($dbcon, $schoolheadCount);

// $teacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position IN ("Teacher I", "Teacher II","Teacher III")';
// $teacherMasterlist_results = fetchAll($dbcon, $teacherMasterlist);

// $masterteacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")';
// $masterteacherMasterlist_results = fetchAll($dbcon, $masterteacherMasterlist);

// $schoolheadMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position="School Head"';
// $schoolheadMasterlist_results = fetchAll($dbcon, $schoolheadMasterlist);

/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
// Query for selectratee.php



/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
