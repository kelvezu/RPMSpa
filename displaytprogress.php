<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';

?>


<div class="container">

<div class="card text-center">
    <div class="card-header h4 bg-success text-white text-center">
Teacher Progress View
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
                    if (isset($teacherMasterlist_results)) :
                        foreach ($teacherMasterlist_results as $teacher) :

                            $teachername = $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname'];
                            ?>
                            <tbody>
                                <tr>
                                    <td width="20%"><?php echo $teachername; ?></td>
                                    <td width="20%"><?php echo $teacher['position']; ?></td>
                                    <td width="20%"><?= ((RPMSdb::isEsatCompleteBool($conn, $teacher['position'], $teacher['user_id']))) ?
                                        '<a href="redisplaytchart.php?user_id='.$teacher["user_id"].'"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs1($conn, $teacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$teacher["user_id"].'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs2($conn, $teacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$teacher["user_id"].'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs3($conn, $teacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$teacher["user_id"].'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
                            <td><?= RPMSdb::TcheckResult_Obs4($conn, $teacher['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$teacher["user_id"].'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<i class="fa fa-times-circle text-danger"></i>'; ?></td>
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