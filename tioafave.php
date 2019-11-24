<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';

$rater_id = "";
$rater_id2 = "";
$rater_id3 = "";
$date = "";
$tobserved = "";
$obs_period = "";
$sy = "";
$school = "";



$query = $conn->query('SELECT mtindicator_tbl.indicator_id,mtindicator_tbl.indicator_name,a_mtioafrating_tbl.* FROM (a_mtioafrating_tbl INNER JOIN mtindicator_tbl ON a_mtioafrating_tbl.indicator_id = mtindicator_tbl.indicator_id) WHERE a_mtioafrating_tbl.user_id = 32 ');
if ($query) :
    while ($row = $query->fetch_assoc()) :

        $rater_id = $row['rater_id1'];
        $rater_id2 = $row['rater_id2'] ?? "NULL";
        $rater_id3 = $row['rater_id3'] ?? "NULL";
        $date = $row['date'];
        $tobserved = 33;
        $obs_period = $row['obs_period'];
        $sy = $row['sy'];
        $school = $row['school_id'];
    endwhile;

endif;

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
            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <div class="row">
                <div class="col">
                    <p>
                        <b>Teacher Observed:</b> <?= displayname($conn, $tobserved) ?><br />
                        <b>School :</b> <?= displaySchool($conn, $school) ?>
                    </p>

                </div>
                <div class="col">
                    <p>
                        <b> OBSERVER:</b> <?= displayname($conn, $rater_id) ?><br />
                        <b> School Year:</b> <?= displaySY($conn, $sy) ?><br />
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead class="alert alert-success">
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
                $query1 = $conn->query('SELECT * FROM mtindicator_tbl ');
                $num = 1;
                while ($rows = $query1->fetch_assoc()) :
                    $indicator_no = $rows['mtindicator_id'];
                    $indicator_name = $rows['mtindicator_name'];
                    ?>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold"><?php echo $indicator_no . '.' ?></td>
                            <td class="font-italic"><?php echo $indicator_name; ?></td>
                            <td class="font-weight-bold text-center">
                                <p><?= $obs1 = showObsRatingMT($conn, 1, $indicator_no, 33, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "-" ?></p>
                            </td>
                            <td class="font-weight-bold text-center">
                                <p><?= $obs2 = showObsRatingMT($conn, 2, $indicator_no, 33, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "-" ?></p>
                            </td>
                            <td class="font-weight-bold text-center">
                                <p><?= $obs3 = showObsRatingMT($conn, 3, $indicator_no, 33, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "-" ?></p>
                            </td>
                            <td class="font-weight-bold text-center">
                                <p><?= $obs4 = showObsRatingMT($conn, 4, $indicator_no, 33, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?? "-" ?></p>
                            </td>
                            <td class=" text-center font-weight-bold apple-color"><?= showObsAverage($obs1, $obs2, $obs3, $obs4) ?? "-"  ?></p>
                            </td>
                        </tr>
                    </tbody>
                <?php
                    $indicator_no++;
                endwhile; ?>
            </table>



        </div>
    </div>

    <div class="container">

        <?php
        pre_r(RPMSdb::fetchCOTrating($conn, 32, 1, $_SESSION['active_sy_id'], $_SESSION['school_id'], 'a_tioafrating_tbl', 'b_tioafrating_tbl'));
        ?>
    </div>


















</div>



<br>
<?php
include 'samplefooter.php';
?>