<?php

use IPCRF\IPCRF;
use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';

$position = '';
if (isset($_GET['user'])) {
    $user_id = $_GET['user'];
    $position = displayPosition($conn, $user_id);
}

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $position = displayPosition($conn, $user_id);
    $_GET['notif'] = "";
    $_GET['user'] = "";
    $_GET['mov_id'] = "";
}


$KRAandOBJ = displayKRAandOBJ($conn, $position);
if (empty($KRAandOBJ)) {
    $KRAandOBJ = "No result";
}
$main_mov_file = 'main_mov';
$supp_mov_file = 'supp_mov';


// pre_r($_POST);
?>

<div class="container mb-5">
    <div class="card">
        <div class="card-header">
            <p>Master Teacher with MOV's</p>
        </div>
        <div class="card-body overflow-auto">
            <!-- action="viewattachment.ratermt.php" -->
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
                        <button type="submit" class="btn btn-sm btn-primary">View MOV</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (empty($user_id)) :
    include 'samplefooter.php';
    exit();
endif;
// THIS FUNCTION WILL DISPLAY THE NOTIFICATION
if (isset($_GET['notif']) and isset($_GET['movtype'])) :
    getNotifmov($_GET['notif'], $_GET['mov_id'], $conn, $_GET['movtype']);
endif;

$ipcrf = new IPCRF($user_id, $_SESSION['active_sy_id'], $_SESSION['school_id'], $position);
$cot_count  = $ipcrf->fetchObsPeriodinCOT('cot_mt_rating_a_tbl');
// pre_r($cot_count);
?>


<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark text-white text-white font-weight-bold">
            <div class="d-flex justify-content-between">
                <div class="p-2"><?= $position ?> <?= displayName($conn, $user_id) ?></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm table-responsive-sm">
                <thead class="alert alert-primary">
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Key Result Area</th>
                        <th>Objectives</th>
                        <th class="text-nowrap">Main MOV</th>
                        <th class="text-nowrap">Attachment Status</th>
                        <th class="text-nowrap">Supporting MOV</th>
                        <th class="text-nowrap">Attachment Status</th>
                    </tr>
                </thead>
                <tbody class=" text-body">
                    <tr>
                        <?php
                        $mov_b = displayKRAandOBJ($conn, $position);
                        if (!$mov_b) :
                            include 'samplefooter.php';
                            exit();
                        endif;
                        foreach ($mov_b as $mov) : ?>
                            <td>
                                <p><?php echo $num++ . '.' ?></p>
                            </td>

                            <!-- DISPLAY KRA -->
                            <td>
                                <p class="font-weight-bold"><?php echo  displayKRA($conn, $mov['kra_id']) ?></p>
                            </td>
                            <!-- --------------------- -->

                            <!-- DISPLAY OBJECTIVES -->
                            <td>
                                <p><?php echo  displayObjectiveMT($conn, $mov['mtobj_id']) ?? "-----" ?></p>
                            </td>
                            <!-- --------------------- -->

                            <!-- COLUMN FOR MAIN MOV -->
                            <td>
                                <?php
                                /* THIS WILL SHOW THE COT IN MOV  */

                                /* THIS BLOCK WILL DISPLAY THE COT FOR OBJECTIVES */
                                if ($mov['mov_type'] == "COT") :
                                    foreach ($cot_count as $c_count) : ?>
                                        <p>
                                            <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#COTmodal<?php echo $c_count['obs_period'] ?>">
                                                COT <?php echo $c_count['obs_period']; ?>
                                            </button>
                                        </p>
                                    <?php endforeach;
                                else :
                                    /* THIS BLOCK WILL DISPLAY THE ATTACHMENTS FOR OBJECTIVES */
                                    ?>
                                    <?php $main_att = rpmsdb::fetch_MAIN_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $mov['mtobj_id'], $mov['kra_id']);
                                    if (isset($main_att)) :
                                        foreach ($main_att as $mmov) : ?>
                                            <p class="text-justify text-nowrap">
                                                <button data-toggle="modal" data-target="#updateModal<?php echo $mmov['mov_id'] . $mov['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm"><?php echo displayMOVfileMT($conn, $mmov['mov_id']);  ?>
                                                </button>

                                                <?php if ($mmov['doc_status'] == "For Approval") : ?>
                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=approve&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-light btn-sm text-success"><i class="fa fa-check-circle"></i></a>

                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=revision&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="For Revision" class="btn btn-sm btn-light text-warning"><i class="fa fa-edit "></i></a>

                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=disapprove&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Disapprove" class="btn btn-sm btn-light text-danger"><i class="fa fa-times-circle "></i></a>

                                                <?php elseif ($mmov['doc_status'] == "Disapproved") : ?>
                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=approve&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-light btn-sm text-success"><i class="fa fa-check-circle"></i></a>

                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=revision&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="For Revision" class="btn btn-sm btn-light text-warning"><i class="fa fa-edit "></i></a>

                                                <?php elseif ($mmov['doc_status'] == "Approved") : ?>
                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=cancel&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Cancel Approve" class="btn btn-sm btn-light text-danger"><i class="fa fa-times "></i></a>

                                                <?php elseif ($mmov['doc_status'] == "For Revision") : ?>
                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=approve&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-sm btn-light text-success"><i class="fa fa-check-circle"></i></a>

                                                    <a href="includes/processmovmt.php?mov_type=main&attach_id=<?= $mmov['attach_mov_id'] ?>&method=disapprove&uid=<?= $mmov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $mmov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Dispprove" class="btn btn-sm btn-light text-danger"><i class="fa fa-times-circle "></i></a>
                                                <?php endif; ?>
                                            </p>
                                            <!-- ---------------------------------------------->
                                            <!--Main MOV Modal -->
                                            <div class="modal fade" id="updateModal<?php echo $mmov['mov_id'] .   $mov['mtobj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Attachments</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-header bg-light">
                                                                    <p><b>Attached in KRA <?php echo $mmov['kra_id'] ?>: </b>"<i><?php echo displayKRA($conn, $mmov['kra_id']) ?></i>"</p>
                                                                    <b>Attached in Objective <?php echo $mov['mtobj_id'] ?>: </b>
                                                                    "<i><?php echo displayObjectiveMT($conn, $mov['mtobj_id']) ?></i>"
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="card">
                                                                        <div class="card-header bg-dark text-white">
                                                                            <div class="d-flex justify-content-between">
                                                                                <div class="p-2">
                                                                                    <p><b>File name:</b> <?php echo displayMOVfileMT($conn, $mmov['mov_id']) ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form action="includes/processupdateattachment.php" method="post">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <p><b>Attachment</b>
                                                                                            <p><?php echo (displayFileMT($conn, $mmov['mov_id'])); ?></p>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-footer alert alert-dark">
                                                                                    <p class="text-justify">
                                                                                        <b>Description:</b>
                                                                                        <p class="text-justify">" <i><?php echo displayFileDescMT($conn, $mmov['mov_id']) ?></i> "</p>
                                                                                    </p>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- End of Card -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End tag of Update Modal -->
                                        <?php
                                        endforeach;
                                    else : ?>
                                        <p class="text-center font-weight-bold"> ----- </p>
                                <?php endif;
                                endif;
                                ?>
                                <!----------------------------------------------------->
                            </td>
                            <!-- END OF COLUMN FOR MAIN MOV -->
                            <td>
                                <!-- COLUMN FOR MAIN MOV STATUS -->
                                <?php
                                $fetch_main_status = rpmsdb::fetch_MAIN_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $mov['mtobj_id'], $mov['kra_id']);
                                if ($fetch_main_status) :
                                    foreach ($fetch_main_status as $m_stats) :
                                        $m_status = $m_stats['doc_status']; ?>
                                        <p>
                                            <?php if ($m_status == "For Approval") : ?>
                                                <button class="btn btn-secondary btn-sm btn-block  text-white">
                                                    <?php echo trim($m_status); ?>
                                                </button>
                                            <?php elseif ($m_status == "Approved") : ?>
                                                <button class="btn btn-success btn-sm btn-block text-white">
                                                    <?php echo trim($m_status); ?>
                                                </button>
                                            <?php elseif ($m_status == "Disapproved") : ?>
                                                <button class="btn btn-danger btn-sm btn-block text-white">
                                                    <?php echo trim($m_status); ?>
                                                </button>
                                            <?php elseif ($m_status == "For Revision") : ?>
                                                <button class="btn btn-warning btn-sm btn-block text-white">
                                                    <?php echo trim($m_status); ?>
                                                </button>
                                            <?php endif; ?>
                                        </p>
                                    <?php endforeach;
                                else : ?>
                                    <p class="text-center font-weight-bold"> ----- </p>

                                <?php endif; ?>
                                <!-- END COLUMN FOR MAIN MOV STATUS  -->
                            </td>
                            <td>
                                <!-- COLUMN FOR SUPP MOV -->
                                <?php
                                $supp_mov =  rpmsdb::fetch_SUPP_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $mov['mtobj_id'], $mov['kra_id']);

                                if ($supp_mov) :
                                    foreach ($supp_mov as $smov) :
                                ?>
                                        <p class="text-justify text-nowrap">
                                            <button data-toggle="modal" data-target="#updateModal<?php echo $smov['mov_id'] . $mov['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm"><?php echo  displayMOVfileMT($conn, $smov['mov_id']) ?>
                                            </button>

                                            <?php if ($smov['doc_status'] == "For Approval") : ?>
                                                <a href='includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=approve&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>' data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-light btn-sm text-success">
                                                    <i class="fa fa-check-circle"></i>
                                                </a>

                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=revision&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="For Revision" class="btn btn-sm btn-light text-warning"><i class="fa fa-edit "></i></a>

                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=disapprove&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Disapprove" class="btn btn-sm btn-light text-danger"><i class="fa fa-times-circle "></i></a>

                                            <?php elseif ($smov['doc_status'] == "Disapproved") : ?>
                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=approve&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-light btn-sm text-success"><i class="fa fa-check-circle"></i></a>

                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=revision&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="For Revision" class="btn btn-sm btn-light text-warning"><i class="fa fa-edit "></i></a>

                                            <?php elseif ($smov['doc_status'] == "Approved") : ?>
                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=cancel&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Cancel Approve" class="btn btn-sm btn-light text-danger"><i class="fa fa-times "></i></a>

                                            <?php elseif ($smov['doc_status'] == "For Revision") : ?>
                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=approve&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-sm btn-light text-success"><i class="fa fa-check-circle"></i></a>

                                                <a href="includes/processmovmt.php?mov_type=supp&attach_id=<?= $smov['attach_mov_id'] ?>&method=disapprove&uid=<?= $smov['user_id'] ?>&approver=<?= $_SESSION['user_id'] ?>&movfile=<?= $smov['mov_id'] ?>" data-toggle="tooltip" data-placement="top" title="Dispprove" class="btn btn-sm btn-light text-danger"><i class="fa fa-times-circle "></i></a>
                                            <?php endif; ?>
                                        </p>

                                        <!--Main SUPP Modal -->
                                        <div class="modal fade" id="updateModal<?php echo $smov['mov_id'] . $mov['mtobj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Attachments</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-header bg-light">
                                                                <p><b>Attached in KRA <?php echo $mov['kra_id'] ?>: </b>"<i><?php echo displayKRA($conn, $mov['kra_id']) ?></i>"</p>
                                                                <b>Attached in Objective <?php echo $mov['mtobj_id'] ?>: </b>
                                                                "<i><?php echo displayObjectiveMT($conn, $mov['mtobj_id']) ?></i>"
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="p-2">
                                                                                <p><b>File name:</b> <?php echo displaymovfilemt($conn, $smov['mov_id']) ?></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form action="includes/processupdateattachment.php" method="post">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <p><b>Attachment</b>
                                                                                        <p><?php echo (displayFileMT($conn, $smov['mov_id'])); ?></p>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer alert alert-dark">
                                                                                <p class="text-justify">
                                                                                    <b>Description:</b>
                                                                                    <p class="text-justify">" <i><?php echo displayFileDescMT($conn, $smov['mov_id']) ?? "---" ?></i> "</p>
                                                                                </p>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End of Card -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End tag of Update Modal -->

                                    <?php
                                    endforeach;
                                else : ?>
                                    <p class="text-center font-weight-bold"> ----- </p>
                                <?php endif; ?>
                            </td>
                            <!-- END COLUMN FOR SUPP MOV -->
                            <td>
                                <!-- COLUMN FOR SUPP MOV STATUS -->
                                <?php
                                $fetch_supp_status = rpmsdb::fetch_SUPP_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $mov['mtobj_id'], $mov['kra_id']);
                                if ($fetch_supp_status) :
                                    foreach ($fetch_supp_status as $s_stats) :
                                        $s_status = $s_stats['doc_status']; ?>
                                        <p>
                                            <?php if ($s_status == "For Approval") : ?>
                                                <button class="btn btn-secondary btn-sm btn-block  text-white">
                                                    <?php echo trim($s_status); ?>
                                                </button>
                                            <?php elseif ($s_status == "Approved") : ?>
                                                <button class="btn btn-success btn-sm btn-block text-white">
                                                    <?php echo trim($s_status); ?>
                                                </button>
                                            <?php elseif ($s_status == "Disapproved") : ?>
                                                <button class="btn btn-danger btn-sm btn-block text-white">
                                                    <?php echo trim($s_status); ?>
                                                </button>
                                            <?php elseif ($s_status == "For Revision") : ?>
                                                <button class="btn btn-warning btn-sm btn-block text-white">
                                                    <?php echo trim($s_status); ?>
                                                </button>
                                            <?php endif; ?>
                                        </p>
                                    <?php endforeach;
                                else : ?>
                                    <p class="text-center font-weight-bold"> ----- </p>
                                <?php endif; ?>
                                <!-- END COLUMN FOR SUPP MOV STATUS  -->
                            </td>
                    </tr>
                <?php
                        endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- COT MODAL -->
<?php
foreach ($cot_count as $c_count) : ?>
    <div class="modal fade" id="COTmodal<?php echo $c_count['obs_period'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Observation Period <?php echo $c_count['obs_period'] ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped table-sm table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Indicator</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cot_details = $ipcrf->fetchCOTdetails($c_count['obs_period'], 'cot_mt_rating_a_tbl');
                            $cot_num = 1;
                            if ($cot_details) :
                                foreach ($cot_details as $cot) :
                            ?>
                                    <tr>
                                        <td>
                                            <p class="font-weight-bold">
                                                <?php echo  $cot_num++ ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="font-italic">
                                                <?= displayMTindicator($conn, $cot['indicator_id']); ?>
                                            </p>
                                        </td>

                                        <td>
                                            <p class="font-weight-bold">
                                                <?= $cot['rating'] ?>
                                            </p>
                                        </td>
                                    </tr>

                                <?php endforeach;
                            else : ?>
                                <p class="red-notif-border">
                                    No record!
                                </p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<?php $cot_num = 0;
endforeach; ?>

<!-- END OF COT MODAL -->
<?php include 'samplefooter.php' ?>