<?php

use IPCRF\IPCRF;

include 'sampleheader.php';

$user = $_SESSION['user_id'];
$school = $_SESSION['school_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$ipcrf = new IPCRF($user, $sy, $school, $position);
$user_ipcrf = $ipcrf->fetch_all_ipcrf_users_unapproved();
$num = 1;
?>


<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>
                            <p>#</p>
                        </th>
                        <th>
                            <p>User</p>
                        </th>

                        <th>
                            <p>IPCRF</p>
                        </th>


                        <th>
                            <p>IPCRF STATUS</p>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($user_ipcrf as $users) : ?>
                        <tr>
                            <td>
                                <p><?= $num++ ?></p>
                            </td>
                            <td>
                                <p> <?= displayname($conn, $users['user_id']) ?> </p>
                            </td>

                            <td>
                                <p> </p>
                            </td>

                            <td>
                                <p><?= $users['doc_status'] ?></p>
                            </td>
                        <?php endforeach; ?>


                        </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php include 'samplefooter.php' ?>