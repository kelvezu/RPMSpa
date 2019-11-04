<?php

use RPMSdb\RPMSdb;

include_once 'sampleheader.php'; ?>
<!--Collapse message -->
<div class="container mb-4">
    <p>
        <!-- Button for Announcement -->
        <a class="btn btn-outline-dark" data-toggle="collapse" href="#announcementCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
            Announcements
        </a>
        <!-- end btn for announcement -->

        <!-- btn for notif -->
        <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#notifCollapse" aria-expanded="false" aria-controls="collapseExample">
            Notifications
        </button>
        <!-- end of btn notif -->
    </p>
    <!-- Notification Collapse -->
    <div class="collapse m-2" id="notifCollapse">
        <div class="card">
            <div class="card-header font-weight-bold">Notification List</div>
            <div class="card card-body">
                <div class="list-group">
                    <?php
                    if (!empty(RPMSdb::showNotif($conn))) :
                        foreach (RPMSdb::showNotif($conn) as $notif) : ?>
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
                    else : echo "<p class='font-weight-bold text-center'>No notification!</p>";
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Notification List -->
    <!-- Announcement List -->
    <div class="collapse m-2" id="announcementCollapse">
        <div class="card">
            <div class=" card card-header font-weight-bold">
                <div class="d-flex justify-content-between">
                    <div class="p-2-">Announcement List</div>
                    <div class="p-2-"> <input type="submit" value="Add Announcement" class="btn btn-sm btn-success" data-toggle="modal" data-target="#AddAnnouncement"></div>
                </div>
            </div>

            <div class=" card-body text-dark">
                <div class="list-group">
                    <div class="card">
                        <div class="card-header">
                            header
                        </div>
                        <div class="card-bdo">
                            body
                        </div>
                        <div class="card-footer">
                            footer
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of announcement list -->
</div>
<!-- End of collapse -->
<div class="container-fluid">
    <div class="row">


        <!-- Left Column -->
        <div class="col">

            <div class="mb-5">
                <div class="card  shadow">
                    <div class="card-header">
                        <h6>sample</h6>
                    </div>
                    <!--  -->
                    sample notif

                    <!--  -->
                </div>
            </div>

            <div class="col mb-3">
                <div class="card border border-dark">
                    <div class="card-header">
                        <h6>Total of Active Teachers</h6>
                    </div>
                    <div class="card-body">
                        <table class=" table table-sm table-responsive-sm table-hover ">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>School Name</th>
                                    <th>T</th>
                                    <th>MT</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                $t_total = RPMSdb::totalTeacherPerSchool($conn);
                                foreach ($t_total as $sch_t) :
                                    if (!empty($sch_t['school_id']) and $sch_t['T'] || $sch_t['MT']) : ?>
                                        <td><?= $num++ ?></td>
                                        <td><?= displaySchool($conn, $sch_t['school_id']); ?></td>
                                        <td class="font-weight-bold text-success"><?= $sch_t['T'] ?></td>
                                        <td class="font-weight-bold text-primary"><?= $sch_t['MT'] ?></td>
                                        <td class="font-weight-bold"><?= $sch_t['T'] + $sch_t['MT']  ?></td>
                                    <?php endif ?>
                            </tbody>

                        <?php endforeach; ?>
                        <tfoot class="bg-light font-weight-bold">
                            <tr>
                                <td class=" text-right" colspan="2">Total:</td>
                                <td> <?= RPMSdb::totalTOnlyCount($conn)["Total"] ?></td>
                                <td> <?= RPMSdb::totalMTOnlyCount($conn)["Total"] ?></td>
                                <td><?= RPMSdb::totalTeachersCount($conn)["Total"] ?></td>

                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->

            </div>


        </div>
        <!-- Middle Column -->
        <div class="col">
            <div>
                <p class="text-secondary black-border">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.</p>
            </div>


            <div>
                <p class="text-primary black-border">titeLorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.</p>
            </div>
        </div>
        <!-- Right Column -->
        <div class="col">
            <p class="text-info black-border">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.</p>
        </div>

    </div>











</div>

<?php include_once 'samplefooter.php' ?>