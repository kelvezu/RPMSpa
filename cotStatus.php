<?php

use RPMSdb\RPMSdb;

$num_t = 1;
$num_mt = 1;

include 'sampleheader.php';
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
                            <td><?= $tcot1 = RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id']) ?  '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= $tcot2 =  RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id']) ?  '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= $tcot3 =  RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id']) ?  '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= $tcot4 =  RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id']) ?  '<i class="fa fa-check-circle text-success"></i>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?php
                                    if (
                                        RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id']) &&
                                        RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id']) &&
                                        RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id']) &&
                                        RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'])
                                    ) :
                                        echo '<a class="btn btn-sm btn-success text-white">View Rating</a>';
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
                <tbody>
                    <?php foreach ($masterteacher_result as $mt_res) : ?>
                        <tr>
                            <td><?= $num_mt++ ?></td>
                            <td><?= displayname($conn, $mt_res['user_id']) ?></td>
                            <td><?= $mt_res['position'] ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <?php endforeach; ?>
                        </tr>
                </tbody>


            </table>
        </div>
        <!-- End Column for MT -->
    </div>
</div>
<?php include 'samplefooter.php'; ?>