<?php

use DevPlan\DevPlan;

include 'conn.inc.php';
include '../libraries/func.lib.php';
include '../classes/devplan/devplan.class.php';

if (isset($_POST['submit_dp'])) :
    // pre_r($_POST);

    $user = $_POST['user'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $rater = $_POST['rater'];
    $approving_authority = $_POST['approving_authority'] ?? "null";
    $position = $_POST['position'];
    $strobj = $_POST['strobj'];


    $devneedobj = $_POST['devneedobj'];

    $a_learn_obj = $_POST['a_learn_obj'];
    $a_intervention = $_POST['a_intervention'];
    $a_timeline = $_POST['a_timeline'];
    $a_resource_needed = $_POST['a_resource_needed'];

    $strbehavioral = $_POST['strbehavioral'];

    $devneedbehavioral = $_POST['devneedbehavioral'];

    $b_learn_obj = $_POST['b_learn_obj'];
    $b_intervention = $_POST['b_intervention'];
    $b_timeline = $_POST['b_timeline'];
    $b_resource_needed = $_POST['b_resource_needed'];

    $devplan = new DevPlan($user, $sy, $school, $position);
    // pre_r($devplan);
    $strobj_result = $devplan->checkOBJstr('devplanmt_a1_strength_tbl');
    pre_r($strobj_result);
    if ($strobj_result) :
        echo "Already exist";
        exit();
    endif;


    for ($i = 0; $i < count($strobj); $i++) :
        $sql = "INSERT INTO `devplanmt_a1_strength_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`,  `strengths_mtobj`, `status`,  `date_created`) VALUES ($user,$rater,$sy,$school,'" . $position . "',$strobj[$i],'Active','" . dateNow() . "')";
        $insert_sql = mysqli_query($conn, $sql) or die($conn->error . $sql);
    endfor;

    if ($insert_sql) {
        echo 'Success';
    }


endif;
