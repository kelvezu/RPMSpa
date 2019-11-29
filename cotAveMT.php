<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';


$obs_period_arr =  showObsPeriodMT($conn, $_SESSION['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']);
$indicator_arr = RPMSdb::fetchSpecificMTindicator($conn, $_SESSION['active_sy_id'], $_SESSION['school_id'],  $_SESSION['user_id']);

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
                        <b>Teacher Observed:</b> <?= displayname($conn, $_SESSION['user_id']) ?><br />
                        <b>School :</b> <?= displaySchool($conn, $_SESSION['school_id']) ?>
                    </p>

                </div>
                <div class="col">
                    <p>
                        <b> Rater:</b> <?= displayName($conn, $_SESSION['rater']) ?><br />
                        <b> School Year:</b> <?= displaySY($conn, $_SESSION['active_sy_id']) ?><br />
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead class="alert alert-primary">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>

                        <th rowspan="2">1st</th>
                        <th rowspan="2">2nd</th>
                        <th rowspan="2">3rd</th>
                        <th rowspan="2">4th</th>
                        <th>Average</th>
                    </tr>
                </thead>
                <?php

                $num = 1;
                foreach ($indicator_arr as $ind) :
                    ?>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold"><?php echo $num++ . '.'; ?></td>
                            <td class="font-italic"><?= displayMTindicator($conn, $ind['indicator_id']); ?></td>


                            <?php foreach ($obs_period_arr as $obsper) : ?>

                                <td class="text-center text-primary">
                                    <?= fetchCOTratingMT($conn, $_SESSION['user_id'], $obsper['obs_period'], $ind['indicator_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?>
                                </td>

                            <?php endforeach; ?>
                            <td class="text-center font-weight-bold text-primary"><?= fetchIndicatorAVGmt($conn, $_SESSION['user_id'], $ind['indicator_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?></td>

                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="container">

        <?php
        //pre_r(RPMSdb::fetchCOTrating($conn, 32, 1, $_SESSION['active_sy_id'], $_SESSION['school_id'], 'a_tioafrating_tbl', 'b_tioafrating_tbl'));
        // pre_r(RPMSdb::fetchtallMT($conn, $_SESSION['school_id']));
        ?>
    </div>


















</div>



<br>
<?php
include 'samplefooter.php';
?>