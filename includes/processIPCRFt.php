<?php

use IPCRF\IPCRF;

include 'conn.inc.php';
include '../libraries/func.lib.php';
include '../classes/ipcrf/ipcrf.class.php';
$score_array = [];


if (isset($_POST['submit_t'])) :
    $user = $_POST['user'];
    $position = $_POST['position'];
    $sy = $_POST['sy'];
    $school = $_POST['school'];
    $kra = $_POST['kra'];
    $obj = $_POST['obj'];
    $quality = $_POST['quality'];
    $efficiency = $_POST['efficiency'];
    $timeliness = ($_POST['timeliness']);
    $rater = ($_POST['rater'] !== "null") ? $_POST['rater'] : null;
    $obj_weight = $_POST['obj_weight'];
    $timeline = $_POST['timeline'];


    // echo generateAVG($quality, $efficiency, $timeliness);


    $ipcrf = new IPCRF($user, $sy, $school, $position);
    $hasIPCRF = $ipcrf->hasIPCRF('ipcrf_t');
    $hasFinalIPCRF = $ipcrf->hasIPCRF('ipcrf_final_t');
    // pre_r($_POST);


    /* CHECK IF THE USER HAS IPCRF RECORD ALREADY  */
    if ($hasFinalIPCRF or $hasIPCRF) :
        header('location:../ipcrf_t.php?notif=ipcrfexist');
        // echo 'User already have an Final IPCRF';
        exit();
    // elseif()
    endif;
    /* ------------------------------------- */

    for ($count = 0; $count < count($obj); $count++) {
        // pre_r($ipcrf->actualResultQualityt($kra[$count], $obj[$count], $quality[$count]));
        // pre_r($ipcrf->actualResultEfficiencyT($kra[$count], $obj[$count], $efficiency[$count]));
        // exit();

        $qry = $conn->query('INSERT INTO `ipcrf_t`( `user_id`, `kra_id`, `obj_id`, `quality`, `efficiency`, `timeliness`, `average`,`objective_weight`,`score`,`rater_id`, `sy_id`, `school_id`, `position`, `division`,`date_created`,`timeline`,`actual_result_quality`,`actual_result_timeliness`,`actual_result_efficiency`) VALUES (
            "' . $user . '",
            "' . $kra[$count] . '",
            "' . $obj[$count] . '",
            "' . $quality[$count] . '",
            "' . $efficiency[$count] . '",
            "' . $timeliness[$count] . '",
            "' . generateAVG($quality[$count], $efficiency[$count], $timeliness[$count]) . '",
            "' . $obj_weight[$count] . '",
            "' . generateScore(generateAVG(($quality[$count]), $efficiency[$count], $timeliness[$count]), $obj_weight[$count]) . '",
            "' . $rater . '",
            "' . $sy . '",
            "' . $school . '",
            "' . $position . '",
            ' . $school . ',
            "' . date("Y-m-d H:i:s") . '",
            "' . $timeline[$count] . '",
            ' . $ipcrf->actualResultQualityt($kra[$count], $obj[$count], $quality[$count]) . ',
            ' . $timeliness[$count] . ',
            ' . $ipcrf->actualResultEfficiencyT($kra[$count], $obj[$count], $efficiency[$count]) . ')')
            or die($conn->error . $qry);

        /* THIS METHOD WILL PUSH ALL THE SCORE IN AN ARRAY  */
        array_push($score_array, generateScore(generateAVG($quality[$count], $efficiency[$count], $timeliness[$count]), $obj_weight[$count]));
    }

    // THIS WILL GENERATE THE SUM 
    $final_score = (array_sum($score_array));
    $adj_rating =  adjectivalRating($final_score);
    $final_t_ipcrf = 'INSERT INTO `ipcrf_final_t`(`user_id`, `position`, `sy_id`, `school_id`, `final_rating`, `adjectival_rating`, `rater_id`, `date_created`) VALUES (' . $user . ', "' . $position . '",' . $sy . ',' . $school . ',' . $final_score . ',"' . $adj_rating . '" , "' . $rater . '","' . dateNow() . '")';

    $r = mysqli_query($conn, $final_t_ipcrf) or die($conn->error . $final_t_ipcrf);

    if ($r) :
        echo 'success';
        header('location:../ipcrf_t_rate_form.php?notif=Success');
    endif;



endif;
