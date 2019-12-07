<?php

use RPMSdb\RPMSdb;

include_once 'sampleheader.php'; ?>
<!--Collapse message -->
<div class="container mb-4">
    <p>
        <!-- Button for Announcement -->
        <button id="ann-btnshow" class="btn btn-outline-dark btn-sm" data-toggle="collapse" data-target="#announcementCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class=" fa fa-newspaper"></i> Announcements
        </button>
        <!-- end btn for announcement -->

        <!-- btn for notif -->
        <button class="btn btn-outline-dark btn-sm" data-toggle="collapse" data-target="#sampleCollapse2" aria-expanded="false" aria-controls="collapseExample">
            <i class=" fa fa-bell"></i> Sample Collapse 2
        </button>
        <!-- end of btn notif -->

        <!-- btn for abang1 -->
        <button class="btn btn-outline-dark btn-sm" data-toggle="collapse" data-target="#abang1" aria-expanded="false" aria-controls="collapseExample">
            Abang 1
        </button>
        <!-- end of btn abang1 -->

        <!-- btn for abang2 -->
        <button class="btn btn-outline-dark btn-sm" data-toggle="collapse" data-target="#abang2" aria-expanded="false" aria-controls="collapseExample">
            Abang 2
        </button>
        <!-- end of btn abang2 -->

    </p>
    <!-- Notification Collapse -->
    <div class="collapse m-2 border border-dark" id="sampleCollapse2">
        <div class="card">
            <div class="card-header font-weight-bold">
                <div class="d-flex">
                    <div class="p-2 w-100">
                        Sample Collapse 2
                    </div>

                </div>

            </div>
            <div class="card card-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit repellat iste consequuntur dicta. Animi doloribus, perferendis illo doloremque voluptas provident at. Ratione provident vel quia accusamus eius recusandae quis perspiciatis numquam accusantium, molestiae cum facere illum commodi dignissimos quo quod. Est, ut dignissimos esse quod sint reprehenderit aspernatur a earum veritatis doloremque ducimus, quae error. Laboriosam, voluptatibus a harum exercitationem distinctio minus illum deleniti blanditiis numquam, enim quis. Repellendus veritatis officia eius velit laboriosam nemo at distinctio temporibus earum incidunt. Aut, dicta non eius obcaecati saepe vero praesentium quam debitis architecto excepturi nobis quod tempora nesciunt rerum fugiat pariatur accusamus.
            </div>
        </div>
    </div>
    <!-- End of Notification List -->
    <!-- Announcement List -->

    <div class="collapse " id="announcementCollapse">
        <div class="card">
            <div class="card-header">
                Announcement List
            </div>
            <div class="card-body box">
                <?php
                if(!$_SESSION['active_sy_id'] == "N/A"):
                $result = RPMSdb::showAnnouncement($conn, $_SESSION['active_sy_id'], 5) or die($conn->error);
                if ($result) :
                    foreach ($result as $res) : ?>
                        <div class="card box">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="px-2 bd-highlight">
                                        <p><b>Subject: </b><?= $res['subject'] ?></p>
                                    </div>
                                    <div class="px-2 bd-highlight">
                                        <p><b>Title: </b><?= $res['title'] ?></p>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body"><?= $res['message'] ?></div>
                            <div class="card-footer">
                                <p><b>Date Posted:</b><?= $res['datetime_stamp'] ?></p>
                            </div>
                        </div><br />
                <?php
                    endforeach;
                endif; endif;?>

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



        <div class="col">

            <!-- First column -->



            <div class="col text-dark font-weight-bold">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between">
                            <div class="p-2"> School Personnel List</div>
                            <div class="p-2 ">
                                <!-- SELECT OPTION FOR FILTER SCHOOL PERSONNEL -->
                                <select id="sel_pos" class="form-control form-control-md">
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="card-body box">
                        <table class="table table-sm ">
                            <thead class="bg-light">
                                <tr>
                                    <td>#</td>
                                    <td>Name: </td>
                                    <td>Position </td>
                                </tr>
                            </thead>
                            <tbody id="sch_personnel">
                                <!-- List of School Personnel -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- <div class="card-footer">
                        <p class=" font-weight-normal">Total of School Personnel:</p>
                    </div> -->
                </div>
            </div>


        </div>


        <div class="col text-info black-border">
            <div id=""></div>
        </div>

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
<script>
    showOptionPosition();
    showAllPersonnel();
</script>