<?php

use IPCRF\IPCRF;
use RPMSdb\RPMSdb;

include 'sampleheader.php';


$num = 1;
$kra_num = 0;
$tobj_num = 1;
// $position = ($_SESSION['position']) ? $_SESSION['position'] : "No Position!";

// $user = $_SESSION['user_id'];
$sy = ($_SESSION['active_sy_id']) ? $_SESSION['active_sy_id'] : "No School Year!";
$school = ($_SESSION['school_id']) ? $_SESSION['school_id'] : "No Rater!";
$rater = ($_SESSION['user_id']) ? $_SESSION['rater'] : "No Rater!";
$app_auth = ($_SESSION['approving_authority']) ? $_SESSION['approving_authority'] : "No Approving Authority!";

if (isset($_POST['select_user'])) :
    $user = $_POST['user_id'];
    $position = displayPosition($conn, $user);
    $kras = displayKRAandOBJ($conn, $position);
    $ipcrf = new IPCRF($user, $sy, $school, $position);
endif;

?>

<div class="container mb-5">
    <?php
    if (!empty($_GET['notif'])) {
        $notif = ($_GET['notif']);
        if ($notif == "Success") {
            echo '<p class="green-notif-border">IPCRF approved!</p>';
        } elseif ($notif == "ipcrfexist") {
            echo '<p class="red-notif-border">IPCRF already exist!</p>';
        }
    }
    ?>
    <div class="card">
        <div class="card-header">
            <p>Master Teacher with MOV's</p>
        </div>
        <div class="card-body overflow-auto">
            <!-- action="viewattachment.ratert.php" -->
            <form method="post">
                <input type="hidden" id="sy_id" name="sy_id" value="<?php echo $_SESSION['active_sy_id'] ?>">
                <input type="hidden" id="school_id" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">
                <input type="hidden" id="rater_id" name="rater_id" value="<?php echo $_SESSION['user_id'] ?>">
                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <select id="user_id" name="user_id" class="form-control-sm">
                            <option value="">--Select Master Teacher--</option>
                            <?php
                            foreach (rpmsdb::showRateesMT($conn, $_SESSION['user_id'],  $_SESSION['school_id']) as $ratees) : ?>
                                <option value=" <?php echo intval($ratees['user_id']) ?>"><?php echo displayName($conn, $ratees['user_id']) ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="select_user" class="btn btn-sm btn-primary">View IPCRF</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

?>



<div class="container-fluid">
    <!-- <?php echo $position ?> -->
    <?php if (!isset($kras)) : ?>
        <!-- <p class="text-center red-notif-border m-5">No Record!</p> -->
        ---
    <?php
        include 'samplefooter.php';
        exit();
    endif; ?>

    <div class="d-flex justify-content-center">
        <div class="h4"><strong> Teacher Individual Performance Commitment and Review Rating Sheet </strong></div>
    </div>

    <table id="rating" class="table  table-sm table-responsive-sm  table-bordered">
        <thead class="bg-dark font-weight-bold text-white">
            <tr>
                <th rowspan="2" class="text-center">
                    <p>#</p>
                </th>
                <th rowspan="2" class="text-center">
                    <p>KRA</p>
                </th>
                <th rowspan="2" class="text-center" width="20%">
                    <p>Objective</p>
                </th>

                <th rowspan=" 2" class="text-center">
                    <p>Weight per Objective</p>
                </th>

                <th rowspan="2" class="text-center" width="20%">
                    <p>Timeline</p>
                </th>

                <th colspan="4" class="text-center">
                    <p>Numerical Ratings</p>
                </th>
                <!-- <th rowspan="2" class="text-center">
                        <p>Score</p>
                    </th> -->
            </tr>
            <tr>
                <th class="text-center">
                    <p>Quality</p>
                </th>
                <th class="text-center">
                    <p>Efficiency</p>
                </th>
                <th class="text-center">
                    <p>Timeliness</p>
                </th>
                <!-- <th class="text-center" width="3%">
                    <p>Average </p>
                </th> -->
            </tr>
        </thead>
        <form action="includes/processIPCRFmt.php" method="post">
            <input type="hidden" name="user" value="<?php echo $user ?>">
            <input type="hidden" name="position" value="<?php echo $position ?>">
            <input type="hidden" name="sy" value="<?php echo $sy ?>">
            <input type="hidden" name="school" value="<?php echo $school ?>">
            <input type="hidden" name="app_auth" value="<?php echo $app_auth ?>">
            <input type="hidden" name="rater" id="" value="<?php echo $rater ?>">
            <tbody>
                <?php foreach ($kras as $kra) :
                    $kra_id = $kra['kra_id'];
                    $obj_id = $kra['mtobj_id'];
                    $mov_type = $kra['mov_type'];
                ?>
                    <tr>
                        <td>
                            <p class="text-center"><?= $num++ ?></p>
                        </td>
                        <!-- KRA  -->
                        <td rowspan="4">
                            <p class="font-weight-bold">
                                <?php echo trim(displayKRA($conn, $kra_id)); ?>
                            </p>
                        </td>
                        <!-- END OF KRA -->


                        <!-- DISPLAY OBJECTIVE -->
                        <td>
                            <p class=" font-italic"><?php echo $obj_id . ' - ' . displayObjectivemT($conn, $obj_id); ?></p>
                        </td>
                        <!-- END DISPLAY OBJECTIVE  -->



                        <!-- DISPLAY WEIGHT per OBJECTIVE -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <?php
                                echo showPercent(displayOBJweightmT($conn, $kra_id)) . '%';
                                $obj_weight = displayOBJweightmT($conn, $kra_id);
                                ?>
                                <input type="hidden" name="obj_weight[]" value="<?php echo $obj_weight ?? 0  ?>" />
                            </p>
                        </td>
                        <!-- DISPLAY WEIGHT per OBJECTIVE -->

                        <!-- DISPLAY TIMELINE -->
                        <td>
                            <textarea required class="form-control" name="timeline[]" cols="30" rows="2" class="text-justify">Year round.
                            </textarea>
                        </td>
                        <!-- DISPLAY TIMELINE -->



                        <!-- DISPLAY QUALITY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <!-- THIS WILL SHOW THE INDICATOR AVG OF OBJECTIVE 1  -->
                                <?php if ($mov_type == "COT") : $indicator = $kra['indicator_id'];
                                    $quality_rate =  $ipcrf->getIndicatorAVGmt($indicator);  ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra_id ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $obj_id ?>">
                                    <input class="form-control-sm text-center font-weight-bold" type="hidden" required step="any" name="quality[]" value="<?php echo $ipcrf->getQualityRange($quality_rate)  ?>" readonly>
                                    <p class="text-center font-weight-bold"><?php echo rawRate($ipcrf->getQualityRange($quality_rate), $position)  ?></p>

                                <?php else : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra_id ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $obj_id ?>">
                                    <input class="form-control-sm text-center" type="hidden" required step="any" name="quality[]" value="<?php echo $quality_rate =  $ipcrf->countMOV($kra_id, $obj_id, 'mov_main_mt_attach_tbl') ?? 1; ?>" reaonly>
                                    <p class="text-center font-weight-bold"><?php echo rawRate($quality_rate, $position) ?></p>

                                <?php endif; ?>
                                <!-- ------------------------------------------------- -->
                            </p>
                        </td>
                        <!-- END DISPLAY QUALITY -->

                        <!-- DISPLAY EFFICIENCY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <input class="form-control-sm text-center" type="hidden" required step="any" name="efficiency[]" value="<?php echo $efficiency_rate = $ipcrf->getEfficiency($kra_id, $obj_id, 'mov_supp_mt_attach_tbl')  ?? $efficiency_rate = 1 ?>">
                                <p class="text-center font-weight-bold"><?php echo  rawRate($efficiency_rate, $position)  ?></p>
                            </p>
                        </td>
                        <!-- END DISPLAY EFFICIENCY -->

                        <!-- DISPLAY TIMELINESS -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <?php $timeliness = $ipcrf->getTimeliness('perfmtindicator_tbl', $kra_id, $obj_id);
                                if ($timeliness) : ?>
                                    <select name="timeliness[]" class="form-control" required>
                                        <option readonly>
                                            --- Select Rate for Timeliness ---
                                        </option>
                                        <?php foreach ($timeliness as $time) : ?>
                                            <option value="<?= intval($time['level_no']) ?>"><?= rawRate($time['level_no'], $position) . ' - ' . $time['desc_name'] ?></option>
                                        <?php endforeach ?>
                                    <?php else : echo "-----"; ?>
                                        <input type="hidden" name="timeliness[]" value=0>
                                    <?php endif ?>
                                    </select>
                            </p>
                        </td>
                        <!-- END DISPLAY TIMELINESS -->
                    </tr>


            </tbody>
        <?php endforeach; ?>
        <tfoot>
            <tr>
                <td colspan="10">
                    <button class="btn btn-success" type="submit" name="submit_mt">submit</button>
                </td>
            </tr>
        </tfoot>

        </form>
    </table>

</div>


<br>
<?php include 'samplefooter.php'; ?>