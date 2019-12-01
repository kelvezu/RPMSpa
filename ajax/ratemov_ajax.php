<?php

use RPMSdb\RPMSdb;

include '../includes/conn.inc.php';
include '../libraries/func.lib.php';
include '../classes/rpmsdb/rpmsdb.class.php';

if (isset($_GET['user_id'])) :
    $user = intval($_GET['user_id']);
    $sy = $_GET['sy_id'];
    $school = $_GET['school_id'];
    $rater = $_GET['rater_id'];
    $mov_res = RPMSdb::showBmovMTuser($conn, $user, $sy, $school, $rater);
    $num = 1;
endif;

?>

<table class="table">
    <thead>
        <tr>
            <th>
                <p>#</p>
            </th>
            <th>
                <p>KRA and Objective</p>
            </th>
            <th>
                <p>MOV attachment</p>
            </th>
            <th>
                <p>MOV type</p>
            </th>
            <th>
                <p>Status</p>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($mov_res as $res) : ?>
                <td>
                    <p><?= $num++ ?></p>
                </td>
                <td>
                    <p>KRA <?= $res['kra_id'] ?> Objective <?= $res['obj_id'] ?></p>
                </td>
                <td>
                    <p><?= displayFileMT($conn, $res['mov_id']); ?></p>
                </td>
                <td>
                    <p><?= $res['mov_type'] . '-->' . $res['mov_id'] . '-->' . $res['user_id'] ?></p>
                </td>
                <td>
                    <p><?= $res['doc_status'] ?></p>
                </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>