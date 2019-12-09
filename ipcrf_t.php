<?php

use IPCRF\IPCRF;

include 'sampleheader.php';
$num = 1;
$kra_num = 0;
$tobj_num = 1;
$position = $_SESSION['position'];
$kras = displayKRAandOBJ($conn, $position);
$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$school = $_SESSION['school_id'];
$rater = $_SESSION['rater'];
$app_auth = $_SESSION['approving_authority'] ?? 0;

$ipcrf = new IPCRF($user, $sy, $school, $position);
?>



<div class="container-fluid">
    <!-- <?php echo $position ?> -->
    <?php
    if (!$kras) :
        ?>
        <p class="text-center red-notif-border m-5">No result!</p>
    <?php
        include 'samplefooter.php';
        exit();
    endif;
    ?>

    <div class="d-flex justify-content-center">
        <div class="h4"><strong> Teacher Individual Performance Commitment and Review Rating Sheet </strong></div>
    </div>

    <table id="rating" class="table  table-sm table-responsive-sm  table-bordered">
        <thead class="bg-success text-white">
            <tr>
                <th rowspan="2" class="text-center">
                    <p>#</p>
                </th>
                <th rowspan="2" class="text-center">
                    <p>KRA</p>
                </th>
                <th rowspan="2" class="text-center">
                    <p>Objective</p>
                </th>
                <th rowspan=" 2" class="text-center">
                    <p>Weight per Objective</p>
                </th>
                <th colspan="3" class="text-center">
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
        <form action="includes/processIPCRFt.php" method="post">
            <input type="hidden" name="user" value="<?php echo $user ?>">
            <input type="hidden" name="position" value="<?php echo $position ?>">
            <input type="hidden" name="sy" value="<?php echo $sy ?>">
            <input type="hidden" name="school" value="<?php echo $school ?>">
            <input type="hidden" name="app_auth" value="<?php echo $app_auth ?>">
            <input type="hidden" name="rater" id="" value="<?php echo $rater ?>">
            <tbody>
                <?php foreach ($kras as $kra) : ?>
                    <tr>
                        <td>
                            <p class="text-center"><?= $num++ ?></p>
                        </td>
                        <!-- KRA  -->
                        <td rowspan="4">
                            <p class="font-weight-bold">
                                <?php echo $kra['kra_id'] . '---' . trim(displayKRA($conn, $kra['kra_id'])); ?>
                            </p>
                        </td>
                        <!-- END OF KRA -->


                        <!-- DISPLAY OBJECTIVE -->
                        <td>
                            <p><?php echo $kra['tobj_id'] . ' - ' . displayObjectiveT($conn, $kra['tobj_id']); ?></p>
                        </td>
                        <!-- END DISPLAY OBJECTIVE  -->

                        <!-- DISPLAY WEIGHT per OBJECTIVE -->
                        <td>

                            <p class="font-weight-bold text-center">
                                <?php echo showPercent(displayOBJweightT($conn, $kra['kra_id'])) . '%' ?>
                            </p>


                        </td>
                        <!-- DISPLAY WEIGHT per OBJECTIVE -->

                        <!-- DISPLAY QUALITY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <!-- THIS WILL SHOW THE INDICATOR AVG OF OBJECTIVE 1  -->
                                <?php
                                    if ($kra['tobj_id'] == 1) : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->getIndicatorAVGt(1) ?? 0 ?>">

                                <?php elseif ($kra['tobj_id'] == 3) : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->getIndicatorAVGt(2) ?? 0; ?>">

                                <?php elseif ($kra['tobj_id'] == 4) : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->getIndicatorAVGt(3) ?? 0; ?>">

                                <?php elseif ($kra['tobj_id'] == 5) : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->getIndicatorAVGt(4) ?? 0; ?>">

                                <?php elseif ($kra['tobj_id'] == 7) : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->getIndicatorAVGt(5) ?? 0; ?>">

                                <?php else : ?>
                                    <input type="hidden" name="kra[]" value="<?php echo $kra['kra_id'] ?>">
                                    <input type="hidden" name="obj[]" value="<?php echo $kra['tobj_id'] ?>">
                                    <input class="form-control-sm text-center" type="text" name="quality[]" id="" value="<?php echo $ipcrf->countMOV($kra['kra_id'], $kra['tobj_id'], 'mov_main_t_attach_tbl') ?? 0; ?>">

                                <?php endif; ?>
                                <!-- ------------------------------------------------- -->
                            </p>
                        </td>
                        <!-- END DISPLAY QUALITY -->

                        <!-- DISPLAY EFFICIENCY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <input class="form-control-sm text-center" type="text" name="efficiency[]" value=" <?php echo  $ipcrf->getEfficiency($kra['kra_id'], $kra['tobj_id'], 'mov_supp_t_attach_tbl')  ?? 0 ?>">
                            </p>
                        </td>
                        <!-- END DISPLAY EFFICIENCY -->

                        <!-- DISPLAY TIMELINESS -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <?php if ($kra['tobj_id'] == 2) : ?>
                                    <select name="timeliness[]" class="form-control">
                                        <option value=5>
                                            <?php echo trim('Presented the research report within the rating period') ?>
                                        </option>
                                        <option value=4>
                                            <?php echo trim('Completed the research report within the rating period') ?>
                                        </option>
                                        <option value=3>
                                            <?php echo trim('Conducted the research report within the rating period') ?>
                                        </option>
                                        <option value=2>
                                            <?php echo trim('Proposed the research report within the rating period') ?>
                                        </option>
                                        <option value=1>
                                            <?php echo trim('No acceptable evidence was shown') ?>
                                        </option>
                                    <?php else : echo "-----"; ?>
                                        <input type="hidden" name="timeliness[]" value=0>
                                    <?php endif ?>
                                    </select>
                            </p>
                        </td>
                        <!-- END DISPLAY TIMELINESS -->

                        <!-- DISPLAY AVERAGE -->
                        <!-- <td>
                            <p class="font-weight-bold text-center">AVERAGE</p>
                        </td> -->
                        <!--END  DISPLAY AVERAGE -->

                        <!-- DISPLAY SCORE -->
                        <!-- <td>
                            <p class="font-weight-bold text-center">SCORE</p>
                        </td> -->
                        <!-- END DISPLAY SCORE -->
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

        <!-- <tfoot>
            <tr>
                <td colspan="5" class="bg-dark">

                </td>
                <td colspan="2" class="text-left px-5">
                    <input type="number" name="f_rating" id="f_rating" class="input form-control" disabled> -->
        <!-- <p><strong>Final Rating: </strong> 9sdsad.9%</p>
        <p><strong>Adjectival Rating:</strong> 99.9%</p>
        </td>


        </tr>




        </tfoot> -->
    </table>

</div>


<br>
<?php include 'samplefooter.php'; ?>