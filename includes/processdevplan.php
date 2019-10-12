<?php


include_once '../libraries/db.library.php';
include_once 'constants.inc.php';
if (isset($_POST['submit'])) :
    $sy = $_POST['sy'];
    $user_id = $_POST['user_id'];
    $school_id = $_POST['school_id'];
    $position = $_POST['position'];
    $rater = $_POST['rater'];
    $lvlcapkra_id = $_POST['lvlcapkra_id'];
    $lvlcapmtobj_id = $_POST['lvlcapmtobj_id'];
    $priodevkra_id = $_POST['priodevkra_id'];
    $priodevmtobj_id = $_POST['priodevmtobj_id'];
    $a_learning_objectives = $_POST['a_learning_objectives'];
    $a_action_plan = $_POST['a_learning_objectives'];
    $a_intervention = $_POST['a_intervention'];
    $a_timeline = $_POST['a_timeline'];
    $a_resources_needed = $_POST['a_resources_needed'];
    // $b_action_plan = $_POST['b_action_plan'];
    // $b_intervention = $_POST['b_intervention'];
    // $b_timeline = $_POST['b_timeline'];
    // $b_resources_needed = $_POST['b_resources_needed'];
    // $feedback = $_POST['feedback'];

    $conn = new mysqli('localhost', 'root', '', 'rpms');
    $stmt = $conn->prepare("INSERT INTO `devplan_a_tbl`(`user_id`, `rater_id`, `sy`, `school`, `position`, `a_strengths`, `a_devneeds`, `a_learn_objectives`, `a_intervention`, `a_timeline`, `a_resource`) VALUES (?,?,?,?,?,?,?,?,?,?,?");
    $stmt->bind_param("iiiisssssss", $user_id, $rater, $sy, $school_id, $position, $lvlcapkra_id, $priodevkra_id, $a_learning_objectives, $a_intervention, $a_timeline, $a_resources_needed);
    $stmt->execute();
    echo "New records created successfully";
    $stmt->close();
    $conn0->close();
    // header("location:../devplan.php");
    echo var_dump($_POST['submit']);



endif;
