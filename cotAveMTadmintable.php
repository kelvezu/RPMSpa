<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';

$sy_id = $_GET['sy'];
$school_id = $_GET['sch'];

$cot_array = [];
$COTqry = mysqli_query($conn, "SELECT * FROM cot_mt_indicator_ave_tbl  WHERE sy = $sy_id AND school = $school_id") or die($conn->error);

if (mysqli_num_rows($COTqry) == 0) :
    echo '<div class="red-notif-border">Average COT is not available</div>';
    exit();
else :
    foreach ($COTqry as $cot) :
        array_push($cot_array, $cot);
    endforeach;
endif;

$indicator_arr = RPMSdb::ViewAdminMTindicator($conn, $sy_id, $school_id);
$obs_period_arr =  showObsPeriodAveAdminMT($conn, $sy_id, $school_id);
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
                        <b>School :</b> <?= displaySchool($conn, $school_id) ?>
                    </p>
                </div>
                <div class="col">
                    <p>
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
                        <th>1st COT</th>
                        <th>2nd COT</th>
                        <th>3rd COT</th>
                        <th>4th COT</th>
                        <th>Average</th>
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
                            <?php foreach ($obs_period_arr as $obsper) : ?>

                                <td class="text-center text-success">
                                    <?php
                                            $position = "Master Teacher I";
                                            $t_average =  rawRate(viewAdminratingMT($conn, $school_id, $obsper['obs_period'], $ind['indicator_id'], $sy_id), $position);
                                            if ($t_average) :
                                                echo $t_average;
                                            else :  echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                            endif; ?>
                                </td>
                                
                            <?php endforeach; ?>
                            <td class="text-center font-weight-bold text-success"><?= rawRate(fetchIndicatorAVGAdminMt($conn, $ind['indicator_id'], $sy_id, $school_id), $position) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>



</div>