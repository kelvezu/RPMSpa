<?php

/* Queries for Development Plan */
$dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$form2_lvlcap_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.lvlcap >= 3 AND esat2_objectivesmt_tbl.priodev  <= 2   GROUP by kra_tbl.kra_id';
$esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);

$form2_priodev_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.priodev >= 3 AND esat2_objectivesmt_tbl.lvlcap  <= 2 GROUP by kra_tbl.kra_id';
$esatForm2_priodev_results = fetchAll($dbcon, $form2_priodev_query);

$form3_cbc_strength_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) >= 3 ORDER BY esat3_core_behavioral_tbl.cbc_id';
$esatForm3_strength_results = fetchAll($dbcon, $form3_cbc_strength_query);

$form3_cbc_devneeds_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) <= 2 ORDER BY esat3_core_behavioral_tbl.cbc_id';
$esatForm3_devneeds_results = fetchAll($dbcon, $form3_cbc_devneeds_query);

$form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '" AND school =  "' . $_SESSION['school_id'] . '"';
$esatForm3results = fetchAll($dbcon, $form3query);





/*------------------------------------------------------------------------------------------------------------------------------------------------*/
