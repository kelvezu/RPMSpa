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
                                            <button data-toggle="modal" data-target="#updateModal<?= $mmov['mov_id'] . $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm m-1">
                                                <?= displayMOVfileMT($conn, $mmov['mov_id']) ?>
                                                <a href="includes/processattachuser.php?&attach_mov_id=<?= $mmov['mov_id'] ?>" class="fa fa-times text-danger"></a>
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


                            <td>Status</td>

                            <!-- DISPLAY MAIN ATTACHMENT STATUS  -->
                            <td class=" text-justify">
                                <?php
                                    $supp_mov =  showSuppAttachmentMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'],  $kra['kra_id']);
                                    foreach ($supp_mov as $smov) :
                                        if ($smov) : ?>
                                        <button data-toggle="modal" data-target="#updateModal<?= $smov['mov_id'] .   $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm m-1"><?= $smov['file_name'] ?> <a href="includes/processattachuser.php?&attach_mov_id=<?= $smov['mov_id']  ?>" class="fa fa-times text-danger"></a></button>

                                        <!--Main MOV Modal -->
                                        <div class="modal fade" id="updateModal<?= $smov['mov_id'] .   $kra['mtobj_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                <p><b>File name:</b> <?= $smov['file_name'] ?></p>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form action="includes/processupdateattachment.php" method="post">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <p><b>Attachment</b>
                                                                                        <p><?= (displayFileMT($conn, $smov['mov_id'])); ?></p>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer alert alert-dark">
                                                                                <p class="text-justify">
                                                                                    <b>Description:</b>
                                                                                    <p class="text-justify">" <i><?= $smov['file_desc'] ?></i> "</p>
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
                                <?php endif;
                                    endforeach;
                                    ?>
                            </td>




                            <!-- --------------------------------------------------------------- -->
                            <td class="text-center"><?= '<p class="">' . showMainMovStatusMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id']) . '</p>' ?></td>

                            <!-- <td><a href="obj_id=<?php //$kra['mtobj_id']  
                                                            ?>"  class="btn btn-sm btn-outline-warning  my-4">Update Attachment</a></td> -->





                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include 'samplefooter.php' ?>