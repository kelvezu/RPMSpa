<?php

use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';
$KRAandOBJ = displayKRAandOBJ($conn, $_SESSION['position']);
$main_mov_file = 'main_mov';
$supp_mov_file = 'supp_mov';
$user_id = $_SESSION['user_id'];
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark text-white text-white font-weight-bold">
            <div class="d-flex justify-content-between">
                <div class="p-2">Means of Verification Attachments</div>
                <div class="p-2"><a href="attachfileMT.php" class="btn btn-sm btn-outline-info"> Add Attachment </a></div>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm table-responsive-sm">
                <thead class="alert alert-primary">
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Key Result Area</th>
                        <th>Objectives</th>
                        <th>COT</th>
                        <th class="text-nowrap">Main MOV</th>
                        <th class="text-nowrap">Attachment Status</th>
                        <th class="text-nowrap">Supporting MOV</th>
                        <th class="text-nowrap">Attachment Status</th>

                    </tr>
                </thead>
                <tbody class="font-weight-bold">

                    <?php
                    if (!$KRAandOBJ) :
                        include 'samplefooter.php';
                        exit();
                    endif;
                    foreach ($KRAandOBJ as $kra) : ?>
                        <tr>
                            <td>
                                <p><?= $num++ ?></p>
                            </td>
                            <!-- DISPLAY KRA LIST -->
                            <td>
                                <p data-toggle="tooltip" data-placement="top" title="<?= displayKRA($conn, $kra['mtobj_id']) ?>" class="text-wrap">
                                    <?= displayKRA($conn, $kra['kra_id']) ?>
                                </p>
                            </td>
                            <!-- ------------------- -->

                            <!-- DISPLAY OBJECTIVE -->
                            <td>
                                <p data-toggle="tooltip" data-placement="top" title="<?= displayObjectiveMT($conn, $kra['mtobj_id']) ?>">Objective <?= $kra['mtobj_id'] ?></p>
                            </td>
                            <!-- ----------------- -->

                            <!-- DISPLAY COT -->
                            <td>COT 1</td>
                            <!-- ----------- -->

                            <!-- DISPLAY MAIN ATTACHMENT -->
                            <td class="text-justify">
                                <?php
                                    $main_mov =  rpmsdb::fetch_MAIN_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $kra['mtobj_id'], $kra['kra_id']);

                                    if (isset($main_mov)) :
                                        foreach ($main_mov as $mmov) : ?>
                                        <p>
                                            <button data-toggle="modal" data-target="#updateModal<?= $mmov['mov_id'] . $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm">
                                                <?= displayMOVfileMT($conn, $mmov['mov_id']) ?>
                                                <a href="includes/processattachuser.php?type=main&attach_mov_id=<?= $mmov['mov_id'] ?>" class="fa fa-times text-danger"></a>
                                            </button>
                                        </p>

                                        <!--Main MOV Modal -->
                                        <div class="modal fade" id="updateModal<?= $mmov['mov_id'] .   $kra['mtobj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <p><b>Attached in KRA <?= $kra['kra_id'] ?>: </b>"<i><?= displayKRA($conn, $kra['kra_id']) ?></i>"</p>
                                                                <b>Attached in Objective <?= $kra['mtobj_id'] ?>: </b>
                                                                "<i><?= displayObjectiveMT($conn, $kra['mtobj_id']) ?></i>"
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="p-2">
                                                                                <p><b>File name:</b>
                                                                                    <?php echo displayMOVfileMT($conn, $mmov['mov_id']) ?></p>
                                                                            </div>
                                                                            <form action="includes/processAttachUser.php" method="POST">
                                                                                <input type="hidden" value="<?= $mmov['user_id'] ?>" name="user_id">
                                                                                <input type="hidden" value="<?= $mmov['sy_id'] ?>" name="sy_id">
                                                                                <input type="hidden" value="<?= $mmov['school_id'] ?>" name="school_id">
                                                                                <input type="hidden" value="<?= $mmov['mov_id'] ?>" name="mov_id">
                                                                                <input type="hidden" value="<?= $kra['mtobj_id'] ?>" name="obj_id">
                                                                                <input type="hidden" value="<?= $mmov['mov_type'] ?>" name="mov_type">
                                                                                <div class="p-2"><button type="submit" class="btn btn-sm btn-outline-danger" name="remove_mt_attach">Remove Attachment</button></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form action="includes/processupdateattachment.php" method="post">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <p><b>Attachment</b>
                                                                                        <p><?= (displayFileMT($conn, $mmov['mov_id'])); ?></p>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer alert alert-dark">
                                                                                <p class="text-justify">
                                                                                    <b>Description:</b>
                                                                                    <p class="text-justify">" <i><?php echo displayFileDescMT($conn, $mmov['mov_id'])  ?></i> "</p>
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

                                                        <!-- <a class="btn btn-outline-primary btn-sm" href="downloadmt.php?file=<?php //$smov['attachment'] 
                                                                                                                                                ?>">View File</a> -->

                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End tag of Update Modal -->

                                    <?php endforeach;
                                        else : ?>
                                    <p class="text-center font-weight-bold"> ----- </p>
                                <?php endif; ?>
                            </td>
                            <!-- -------------------------------- -->


                            <td>
                                <!-- COLUMN FOR MAIN MOV STATUS -->
                                <?php
                                    $fetch_main_status = rpmsdb::fetch_MAIN_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $kra['mtobj_id'], $kra['kra_id']);
                                    if ($fetch_main_status) :
                                        foreach ($fetch_main_status as $m_stats) :
                                            $m_status = $m_stats['doc_status']; ?>
                                        <p>
                                            <?php if ($m_status == "For Approval") : ?>
                                                <button class="btn btn-info btn-sm btn-block  text-white">
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

                            <!-- DISPLAY SUPP MOV  -->
                            <td class=" text-justify">
                                <!-- COLUMN FOR SUPP MOV -->
                                <?php
                                    $supp_mov =  rpmsdb::fetch_SUPP_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $kra['mtobj_id'], $kra['kra_id']);

                                    if ($supp_mov) :
                                        foreach ($supp_mov as $smov) :
                                            ?>
                                        <p class="text-justify text-nowrap">

                                            <button data-toggle="modal" data-target="#updateModal<?= $smov['mov_id'] . $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm">
                                                <?= displayMOVfileMT($conn, $smov['mov_id']) ?>
                                                <a href="includes/processattachuser.php?&type=supp&attach_mov_id=<?= $smov['mov_id'] ?>" class="fa fa-times text-danger"></a>
                                            </button>

                                            <?php /* if ($smov['doc_status'] == "For Approval") : ?>
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
                                            <?php endif; */ ?>
                                        </p>

                                        <!--Main SUPP Modal -->
                                        <div class="modal fade" id="updateModal<?php echo $smov['mov_id'] . $kra['mtobj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <p><b>Attached in KRA <?php echo $kra['kra_id'] ?>: </b>"<i><?php echo displayKRA($conn, $kra['kra_id']) ?></i>"</p>
                                                                <b>Attached in Objective <?php echo $kra['mtobj_id'] ?>: </b>
                                                                "<i><?php echo displayObjectiveMT($conn, $kra['mtobj_id']) ?></i>"
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




                            <!-- --------------------------------------------------------------- -->
                            <td class="text-center">
                                <!-- COLUMN FOR SUPP MOV STATUS -->
                                <?php
                                    $fetch_supp_status = rpmsdb::fetch_SUPP_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id'], $kra['mtobj_id'], $kra['kra_id']);
                                    if ($fetch_supp_status) :
                                        foreach ($fetch_supp_status as $s_stats) :
                                            $s_status = $s_stats['doc_status']; ?>
                                        <p>
                                            <?php if ($s_status == "For Approval") : ?>
                                                <button class="btn btn-info btn-sm btn-block  text-white">
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

                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include 'samplefooter.php' ?>