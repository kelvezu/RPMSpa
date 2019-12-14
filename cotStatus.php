<?php

use RPMSdb\RPMSdb;

$num_t = 1;
$num_mt = 1;
$obsMTperiod = 0;


include 'sampleheader.php';
$school = $_SESSION['school_id'];
$sy = $_SESSION['active_sy_id'];
$teacher_result = RPMSdb::fetchtallT($conn, $_SESSION['school_id']);

// pre_r($teacher_result);
$masterteacher_result = RPMSdb::fetchtallMT($conn, $_SESSION['school_id']);

// $hasCOT2T = RPMSdb::TcheckResult_Obs2($conn, $_SESSION['user_id']);
// $hasCOT3T = RPMSdb::TcheckResult_Obs3($conn, $_SESSION['user_id']);
// $hasCOT4T = RPMSdb::TcheckResult_Obs4($conn, $_SESSION['user_id']);


?>
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="p-2">
            <h2>Class Observation Status</h2>
        </div>
    </div>

    <div class="row">
        <!-- Column for T -->
        <div class="col">
            <table class="table table-sm table-responsive-sm table-bordered table-hover">
                <thead class=" alert alert-success text-center">

                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th>Status</th>
                    </tr>


                </thead>
                <tbody class="text-center font-weight-bold">
                    <?php foreach ($teacher_result as $t_res) : ?>
                        <tr>
                            <td><?= $num_t++ ?></td>
                            <td><?= displayname($conn, $t_res['user_id']) ?></td>
                            <td><?= $t_res['position'] ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id'], $sy, $school) ?
                                        '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id'], $sy, $school) ?
                                        '<i class="fa fa-check-circle text-success"></i>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id'], $sy, $school) ?
                                        '<i class="fa fa-check-circle text-success"></i>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'], $sy, $school) ?
                                        '<i class="fa fa-check-circle text-success"></i>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?php
                                    if (
                                        RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'], $sy, $school)
                                    ) :
                                        echo '<a class="btn btn-success btn-sm text-white">View Rating</a>';
                                    else : echo '---';
                                    endif;
                                    ?>
                            </td>
                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>
        <!-- End Column for T -->

        <!-- Column for MT -->
        <div class="col">
            <table class="table table-sm table-responsive-sm table-bordered">
                <thead class=" alert alert-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center font-weight-bold">
                    <?php
                    foreach ($masterteacher_result as $mt_res) :
                        $mt_user = $mt_res['user_id'];
                        $mt_rater = $mt_res['rater'];

                        ?>
                        <tr>
                            <td><?= $num_mt++ ?></td>
                            <td><?= displayname($conn, $mt_user) ?></td>
                            <td><?= $mt_res['position'] ?></td>

                            <td><?= $mtcot1 = RPMSdb::MTcheckResult_Obs1($conn, $mt_user, $sy, $school) ?
                                        '<i class="fa fa-check-circle text-primary"></i>' : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?> </td>

                            <td><?= $mtcot2 =  RPMSdb::MTcheckResult_Obs2($conn, $mt_user, $sy, $school) ?
                                        '<i class="fa fa-check-circle text-primary"></i>'  : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?></td>

                            <td><?= $mtcot3 =  RPMSdb::MTcheckResult_Obs3($conn, $mt_user, $sy, $school) ?
                                        '<i class="fa fa-check-circle text-primary"></i>'  : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?></td>

                            <td><?= $mtcot4 =  RPMSdb::MTcheckResult_Obs4($conn, $mt_user, $sy, $school) ?
                                        '<i class="fa fa-check-circle text-primary"></i>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>

                            <td><?php
                                    if (
                                        RPMSdb::MTcheckResult_Obs1($conn, $mt_user, $sy, $school) &&
                                        RPMSdb::MTcheckResult_Obs2($conn, $mt_user, $sy, $school) &&
                                        RPMSdb::MTcheckResult_Obs3($conn, $mt_user, $sy, $school) &&
                                        RPMSdb::MTcheckResult_Obs4($conn, $mt_user, $sy, $school)
                                    ) :
                                        echo '<a class="btn btn-primary btn-sm text-white">View Rating</a>';
                                    else : echo '---';
                                    endif;
                                    ?>
                            </td>

                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>
        <!-- End Column for MT -->
    </div>
</div>

<?php include 'samplefooter.php'; ?>