<?php

use RPMSdb\RPMSdb;

$num_t = 1;
$num_mt = 1;
$obsMTperiod = 0;


include 'sampleheader.php';
$school = $_SESSION['school_id'];
$sy = $_SESSION['active_sy_id'];
$teacher_result = RPMSdb::fetchtallTrate($conn, $_SESSION['school_id'], $_SESSION['user_id']);


?>
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="p-2">
            <h2>Class Observation Status of Teachers that I Rate</h2>
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
                    <?php 
                    if(($teacher_result) > 0):
                    foreach ($teacher_result as $t_res) : ?>
                        <tr>
                            <td><?= $num_t++ ?></td>
                            <td><?= displayname($conn, $t_res['user_id']) ?></td>
                            <td><?= $t_res['position'] ?></td>
                             <td><?= RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
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
                        <?php endforeach; 
                        else:
                        echo "<div class='red-notif-border'>No Record Found</div>";
                        endif;?>
                        </tr>
                </tbody>
            </table>
        </div>
        <!-- End Column for T -->
<?php

$masterteacher_result = RPMSdb::fetchtallMTrate($conn, $_SESSION['school_id'],$_SESSION['user_id']);
?>



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
                    if(($masterteacher_result) > 0):
                    foreach ($masterteacher_result as $mt_res) :
                        $mt_user = $mt_res['user_id'];
                        $mt_rater = $mt_res['rater'];

                        ?>
                        <tr>
                            <td><?= $num_mt++ ?></td>
                            <td><?= displayname($conn, $mt_user) ?></td>
                            <td><?= $mt_res['position'] ?></td>

                            <td><?= RPMSdb::MTcheckResult_Obs1($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs2($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs3($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs4($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>

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

                        <?php endforeach; 
                        else: echo "<div class='red-notif-border'>No Record Found</div>";
                    endif;?>
                        </tr>
                </tbody>
            </table>
        </div>
        <!-- End Column for MT -->
    </div>
</div>

<?php include 'samplefooter.php'; ?>