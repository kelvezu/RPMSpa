<?php
include 'conn.inc.php';
include '../libraries/func.lib.php';


if (isset($_POST['submit_mt'])) :
    $user = $_POST['user'];
    $position = $_POST['position'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $kra = $_POST['kra'];
    $obj = $_POST['obj'];
    $quality = $_POST['quality'];
    $efficiency = $_POST['efficiency'];
    $timeliness = $_POST['timeliness'];
    $rater = $_POST['rater'];
    // echo generateAVG($quality, $efficiency, $timeliness);
    pre_r($_POST);

    for ($count = 0; $count < count($obj); $count++) {
        $conn->query('INSERT INTO `ipcrf_mt`( `user_id`, `kra_uid`, `obj_id`, `quality`, `efficiency`, `timeliness`, `average`,`rater_id`, `sy_id`, `school_id`, `position`, `division`,   `date_created`) VALUES (' . $user . ',' . $kra[$count] . ',' . $obj[$count] . ',' . $quality[$count] . ',' . $efficiency[$count] . ',' . $timeliness[$count] . ',' . round(generateAVG($quality[$count], $efficiency[$count], $timeliness[$count]), 3) . ',' . $rater . ',' . $sy . ',' . $school . ',"' . $position . '",' . $school . ',"' . date("Y-m-d H:i:s") . '")')  or die($conn->error);
    } else : echo 'error';






endif;
