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

        <!--  2nd column of 2nd row -->

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
    <!-- End of Second Row -->
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
    <!-- Table for Principal List -->
    <div class="col">
        <div class="card">
            <div class="card-header font-weight-bold"><i class="fa fa-user-circle"></i> Master Teacher ESAT Level of Priority Summary</div>
            <div class="card-body box">
                <div id="levelofpriorityMT" style="width:max-width; height:300px;"></div>
                </div>
            </div>
        </div>

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
          FROM cot_mt_indicator_ave_tbl  WHERE school = '" . $_SESSION['school_id'] . "' GROUP BY indicator_id,average,sy) a
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
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "'  GROUP BY tobj_id,lvlcap) as b on a.tobj_id =b.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as c on a.tobj_id =c.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as d on a.tobj_id =d.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as e on a.tobj_id =e.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as f on a.tobj_id =f.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as g on a.tobj_id =g.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as h on a.tobj_id =h.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as i on a.tobj_id =i.tobj_id 
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
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "'  GROUP BY mtobj_id,lvlcap) as b on a.mtobj_id =b.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "'  GROUP BY mtobj_id,lvlcap) as c on a.mtobj_id =c.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as d on a.mtobj_id =d.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as e on a.mtobj_id =e.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as f on a.mtobj_id =f.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as g on a.mtobj_id =g.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as h on a.mtobj_id =h.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as i on a.mtobj_id =i.mtobj_id 
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
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as b on a.tobj_id =b.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as c on a.tobj_id =c.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as d on a.tobj_id =d.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as e on a.tobj_id =e.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as f on a.tobj_id =f.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as g on a.tobj_id =g.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as h on a.tobj_id =h.tobj_id 
        LEFT JOIN (select tobj_id,count(DISTINCT user_id)low from esat2_objectivest_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY tobj_id,lvlcap) as i on a.tobj_id =i.tobj_id 
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
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as b on a.mtobj_id =b.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as c on a.mtobj_id =c.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as d on a.mtobj_id =d.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE lvlcap = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as e on a.mtobj_id =e.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 1 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as f on a.mtobj_id =f.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 2 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as g on a.mtobj_id =g.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 3 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as h on a.mtobj_id =h.mtobj_id 
                LEFT JOIN (select mtobj_id,count(DISTINCT user_id)low from esat2_objectivesmt_tbl WHERE priodev = 4 AND sy = '" . $_SESSION['active_sy_id'] . "' and  school = '" . $_SESSION['school_id'] . "' GROUP BY mtobj_id,lvlcap) as i on a.mtobj_id =i.mtobj_id 
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

showOptionPosition();
showAllPersonnel();


</script>

<?php include_once 'samplefooter.php' ?>
<script>
    // annBtnShow.click(fetchAnnouncement());
</script>