<?php

use RPMSdb\RPMSdb;

include_once 'sampleheader.php'; ?>
<!--Collapse message -->
<div class="container mb-4">
    <p>
        <!-- Button for Announcement -->
        <button id="ann-btnshow" class="btn btn-outline-dark" data-toggle="collapse" data-target="#announcementCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class=" fa fa-newspaper"></i> Announcements
        </button>
        <!-- end btn for announcement -->

        <!-- btn for notif -->
        <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#notifCollapse" aria-expanded="false" aria-controls="collapseExample">
            <i class=" fa fa-bell"></i> Notifications
        </button>
        <!-- end of btn notif -->

        <!-- btn for abang1 -->
        <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#abang1" aria-expanded="false" aria-controls="collapseExample">
            Abang 1
        </button>
        <!-- end of btn abang1 -->

        <!-- btn for abang2 -->
        <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#abang2" aria-expanded="false" aria-controls="collapseExample">
            Abang 2
        </button>
        <!-- end of btn abang2 -->

    </p>
    <!-- Notification Collapse -->
    <div class="collapse m-2 border border-dark" id="notifCollapse">
        <div class="card">
            <div class="card-header font-weight-bold">
                <div class="d-flex">
                    <div class="p-2 w-100">
                        Notification List
                    </div>
                    <div class="p-2 flex-shrink-1">
                        <a href="settings/notification_settings.php" class="btn btn-sm btn-primary">View All Notifications</a>
                    </div>
                </div>

            </div>
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
                    else : echo "<p class='text-danger font-weight-bold text-center'>No notification!</p>";
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Notification List -->
    <!-- Announcement List -->

    <div class="collapse " id="announcementCollapse">
        <div class="card box">
            <div class=" card card-header font-weight-bold">
                <div class="d-flex justify-content-between">
                    <div class="p-2">Announcement List</div>
                    <div class="row">
                        <div class="p-2"> <input type="submit" value="Add Announcement" class="btn btn-sm btn-success" data-toggle="modal" data-target="#AddAnnouncement"></div>

                        <div class="p-2">
                            <a href="settings/announcement_settings.php" class="btn btn-sm btn-primary">Announcement Settings</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class=" card-body text-dark">
                <div class="list-group">
                    <div id='fetch-announcement'>
                        <!-- result here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of announcement list -->

    <!-- Start of Abang 1 -->
    <div class="collapse m-2 border border-dark" id="abang1">
        <div class="card">
            <div class=" card card-header font-weight-bold">
                <div class="d-flex justify-content-between">
                    <div class="p-2-">Abang Result</div>
                </div>
            </div>
            <div class=" card-body text-dark">
                <div class="list-group">
                    <div id='data-sample'>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, eos dicta labore laborum eaque amet qui ex temporibus quidem tempora quod earum molestias possimus expedita perspiciatis officiis doloribus aut voluptate deserunt enim placeat assumenda beatae excepturi? Inventore perferendis earum neque facilis odio illo explicabo nam ullam. Dolorem eligendi, eveniet eos cumque quisquam maxime minus natus voluptas alias amet aliquam dolor officia ad culpa velit consequatur. Tenetur ad blanditiis culpa magnam nihil quo rem. Distinctio non voluptates quisquam illum nisi blanditiis obcaecati molestias, nihil ad amet dicta ut, perferendis eum odit, exercitationem adipisci eos voluptate facilis! Quas alias mollitia ipsam autem?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Abang 1 -->

    <!-- Start of Abang 2 -->
    <div class="collapse m-2 border border-dark" id="abang2">
        <div class="card">
            <div class=" card card-header font-weight-bold">
                <div class="d-flex justify-content-between">
                    <div class="p-2-">Abang Result 2</div>
                </div>
            </div>
            <div class=" card-body text-dark">
                <div class="list-group">
                    <div id='data-sample'>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, eos dicta labore laborum eaque amet qui ex temporibus quidem tempora quod earum molestias possimus expedita perspiciatis officiis doloribus aut voluptate deserunt enim placeat assumenda beatae excepturi? Inventore perferendis earum neque facilis odio illo explicabo nam ullam. Dolorem eligendi, eveniet eos cumque quisquam maxime minus natus voluptas alias amet aliquam dolor officia ad culpa velit consequatur. Tenetur ad blanditiis culpa magnam nihil quo rem. Distinctio non voluptates quisquam illum nisi blanditiis obcaecati molestias, nihil ad amet dicta ut, perferendis eum odit, exercitationem adipisci eos voluptate facilis! Quas alias mollitia ipsam autem?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Abang 2 -->


</div>
<!-- End of collapse container -->





<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<!-- Main Container -->
<div class="container-fluid">

    <div class="row">

        <!-- First row -->



        <div class="col-sm-6">

            <!-- First column -->

            <!-- Total of Active Teachers -->

            <div class="col">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2 w-100">
                                <h6>Total of Active Teachers</h6>
                            </div>
                            <div class="p-2 left-shrink">
                                <input type="button" id="show-tcount-btn" class="btn btn-sm btn-primary" value="Show Table">
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body box">
                        <div class="" id="teacher_count_table">
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
                                <tbody class="box">
                                    <?php
                                    //  and $sch_t['T'] || $sch_t['MT']
                                    $num = 1;
                                    $t_total = RPMSdb::totalTeacherPerSchool($conn);
                                    foreach ($t_total as $sch_t) :
                                        if (!empty($sch_t['school_id'])) : ?>
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
                                    <td> <?= RPMSdb::totalTOnlyCount($conn) ?></td>
                                    <td> <?= RPMSdb::totalMTOnlyCount($conn) ?></td>
                                    <td><?= $totalCount = RPMSdb::totalTeachersCount($conn) ?></td>
                                </tr>
                            </tfoot>
                            </table>

                        </div>


                        <!-- Total Chart for Teacher -->
                        <div id="teacher_count_chart">
                            <div style="width:max-width; height:300px;" id="teacher_chart"></div>
                        </div>
                        <!-- End of Total Chart for Teacher -->

                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>


        </div>

        <!-- Table for Principal List -->
        <div class="col-sm box">
            <div class="card">
                <div class="card-header">Principals</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Principal</th>
                                <th>School</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $principal = RPMSdb::showAllPrincipal($conn);
                            foreach ($principal as $prin) : ?>
                                <tr>
                                    <td><?= displayName($conn, $prin['user_id']) ?></td>
                                    <td><?= displaySchool($conn, $prin['school_id']) ?></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Table for Principal List  -->
        <!-- End of First Row -->
    </div>

    <!-- Second Row -->
    <div class="row">
        <!-- 1st column of 2nd row -->
        <div class="col-4 text-primary black-border">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro tenetur ducimus, corrupti sunt vel corporis voluptates provident obcaecati soluta? Rerum, id similique veniam dignissimos sit eveniet facilis modi sint voluptates error nisi nesciunt nostrum commodi aut optio, accusamus laboriosam necessitatibus reprehenderit exercitationem recusandae rem repellendus natus alias? Perspiciatis, expedita excepturi!
        </div>
        <!-- End of 1st column of 2nd row  -->

        <!--  2nd column of 2nd row -->
        <div class="col text-secondary black-border">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam dicta, atque aperiam distinctio vel voluptas aliquid neque. Maxime tenetur iure labore placeat sunt sequi quis provident iusto nesciunt obcaecati sint sed eum magnam fugiat est minus dolore animi, esse eaque voluptatum ullam id vel aliquid necessitatibus? Tenetur cum dicta animi sapiente explicabo doloremque, sint vel ut aut laboriosam voluptatum nihil tempora cumque aspernatur praesentium distinctio expedita repudiandae exercitationem beatae. Voluptates non aspernatur quasi repellat facilis consequuntur unde debitis iste repudiandae similique esse cupiditate, nulla dolores vitae voluptatem veritatis vel, molestiae reiciendis error officiis dolorem soluta? Ipsa nesciunt accusamus alias eum.
        </div>
        <!-- End of 2nd column of 2nd row   -->
    </div>
    <!-- End of Second Row -->

    <div class="row">
        <div class="col text-success black-border">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium incidunt nostrum accusamus, reiciendis eveniet libero eius iste possimus, sit dolorem voluptatum fugiat delectus quo! Numquam reiciendis a totam, molestiae quas reprehenderit facilis tempora odit ipsa fuga et in ab excepturi vitae qui explicabo amet quis rem. Repudiandae, pariatur eligendi sunt esse impedit unde aliquam id nam sint placeat mollitia natus. Et eius totam sequi veritatis alias quos error, sapiente reiciendis saepe minima quidem magni natus eligendi nobis. At similique perferendis, iure quasi et nobis minima. Molestias nobis amet aperiam, nostrum, inventore quasi ab alias iusto ipsa maxime cum dolores?
        </div>
    </div>












</div>
<!-- End of main container -->

<?php include_once 'samplefooter.php' ?>