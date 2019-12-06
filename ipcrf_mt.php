<?php include 'sampleheader.php';
$num = 1;
$kra_num = 0;
$tobj_num = 1;
$kras = displayKRAandOBJ($conn, $_SESSION['position']);
?>



<div class="container-fluid">

    <?php
    if (!$kras) : ?>
        <p class="text-center red-notif-border m-5">No result!</p>
    <?php
        include 'samplefooter.php';
        exit();
    endif; ?>

    <div class="d-flex justify-content-center">
        <div class="h4"><strong> Master Teacher Individual Performance Commitment and Review Rating Sheet </strong></div>
    </div>
    <form action="includes/processtipcrf.php" method="POST">
        <table id="rating" class="table table-striped table-bordered table-sm table-responsive-sm border bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th rowspan="2" class="text-center" width="6%">
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
                    <th class="text-center" width="6%">
                        <p>Quality</p>
                    </th>
                    <th class="text-center" width="6%">
                        <p>Efficiency</p>
                    </th>
                    <th class="text-center" width="6%">
                        <p>Timeliness</p>
                    </th>
                    <th class="text-center" width="6%">
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
                                <?php echo trim(displayKRA($conn, $kra['kra_id'])); ?>
                            </p>
                        </td>
                        <!-- END OF KRA -->


                        <!-- DISPLAY OBJECTIVE -->
                        <td>
                            <p><?php echo  displayObjectiveMT($conn, $kra['mtobj_id']); ?></p>
                        </td>
                        <!-- END DISPLAY OBJECTIVE  -->

                        <!-- DISPLAY KRA WEIGHT -->
                        <td>
                            <p class="font-weight-bold text-center">
                                <?php echo showPercent(displayOBJweightMT($conn, $kra['kra_id'])) . '%' ?>
                            </p>
                        </td>
                        <!-- DISPLAY KRA WEIGHT -->

                        <!-- DISPLAY QUALITY -->
                        <td>
                            <p class="font-weight-bold text-center">1</p>
                        </td>
                        <!-- END DISPLAY QUALITY -->

                        <!-- DISPLAY EFFICIENCY -->
                        <td>
                            <p class="font-weight-bold text-center">2</p>
                        </td>
                        <!-- END DISPLAY EFFICIENCY -->

                        <!-- DISPLAY TIMELINESS -->
                        <td>
                            <p class="font-weight-bold text-center">3</p>
                        </td>
                        <!-- END DISPLAY TIMELINESS -->

                        <!-- DISPLAY AVERAGE -->
                        <td>
                            <p class="font-weight-bold text-center">4</p>
                        </td>
                        <!--END  DISPLAY AVERAGE -->

                        <!-- DISPLAY SCORE -->
                        <td>
                            <p class="font-weight-bold text-center">5</p>
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