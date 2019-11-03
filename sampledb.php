<?php

use RPMSdb\RPMSdb;

include_once 'sampleheader.php'; ?>
<!--Collapse message -->
<div class="container mb-4">
    <p>
        <a class="btn btn-outline-primary" data-toggle="collapse" href="#tite" role="button" aria-expanded="false" aria-controls="collapseExample">
            Announcements
        </a>
        <button class="btn btn-outline-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Sample Buttons
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
        </div>
    </div>

    <div class="collapse" id="tite">
        <div class="card card-body">
            titetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetiteteititetitetei
        </div>
    </div>
</div>
<!-- End of collapse -->
<div class="container-fluid">
    <div class="row">


        <!-- Left Column -->
        <div class="col">

            <div class="mb-5">
                <div class="card  shadow">
                    <div class="card-header">
                        <h6>Notifications</h6>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati similique magni fuga, temporibus soluta autem expedita, ab tempore iusto excepturi blanditiis perspiciatis in illo aperiam voluptates sit ex, nihil
                    </div>
                    <div class="card-footer">
                        im a footer
                    </div>
                </div>
            </div>

            <div class="col mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6>Total of Active Teachers</h6>
                    </div>
                    <div class="card-body">
                        <table class=" table table-sm table-responsive-sm table-hover font-weight-bold ">
                            <thead class="bg-dark text-white">
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
                                        <td class="bg-success text-white"><?= $sch_t['T'] ?></td>
                                        <td class="bg-primary text-white"><?= $sch_t['MT'] ?></td>
                                        <td><?= $sch_t['T'] + $sch_t['MT']  ?></td>
                                    <?php endif ?>
                            </tbody>

                        <?php endforeach; ?>
                        <tfoot class="bg-dark text-white">
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
                <p class="text-primary black-border overflow-auto">titeLorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.</p>
            </div>
        </div>
        <!-- Right Column -->
        <div class="col">
            <p class="text-info black-border">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores debitis voluptatum rem fugit! Similique quo laboriosam molestias nisi exercitationem nemo sint repudiandae odio sequi laudantium, cum commodi quam voluptatum deleniti cumque aperiam temporibus unde mollitia, illum eveniet. Corrupti vitae, delectus, ipsa fugiat exercitationem atque soluta fugit, ullam odit reprehenderit ut.</p>
        </div>

    </div>











</div>

<?php include_once 'samplefooter.php' ?>