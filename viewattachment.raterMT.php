<?php

use RPMSdb\RPMSdb;

$num = 1;
include 'sampleheader.php';
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
                        $mov_b = rpmsdb::fetch_B_MT_MOV_ATT($conn, $user_id, $_SESSION['school_id'], $_SESSION['active_sy_id']);
                        foreach ($mov_b as $mov) : ?>
                            <td>
                                <p><?php echo $num++ ?></p>
                            </td>
                            <td>
                                <p><?php echo displayKRA($conn, $mov['kra_id'])  ?></p>
                            </td>
                            <td>
                                <p><?php echo displayObjectiveMT($conn, $mov['obj_id']) ?? "-----" ?></p>
                            </td>
                            <td>
                                <p class="text-center"><?php echo displayMainMOVattachment($conn, $mov['attach_mov_id'], $mov['kra_id'], $mov['obj_id'])  ?? "-----" ?></p>
                            </td>
                            <td>
                                <p class="text-center"><?php echo displayMainMOVstatus($conn, $mov['attach_mov_id'], $mov['kra_id'], $mov['obj_id'])  ?? "-----" ?></p>
                            </td>
                            <td>
                                <p class="text-center"><?php echo (displaySuppMOVattachment($conn, $mov['attach_mov_id'], $mov['kra_id'], $mov['obj_id']))  ?? "-----" ?></p>
                            </td>
                            <td>
                                <p class="text-center"><?php echo (displaySuppMOVstatus($conn, $mov['attach_mov_id'], $mov['kra_id'], $mov['obj_id']))  ?? "-----" ?></p>
                            </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include 'samplefooter.php' ?>