<?php

use IPCRF\IPCRF;

include 'sampleheader.php';

$user_id = $_SESSION['user_id'];
$school = $_SESSION['school_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$ipcrf = new IPCRF($user_id, $sy, $school, $position);
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

                    <?php if ($user_ipcrf) : foreach ($user_ipcrf as $users) :
                            $user = $users['user_id'];

                    ?>
                            <tr>
                                <td>
                                    <p><?= $num++ ?></p>
                                </td>
                                <td>
                                    <p> <?= displayname($conn, $users['user_id']) ?> </p>
                                </td>

                                <td>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#ipcrf_modal<?= $user ?>">View IPCRF</button>
                                </td>

                                <td>
                                    <p><?= $users['doc_status'] ?></p>
                                </td>
                            <?php endforeach;
                    else : ?>
                            <td colspan="10" class="text-center text-danger font-weight-bold">No available IPCRF to Approved</td>
                            </tr>
                        <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php foreach ($user_ipcrf as $users) :
    $user = $users['user_id'];
    $position_view = displayPosition($conn, $user);
    $table = show_ipcrf_table($position_view);
    $ipcrf_view = $ipcrf->fetch_ipcrf_user_details($table, $user);

?>
    <!-- modal for ipcrf  -->
    <div id="ipcrf_modal<?= $user ?>" class="tite bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">IPCRF of <?= displayname($conn, $user) ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <?php if (!$ipcrf_view) :
                        echo '<p class="red-notif-border"> No record! </p>';
                    else :

                    ?>
                        <div class="card">
                            <div class="card-body box">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <p>
                                                    KRA
                                                </p>
                                            </th>

                                            <th>
                                                <p>
                                                    OBJECTIVE
                                                </p>
                                            </th>

                                            <th>
                                                <p>
                                                    QUALITY
                                                </p>
                                            </th>

                                            <th>
                                                <p>
                                                    EFFICIENCY
                                                </p>
                                            </th>

                                            <th>
                                                <p>
                                                    TIMELINESS
                                                </p>
                                            </th>
                                            <th>
                                                <p>
                                                    OBJECTIVE WEIGHT
                                                </p>
                                            </th>
                                            <th>
                                                <p>
                                                    SCORE
                                                </p>
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($ipcrf_view as $iv) :
                                            $kra = $iv['kra_id'];
                                            $obj = $iv['obj_id'];
                                            $quality = $iv['quality'];
                                            $efficiency = $iv['efficiency'];
                                            $timeliness = $iv['timeliness'];
                                            $objective_weight = $iv['objective_weight'];
                                            $score = $iv['score'];
                                            $actual_result_quality = $iv['actual_result_quality'];
                                            $actual_result_efficiency = $iv['actual_result_efficiency'];
                                            $actual_result_timeliness = $iv['actual_result_timeliness'];
                                        ?>
                                            <tr>

                                                <td>
                                                    <p>
                                                        <?= displayKRA($conn, $kra) ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p>
                                                        <?= $obj ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p>
                                                        <?= $quality ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p>
                                                        <?= $efficiency ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p>
                                                        <?= $timeliness ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?= $objective_weight ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?= $score ?>
                                                    </p>
                                                </td>
                                            <?php endforeach; ?>
                                            </tr>
                                    </tbody>
                                    <tfoot></tfoot>
                                </table>

                            </div>
                        </div>

                    <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-primary" href="includes/<?= show_ipcrf_process($position_view) ?>?user_update=<?= $user ?>&sy=<?= $sy ?>&school=<?= $school ?>&app_auth=<?= $user_id ?>">Approve</a>

                    <!-- <a class="btn btn-danger" href="includes/<?php /* show_ipcrf_process($position_view) ?>?user_decline=<?= $user ?>&sy=<?= $sy ?>&school=<?= $school ?>&app_auth=<?= $user_id */ ?>">Decline</a> -->
                    <button class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal<?= $user ?>">Declined</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?= $user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="includes/<?= show_ipcrf_process($position_view) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">State your comment for <?= displayName($conn, $user) ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="user" value="<?= $user ?>">
                        <input type="hidden" name="sy" value="<?= $sy ?>">
                        <input type="hidden" name="school" value="<?= $school ?>">
                        <input type="hidden" name="app_auth" value="<?= $user_id ?>">
                        <textarea class="form-control" name="comment" id="" cols="30" rows="10" required placeholder="Please include a comment"></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="user_decline" class="btn btn-primary">Declined the IPCRF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    ?>
    </div>
<?php endforeach ?>

<!-- modal for ipcrf  -->


<?php include 'samplefooter.php' ?>