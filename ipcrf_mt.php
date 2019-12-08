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
        <div class="h4"><strong> Master Teacher Individual Performance Commitment and Review Rating Sheet </strong></div>
    </div>
    <form action="includes/processtipcrf.php" method="POST">
        <table id="rating" class="table  table-sm table-responsive-sm  table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th rowspan="2" class="text-center" width="2%">
                        <p>#</p>
                    </th>
                    <th rowspan="2" class="text-center" width="8%">
                        <p>KRA</p>
                    </th>
                    <th rowspan="2" class="text-center" width="20%">
                        <p>Objective</p>
                    </th>
                    <th rowspan="2" class="text-center" width="6%">
                        <p>Weight per Objective</p>
                    </th>
                    <th colspan="4" class="text-center">
                        <p>Numerical Ratings</p>
                    </th>
                    <th rowspan="2" class="text-center" width="6%">
                        <p>Score</p>
                    </th>
                </tr>
                <tr>
                    <th class="text-center" width="3%">
                        <p>Quality</p>
                    </th>
                    <th class="text-center" width="3%">
                        <p>Efficiency</p>
                    </th>
                    <th class="text-center" width="3%">
                        <p>Timeliness</p>
                    </th>
                    <th class="text-center" width="3%">
                        <p>Average </p>
                    </th>
                </tr>
            </thead>
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
                            <p><?php echo $kra['mtobj_id'] . ' - ' . displayObjectiveMT($conn, $kra['mtobj_id']); ?></p>
                        </td>
                        <!-- END DISPLAY OBJECTIVE  -->

                        <!-- DISPLAY WEIGHT per OBJECTIVE -->
                        <td>

                            <p class="font-weight-bold text-center">
                                <?php echo showPercent(displayOBJweightMT($conn, $kra['kra_id'])) . '%' ?>
                            </p>


                        </td>
                        <!-- DISPLAY WEIGHT per OBJECTIVE -->

                        <!-- DISPLAY QUALITY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <!-- THIS WILL SHOW THE INDICATOR AVG OF OBJECTIVE 1  -->
                                <?php
                                    if ($kra['mtobj_id'] == 1) : echo ($ipcrf->getIndicatorAVGmt(1)) ?? 0;
                                    elseif ($kra['mtobj_id'] == 3) : echo ($ipcrf->getIndicatorAVGmt(2)) ?? 0;
                                    elseif ($kra['mtobj_id'] == 4) : echo ($ipcrf->getIndicatorAVGmt(3)) ?? 0;
                                    elseif ($kra['mtobj_id'] == 5) : echo ($ipcrf->getIndicatorAVGmt(4)) ?? 0;
                                    elseif ($kra['mtobj_id'] == 7) : echo ($ipcrf->getIndicatorAVGmt(5)) ?? 0;
                                    else :   echo $ipcrf->countMOV($kra['kra_id'], $kra['mtobj_id'], 'mov_main_mt_attach_tbl') ?? 0;
                                    endif; ?>
                                <!-- ------------------------------------------------- -->
                            </p>
                        </td>
                        <!-- END DISPLAY QUALITY -->

                        <!-- DISPLAY EFFICIENCY -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <?php echo  $ipcrf->getEfficiency($kra['kra_id'], $kra['mtobj_id'], 'mov_supp_mt_attach_tbl')  ?? 0 ?>
                            </p>
                        </td>
                        <!-- END DISPLAY EFFICIENCY -->

                        <!-- DISPLAY TIMELINESS -->
                        <td>
                            <p class="font-weight-bold text-center">TIMELINESS</p>
                        </td>
                        <!-- END DISPLAY TIMELINESS -->

                        <!-- DISPLAY AVERAGE -->
                        <td>
                            <p class="font-weight-bold text-center">AVERAGE</p>
                        </td>
                        <!--END  DISPLAY AVERAGE -->

                        <!-- DISPLAY SCORE -->
                        <td>
                            <p class="font-weight-bold text-center">SCORE</p>
                        </td>
                        <!-- END DISPLAY SCORE -->
                    </tr>
            </tbody>
        <?php endforeach; ?>

        <tfoot>
            <tr>
                <td colspan="7" class="bg-dark">

                </td>
                <td colspan="2" class="text-left px-5">
                    <!-- <input type="number" name="f_rating" id="f_rating" class="input form-control" disabled> -->
                    <p><strong>Final Rating: </strong> 99.9%</p>
                    <p><strong>Adjectival Rating:</strong> 99.9%</p>
                </td>


            </tr>




        </tfoot>
        </table>
    </form>

</div>


<br>
<?php include 'samplefooter.php'; ?>