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
        <button class="btn btn-outline-dark btn-sm" data-toggle="collapse" data-target="#notifCollapse" aria-expanded="false" aria-controls="collapseExample">
            <i class=" fa fa-bell"></i> Notifications
        </button>
        <!-- end of btn notif -->



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




</div>
<!-- End of collapse container -->





<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<!-- Main Container -->
<div class="container-fluid">

    <div class="row">

        <!-- First row -->



        <div class="col">

            <!-- First column -->

            <!-- Total of Active Teachers -->

            <div class="col">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100">
                                <h6><i class="fa fa-users"></i> Total of Active Teachers</h6>
                            </div>
                            <div class="left-shrink">
                                <input type="button" id="show-tcount-btn" class="btn btn-sm btn-primary" value="Show Table">
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body box">
                        <div id="teacher_count_table">
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

<!-- IPCRF Summary -->

<div class="col">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100">
                                <h6><i class="fa fa-users"></i> IPCRF Rating Per Schools</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body box">
                        <div id="teacher_count_table">
                            <table class=" table table-sm table-responsive-sm table-hover ">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>School Name</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody class="box">
                                    <?php
                                    //  and $sch_t['T'] || $sch_t['MT']
                                    $num = 1;
                                    $ipcrf_total = RPMSdb::ipcrfsum($conn);
                                    foreach ($ipcrf_total as $ipcrf_t) :
                                        if (!empty($ipcrf_t['school_id'])) : ?>
                                            <td><?= $num++ ?></td>
                                            <td><?= displaySchool($conn, $ipcrf_t['school_id']); ?></td>
                                            <td class="font-weight-bold text-success"><?= $ipcrf_t['rating'] ?></td>
                                            
                                        <?php endif ?>
                                </tbody>
                            <?php endforeach; ?>
                            </table>
                        </div>

                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>


        
<!-- End of IPCRF -->



        <!-- Table for Principal List -->
        <div class="col">
            <div class="card">
                <div class="card-header font-weight-bold"><i class="fa fa-user-circle"></i> Principals</div>
                <div class="card-body box">
                    <table class="table table-sm  table-responsive-sm">
                        <thead class="bg-light font-weight-bold">
                            <tr>
                                <th>#</th>
                                <th>Principal</th>
                                <th>School</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $principal = RPMSdb::showAllPrincipal($conn);
                            $nump = 1;
                            foreach ($principal as $prin) : ?>
                                <tr>
                                    <td><?= $nump++ ?></td>
                                    <td><?= displayName($conn, $prin['user_id']) ?></td>
                                    <td><?= displaySchool($conn, $prin['school_id']) ?></td>
                                    <td><?= $prin['contact'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                        <tfoot class="bg-light font-weight-bold">
                            <tr>

                                <td colspan="5"> Principal Total: <?= count($principal) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Table for Principal List  -->
        <!-- End of First Row -->
    </div>
    <br/>
    <!-- Second Row -->
    <div class="row">
        <!-- 1st column of 2nd row -->
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i> Teacher COT Average Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="cotchart" style="width:max-width; height:300px;"></div>
                </div>
            </div>
        </div>
        <!-- End of 1st column of 2nd row  -->

        <!--  2nd column of 2nd row -->
        <br/>                        
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i> Master Teacher COT Average Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="cotMTchart" style="width:max-width; height:300px;"></div>
                </div>
            </div>
        </div>
        <!-- End of 2nd column of 2nd row   -->
    </div>
    <br/>
    <!-- End of Second Row -->
    <div class="row">
        <div class="col">
            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i> Teacher ESAT Level of Capability Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="selfassessmentchart" style="width:max-width; height:300px;"></div>
                </div>
                <!-- end of card-body -->
            </div>
            <!-- end of card -->
        </div>
        <!-- Table for Principal List -->
        <div class="col">
            <div class="card">
                <div class="card-header font-weight-bold"><i class="fa fa-user-circle"></i> Master Teacher ESAT Level of Capability Summary</div>
                <div class="card-body box">
                    <div id="selfassessmentMTchart" style="width:max-width; height:300px;"></div>
                </div>
            </div>
        </div>
        <!-- End Table for Principal List  -->
    </div>

    <br/>
    <div class="row">
        <div class="col">
            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i> Teacher ESAT Level of Priority Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="levelofpriority" style="width:max-width; height:300px;"></div>
                </div>
                <!-- end of card-body -->
            </div>
            <!-- end of card -->
        </div>
        <!-- Table for Principal List -->
        <div class="col">
            <div class="card">
                <div class="card-header font-weight-bold"><i class="fa fa-user-circle"></i> Master Teacher ESAT Level of Priority Summary</div>
                <div class="card-body box">
                    <div id="levelofpriorityMT" style="width:max-width; height:300px;"></div>
                </div>
            </div>
        </div>
        <br/>
                

        <!-- End Table for Principal List  -->
    </div>


    <!-- Teacher Average IPCRF Summary -->

    <div class="row">
        <div class="col">
            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i>Teacher Average IPCRF Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="chartIPCRFT" style="width:max-width; height:300px;"></div>
                </div>
                <!-- end of card-body -->
            </div>
            <!-- end of card -->
        </div>  
<!-- End of Teacher Average IPCRF Summary -->
<!-- Master Teacher Average IPCRF Summary -->

        <div class="col">
            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="w-100">
                            <h6><i class="fa fa-users"></i>Master Teacher Average IPCRF Summary</h6>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body box">
                    <div id="chartIPCRFMT" style="width:max-width; height:300px;"></div>
                </div>
                <!-- end of card-body -->
            </div>
            <!-- end of card -->
        </div>  
        <!-- End of Teacher Average IPCRF Summary -->
    </div>
        
</div>

<!-- End of main container -->

<!-- COT Chart Function -->

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(chartCoT);

    function chartCoT() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Indicator No.', 'School Year 1', 'School Year 2', 'School Year 3', 'Average'],
            <?php
            $position = 'Teacher I';
            $qry = $conn->query("SELECT a.indicator_id, AVG(a.T_average) AS T_average,AVG(a.sy) AS sy,AVG(a.sy2) as sy2, AVG(a.sy3) as sy3 FROM
        (SELECT indicator_id,AVG(average) AS T_average,
          CASE WHEN sy = ('" . $_SESSION['active_sy_id'] . "')-2 THEN AVG(average) END AS sy3,
          CASE WHEN sy = ('" . $_SESSION['active_sy_id'] . "')-1 THEN AVG(average) END AS sy2,
          CASE WHEN sy = '" . $_SESSION['active_sy_id'] . "' THEN AVG(average) END AS sy
          FROM cot_t_indicator_ave_tbl  GROUP BY indicator_id,average,sy) a
          GROUP BY a.indicator_id") or die($conn->error);
            while ($cotQry = $qry->fetch_assoc()) :
                echo "['" . $cotQry['indicator_id'] . "', 
                " . rawRate(($cotQry['sy3']), $position) . ",  
                " . rawRate(($cotQry['sy2']), $position) . ",   
                " . rawRate(($cotQry['sy']), $position) . ", 
                " . rawRate(($cotQry['T_average']), $position) . "],";
            endwhile;
            ?>
        ]);

        var options = {
            title: 'Classroom Observation',
            vAxis: {
                title: 'Rating'
            },
            hAxis: {
                title: 'Indicator and Period No.'
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                3: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('cotchart'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(chartCoT);

    function chartCoT() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Indicator No.', 'School Year 1', 'School Year 2', 'School Year 3', 'Average'],
            <?php

            $qry = $conn->query("SELECT a.indicator_id, AVG(a.T_average) AS T_average,AVG(a.sy) AS sy,AVG(a.sy2) as sy2, AVG(a.sy3) as sy3 FROM
        (SELECT indicator_id,AVG(average) AS T_average,
          CASE WHEN sy = ('" . $_SESSION['active_sy_id'] . "')-2 THEN AVG(average) END AS sy3,
          CASE WHEN sy = ('" . $_SESSION['active_sy_id'] . "')-1 THEN AVG(average) END AS sy2,
          CASE WHEN sy = '" . $_SESSION['active_sy_id'] . "' THEN AVG(average) END AS sy
          FROM cot_mt_indicator_ave_tbl  GROUP BY indicator_id,average,sy) a
          GROUP BY a.indicator_id") or die($conn->error);
            while ($cotQry = $qry->fetch_assoc()) :
                echo "['" . $cotQry['indicator_id'] . "', 
                " . rawRate(($cotQry['sy3']), $position) . ",  
                " . rawRate(($cotQry['sy2']), $position) . ",   
                " . rawRate(($cotQry['sy']), $position) . ", 
                " . rawRate(($cotQry['T_average']), $position) . "],";
            endwhile;
            ?>
        ]);

        var options = {
            title: 'Classroom Observation',
            vAxis: {
                title: 'Rating'
            },
            hAxis: {
                title: 'Indicator and Period No.'
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                3: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('cotMTchart'));
        chart.draw(data, options);
    }
</script>


<!-- End of COT Chart Function -->

<!-- ESAT Level Capability -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(SelfAssessmentChart);

    function SelfAssessmentChart() {
        let data = google.visualization.arrayToDataTable([
            ['Objective', 'Low', 'Moderate', 'High', 'Very High'],

            <?php

            $qry = mysqli_query($conn, "SELECT a.tobj_id, b.low as L_LOW, c.low as L_MODERATE, d.low as L_HIGH, e.low as L_VERY_HIGH, f.low as P_LOW, g.low as P_MODERATE, h.low as P_HIGH, i.low as P_VERY_HIGH from tobj_tbl a 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as b on a.tobj_id =b.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as c on a.tobj_id =c.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as d on a.tobj_id =d.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as e on a.tobj_id =e.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as f on a.tobj_id =f.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as g on a.tobj_id =g.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as h on a.tobj_id =h.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as i on a.tobj_id =i.tobj_id 
        GROUP BY a.tobj_id, b.low, c.low, d.low, e.low") or die($conn->error . $qry);

            foreach ($qry as $result) :
                echo "
                [" . $result['tobj_id'] . ", 
                " . intval($result['L_LOW']) . " ,
                " . intval($result['L_MODERATE']) . ",
                " . intval($result['L_HIGH'])  . ",
                " . intval($result['L_VERY_HIGH'])  . ",],
                ";
            endforeach;

            ?>
        ]);
        let options = {
            title: 'Level of Capability',
            vAxis: {
                title: 'No. of Teachers',
                maxValue: 10
            },
            hAxis: {
                title: 'Objective and Level of Capability',
                maxValue: 13,
                minValue: 1,
                ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        let chart = new google.visualization.ComboChart(document.getElementById('selfassessmentchart'));
        chart.draw(data, options)


    };
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(SelfAssessmentChart);

    function SelfAssessmentChart() {
        let data = google.visualization.arrayToDataTable([
            ['Objective', 'Low', 'Moderate', 'High', 'Very High'],

            <?php

            $qry = mysqli_query($conn, "SELECT a.mtobj_id, b.low as L_LOW, c.low as L_MODERATE, d.low as L_HIGH, e.low as L_VERY_HIGH, f.low as P_LOW, g.low as P_MODERATE, h.low as P_HIGH, i.low as P_VERY_HIGH from mtobj_tbl a 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as b on a.mtobj_id =b.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as c on a.mtobj_id =c.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as d on a.mtobj_id =d.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as e on a.mtobj_id =e.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as f on a.mtobj_id =f.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as g on a.mtobj_id =g.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as h on a.mtobj_id =h.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "'  GROUP BY mtobj_id,lvlcap) as i on a.mtobj_id =i.mtobj_id 
                GROUP BY a.mtobj_id, b.low, c.low, d.low, e.low") or die($conn->error . $qry);

            foreach ($qry as $result) :
                echo "
    [" . $result['mtobj_id'] . ", 
    " . intval($result['L_LOW']) . " ,
    " . intval($result['L_MODERATE']) . ",
    " . intval($result['L_HIGH'])  . ",
    " . intval($result['L_VERY_HIGH'])  . ",],
    ";
            endforeach;

            ?>
        ]);
        let options = {
            title: 'Level of Capability',
            vAxis: {
                title: 'No. of Teachers',
                maxValue: 10
            },
            hAxis: {
                title: 'Objective and Level of Capability',
                maxValue: 13,
                minValue: 1,
                ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        let chart = new google.visualization.ComboChart(document.getElementById('selfassessmentMTchart'));
        chart.draw(data, options)


    };
</script>
<!--End of ESAT Level Capability -->

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(LevelofPriority);

    function LevelofPriority() {
        let data = google.visualization.arrayToDataTable([
            ['Objective', 'Low', 'Moderate', 'High', 'Very High'],

            <?php

            $qry = mysqli_query($conn, "SELECT a.tobj_id, b.low as L_LOW, c.low as L_MODERATE, d.low as L_HIGH, e.low as L_VERY_HIGH, f.low as P_LOW, g.low as P_MODERATE, h.low as P_HIGH, i.low as P_VERY_HIGH from tobj_tbl a 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as b on a.tobj_id =b.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as c on a.tobj_id =c.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as d on a.tobj_id =d.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as e on a.tobj_id =e.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as f on a.tobj_id =f.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as g on a.tobj_id =g.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as h on a.tobj_id =h.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY tobj_id,lvlcap) as i on a.tobj_id =i.tobj_id 
        GROUP BY a.tobj_id, b.low, c.low, d.low, e.low") or die($conn->error . $qry);

            foreach ($qry as $result) :
                echo "
                [" . $result['tobj_id'] . ", 
                " . intval($result['P_LOW']) . " ,
                " . intval($result['P_MODERATE']) . ",
                " . intval($result['P_HIGH'])  . ",
                " . intval($result['P_VERY_HIGH'])  . ",],
                ";
            endforeach;

            ?>
        ]);
        let options = {
            title: 'Level of Priority',
            vAxis: {
                title: 'No. of Teachers',
                maxValue: 10
            },
            hAxis: {
                title: 'Objective and Level of Priority',
                maxValue: 13,
                minValue: 1,
                ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofpriority'));
        chart.draw(data, options)


    };
</script>


<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(LevelofPriority);

    function LevelofPriority() {
        let data = google.visualization.arrayToDataTable([
            ['Objective', 'Low', 'Moderate', 'High', 'Very High'],

            <?php

            $qry = mysqli_query($conn, "SELECT a.mtobj_id, b.low as L_LOW, c.low as L_MODERATE, d.low as L_HIGH, e.low as L_VERY_HIGH, f.low as P_LOW, g.low as P_MODERATE, h.low as P_HIGH, i.low as P_VERY_HIGH from mtobj_tbl a 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as b on a.mtobj_id =b.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as c on a.mtobj_id =c.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as d on a.mtobj_id =d.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as e on a.mtobj_id =e.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as f on a.mtobj_id =f.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as g on a.mtobj_id =g.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as h on a.mtobj_id =h.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' GROUP BY mtobj_id,lvlcap) as i on a.mtobj_id =i.mtobj_id 
                GROUP BY a.mtobj_id, b.low, c.low, d.low, e.low") or die($conn->error . $qry);

            foreach ($qry as $result) :
                echo "
    [" . $result['mtobj_id'] . ", 
    " . intval($result['P_LOW']) . " ,
    " . intval($result['P_MODERATE']) . ",
    " . intval($result['P_HIGH'])  . ",
    " . intval($result['P_VERY_HIGH'])  . ",],
    ";
            endforeach;

            ?>
        ]);
        let options = {
            title: 'Level of Priority',
            vAxis: {
                title: 'No. of Teachers',
                maxValue: 10
            },
            hAxis: {
                title: 'Objective and Level of Priority',
                maxValue: 13,
                minValue: 1,
                ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofpriorityMT'));
        chart.draw(data, options)


    };
</script>

<!-- Start of IPCRF Teacher Chart Function -->

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(ipcrfchartT);

    function ipcrfchartT() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['obj_id', 'Quality', 'Efficiency', 'Timeliness','Average'],
            <?php

            $qry = $conn->query("SELECT obj_id,
                                avg(quality) as quality,
                                avg(efficiency) as efficiency,
                                avg(timeliness) as timeliness,
                                round(avg(average)) as average
                                FROM ipcrf_t group by obj_id order by obj_id") or die($conn->error);
            while ($ipcrfqueryt = $qry->fetch_assoc()) :
                echo "['" . $ipcrfqueryt['obj_id'] . "', 
                " . $ipcrfqueryt['quality'] . ",  
                " . $ipcrfqueryt['efficiency'] . ",   
                " . $ipcrfqueryt['timeliness'] . ", 
                " . $ipcrfqueryt['average'] . ", 
                ],";
            endwhile;
            ?>
        ]);

        var options = {
            title: 'IPCRF Rating',
            vAxis: {
                title: 'Rating'
            },
            hAxis: {
                title: 'Objective and Rating'
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                3: {
                type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chartIPCRFT'));
        chart.draw(data, options);
    }
</script>


<!-- End of IPCRF Teacher Chart Function -->

<!-- Start of IPCRF Master Teacher Chart Function -->

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(ipcrfchartMT);

    function ipcrfchartMT() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['obj_id', 'Quality', 'Efficiency', 'Timeliness','Average'],
            <?php

            $qry = $conn->query("SELECT obj_id,
                                avg(quality) as quality,
                                avg(efficiency) as efficiency,
                                avg(timeliness) as timeliness,
                                round(avg(average)) as average
                                FROM ipcrf_mt group by obj_id order by obj_id") or die($conn->error);
            while ($ipcrfqueryt = $qry->fetch_assoc()) :
                echo "['" . $ipcrfqueryt['obj_id'] . "', 
                " . $ipcrfqueryt['quality'] . ",  
                " . $ipcrfqueryt['efficiency'] . ",   
                " . $ipcrfqueryt['timeliness'] . ", 
                " . $ipcrfqueryt['average'] . ", 
                ],";
            endwhile;
            ?>
        ]);

        var options = {
            title: 'IPCRF Rating',
            vAxis: {
                title: 'Rating'
            },
            hAxis: {
                title: 'Objective and Rating'
            },
            explorer: {
                axis: 'horizontal',
                keepInBounds: true
            },
            seriesType: 'bars',
            bar: {
                groupWidth: 50
            },
            series: {
                3: {
                type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chartIPCRFMT'));
        chart.draw(data, options);
    }
</script>


<!-- End of IPCRF Master Teacher Chart Function -->

<?php include_once 'samplefooter.php' ?>
<script>
    // annBtnShow.click(fetchAnnouncement());
</script>