<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';

?>


<div class="container">

<div class="card text-center">
    <div class="card-header h4 bg-info text-white text-center">
Master Teacher Progress View
    </div>
    <div class="card-body">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>ESAT</th>
                            <th colspan="4" class="text-center">COT</th>
                            <th>IPCRF</th>
                            <th>DEVELOPMENT PLAN</th>

                        </tr>
                    </thead>
                    <?php
                    if (isset($masterteacherMasterlist_results)) :
                        foreach ($masterteacherMasterlist_results as $masterteacher) :

                            $masterteachername = $masterteacher['firstname'] . ' ' . substr($masterteacher['middlename'], 0, 1) . '. ' . $masterteacher['surname'];
                            ?>
                            <tbody>
                                <tr>
                                    <td width="20%"><?php echo $masterteachername; ?></td>
                                    <td width="20%"><?php echo $masterteacher['position']; ?></td>
                                    <td width="20%"><?= ((RPMSdb::isEsatCompleteBool($conn, $masterteacher['position'], $masterteacher['user_id']))) ?
                                        '<a href="redisplaymtchart.php?user_id='.$masterteacher["user_id"].'"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs1($conn, $masterteacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$masterteacher["user_id"].'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs2($conn, $masterteacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$masterteacher["user_id"].'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs3($conn, $masterteacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$masterteacher["user_id"].'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs4($conn, $masterteacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$masterteacher["user_id"].'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= '<i class="fa fa-times-circle text-danger"></i>'; ?></td>


                                </tr>
                        <?php
                            endforeach;
                        else :
                            echo 'no record';

                        endif;
                        ?>

                            </tbody>
                </table>
    </div>
</div>
</div>


       


<?php include 'samplefooter.php'; ?>