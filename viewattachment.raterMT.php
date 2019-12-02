<?php

use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';
$position = '';
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $position = displayPosition($conn, $user_id);
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
                            foreach (rpmsdb::showRatees($conn, $_SESSION['user_id'],  $_SESSION['school_id'], 'For Approval') as $ratees) : ?>
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
if (empty($_POST)) :
    include 'samplefooter.php';
    exit();
endif
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark text-white text-white font-weight-bold">
            <div class="d-flex justify-content-between">
                <div class="p-2"><?= $position ?> <?= displayName($conn, $user_id) ?></div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm table-responsive-sm">
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
                <tbody>
                    <tr>
                        <?php
                        $mov_b = displayKRAandOBJ($conn, $position);
                        if (!$mov_b) :
                            include 'samplefooter.php';
                            exit();
                        endif;
                        foreach ($mov_b as $mov) : ?>
                            <td>
                                <p><?php echo $num++ ?></p>
                            </td>
                            <td>
                                <p><?php echo  $mov['kra_id'] ?></p>
                            </td>
                            <td>
                                <p><?php echo  $mov['obj_id'] ?? "-----" ?></p>
                            </td>
                            <!-- COLUMN FOR MAIN MOV -->
                            <td><?php $main_att = rpmsdb::fetch_MAIN_MT_MOV_ATT($conn, $mov['mtobj_id'], $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], 'main_mov', $mov['kra_id']);
                                    foreach ($main_att as $mmov) :
                                        // if (isset($mmov)) : 
                                        ?>
                                    <button data-toggle="modal" data-target="#updateModal<?php echo $mmov['mov_id'] . $mov['obj_id'] ?>" class="btn btn-outline-primary btn-sm m-1"><?php echo $mmov['file_name'] ?> <a href="includes/processattachuser.php?attach_mov_id=<?php echo showAttachmentIDMT($conn, $mov['sy_id'], $mov['school_id'], $mov['mov_id'], $mov['obj_id'], 'main_mov', $mov['kra_id'])  ?>" class="fa fa-times text-danger"></a> </button>
                                    <!-- ---------------------------------------------->
                                    <!--Main MOV Modal -->
                                    <div class="modal fade" id="updateModal<?php echo $mov['mov_id'] .   $mov['obj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <b>Attached in Objective <?php echo $mov['obj_id'] ?>: </b>
                                                            "<i><?php echo displayObjectiveMT($conn, $mov['obj_id']) ?></i>"
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="card">
                                                                <div class="card-header bg-dark text-white">
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="p-2">
                                                                            <p><b>File name:</b> <?php echo $mmov['file_name'] ?></p>
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
                                                                                <p class="text-justify">" <i><?php echo $mmov['file_desc'] ?></i> "</p>
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
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End tag of Update Modal -->
                                <?php //endif;
                                    endforeach; ?>
                                <!----------------------------------------------------->
                            </td>
                            <!-- END OF COLUMN FOR MAIN MOV -->
                            <td>
                                <p class="text-center"><?php echo displayMainMOVstatus($conn, $mov['attach_mov_id'], $mov['kra_id'], $mov['obj_id'])  ?? "-----" ?></p>


                            </td>
                            <td>
                                <!-- COLUMN FOR SUPP MOV -->
                                <?php
                                    $supp_mov =  showAttachmentMT($conn, $mov['obj_id'], $user_id, $mov['school_id'], $mov['sy_id'], 'supp_mov', $mov['kra_id']);
                                    if ($supp_mov) :
                                        foreach ($supp_mov as $smov) :

                                            ?>
                                        <button data-toggle="modal" data-target="#updateModal<?php echo $smov['mov_id'] .   $mov['obj_id'] ?>" class="btn btn-outline-primary btn-sm m-1"><?php echo $smov['file_name'] ?> <a href="includes/processattachuser.php?&attach_mov_id=
                                        <?php
                                                    echo showAttachmentIDMT(
                                                        $conn,
                                                        $mov['sy_id'],
                                                        $mov['school_id'],
                                                        $mov['mov_id'],
                                                        $mov['obj_id'],
                                                        'supp_mov',
                                                        $mov['kra_id']
                                                    )  ?>" class="fa fa-times text-danger"></a></button>

                                        <!--Main MOV Modal -->
                                        <div class="modal fade" id="updateModal<?php echo $smov['mov_id'] .   $mov['obj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <b>Attached in Objective <?php echo $mov['obj_id'] ?>: </b>
                                                                "<i><?php echo displayObjectiveMT($conn, $mov['obj_id']) ?></i>"
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="p-2">
                                                                                <p><b>File name:</b> <?php echo $smov['file_name'] ?></p>
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
                                                                                    <p class="text-justify">" <i><?php echo $smov['file_desc'] ?></i> "</p>
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
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End tag of Update Modal -->

                                <?php

                                        endforeach;
                                    endif;
                                    ?>
                            </td>
                            <!-- END COLUMN FOR SUPP MOV -->
                            <td>
                                <p class="text-center">
                                    <?php
                                        $res_status = displayAttachmentStatusMT($conn, $mov['attach_mov_id'], 'supp_mov', $mov['kra_id'], $mov['obj_id'], $user_id);
                                        if ($res_status) :
                                            foreach ($res_status as $rr) : ?>
                                            <?php echo $rr['doc_status'] . $mov['attach_mov_id'] . ' kra=' . $mov['kra_id'] . ' obj=' . $mov['obj_id'] . 'kra=' . $mov['kra_id'] . $mov['mov_type'] ?>

                                    <?php pre_r($rr);
                                            endforeach;
                                        endif;
                                        ?>
                                </p>
                            </td>
                    </tr>
                    <?php endforeach; ?>x
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'samplefooter.php' ?>