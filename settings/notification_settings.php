<?php

use RPMSdb\RPMSdb;

include 'header.php'

?>
<div class="container d-flex my-5">
    <div>
        <div class="card">
            <div class="card-header font-weight-bold">
                <div class="d-flex">
                    <div class="p-2 w-100">
                        Notification List
                    </div>
                    <div class="p-2 flex-left-shrink">
                        <?= directToDb($_SESSION['position']) ?? false ?>
                    </div>

                </div>
            </div>
            <div class="card card-body">
                <div class="list-group">
                    <?php
                    if (!empty(RPMSdb::showAllNotif($conn))) :
                        foreach (RPMSdb::showAllNotif($conn) as $notif) : ?>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $notif['category'] ?></h5>
                                    <small><?= displaySchool($conn, $notif['school_id']) ?></small>
                                </div>
                                <p class="mb-1"><?= $notif['message']  ?></p>
                                <small>Date posted: <?= displayDate($notif['datetime_stamp']) ?></small><br>
                            </a>
                            <br />


                    <?php
                        endforeach;
                    else : echo "<p class='text-danger font-weight-bold text-center'>No notification!</p>";
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php'
?>