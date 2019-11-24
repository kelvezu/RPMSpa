<?php

use RPMSdb\RPMSdb;

$num_t = 1;
$num_mt = 1;
$obsMTperiod = 0;

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
                <tbody class="text-center font-weight-bold">
                    <?php foreach ($masterteacher_result as $mt_res) : ?>
                        <tr>
                            <td><?= $num_mt++ ?></td>
                            <td><?= displayname($conn, $mt_res['user_id']) ?></td>
                            <td><?= $mt_res['position'] ?></td>

                            <td><?= $mtcot1 = RPMSdb::MTcheckResult_Obs1($conn, $mt_res['user_id']) ?
                                        '<a data-toggle="modal" data-target="#viewCOTmodalMT1' . $mt_res['user_id'] . '"> <li class="fa fa-check-circle text-success"></li></a>' : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?> </td>

                            <td><?= $mtcot2 =  RPMSdb::MTcheckResult_Obs2($conn, $mt_res['user_id']) ?
                                        '<a data-toggle="modal" data-target="#viewCOTmodalMT2' . $mt_res['user_id'] . '"> <li class="fa fa-check-circle text-success"></li></a>' : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?></td>

                            <td><?= $mtcot3 =  RPMSdb::MTcheckResult_Obs3($conn, $mt_res['user_id']) ?
                                        '<a data-toggle="modal" data-target="#viewCOTmodalMT3' . $mt_res['user_id'] . '"> <li class="fa fa-check-circle text-success"></li></a>' : '<i class="fa fa-times-circle text-danger"></i>';
                                    ?></td>

                            <td><?= $mtcot4 =  RPMSdb::MTcheckResult_Obs4($conn, $mt_res['user_id']) ?
                                        '<a data-toggle="modal" data-target="#viewCOTmodalMT4' . $mt_res['user_id'] . '"> <li class="fa fa-check-circle text-success"></li></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>

                            <td><?php
                                    if (
                                        RPMSdb::MTcheckResult_Obs1($conn, $mt_res['user_id']) &&
                                        RPMSdb::MTcheckResult_Obs2($conn, $mt_res['user_id']) &&
                                        RPMSdb::MTcheckResult_Obs3($conn, $mt_res['user_id']) &&
                                        RPMSdb::MTcheckResult_Obs4($conn, $mt_res['user_id'])
                                    ) :
                                        echo '<a class="btn btn-sm btn-primary text-white">View Rating</a>';
                                    else : echo '---';
                                    endif;
                                    ?>
                            </td>
                            <!-- View COT MT Obs1 Period Modal -->
                            <div class="modal fade" id="viewCOTmodalMT1<?= $mt_res['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Observation Period 1 </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->

                            <!-- View COT MT Obs2 Period Modal -->
                            <div class="modal fade" id="viewCOTmodalMT2<?= $mt_res['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Observation Period 2 </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->

                            <!-- View COT MT Obs3 Period Modal -->
                            <div class="modal fade" id="viewCOTmodalMT3<?= $mt_res['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Observation Period 3 </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->

                            <!-- View COT MT Obs4 Period Modal -->
                            <div class="modal fade" id="viewCOTmodalMT4<?= $mt_res['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Observation Period 4 </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal -->
                        <?php endforeach; ?>
                        </tr>
                </tbody>


            </table>
        </div>
        <!-- End Column for MT -->
    </div>
</div>
<?php include 'samplefooter.php'; ?>