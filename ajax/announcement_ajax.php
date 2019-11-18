<?php
session_start();

use RPMSdb\RPMSdb;

include_once '../classes/rpmsdb/rpmsdb.class.php';



include '../includes/conn.inc.php';
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


<?php
    endforeach;
endif; ?>