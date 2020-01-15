<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';

$sy_id = $_GET['sy'];
$school = $_GET['sch'];
$num = 1;


$cot_array = [];
$COTqry = mysqli_query($conn, "SELECT * FROM cot_mt_indicator_ave_tbl  WHERE sy = $sy_id AND school = '$school'") or die($conn->error);

if (mysqli_num_rows($COTqry) == 0) :
    echo '<div class="red-notif-border">Average COT is not available</div>';
    exit();
else :
    foreach ($COTqry as $cot) :
        array_push($cot_array, $cot);
    endforeach;
endif;

$indicator_arr = fetchMTindicator($conn);
$obs_period_arr =  showObsPeriodAveAdminMT($conn, $sy_id, $school);
?>

<div class="container">

    <div class="d-flex justify-content-censer">
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
                        <b> School:</b> <?= displaySchool($conn, $school) ?><br />
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
                <thead class="alert alert-primary">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>1st COT</th>
                        <th>2nd COT</th>
                        <th>3rd COT</th>
                        <th>4th COT</th>
                        <th>COT Average</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($indicator_arr) : foreach ($indicator_arr as $ind) :
                            $ind_id = $ind['mtindicator_id'];
                    ?>
                            <tr>
                                <td>
                                    <p><?= $num++ ?></p>
                                </td>

                                <td>
                                    <p><?= displayMTindicator($conn, $ind_id) ?></p>
                                </td>

                                <?php for ($count = 1; $count <= 4; $count++) : $obs_per = $count; ?>
                                    <td class="text-center">
                                        <p><?php
                                            /* 'obs period: '.$count.' indi:'.$ind_id */
                                            echo (fetch_cot_rating_mt($conn, $obs_per, $ind_id, $sy_id, $school)) ? '<p>' . fetch_cot_rating_mt($conn, $obs_per, $ind_id, $sy_id, $school) . '</p>' : "<p class='text-danger'>N/A</p>";
                                            ?></p>
                                    </td>
                                <?php endfor; ?>

                                <td class="text-center">
                                    <p><?php echo fetchIndicatorAVGAdminMt($conn, $ind_id, $sy_id, $school) ? '<p>' . fetchIndicatorAVGAdminMt($conn, $ind_id, $sy_id, $school) . '</p>' : "<p class='text-danger'>N/A</p>";  ?></p>
                                </td>
                            <?php endforeach; ?>
                            </tr>

                        <?php else : ?>
                            <td colspan="10">
                                <p>
                                    No Record!
                                </p>
                            </td>

                        <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php /*
                $num =
                foreach ($indicator_arr as $ind) :  ?>
                         <?php 1; foreach ($obs_period_arr as $obsper) : ?>
                        <tr>
                            <td class="font-weight-bold"><?= $num++ . '.'; ?></td>
                            <td class="font-italic"><?= displayTindicator($conn, $ind['indicator_id']); ?></td>
                           
                                <td class="text-center text-success">

                                    <?php
                                            $position = "Teacher I";
                                            $t_average =  rawRate(viewAdminratingTObs1($conn, $school, $ind['indicator_id'], $sy_id), $position);
                                            if ($t_average) :
                                                echo $t_average;
                                            else :  echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                            endif; ?>
                                </td>
                                  <td class="text-center text-success">

                                    <?php
                                            $position = "Teacher I";
                                            $t_average =  rawRate(viewAdminratingTObs2($conn, $school, $ind['indicator_id'], $sy_id), $position);
                                            if ($t_average) :
                                                echo $t_average;
                                            else :  echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                            endif; ?>
                                </td>
                                  <td class="text-center text-success">

                                    <?php
                                            $position = "Teacher I";
                                            $t_average =  rawRate(viewAdminratingTObs3($conn, $school, $ind['indicator_id'], $sy_id), $position);
                                            if ($t_average) :
                                                echo $t_average;
                                            else :  echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                            endif; ?>
                                </td>
                                  <td class="text-center text-success">

                                    <?php
                                            $position = "Teacher I";
                                            $t_average =  rawRate(viewAdminratingTObs4($conn, $school, $ind['indicator_id'], $sy_id), $position);
                                            if ($t_average) :
                                                echo $t_average;
                                            else :  echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                            endif; ?>
                                </td>
                           
                            <td class="text-center font-weight-bold text-success">
                                <?php echo rawRate(fetchIndicatorAVGAdmint($conn, $ind['indicator_id'], $sy_id, $school), $position) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?></td>
                                 <?php endforeach; ?>
                        </tr>
                        <?php endforeach; */ ?>