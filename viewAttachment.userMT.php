<?php

use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';
$KRAandOBJ = displayKRAandOBJ($conn, $_SESSION['position']);
if (empty($KRAandOBJ)) {
    $KRAandOBJ = "No result";
}
$main_mov_file = 'main_mov';
$supp_mov_file = 'supp_mov';
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
                        <th>Key Result Area</th>
                        <th>Objectives</th>
                        <th class="text-nowrap">Main MOV</th>
                        <th class="text-nowrap">Supporting MOV</th>
                        <th class="text-nowrap">Attachment Status</th>

                    </tr>
                </thead>
                <tbody class="font-weight-bold">
                    <?php foreach ($KRAandOBJ as $kra) : ?>
                        <tr>
                            <td><?= $num++ ?></td>
                            <td><?= displayKRA($conn, $kra['kra_id']) ?></td>
                            <td><?= displayObjectiveMT($conn, $kra['mtobj_id']) ?></td>
                            <td class="text-justify">
                                <?php
                                    $main_mov =  showAttachmentMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'main_mov');
                                    foreach ($main_mov as $mmov) :
                                        if ($mmov) : ?>
                                        <a href="<?= 'sy_id=' . $mmov['sy_id'] . 'school=' . $mmov['school_id'] . 'movID=' . $mmov['mov_id'] . 'objID=' . $kra['mtobj_id'] . 'movType=' . $mmov['mov_type'] ?>" data-toggle="modal" data-target="#updateModal<?= $mmov['mov_id'] .   $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm m-1"><?= $mmov['file_name'] ?></a>

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
                                                                <p><b>Attached in KRA: </b>"<i><?= displayKRA($conn, $kra['kra_id']) ?></i>"</p>
                                                                <b>Attached in Objective: </b>
                                                                "<i><?= displayObjectiveMT($conn, $kra['mtobj_id']) ?></i>"
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="p-2">
                                                                                <p><b>File name:</b> <?= $mmov['file_name'] ?></p>
                                                                            </div>
                                                                            <form action="includes/processAttachUser.php" method="POST">
                                                                                <input type="text" value="<?= $mmov['sy_id'] ?>" name="sy">
                                                                                <input type="text" value="<?= $mmov['school_id'] ?>" name="school">
                                                                                <input type="text" value="<?= $mmov['mov_id'] ?>" name="mov_id">
                                                                                <input type="text" value="<?= $kra['mtobj_id'] ?>" name="obj_id">
                                                                                <input type="text" value="<?= $mmov['mov_type'] ?>" name="mov_type">
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
                                                                                <div class="col">
                                                                                    <p class="text-justify">
                                                                                        <b>Description:</b>
                                                                                        <p class="text-justify">" <i><?= $mmov['file_desc'] ?></i> "</p>
                                                                                    </p>
                                                                                </div>
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
                            <td class=" text-justify">
                                <?php
                                    $supp_mov =  showAttachmentMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'supp_mov');
                                    foreach ($supp_mov as $smov) :
                                        if ($smov) : ?>
                                        <a href="<?= 'sy_id=' . $smov['sy_id'] . 'school=' . $smov['school_id'] . 'movID=' . $smov['mov_id'] . 'objID=' . $kra['mtobj_id'] . 'movType=' . $smov['mov_type'] ?>" data-toggle="modal" data-target="#updateModal<?= $smov['mov_id'] .   $kra['mtobj_id'] ?>" class="btn btn-outline-primary btn-sm m-1"><?= $smov['file_name'] ?></a>

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
                                                                <p><b>Attached in KRA: </b>"<i><?= displayKRA($conn, $kra['kra_id']) ?></i>"</p>
                                                                <b>Attached in Objective: </b>
                                                                "<i><?= displayObjectiveMT($conn, $kra['mtobj_id']) ?></i>"
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="card">
                                                                    <div class="card-header bg-dark text-white">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="p-2">
                                                                                <p><b>File name:</b> <?= $mmov['file_name'] ?></p>
                                                                            </div>
                                                                            <form action="includes/processAttachUser.php" method="POST">
                                                                                <input type="text" value="<?= $mmov['sy_id'] ?>" name="sy">
                                                                                <input type="text" value="<?= $mmov['school_id'] ?>" name="school">
                                                                                <input type="text" value="<?= $mmov['mov_id'] ?>" name="mov_id">
                                                                                <input type="text" value="<?= $kra['mtobj_id'] ?>" name="obj_id">
                                                                                <input type="text" value="<?= $mmov['mov_type'] ?>" name="mov_type">
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
                                                                                <div class="col">
                                                                                    <p class="text-justify">
                                                                                        <b>Description:</b>
                                                                                        <p class="text-justify">" <i><?= $mmov['file_desc'] ?></i> "</p>
                                                                                    </p>
                                                                                </div>
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
                            <td class="text-center"><?= '<p class="my-4">' . showAttachmentStatusMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id']) . '</p>' ?></td>

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