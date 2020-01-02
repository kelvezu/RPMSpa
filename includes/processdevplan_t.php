<?php

use DevPlan\DevPlan;

include 'conn.inc.php';
include '../libraries/func.lib.php';
include '../classes/devplan/devplan.class.php';

if (isset($_POST['submit_dp'])) :
     pre_r($_POST);

    $user = $_POST['user'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $rater = $_POST['rater'];
    $approving_authority = $_POST['approving_authority'] ?? "null";
    $position = $_POST['position'];
    $strobj = $_POST['strobj'];
    $devneedobj = $_POST['devneedobj'];
    $a_learn_obj = filter_input_string($_POST['a_learn_obj']);
    $a_intervention = filter_input_string($_POST['a_intervention']);
    $a_timeline = filter_input_string($_POST['a_timeline']);
    $a_resource_needed = filter_input_string($_POST['a_resource_needed']);
    $strbehavioral = $_POST['strbehavioral'];
    $devneedbehavioral = $_POST['devneedbehavioral'];
    $b_learn_obj = filter_input_string($_POST['b_learn_obj']);
    $b_intervention = filter_input_string($_POST['b_intervention']);
    $b_timeline = filter_input_string($_POST['b_timeline']);
    $b_resource_needed = filter_input_string($_POST['b_resource_needed']);
     pre_r($_POST);
    $devplan = new DevPlan($user, $sy, $school, $position);

    // CHECK IF THERE ARE EXISTING RECORD
    $check_dp_str = $devplan->checkOBJ_dp('devplant_a1_strength_tbl');
    $check_dp_devneed = $devplan->checkOBJ_dp('devplant_a2_devneeds_tbl');
    $check_dp_actionplan = $devplan->checkOBJ_dp('devplant_a3_actionplan_tbl');
    $check_dp_str_behavioral = $devplan->checkOBJ_dp('devplant_b1_strength_tbl');
    $check_dp_devneeed_behavioral = $devplan->checkOBJ_dp('devplant_b2_devneeds_tbl');
    $check_dp_actionplan2 = $devplan->checkOBJ_dp('devplant_b3_actionplan_tbl');

    if ($check_dp_str && $check_dp_devneed && $check_dp_actionplan && $check_dp_str_behavioral && $check_dp_devneeed_behavioral && $check_dp_actionplan2) :
        header("location:../devplan_create_t.php?notif=recordexist");
        exit();
    endif;



    if ($check_dp_str) :
        console_log("Record already exist in devplant_a1_strength_tbl");
    else :
        for ($i = 0; $i < count($strobj); $i++) :
            $sql = "INSERT INTO `devplant_a1_strength_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`,  `strengths_mtobj`, `status`,  `date_created`) VALUES ($user,$rater,$sy,$school,'" . $position . "',$strobj[$i],'Active','" . dateNow() . "')";
            $insert_sql_str_obj = mysqli_query($conn, $sql) or die($conn->error . $sql . 'a');
        endfor;
    endif;

    if ($check_dp_devneed) :
        console_log("Record already exist in devplant_a2_devneeds_tbl");
    else :
        for ($i = 0; $i < count($devneedobj); $i++) :
            $sql = "INSERT INTO `devplant_a2_devneeds_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`,  `devneeds_mtobj`, `status`,  `date_created`) VALUES ($user,$rater,$sy,$school,'" . $position . "',$devneedobj[$i],'Active','" . dateNow() . "')";
            $insert_sql_devneed_obj = mysqli_query($conn, $sql) or die($conn->error . $sql . 'b');
        endfor;
    endif;

    if ($check_dp_actionplan) :
        console_log("Record already exist in devplant_a3_actionplan_tbl");
    else :
        $sql = "INSERT INTO `devplant_a3_actionplan_tbl`( `user_id`, `rater_id`, `sy`, `school`, `position`, `a_learning_objectives`, `a_intervention`, `a_timeline`, `a_resources_needed`, `status`, `date_created`) VALUES ($user,$rater,$sy,$school,'$position','$a_learn_obj','$a_intervention','$a_timeline','$a_resource_needed','Active','" . dateNow() . "')";
        $insert_sql_actionplan = mysqli_query($conn, $sql) or die($conn->error . $sql . 'b');
        if ($insert_sql_actionplan) {
            console_log('Success devplant_a3_actionplan_tbl');
        };
    endif;

    if ($check_dp_str_behavioral) :
        console_log("Record already exist in devplant_b1_strength_tbl");
    else :
        for ($i = 0; $i < count($strbehavioral); $i++) :
            $sql = "INSERT INTO `devplant_b1_strength_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`,  `strength_cbc_id`, `status`,  `date_created`) VALUES ($user,$rater,$sy,$school,'" . $position . "',$strbehavioral[$i],'Active','" . dateNow() . "')";
            $insert_sql_str_behavioral = mysqli_query($conn, $sql) or die($conn->error . $sql . 'a');
        endfor;
        if ($insert_sql_str_behavioral) {
            console_log('Success devplant_b1_strength_tbl');
        };
    endif;

    if ($check_dp_devneeed_behavioral) :
        console_log("Record already exist in devplant_b2_devneeds_tbl");
    else :
        for ($i = 0; $i < count($devneedbehavioral); $i++) :
            $sql = "INSERT INTO `devplant_b2_devneeds_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`,  `devneed_cbc_id`, `status`,  `date_created`) VALUES ($user,$rater,$sy,$school,'" . $position . "',$devneedbehavioral[$i],'Active','" . dateNow() . "')";
            $insert_sql_devneed_behavioral = mysqli_query($conn, $sql) or die($conn->error . $sql . 'a');
        endfor;
        if ($insert_sql_devneed_behavioral) {
            console_log('Success devplant_b2_devneeds_tbl');
        };
    endif;

    if ($check_dp_actionplan2) :
        console_log("Record already exist in devplant_b3_actionplan_tbl");
    else :
        $sql = "INSERT INTO `devplant_b3_actionplan_tbl`( `user_id`, `rater_id`, `sy`, `school`, `position`, `b_learning_objectives`, `b_intervention`, `b_timeline`, `b_resources_needed`, `status`, `date_created`) VALUES ($user,$rater,$sy,$school,'$position','$b_learn_obj','$b_intervention','$b_timeline','$b_resource_needed','Active','" . dateNow() . "')";
        $insert_sql_actionplan2 = mysqli_query($conn, $sql) or die($conn->error . $sql . 'b');
        if ($insert_sql_actionplan2) {
            console_log('Success devplant_b2_devneeds_tbl');
        };
    endif;

    if ($insert_sql_str_obj  && $insert_sql_devneed_obj  && $insert_sql_actionplan  && $insert_sql_str_behavioral  && $insert_sql_devneed_behavioral  && $insert_sql_actionplan2) :
        header("location:../devplan_create_t.php?notif=success");
        exit();
    endif;










endif;
