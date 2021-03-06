<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';



$teacher_id = $_GET['user'];
$school_id = $_GET['sch'];
$rater = $_GET['rater'];
$sy_id = $_GET['sy'];
$obs = $_GET['obs'];
$position = "Master Teacher I";

$cot_array = [];
$COTqry = mysqli_query($conn, "SELECT * FROM cot_mt_rating_a_tbl WHERE sy = $sy_id AND `user_id` = $teacher_id AND obs_period = $obs") or die($conn->error);

if (mysqli_num_rows($COTqry) == 0) :
    echo '<div class="red-notif-border">No Classroom Observation Record Available</div>';
    exit();
else :
    foreach ($COTqry as $cot) :
        array_push($cot_array, $cot);
    endforeach;
endif;

$indicator_arr = RPMSdb::fetchSpecificMTindicator($conn, $sy_id, $school_id,  $teacher_id);
?>



<div class="container">

    <div class="d-flex justify-content-center">
        <img src="img\deped.png" width="100" height="100" class="rounded-circle">
    </div>

    <div class="d-flex justify-content-center my-2">
        <h5><strong>COT-RPMS for Master Teacher I-IV</strong></h5>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <div class="row">
                <div class="col">
                    <p>
                        <b>Master Teacher Observed:</b> <?php displayname($conn, $teacher_id) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?><br />
                        <b>School :</b> <?= displaySchool($conn, $school_id) ?><br />
                        <b>Observation Period :</b> <?= $obs; ?>
                    </p>
                </div>
                <div class="col">
                    <p>
                        <b> Rater:</b> <?= displayName($conn, $rater)  ?><br />
                        <b> School Year:</b> <?= displaySY($conn, $sy_id) ?><br />
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead class="alert alert-info">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>COT Rating</th>
                    </tr>
                </thead>
                <?php
                $num = 1;
                foreach ($indicator_arr as $ind) :
                    ?>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold"><?= $num++ . '.'; ?></td>
                            <td class="font-italic"><?= displayMTindicator($conn, $ind['indicator_id']); ?></td>
                            <td class="text-center text-success">
                                <?php if (empty(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id))) :
                                        echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                    else :
                                        echo rawRate(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id), $position);
                                    endif;   ?>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>


</div>