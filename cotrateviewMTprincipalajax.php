<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';

$teacher_id = $_GET['teacher'];
$school_id = $_GET['sch'];
$sy_id = $_GET['sy'];
$obs = $_GET['obs'];

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

$positionQry = $conn->query("SELECT * FROM account_tbl WHERE `user_id` = '$teacher_id' ");
while ($result = $positionQry->fetch_assoc()) :
    $position = $result['position'];

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
                            <b>Teacher Observed:</b> <?= displayname($conn, $teacher_id) ?><br />
                            <b>School :</b> <?= displaySchool($conn, $school_id) ?>
                        </p>

                    </div>
                    <div class="col">
                        <?php $qry = $conn->query("SELECT rater FROM account_tbl WHERE `user_id` = $teacher_id");
                            while ($row = $qry->fetch_assoc()) :
                                $rater = $row['rater'] ?? "---";
                                ?>
                            <p>
                                <b> Rater:</b> <?= displayName($conn, $rater) ?><br />
                                <b> School Year:</b> <?= displaySY($conn, $sy_id) ?><br />
                            </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead class="alert alert-primary">
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
                            <td class="font-weight-bold"><?php echo $num++ . '.'; ?></td>
                            <td class="font-italic"><?= displayMTindicator($conn, $ind['indicator_id']) ?? "---"; ?></td>




                            <td class="text-center text-primary">
                                <?php

                                        if (empty(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id))) :
                                            echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                        else :
                                            echo rawRate(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id), $position);
                                        endif;   ?>
                            </td>



                        </tr>
                    </tbody>
            <?php endforeach;
            endwhile; ?>
            </table>
        </div>
        </div>
    </div>