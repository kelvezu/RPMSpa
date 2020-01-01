<?php
include 'sampleheader.php';


use IPCRF\IPCRF;

$user = $_SESSION['user_id'];
$name = displayName($conn, $user);
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$rater_name = ($rater) ? displayName($conn, $rater) : "No rater";
$rater_position = ($rater) ? getPosition($conn, $rater) : "No rater";
$app_auth = displayName($conn, $_SESSION['approving_authority']) or $app_auth = "N/A";
$kra_tbl = kra_tbl($conn);
$num = 1;
$ipcrf_tbl = 'ipcrf_mt';
$ipcrf_final_tbl = 'ipcrf_final_mt';
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_score = $ipcrf->fetch_QETscore_mt();
$obj_tbl = $ipcrf->fetchMTObjective_tbl();
$obj_count = intval(count($obj_tbl));
$ipcrf_user = $ipcrf->fetch_ipcrf_users($ipcrf_final_tbl);
?>




<div class="container-fluid">
    <h4 class="text-center bg-dark text-white p-3">INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW FORM – Master Teacher I-IV (High-Proficient Teachers)</h4>

    <a href="ipcrf_mt_total_rating_pdf.php" class="btn btn-primary m-3"><i class="fa fa-file-pdf"></i> Save as PDF</a>

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


    <table class="table table-bordered table-striped">
        <thead class=" bg-dark text-white text-center ">
            <tr>
                <th rowspan='3'>
                    <p>#</p>
                </th>

                <th rowspan='3'>
                    <p>Teacher Name </p>
                </th>

                <th rowspan='3'>
                    <p>Position</p>
                </th>

                <th class='header_pdf' colspan='<?= $obj_count ?>'>
                    <p>Objective Scores</p>
                </th>

                <th rowspan='3'>
                    <p> Final </p>
                </th>

                <th rowspan='3'>
                    <p> Adjectival </p>
                </th>
            </tr>
            <tr>
                <?php
                foreach ($kra_tbl as $kra) :
                    $kra_id = $kra['kra_id']; ?>
                    <th colspan="<?php echo $ipcrf->countKRAobjective($kra_id, 'mtobj_tbl') ?>">
                        <p> KRA: <?= $kra_id ?> </p>
                    </th>
                <?php endforeach; ?>

            </tr>
            <tr>

                <?php foreach ($obj_tbl as $obj) :
                    $obj_id = $obj['mtobj_id']; ?>
                    <th>
                        <p> <?= $obj_id ?> </p>
                    </th>
                <?php endforeach; ?>


            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            if ($ipcrf_user) :
                foreach ($ipcrf_user as $user) :
                    $users = $user['user_id'];
                    $user_position = $user['position'];  ?>
                    <tr>
                        <td>
                            <p><?= $num++ ?></p>
                        </td>
                        <td class="text-nowrap">
                            <p><?php echo displayname($conn, $users) ?></p>
                        </td>

                        <?php if ($user_position) : ?>
                            <td class="text-nowrap">
                                <p><?php echo $user_position ?> </p>
                            <?php else : ?>
                            <td>
                                <p> --- </p>
                            <?php endif; ?>

                            <?php
                            // DISPLAY OBJECTIVES
                            if ($obj_tbl) :
                                foreach ($obj_tbl as $obj) :
                                    // DISPLAY OBJECTIVE SCORE
                                    if ($ipcrf->fetch_user_Score($ipcrf_tbl, $obj['mtobj_id'], $users)) : ?>

                            <td>
                                <p> <?php echo $ipcrf->fetch_user_Score($ipcrf_tbl, $obj['mtobj_id'], $users) ?></p>
                            <?php else : ?>
                            <td>
                                <p> --- </p>
                        <?php endif;
                                endforeach;
                            endif;

                            // DISPLAY OF FINAL RATING
                            if ($ipcrf->getFinalRating($ipcrf_final_tbl, $users)) :  ?>

                            <td>
                                <p class="font-weight-bold"> <?php echo $ipcrf->getFinalRating($ipcrf_final_tbl, $users) ?></p>
                            <?php else : ?>
                            <td>
                                <p> --- </p>
                            <?php endif;

                            // DISPLAY OF ADJECTIVAL FINAL RATING
                            if ($ipcrf->getAdjectivalRating($ipcrf_final_tbl, $users)) : ?>

                            <td class="font-weight-bold">
                                <p> <?php echo $ipcrf->getAdjectivalRating($ipcrf_final_tbl, $users) ?></p>
                            <?php else : ?>
                            <td>
                                <p> --- </p>
                    <?php endif;

                        endforeach;
                    endif; ?>


                            </td>
                    </tr>
        </tbody>

    </table>

</div>




<?php include 'samplefooter.php' ?>