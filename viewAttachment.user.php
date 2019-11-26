<?php

use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';
$KRAandOBJ = displayKRAandOBJ($conn, $_SESSION['position']);
if (empty($KRAandOBJ)) {
    $KRAandOBJ = "No result";
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-dark text-white text-white font-weight-bold">
            Means of Verification Attachments
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
                            <td class="text-center">
                                <?php
                                    $main_mov =  showAttachmentMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'main_mov');
                                    foreach ($main_mov as $mmov) :
                                        echo $mmov . ' ,';
                                    endforeach;
                                    ?>
                            </td>
                            <td class="text-center"><?= showAttachmentMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'supp_mov')  ?? '---' ?></td>
                            <td class="text-center"><?= showAttachmentStatusMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'supp_mov') ??  showAttachmentStatusMT($conn, $kra['mtobj_id'], $_SESSION['user_id'], $_SESSION['school_id'], $_SESSION['active_sy_id'], 'main_mov') ?></td>
                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-dark text-white text-white font-weight-bold text-center">
            Attachments for <?= $_SESSION['active_sy'] ?>
        </div>

    </div>
</div>

<?php include 'samplefooter.php' ?>