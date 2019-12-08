<?php
// ADD A CONDITION THAT WILL DEFINE THE POSITION AND ITS QUERIES
include_once '../libraries/db.library.php';
include_once '../libraries/func.lib.php';
include_once 'constants.inc.php';
include_once 'conn.inc.php';


if (isset($_POST['submit'])) :
    $user_id = $_POST['user_id'];
    $rater_id = $_POST['rater'];
    $sy = $_POST['sy'];
    $school_id = $_POST['school_id'];
    $position = $_POST['position'];
    $approving_authority = $_POST['app_auth'];

    $a_lvlcapkra_id = $_POST['lvlcapkra_id'];
    $a_lvlcapmtobj_id = $_POST['lvlcapobj_id'];
    $a_priodevkra_id = $_POST['priodevkra_id'];
    $a_priodevmtobj_id = $_POST['priodevmmtobj_id'];
    $a_learning_objectives = $_POST['a_learning_objectives'];
    $a_intervention = $_POST['a_intervention'];
    $a_timeline = $_POST['a_timeline'];
    $a_resources_needed = $_POST['a_resources_needed'];

    $strength_cbc_id = $_POST['strength_cbc_id'];
    $strength_cbc_ind_id = $_POST['strength_cbc_ind_id'];

    $devneed_cbc_id = $_POST['devneed_cbc_id'];
    $devneed_cbc_ind_id = $_POST['devneed_cbc_ind_id'];
    $b_learning_objectives = $_POST['b_learning_objectives'];
    $b_intervention = $_POST['b_intervention'];
    $b_timeline = $_POST['b_timeline'];
    $b_resources_needed = $_POST['b_resources_needed'];
    $status = "Submit";
    $feedback = $_POST['feedback'];

    for ($count = 0; $count < count($a_lvlcapmtobj_id); $count++) {
        $conn->query('INSERT INTO `devplanmt_a1_strength_tbl`( `user_id`,`rater_id`,`sy`, `school`, `position`, `a_strengths`, `strengths_mtobj`,`status`,`approving_authority`) VALUES (' . $user_id . ',"' . $rater_id . '",' . $sy . ',' . $school_id . ',"' . $position . '",' . $a_lvlcapkra_id[$count] . ',' . $a_lvlcapmtobj_id[$count] . ',"' . $status . '","' . $approving_authority . '" )') or die($conn->error . 'ERROR IN devplanmt_a1_strength_tbl');
    }

    for ($count = 0; $count < count($a_priodevmtobj_id); $count++) {
        $conn->query('INSERT INTO `devplanmt_a2_devneeds_tbl`(  `user_id`,`rater_id`,`sy`, `school`, `position`, `a_devneeds`, `devneeds_mtobj`,`status`,`approving_authority`) VALUES (' . $user_id . ',' . $rater_id . ',"' . $sy . '","' . $school_id . '","' . $position . '","' . $a_priodevkra_id[$count] . '","' . $a_priodevmtobj_id[$count] . '","' . $status . '" ,"' . $approving_authority . '")') or die($conn->error . 'ERROR IN devplanmt_a2_devneeds_tbl');
    }

    $conn->query('INSERT INTO `devplanmt_a3_actionplan_tbl`( `user_id`,`rater_id`,`sy`, `school`, `position`, `a_learning_objectives`, `a_intervention`, `a_timeline`, `a_resources_needed`,`status`,`approving_authority`) VALUES (' . $user_id . ',' . $rater_id . ',"' . $sy . '","' . $school_id . '","' . $position . '","' . $a_learning_objectives . '","' . $a_intervention . '","' . $a_timeline . '","' . $a_resources_needed . '","' . $status . '","' . $approving_authority . '")') or die($conn->error . 'ERROR IN devplanmt_a3_actionplan_tbl');


    for ($count = 0; $count < count($strength_cbc_ind_id); $count++) {
        $conn->query('INSERT INTO `devplanmt_b1_strength_tbl`(  `user_id`,`rater_id`,`sy`, `school`, `position`, `strength_cbc_id`, `strength_cbc_ind_id`,`status`,`approving_authority`) VALUES (' . $user_id . ',' . $rater_id . ',"' . $sy . '","' . $school_id . '","' . $position . '","' . $strength_cbc_id[$count] . '","' . $strength_cbc_ind_id[$count] . '" ,"' . $status . '","' . $approving_authority . '")') or die($conn->error . 'ERROR IN devplant_b1_strength_tbl');
    }

    for ($count = 0; $count < count($devneed_cbc_ind_id); $count++) {
        $conn->query('INSERT INTO `devplanmt_b2_devneeds_tbl`( `user_id`,`rater_id`, `sy`, `school`, `position`, `devneed_cbc_id`, `devneed_cbc_ind_id`,`status`,`approving_authority`) VALUES (' . $user_id . ',' . $rater_id . ',"' . $sy . '","' . $school_id . '","' . $position . '","' . $devneed_cbc_id[$count] . '","' . $devneed_cbc_ind_id[$count] . '" ,"' . $status . '","' . $approving_authority . '")') or die($conn->error . 'ERROR IN devplant_b2_devneeds_tbl');
    }

    $conn->query('INSERT INTO `devplanmt_b3_actionplan_tbl`( `user_id`,`rater_id`,`sy`, `school`, `position`, `b_learning_objectives`, `b_intervention`, `b_timeline`, `b_resources_needed`,`status`,`approving_authority`) VALUES (' . $user_id . ',' . $rater_id . ',"' . $sy . '","' . $school_id . '","' . $position . '","' . $b_learning_objectives . '","' . $b_intervention . '","' . $b_timeline . '","' . $b_resources_needed . '","' . $status . '","' . $approving_authority . '")') or die($conn->error . 'ERROR IN devplant_b3_actionplan_tbl');

    $conn->query('INSERT INTO `devplanmt_c_tbl`( `feedback`,`user_id`,`position`,`rater_id`, `sy`, `school`, `status`,`approving_authority`) 
    VALUES ("' . $feedback . '",' . $user_id . ',"' . $position . '","' . $rater_id . '","' . $sy . '","' . $school_id . '","' . $status . '","' . $approving_authority . '")') or die($conn->error . "error in devplanmt_c_tbl");

    header('location:../gendevplanmt.php');
endif;


// IF USER PRESSED save BUTTON 
if (isset($_POST['save'])) :
    echo 'na save hihi';
endif;

// IF USER PRESSED edit BUTTON 

if (isset($_POST['edit'])) :

    header('location:../editdevplan.php');

endif;
