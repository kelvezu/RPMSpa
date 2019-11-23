<?php

use RPMSdb\RPMSdb;

$num_t = 1;
$num_mt = 1;

include 'sampleheader.php';
$teacher_result = RPMSdb::fetchtallT($conn, $_SESSION['school_id']);
$masterteacher_result = RPMSdb::fetchtallMT($conn, $_SESSION['school_id']);
?>
<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="p-2">
            <h2>Class Observation Status</h2>
        </div>
    </div>

    <div class="row">
        <!-- Column for T -->
        <div class="col">
            <table class="table table-sm table-responsive-sm table-bordered">
                <thead class=" alert alert-success">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>View COT Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teacher_result as $t_res) : ?>
                        <tr>
                            <td><?= $num_t++ ?></td>
                            <td><?= displayname($conn, $t_res['user_id']) ?></td>
                            <td><?= $t_res['position'] ?></td>
                            <td></td>
                        <?php endforeach; ?>
                        </tr>
                </tbody>
            </table>
        </div>
        <!-- End Column for T -->

        <!-- Column for MT -->
        <div class="col">
            <table class="table table-sm table-responsive-sm table-bordered">
                <thead class=" alert alert-primary">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>View COT Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>


            </table>
        </div>
        <!-- End Column for MT -->
    </div>
</div>
<?php include 'samplefooter.php'; ?>