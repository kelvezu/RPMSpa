<?php
include 'libraries/func.lib.php';
if (isset($_POST['create_dp_mt'])) :
    pre_r($_POST);

    $user = $_POST['user'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $rater = $_POST['rater'];
    $approving_authority = $_POST['approving_authority'];
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
endif;
