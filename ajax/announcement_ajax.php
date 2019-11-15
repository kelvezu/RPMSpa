<?php
session_start();

use RPMSdb\RPMSdb;

include_once '../classes/rpmsdb/rpmsdb.class.php';


$res_arr = [];
include '../includes/conn.inc.php';
// $qry = 'SELECT * FROM `announcement_tbl` WHERE `status` = "Active" ORDER BY id  desc LIMIT 5';
// $result = mysqli_query($conn, $qry) or die($conn->error);
$result = RPMSdb::showAnnouncement($conn, $_SESSION['active_sy_id'], 5) or die($conn->error);

if ($result) :
    foreach ($result as $res) :
        $subject = $res['subject'];
        $title = $res['title'];
        $id = $res['id'];
        $message = $res['message'];
        $timestamp = $res['datetime_stamp'];
        ?>

        <div class="card h-25">
            <div class="card-header">
                <div class="d-flex">
                    <div class="px-2 bd-highlight">
                        <p><b>Subject: </b><?= $subject ?></p>
                    </div>
                    <div class="px-2 bd-highlight">
                        <p><b>Title: </b><?= $title ?></p>
                    </div>

                </div>
            </div>
            <div class="card-body"><?= $message ?></div>
            <div class="card-footer">
                <p><b>Date Posted:</b><?= $timestamp ?></p>
            </div>
        </div><br />

        <script src="../includes/func.lib.js"></script>
        <!-- Update Announcement Modal -->
        <!-- <div class="modal fade" id="updateAnnouncementModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"> -->

        <?php
                // if (isset($id)) :
                //     $results = RPMSdb\RPMSdb::displayAnnouncement($conn, $id) or die($conn->error);
                //     foreach ($results as $res) :
                //         $up_id = $res['id'];
                //         $up_subject = $res['subject'];
                //         $up_title = $res['title'];
                //         $up_message = $res['message'];
                //     endforeach;
                // endif;
                ?>

        <!-- <form method="POST" action="../includes/processannouncement.php">
                            <input type="hidden" id="ann_id" value="<?= $up_id ?>" />
                            <div class="form-group-sm">
                                <label for="subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" id="update-subject" name="upd_subj" value="<?= $up_subject ?>">
                            </div>
                            <div class="form-group-sm">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="update-title" name="upd_title" value="<?= $up_title ?>">
                            </div>
                            <div class="form-group-sm">
                                <label for="message" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="update-message" name="upd_message"><?= $up_message ?></textarea>
                            </div> -->

        <!-- </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Save Changes" />

                    </div>
                    </form>
                </div>
            </div>
        </div> -->


        <!-- End of Update Announcement Modal -->

<?php
    endforeach;
// echo json_encode($res_arr);

else :
    echo 'No result';
endif;

?>