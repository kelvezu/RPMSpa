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
                <thead class="alert alert-success">
                    <tr>
                        <th>#</th>
                        <th>Key Result Area</th>
                        <th>Objectives</th>
                        <th class="text-nowrap">Main MOV</th>
                        <th class="text-nowrap">Supporting MOV</th>
                    </tr>
                </thead>
                <tbody class="font-weight-bold">
                    <?php foreach ($KRAandOBJ as $kra) : ?>
                        <tr>
                            <td><?= $num++ ?></td>
                            <td><?= displayKRA($conn, $kra['kra_id']) ?></td>
                            <td><?= displayObjectiveMT($conn, $kra['mtobj_id']) ?></td>
                            <td></td>
                            <td></td>
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