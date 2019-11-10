<?php

use PHPMailer\PHPMailer\Exception;

include_once '../classes/rpmsdb/rpmsdb.class.php';

$res_arr = [];
include '../includes/conn.inc.php';
$qry = 'SELECT * FROM `announcement_tbl` WHERE `status` = "Active" ORDER BY id  desc LIMIT 6';
$result = mysqli_query($conn, $qry) or die($conn->error);

if ($result) :
    foreach ($result as $res) :
        $subject = $res['subject'];
        $title = $res['title'];
        $id = $res['id'];
        $message = $res['message'];
        $timestamp = $res['datetime_stamp'];
        ?>

        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="px-2 bd-highlight">
                        <p><b>Subject: </b><?= $subject ?></p>
                    </div>
                    <div class="px-2 bd-highlight">
                        <p><b>Title: </b><?= $title ?></p>
                    </div>
                    <div class="ml-auto px-2">
                        <div class="row">
                            <div class="px-2">
                                <a href="?ann_id=<?= $id ?>" id="ann-btnupdate" class="btn btn-info btn-sm" data-ann-id="<?= $id ?>" data-toggle="modal" data-target="#updateAnnouncementModal<?= $id ?>">Update</a>
                            </div>
                            <div class="px-2">
                                <button class="btn btn-danger btn-sm" data-ann-id="<?= $id ?>">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body"><?= $message ?></div>
            <div class="card-footer">
                <p><b>Date Posted:</b><?= $timestamp ?></p>
            </div>
        </div><br />
        <link rel="stylesheet" href="../includes/func.lib.js">

        <!-- Update Announcement Modal -->
        <div class="modal fade" id="updateAnnouncementModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="show-notif" class="green-notif-border"><?= $id ?></p>
                        <?php
                                if (isset($id)) :
                                    $results = RPMSdb\RPMSdb::displayAnnouncement($conn, $id) or die($conn->error);
                                    foreach ($results as $res) :
                                        $up_id = $res['id'];
                                        $up_subject = $res['subject'];
                                        $up_title = $res['title'];
                                        $up_message = $res['message'];
                                    endforeach;
                                endif;
                                ?>
                        <form method="post" id="update_announcement_form">
                            <input type="hidden" id="user_id" value="<?= $up_id ?>" />
                            <div class="form-group-sm">
                                <label for="subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" id="update-subject" value="<?= $up_subject ?>">
                            </div>
                            <div class="form-group-sm">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="update-title" value="<?= $up_title ?>">
                            </div>
                            <div class="form-group-sm">
                                <label for="message" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="update-message"><?= $up_message ?></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of Update Announcement Modal -->

<?php
    endforeach;
// echo json_encode($res_arr);

else :
    echo 'No result';
endif;

?>