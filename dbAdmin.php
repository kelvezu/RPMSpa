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



<!-- Adding BORDERS to determine the width and height of each div -->
<!-- Main Container -->
<div class="container-fluid">

    <div class="row">
        <!-- First row -->

        <div class="col">
            <!-- First column -->
            <!-- Total of Active Teachers -->
            <div class="col">
                <!-- Card -->
                <div class="card border border-dark">
                    <div class="card-header">
                        <h6>Total of Active Teachers</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body overflow-auto">
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
            <!-- Total of Active Teachers -->
            <!-- End of First Column -->
        </div>


        <!-- 1st row 2nd column -->
        <div class="col text-danger">
            <div class="box">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quo officia suscipit delectus hic perspiciatis? Natus, id enim excepturi optio eaque dignissimos totam autem, maxime veritatis iste recusandae consequuntur molestiae ad. O
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid ipsa beatae, odio, natus amet quos ullam veniam exercitationem vitae corrupti delectus at assumenda sapiente alias dignissimos, ad perspiciatis. Minima veniam inventore voluptas praesentium et dolorum repudiandae laborum dolores nisi, tempore ipsa eos illum natus nihil odio doloremque maxime accusantium perspiciatis porro quo itaque vitae hic? Quod, debitis. Aspernatur libero iure aut deleniti praesentium necessitatibus sapiente eos! Obcaecati quasi iure mollitia itaque accusantium cumque, dolor atque. Tempora quidem error sequi corporis cumque ea voluptate, qui quis numquam culpa cum pariatur placeat eos laborum aliquam beatae blanditiis earum a amet ullam. Facere rerum, vero amet natus quos vitae quisquam voluptate repellat itaque architecto voluptatibus fugiat molestias rem laboriosam officia. Dolor nihil debitis, nulla exercitationem ipsam repellat odio molestiae! Architecto rerum eaque, similique quod voluptate pariatur cumque? Sit ad sed a tempore molestias, nam ea dicta magnam dolores, excepturi magni, temporibus est. Dignissimos, assumenda itaque fugiat neque, alias est earum corporis fuga, at vero labore. Est quas, voluptatibus facere similique doloremque ut iusto. Alias provident ipsam at in culpa perferendis ea exercitationem minus, fugiat dolorem? Possimus deleniti perferendis neque fugiat? Cupiditate blanditiis expedita iure doloremque? Ea dicta expedita quibusdam debitis animi nostrum laudantium, inventore minus dolores itaque suscipit modi cupiditate at beatae numquam temporibus qui aliquid! Facere, autem, architecto quaerat quos ullam explicabo mollitia sit blanditiis, non assumenda dolores porro. Laboriosam consequatur aspernatur sapiente ipsam modi porro accusantium officia totam omnis aliquid perferendis ipsa, illum voluptatibus fugit atque sit voluptatem cum quasi mollitia nisi suscipit nesciunt soluta? Inventore, esse? Quibusdam ea dolor excepturi, sit tenetur quo odit repudiandae porro ipsum dolorum nemo molestias esse ratione amet eius ipsa illo magnam nihil blanditiis suscipit, corrupti inventore. Temporibus, animi ipsum. Cumque iure blanditiis, atque aspernatur optio, consequuntur magni perferendis eos voluptate iste omnis vel unde, quas laudantium? Omnis nisi illo temporibus corrupti laboriosam aperiam optio hic accusantium numquam, debitis est. Ipsum molestias modi velit eligendi! Autem natus ea quisquam rerum reiciendis, amet animi numquam labore similique iste eius aliquid. Dolorum ipsum optio, consequatur iusto perferendis assumenda repellat repudiandae! Quos, est. Repellendus quo eum assumenda, animi quisquam accusantium omnis, quas sed asperiores modi velit vero possimus! Repellat obcaecati recusandae minima incidunt provident, fugit, hic excepturi, rem animi esse officia. Aperiam, ullam! Itaque reprehenderit dolor dicta voluptatibus sed natus tempore quidem earum suscipit assumenda vero, amet molestiae quibusdam, officia rerum est atque nobis veniam optio vitae omnis magni, a tempora? Explicabo eos nesciunt tenetur accusantium quam minus. Laborum obcaecati, ad laudantium distinctio quas dolorem, accusamus in earum animi iste quae a. Hic voluptatem officia qui veritatis? Commodi distinctio consequatur pariatur, dicta ullam, unde porro ipsum repellat est, velit ipsam dignissimos possimus saepe deserunt? Provident accusantium voluptatem, pariatur eligendi adipisci vel delectus, explicabo optio error perspiciatis quam. Perspiciatis necessitatibus doloremque culpa, optio quae ipsum, omnis sint assumenda quam nihil aperiam nemo molestiae pariatur temporibus numquam impedit, recusandae vero minus. Itaque temporibus rem dolor odit, quae voluptate placeat, cumque, recusandae assumenda explicabo amet nisi a vel deleniti laboriosam!
            </div>

        </div>
        <!-- end  1st row 2nd column-->

        <div class=" col black-border text-warning ">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat quo officia suscipit delectus hic perspiciatis? Natus, id enim excepturi optio eaque dignissimos totam autem, maxime veritatis iste recusandae consequuntur molestiae ad. Officiis laboriosam provident ab nihil cumque assumenda aut molestias reprehenderit fugit, expedita ea sit quibusdam delectus quaerat doloremque voluptas.
        </div>


    </div>
    <!-- End of First Row -->

    <!-- Second Row -->
    <div class=" row">
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