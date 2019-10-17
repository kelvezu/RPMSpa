<?php
/* Queries for Development Plan */
$dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$form2_lvlcap_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.lvlcap >= 3 AND esat2_objectivesmt_tbl.priodev  <= 2   GROUP by kra_tbl.kra_id';
$esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);


// this will check if the query return some values
// if (!$form2_lvlcap_query) :
//    
//     echo !$form2_lvlcap_query;
// else :
//     echo 'no record of level of capability! :D';
// endif;

$form2_priodev_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.priodev >= 3 AND esat2_objectivesmt_tbl.lvlcap  <= 2 GROUP by kra_tbl.kra_id';
$esatForm2_priodev_results = fetchAll($dbcon, $form2_priodev_query);

// if ($form2_priodev_query) :
//     $esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);
// else :
//     echo 'no record!';
// endif;

$form3_cbc_strength_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores, esat3_core_behavioral_tbl.* FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) >= 3 ORDER BY esat3_core_behavioral_tbl.cbc_id';
$esatForm3_strength_results = fetchAll($dbcon, $form3_cbc_strength_query);

$form3_cbc_devneeds_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores, esat3_core_behavioral_tbl.* FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) <= 2 ORDER BY esat3_core_behavioral_tbl.cbc_id';
$esatForm3_devneeds_results = fetchAll($dbcon, $form3_cbc_devneeds_query);

$form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '" AND school =  "' . $_SESSION['school_id'] . '"';
$esatForm3results = fetchAll($dbcon, $form3query);

/*------------------------------------------------------------------------------------------------------------------------------------------------*/

$teacherCount = 'SELECT COUNT(user_id) as Total_Count_Teacher FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III")';
$teacherTotal = fetchAll($dbcon, $teacherCount);

$masterteacherCount = 'SELECT COUNT(user_id) as Total_Count_MasterTeacher FROM account_tbl WHERE position IN ("Master Teacher I","Master Teacher II","Master Teacher III","Master Teacher IV")';
$masterteacherTotal = fetchAll($dbcon, $masterteacherCount);

$schoolheadCount = 'SELECT COUNT(user_id) as Total_Count_SchoolHead FROM account_tbl WHERE position="School Head" AND school_id= "' . $_SESSION['school_id'] . '"';
$schoolheadTotal = fetchAll($dbcon, $schoolheadCount);

$teacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position IN ("Teacher I", "Teacher II","Teacher III")';
$teacherMasterlist_results = fetchAll($dbcon, $teacherMasterlist);

$masterteacherMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")';
$masterteacherMasterlist_results = fetchAll($dbcon, $masterteacherMasterlist);

$schoolheadMasterlist = 'SELECT * FROM account_tbl WHERE school_id= "' . $_SESSION['school_id'] . '" AND position="School Head"';
$schoolheadMasterlist_results = fetchAll($dbcon, $schoolheadMasterlist);

/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
// Query for selectratee.php

$fetchTeacherRatee = 'SELECT * FROM account_tbl WHERE rater = "' . $_SESSION['user_id'] . '"  AND school_id = "' . $_SESSION['school_id'] . '" ';
$fetchRateeresults = fetchAll($dbcon, $fetchTeacherRatee);

/*---------------------------------------------------------------------------------------------------------------------------------------------------*/
