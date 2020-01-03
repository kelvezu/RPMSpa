<?php

use IPCRF\IPCRF;

include 'sampleheader.php';
$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$num = 1;
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_details = $ipcrf->getSchoolFinalRating();
$ipcrf_school = $ipcrf->fetch_all_ipcrf_users();
?>


<div class="container-fluid">
    <!-- THIS FUNCTION WILL CHECK IF THERE ARE RECORDS -->
    <?php isNoRecord($ipcrf_details); ?>


    <div>
        <a href="ipcrf_school_ranking_pdf.php" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Create PDF</a>
    </div>
    <br>
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <h4 class="text-center bg-dark text-white p-3">IPCRF School Ranking for SY: <?= displaysy($conn, $sy) ?></h4>
            <table class="table table-sm table-responsive-sm table-bordered table-striped text-center font-weight-bold">
                <thead class="text-white bg-dark font-weight-bold">
                    <tr>
                        <th>
                            <p>#</p>
                        </th>
                        <th>
                            <p>School Name</p>
                        </th>
                        <th>
                            <p>Principal Name</p>
                        </th>
                        <th>
                            <p>IPCRF General Rating</p>
                        </th>
                        <th>
                            <p>IPCRF Adjectival Rating</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ipcrf_details as $ipcrf_d) :
                        $id_school = $ipcrf_d['school_id'];
                        $school_final_rating = $ipcrf_d['school_final_rating'];
                        $school_adjectival_rating = adjectivalRating($school_final_rating);
                    ?>
                        <tr>
                            <td>
                                <p>
                                    <?= $num++ ?>
                                </p>
                            </td>

                            <td>
                                <a data-toggle="modal" data-target="#viewModal<?= $id_school ?>">
                                    <?= displaySchool($conn, $id_school) ?>
                                </a>
                            </td>

                            <td>
                                <p>
                                    <?= displayName($conn, displayPrincipal($conn, $id_school)) ?>
                                </p>
                            </td>

                            <td>
                                <p>
                                    <?= $school_final_rating ?>
                                </p>
                            </td>

                            <td>
                                <p>
                                    <?= $school_adjectival_rating ?>
                                </p>
                            </td>
                        <?php endforeach;
                    $num = 1; ?>
                        </tr>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?php foreach ($ipcrf_details as $det) :
    $view_school = $det['school_id'];
    $school_name = displaySchool($conn, $view_school);

?>
    <!-- Modal -->
    <div class="modal fade" id="viewModal<?= $view_school  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">IPCRF of <?= $school_name ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    <p>
                                        #
                                    </p>
                                </th>

                                <th>
                                    <p>
                                        Teacher Name
                                    </p>
                                </th>

                                <th>
                                    <p>
                                        Position
                                    </p>
                                </th>

                                <th>
                                    <p>
                                        Final Rating
                                    </p>
                                </th>

                                <th>
                                    <p>
                                        Adjectival Rating
                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <?php foreach (get_all_ipcrf_user($conn, $sy, $view_school) as $users) :
                        ?>
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        <p>
                                            <?= $num++ ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?= displayName($conn, $users['user_id']) ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?= $users['position'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?= $users['final_rating'] ?>
                                        </p>
                                    </td>

                                    <td>
                                        <p>
                                            <?= $users['adjectival_rating'] ?>
                                        </p>
                                    </td>
                                <?php endforeach; ?>
                                </tr>
                            <tfoot class="bg-dark text-white font-weight-bold">
                                <tr>
                                    <td colspan="4" class="text-right">
                                        <p>Overall Rating:<br>
                                            Adjectival Rating: <span class="text-success"></span></p>
                                    </td>
                                    <td>
                                        <p>
                                            <?= get_final_ipcrf_rating($conn, $sy, $school) ?><br>
                                            <?= adjectivalRating(get_final_ipcrf_rating($conn, $sy, $school)) ?>

                                        </p>
                                    </td>

                                </tr>
                            </tfoot>
                            </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach;  ?>
<!-- End of Modal -->


<?php include 'samplefooter.php'; ?>