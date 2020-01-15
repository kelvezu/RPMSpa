<?php

use IPCRF\IPCRF;

include 'sampleheader.php';
$user = $_SESSION['user_id'];

if (isset($_POST['sy_select_btn'])) :
    $sy = $_POST['sy_select'];
else :
    $sy = $_SESSION['active_sy_id'];
endif;

$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$num = 1;
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_details = $ipcrf->fetch_all_ipcrf_users();
$overall_final_rating = $ipcrf->getAllFinalRating();
$overall_adjectival_rating = adjectivalRating($overall_final_rating);

?>


<div class="container-fluid">
    <!-- THIS FUNCTION WILL CHECK IF THERE ARE RECORDS -->
    <?php isNoRecord($ipcrf_details); ?>
    <div>
        <a href="ipcrf_local_ranking_pdf.php" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Create PDF</a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <table class="table table-bordered" cellpadding="5">
                <tr>
                    <td style="text-align:left">
                        <p>
                            <b class="font-weight-bold">Principal's Name: </b><?php echo displayName($conn, displayPrincipal($conn, $school)) ?><br>
                            <b class="font-weight-bold">Bureau/Center/Service/Division: </b><?php echo displaySchool($conn, $school) ?><br>
                            <b class="font-weight-bold">Rating Period: </b><?php echo displaySydesc($conn, $sy) ?><br>
                        </p>
                    </td>

                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="m-2">
                    <label for="">Select School Year:</label>
                    <form action="" method="post">

                        <select name="sy_select" class="form-control-sm">
                            <option value="" disabled selected>Select SY</option>
                            <?php $syQry = $conn->query("SELECT * FROM sy_tbl");
                            foreach ($syQry as $sy_id) : ?>
                                <option value="<?php echo $sy_id['sy_id'] ?>"><?php echo $sy_id['sy_desc'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" name="sy_select_btn" class="btn btn-primary btn-sm">Display Ranking</button>

                    </form>

                </div>
                <div class="m-2"></div>
                <div class="m-2">
                    <?php foreach (kra_tbl($conn) as $kra) : ?>
                        <button data-toggle="modal" data-target="#staticBackdrop<?= $kra['kra_id'] ?>" class="btn btn-outline-dark"> Top of KRA <?= $kra['kra_id'] ?> </button>
                    <?php endforeach ?>
                </div>
            </div>
            <h4 class="text-center bg-dark text-white p-3">IPCRF Ranking for SY: <?php echo  displaySY($conn, $sy) ?></h4>

            <table class="table table-sm table-responsive-sm table-bordered table-striped text-center font-weight-bold ">
                <thead class="text-white bg-dark font-weight-bold">
                    <tr>
                        <th>
                            <p>#</p>
                        </th>
                        <th>
                            <p>Teacher Name</p>
                        </th>
                        <th>
                            <p>Position</p>
                        </th>

                        <?php foreach (kra_tbl($conn) as $kra) : ?>
                            <th>
                                <p>KRA <?= $kra['kra_id'] ?> </p>
                            </th>
                        <?php endforeach ?>


                        <th>
                            <p>Final Rating</p>
                        </th>
                        <th>
                            <p>
                                Adjectival Rating
                            </p>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ipcrf_details as $details) :
                        $view_user = $details['user_id'];
                        $name = displayName($conn, $details['user_id']);
                        $user_position = $details['position'];
                        $final_rating = $details['final_rating'];
                        $adjectival_rating = $details['adjectival_rating'];
                    ?>
                        <tr>
                            <td>
                                <p>
                                    <?= $num++ ?>.
                                </p>
                            </td>

                            <td>
                                <button class="btn btn-link font-weight-bold" data-toggle="modal" data-target="#viewModal<?= $view_user ?>">
                                    <?= $name ?>
                                </button>
                            </td>

                            <td>
                                <p>
                                    <?= $user_position; ?>
                                </p>
                            </td>

                            <?php foreach (kra_tbl($conn) as $kra) :
                                $kra_avg = $ipcrf->get_kra_average($kra['kra_id'], $view_user, $user_position) ?>
                                <td>
                                    <p> <?php echo round($kra_avg * displayKRAweight($conn, $kra['kra_id']), 3)  ?> </p>
                                </td>
                            <?php endforeach ?>


                            <td>
                                <p>
                                    <?= $final_rating; ?>
                                </p>
                            </td>

                            <td>
                                <p>
                                    <?= $adjectival_rating; ?>
                                </p>
                            </td>

                        <?php endforeach; ?>
                        </tr>
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <div class="p-2">
                    <p>
                        <span><b>Overall Final Rating: </b><?php echo $overall_final_rating ?? 0 ?> </span><br>
                        <span><b>Overall Adjectival Rating:</b> <?php echo $overall_adjectival_rating ?? "---" ?> </span><br>
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

<?php foreach ($ipcrf_details as $det) :
    $user_view = $det['user_id'];
    $position_view =  getPosition($conn, $user_view);

?>
    <!-- Modal -->
    <div class="modal fade" id="viewModal<?= $user_view  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <?php

        if ($position_view == 'Master Teacher IV' || $position_view == 'Master Teacher III' || $position_view == 'Master Teacher II' || $position_view == 'Master Teacher I') :
            $table = 'ipcrf_mt';
        elseif ($position_view == 'Teacher III' || $position_view == 'Teacher II' || $position_view == 'Teacher I') :
            $table = 'ipcrf_t';
        endif;
        $ipcrf_view = $ipcrf->fetch_ipcrf_user_details($table, $user_view);
        ?>

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">IPCRF of <?= displayname($conn, $user_view) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!$ipcrf_view) :
                        echo '<p class="red-notif-border"> No record! </p>';

                    else :

                    ?>
                        <table class="table table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <p>
                                            KRA
                                        </p>
                                    </th>

                                    <th>
                                        <p>
                                            OBJECTIVE
                                        </p>
                                    </th>

                                    <th>
                                        <p>
                                            QUALITY
                                        </p>
                                    </th>

                                    <th>
                                        <p>
                                            EFFICIENCY
                                        </p>
                                    </th>

                                    <th>
                                        <p>
                                            TIMELINESS
                                        </p>
                                    </th>
                                    <th>
                                        <p>
                                            OBJECTIVE WEIGHT
                                        </p>
                                    </th>
                                    <th>
                                        <p>
                                            SCORE
                                        </p>
                                    </th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php foreach ($ipcrf_view as $iv) :
                                    $kra = $iv['kra_id'];
                                    $obj = $iv['obj_id'];
                                    $quality = $iv['quality'];
                                    $efficiency = $iv['efficiency'];
                                    $timeliness = $iv['timeliness'];
                                    $objective_weight = $iv['objective_weight'];
                                    $score = $iv['score'];
                                    $actual_result_quality = $iv['actual_result_quality'];
                                    $actual_result_efficiency = $iv['actual_result_efficiency'];
                                    $actual_result_timeliness = $iv['actual_result_timeliness'];
                                ?>
                                    <tr>

                                        <td>
                                            <p>
                                                <?= displayKRA($conn, $kra) ?>
                                            </p>
                                        </td>

                                        <td>
                                            <p>
                                                <?= $obj ?>
                                            </p>
                                        </td>

                                        <td>
                                            <p>
                                                <?= $quality ?>
                                            </p>
                                        </td>

                                        <td>
                                            <p>
                                                <?= $efficiency ?>
                                            </p>
                                        </td>

                                        <td>
                                            <p>
                                                <?= $timeliness ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?= $objective_weight ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?= $score ?>
                                            </p>
                                        </td>
                                    <?php endforeach; ?>
                                    </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach; ?>
<!-- End of Modal -->

<!-- TOP OF KRA MODAL -->

<?php foreach (kra_tbl($conn) as $kra) : $id_kra = $kra['kra_id'];
    $nums = 1; ?>
    <div class="modal fade" id="staticBackdrop<?= $id_kra ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ranking of Teachers in Key Result Area: <?= $kra['kra_id'] ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body overflow-auto">
                    <div class="d-flex m-2 justify-content-lg-end">

                    </div>
                    <table class="table table-bordered table-responsive-sm table-striped font-weight-bold text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    <p>#</p>
                                </th>

                                <th>
                                    <p>Position</p>
                                </th>

                                <th>
                                    <p>Name</p>
                                </th>

                                <th>
                                    <p>KRA Average</p>
                                </th>

                                <th>
                                    <p>Action</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ipcrf->get_kra_avg_rank($id_kra) as $kra_rank) :
                                $r_name = displayName($conn, $kra_rank['user_id']);
                                $avg_kra = round($kra_rank['kra_average'], 3);
                                $position_user = getPosition($conn, $kra_rank['user_id']);
                            ?>
                                <tr>
                                    <td>
                                        <p><?= $nums++ ?>.</p>
                                    </td>

                                    <td>
                                        <p><?= $position_user  ?></p>
                                    </td>

                                    <td>
                                        <p><?= $r_name ?></p>
                                    </td>

                                    <td>
                                        <p><?= round($avg_kra * displayKRAweight($conn, $id_kra), 3) ?></p>
                                    </td>

                                    <td>
                                        <p><a href="ipcrf_mtd" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Create PDF</a></p>
                                    </td>
                                <?php endforeach ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach  ?>


<!-- END OF TOP OF KRA MODAL -->


<?php include 'samplefooter.php'; ?>