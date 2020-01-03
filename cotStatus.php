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


if(isset($_GET['notif'])):
    if($_GET['notif'] == 'wrongpassword'):
        echo '<div class="red-notif-border">Wrong password entered.</div>';
    endif;
endif;

       

if(isset($_GET['ratecot'])):
    $period_result = $_GET['ratecot'];
   
        showModal('confirmRate');
endif;

if(isset($_GET['ratecotMT'])):
    $period_resultMT = $_GET['ratecotMT'];
   
        showModal('confirmRateMT');
endif;
?>


<div id="confirmRate" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                   
        <?php
        $date = date('Y/m/d');
        $intdate = intval(strtotime($date));
        $first_period_int = intval(strtotime($_SESSION['first_period']));
        $second_period_int = intval(strtotime($_SESSION['second_period']));
        $third_period_int = intval(strtotime($_SESSION['third_period']));
        $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                if ($intdate >= $fourth_period_int) :
                    $period = 4;
                elseif ($intdate >= $third_period_int) :
                    $period = 3;
                elseif ($intdate >= $second_period_int) :
                    $period = 2;
                elseif ($intdate >= $first_period_int) :
                    $period = 1;
                else :
                    $period = "Invalid Period";
                endif;

        if($period_result == $period):
            echo  '<div class="tomato-color font-italic font-weight-bold"><h4>Are you sure you want to rate teacher for Period '. $period_result.' ?</h4></div>
                    <a href="setcotform.php">Proceed</a>';
        else:
            echo '<div class="tomato-color font-italic font-weight-bold"><h4>You are about to rate teacher that is past the scheduled period.</h4></div>
            <div class="tomato-color font-italic font-weight-bold"><h4>Please enter Principal Password to proceed.</h4></div>
            ';?>

            <form action="cotstatusrate.php" id="form" method="POST">
            <label><strong>Enter Principal Password:</strong></label>
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>">
            <input type="password" name="pass">
            <input type="submit" value="Go" class="btn btn-primary" name="password_sub">
        </form>
<?php
        endif;
?>                
        

                </div>
            </div>
        </div>
</div>



<div id="confirmRateMT" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                   
        <?php
        $date = date('Y/m/d');
        $intdate = intval(strtotime($date));
        $first_period_int = intval(strtotime($_SESSION['first_period']));
        $second_period_int = intval(strtotime($_SESSION['second_period']));
        $third_period_int = intval(strtotime($_SESSION['third_period']));
        $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                if ($intdate >= $fourth_period_int) :
                    $period = 4;
                elseif ($intdate >= $third_period_int) :
                    $period = 3;
                elseif ($intdate >= $second_period_int) :
                    $period = 2;
                elseif ($intdate >= $first_period_int) :
                    $period = 1;
                else :
                    $period = "Invalid Period";
                endif;

        if($period_resultMT == $period):
            echo  '<div class="tomato-color font-italic font-weight-bold"><h4>Are you sure you want to rate teacher for Period '. $period_resultMT.' ?</h4></div>
                    <a href="setcotformMT.php">Proceed</a>';
        else:
            echo '<div class="tomato-color font-italic font-weight-bold"><h4>You are about to rate teacher that is past the scheduled period.</h4></div>
            <div class="tomato-color font-italic font-weight-bold"><h4>Please enter Principal Password to proceed.</h4></div>
            ';?>

            <form action="cotstatusrateMT.php" id="form" method="POST">
            <label><strong>Enter Principal Password:</strong></label>
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>">
            <input type="password" name="pass">
            <input type="submit" value="Go" class="btn btn-primary" name="password_sub">
        </form>
<?php
        endif;
?>                
        

                </div>
            </div>
        </div>
</div>


 
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="p-2">
            <h2>Class Observation Status</h2>
        </div>
    </div>

      <div class="container">
    <div class='black-border'>
         <strong>Legend:</strong> <br>
        <i class="fa fa-check-circle text-success"></i> <?php echo " - Rating has been completed <br>"; ?>
        <i class="fa fa-times-circle text-danger"></i> <?php echo " - Rating is not yet conducted <br>"; ?>
        <strong> Note: </strong><br>
        <div class="tomato-color">You can click the icons for possible options.</div>
    </div>

</div>  
<br>

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
                             <td><?= RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<a href="cotstatus.php?ratecot=1"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecot=2"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecot=3"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                                    <td><?= RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'], $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaytcotprogress.php?user_id='.$t_res["user_id"].'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecot=4"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                            <td><?php
                                    if (
                                        RPMSdb::TcheckResult_Obs1($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs2($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs3($conn, $t_res['user_id'], $sy, $school) &&
                                        RPMSdb::TcheckResult_Obs4($conn, $t_res['user_id'], $sy, $school)
                                    ) :
                                        echo 'Complete';
                                    else : echo 'Incomplete';
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
            <table class="table table-sm table-responsive-sm table-bordered table-hover">
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

                            <td><?= RPMSdb::MTcheckResult_Obs1($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=1"><i class="fa fa-check-circle text-success"></i></a>' : '<a href="cotstatus.php?ratecotMT=1"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs2($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=2"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecotMT=2"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs3($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=3"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecotMT=3"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>
                            <td><?= RPMSdb::MTcheckResult_Obs4($conn, $mt_user, $_SESSION['active_sy_id'], $_SESSION['school_id']) ?
                                        '<a href="displaymtcotprogress.php?user_id='.$mt_user.'&obs=4"><i class="fa fa-check-circle text-success"></i></a>'  : '<a href="cotstatus.php?ratecotMT=4"><i class="fa fa-times-circle text-danger"></i></a>'; ?></td>

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