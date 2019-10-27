<?php
// ADD A CONDITION THAT WILL DEFINE THE POSITION AND ITS QUERIES
include_once '../libraries/db.library.php';
include_once '../libraries/func.lib.php';
include_once 'constants.inc.php';
include_once 'conn.inc.php';


if (isset($_POST['submit'])) :
    $user_id = $_POST['user_id'];
    $rater = $_POST['rater'];
    $sy = $_POST['sy'];
    $school_id = $_POST['school_id'];
    $position = $_POST['position'];
    $approving_authority = $_POST['approving_authority'];

    $a_kra_id = $_POST['kra_name'];
    $a_obj_id = $_POST['tobj_name'];
    $a_kra_id1 = $_POST['kra_name1'];
    $a_obj_id1 = $_POST['tobj_name1'];
    $a_learning_objectives = $_POST['a_learning_objectives'];
    $a_intervention = $_POST['a_intervention'];
    $a_timeline = $_POST['a_timeline'];
    $a_resources_needed = $_POST['a_resources_needed'];

    $b_cbc_id = $_POST['strength_cbc'];
    $b_cbc_name = $_POST['cbc_name'];

    $b_dev_cbc = $_POST['dev_cbc'];
    $b_cbc_name2 = $_POST['cbc_name2'];
    $b_learning_obj = $_POST['b_learning_objectives'];
    $b_intervention = $_POST['b_intervention'];
    $b_timeline = $_POST['b_timeline'];
    $b_resources_needed = $_POST['b_resources_needed'];
    $feedback = $_POST['feedback'];
    $status = $_POST['submit'];


    $conn->query('INSERT INTO `devplant_a1_strength_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `a_strengths`, `strengths_mtobj`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' . $a_kra_id . '","' . $a_obj_id . '")') or die($conn->error);

    $conn->query('INSERT INTO `devplant_a2_devneeds_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `a_devneeds`, `devneeds_mtobj`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' . $a_kra_id1 . '","' . $a_obj_id1 . '")') or die($conn->error);

    $conn->query('INSERT INTO `devplant_a3_actionplan_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `a_learning_objectives`, `a_intervention`, `a_timeline`, `a_resources_needed`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' . $a_learning_objectives . '","' . $a_intervention . '","' . $a_timeline . '","' . $a_resources_needed . '")') or die($conn->error);

    $conn->query('INSERT INTO `devplant_b1_strength_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `strength_cbc_id`, `strength_cbc_ind_id`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' . $b_cbc_id . '","' . $b_cbc_name . '")') or die($conn->error);

    $conn->query('INSERT INTO `devplant_b2_devneeds_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `devneed_cbc_id`, `devneed_cbc_ind_id`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' . $b_dev_cbc  . '","' .  $b_cbc_name2 . '")') or die($conn->error);

    $conn->query('INSERT INTO `devplant_b3_actionplan_tbl` (`user_id`, `rater_id`, `sy`, `school`, `position`, `b_learning_objectives`, `b_intervention`, `b_timeline`, `b_resources_needed`) VALUES ("' . $user_id . '","' . $rater . '","' . $sy . '","' . $school_id . '","' . $position . '","' .  $b_learning_obj . '","' .  $b_intervention . '","' .  $b_timeline  . '", "' .  $b_resources_needed . '")') or die($conn->error);


    $conn->query('INSERT INTO `devplant_c_tbl`(`feedback`,`user_id`, `position`, `rater_id`, `approving_authority`, `sy`, `school_id`, `status`) VALUES ("' . $feedback . '","' . $user_id . '","' . $position . '","' . $rater . '","' . $approving_authority . '","' . $sy . '","' . $school_id . '","' . $status . '")') or die($conn->error . "error in devplanMT_c_tbl");

    echo 'complete!';
    header('location:../editdevplan.php');
    pre_r($_POST['submit']);
endif;


// IF USER PRESSED save BUTTON 
if (isset($_POST['save'])) :
    echo 'na save hihi';
endif;

// IF USER PRESSED edit BUTTON 
