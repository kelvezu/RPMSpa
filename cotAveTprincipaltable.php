<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';

$sy_id = $_GET['sy'];
$teacher_id = $_GET['user'];
$school_id = $_GET['sch'];

$positionQry = $conn->query("SELECT * FROM account_tbl WHERE `user_id` = '$teacher_id' ");
while ($result = $positionQry->fetch_assoc()) :
    $position = $result['position'];


    $cot_array = [];
    $COTqry = mysqli_query($conn, "SELECT * FROM cot_t_indicator_ave_tbl  WHERE sy = $sy_id AND `user_id` = $teacher_id") or die($conn->error);

    if (mysqli_num_rows($COTqry) == 0) :
        echo '<div class="red-notif-border">Average COT is not available</div>';
        exit();
    else :
        foreach ($COTqry as $cot) :
            array_push($cot_array, $cot);
        endforeach;
    endif;


    $obs_period_arr =  showObsPeriodT($conn, $teacher_id, $sy_id, $school_id);
    $indicator_arr = RPMSdb::fetchSpecificTindicator($conn, $sy_id, $school_id,  $teacher_id);

    $qry = $conn->query("SELECT * FROM account_tbl WHERE `user_id` = $teacher_id ") or die($conn->error);
    while ($row = $qry->fetch_assoc()) :
        $rater = $row['rater'];


        ?>

        <div class="container">

            <div class="d-flex justify-content-center">
                <img src="img\deped.png" width="100" height="100" class="rounded-circle">
            </div>

            <div class="d-flex justify-content-center my-2">
                <h5><strong>COT-RPMS for Teacher I-III</strong></h5>
            </div>

            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col">
                            <p>
                                <b>Teacher Observed:</b> <?php displayname($conn, $teacher_id) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?><br />
                                <b>School :</b> <?= displaySchool($conn, $school_id) ?>
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
            <?php endwhile; ?>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm table-sm">
                    <thead class="alert alert-success">
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
                    <?php
                        $num = 1;
                        foreach ($indicator_arr as $ind) :
                            ?>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold"><?= $num++ . '.'; ?></td>
                                <td class="font-italic"><?= displayTindicator($conn, $ind['indicator_id']); ?></td>
                                <?php foreach ($obs_period_arr as $obsper) : ?>

                                    <td class="text-center text-success">
                                        <?php
                                                    if (empty(fetchCOTratingTObs1($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id))) :
                                                        echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                                    else :
                                                        echo rawRate(fetchCOTratingTObs1($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id), $position);
                                                    endif;
                                                    ?>
                                    </td>
                                    <td class="text-center text-success">
                                        <?php
                                                    if (empty(fetchCOTratingTObs2($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id))) :
                                                        echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                                    else :
                                                        echo rawRate(fetchCOTratingTObs2($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id), $position);
                                                    endif;
                                                    ?>
                                    </td>
                                     <td class="text-center text-success">
                                        <?php
                                                    if (empty(fetchCOTratingTObs3($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id))) :
                                                        echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                                    else :
                                                        echo rawRate(fetchCOTratingTObs3($conn, $teacher_id,$ind['indicator_id'], $sy_id, $school_id), $position);
                                                    endif;
                                                    ?>
                                    </td>
                                     <td class="text-center text-success">
                                        <?php
                                                    if (empty(fetchCOTratingTObs4($conn, $teacher_id,$ind['indicator_id'], $sy_id, $school_id))) :
                                                        echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                                    else :
                                                        echo rawRate(fetchCOTratingTObs4($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id), $position);
                                                    endif;
                                                    ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-center font-weight-bold text-success"><?php echo rawRate(fetchIndicatorAVGt($conn, $teacher_id, $ind['indicator_id'], $sy_id, $school_id), $position) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?></td>
                            </tr>
                        </tbody>
                <?php endforeach;
                endwhile; ?>
                </table>
            </div>
            </div>


        </div>