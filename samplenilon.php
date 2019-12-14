<?php include 'sampleheader.php' ?>

<script>

</script>
<div class="col">
                    <!-- mt cbc chart -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2 w-100">
                                    <h6>ESAT Result</h6>
                                </div>
                                <div class="p-2 left-shrink">
                                    <input type="button" id="show-mtcbc-btn" class="btn btn-sm btn-primary" value="Show Table">
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body box" style="height:500px;">
                            <div class="" id="mtcbc_table">
                                <table class=" table table-sm table-responsive-sm table-hover ">
                                    <thead class="bg-light"><b>Core Behavioral Competencies</b>
                                        <tr>
                                            <th>#</th>
                                            <th width="auto">Competencies</th>
                                            <th width="auto">Indicator</th>
                                            <th width="10%;">School Year</th>
                                        </tr>
                                    </thead>
                                    <tbody class="box">
                                        <?php
                                        //  and $sch_t['T'] || $sch_t['MT']
                                        $num = 1;
                                        $mtcbc = RPMSDB\RPMSdb::mtcbc($conn);
                                        foreach ($mtcbc as $mtcbcrow) :
                                            if (!empty($mtcbcrow['sy_desc'])) : ?>
                                                <td><?= $num++ ?></td>
                                                <td><?= $mtcbcrow['CBC_NAME']; ?></td>
                                                <td><?= $mtcbcrow['indicator'] ?></td>
                                                <td><?= $mtcbcrow['sy_desc'] ?></td>
                                            <?php endif ?>
                                    </tbody>

                                        <?php endforeach; ?>
                                </table>

                            </div>


                            <!-- Total Chart for Teacher -->
                            <div id="mt_cbc_chart">
                                                
                                <div style="width:max-width; height:1000px;" id="mtcbc_chart_div"></div>
                            
                            </div>
                            <!-- End of Total Chart for Teacher -->

                        </div>
                        <!-- end of card-body -->
                    </div>
                    <!-- end of card -->
                </div>

                <!-- mt chart Assessment -->
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2 w-100">
                                <h6>ESAT Result</h6>
                            </div>
                            <div class="p-2 left-shrink">
                                <input type="button" id="show-mtass-btn" class="btn btn-sm btn-primary" value="Show Table">
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body box" style="height:500px;">
                        <div class="" id="teacher_count_table">
                            <table class=" table table-sm table-responsive-sm table-hover ">
                                <thead class="bg-light"><b>Assessment of Capabilities and Priority</b>
                                    <tr>
                                        <th>#</th>
                                        <th width="auto">Objectives</th>
                                        <th width="auto">Level of Capability</th>
                                        <th width="auto">Priority for Development</th>
                                        <th width="10%;">School Year</th>
                                    </tr>
                                </thead>
                                <tbody class="box">
                                    <?php
                                    //  and $sch_t['T'] || $sch_t['MT']
                                    $num = 1;
                                    $mtlvlcap = RPMSDB\RPMSdb::mtlvlcap2($conn);
                                    foreach ($mtlvlcap as $mtlvlres) :
                                        if (!empty($mtlvlres['sy_desc'])) : ?>
                                            <td><?= $num++ ?></td>
                                            <td><?= $mtlvlres['OBJECTIVES']; ?></td>
                                            <td><?= $mtlvlres['lvlcap'] ?></td>
                                            <td><?= $mtlvlres['priodev'] ?></td>
                                            <td><?= $mtlvlres['sy_desc'] ?></td>
                                        <?php endif ?>
                                </tbody>

                                    <?php endforeach; ?>
                            </table>

                        </div>


                        <!-- Total Chart for Teacher -->
                        <div id="teacher_count_chart">
                                            
                            <div style="width:max-width; height:1000px;" id="mtass_chart_div"></div>
                        
                        </div>
                        <!-- End of Total Chart for Teacher -->

                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>


        </div>

<script>
        
        
        const mt_cbctable = document.getElementById('mtcbc_table');
        const mt_cbcchart = document.getElementById('teacher_count_chart');
        const showmtcbcbtn = document.getElementById('show-mtcbc-btn');
        const showmtassbtn = document.getElementById('show-mtass-btn');                                   
        mt_cbctable.style.display = "none";
        mt_cbcchart.style.display = "block";
        showmtcbcbtn.addEventListener('click', showmtcbc_chart);
        showmtassbtn.addEventListener('click', showmtass_chart);
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawmtcbcchart);
        google.charts.setOnLoadCallback(drawmtasschart);                                        

        let xhr = new XMLHttpRequest();
        xhr.open('GET','ajax/cbcdisplay_ajax.php');
        console.log(xhr.status);
        xhr.onload = function() {
            console.log('cbc status: ' + this.statusText);
            let result = (this.responseText);
            
            if (result) {
                    setTimeout(document.getElementById('mtcbc_chart_div').innerHTML = result, 1000);
                } else {
                    document.getElementById('mtcbc_chart_div').innerHTML = 'No Result';
                }
            
            

        }
        
        xhr.send();

        function showmtcbc_chart() {
                if (mt_cbctable.style.display === "none") {
                    mt_cbcchart.style.display = "none";
                    mt_cbctable.style.display = "block";
                    showmtcbcbtn.value = "Show Table"
                } else {
                    mt_cbctable.style.display = "none";
                    mt_cbcchart.style.display = "block";
                    showmtcbcbtn.value = "Show Chart"
                }
        }    


        function showmtass_chart() {
                if (teacherTable.style.display === "none") {
                    teacherChart.style.display = "none";
                    teacherTable.style.display = "block";
                    showmtassbtn.value = "Show Table"
                } else {
                    teacherTable.style.display = "none";
                    teacherChart.style.display = "block";
                    showmtassbtn.value = "Show Chart"
                }
        }    



        
        
        // 1st Chart Core Behavioral Competencies

        function drawmtcbcchart() {
        var data = google.visualization.arrayToDataTable([
            ['Core Behavioral', 'Score'],
            <?php
                   //$result = RPMSDB\RPMSdb::teacherSYcbc($conn);
                   $mtcbc = RPMSDB\RPMSdb::mtcbc($conn);
                    foreach ($mtcbc as $mtcbcrow) :
                      //  if ($(tyear2)
                            
                            
                       //     $row["tyear2"])
                        //{
                            $data = "['" . $mtcbcrow['CBC_NAME'] . " '," . $mtcbcrow['cbc_score'] . "," .      $mtcbcrow['sy_desc'] . "],";
                       // }
                        echo ($data);
                    endforeach;
            ?>
        
        ]);

        var options = {
            title: 'Core Behavioral Competencies',
            chartArea: {width: '50%'},
            hAxis: {
            title: 'Score',
            minValue: 0
            },
            vAxis: {    
            title: 'CBC'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('mtcbc_chart_div'));
        chart.draw(data, options);
        }

        function drawmtasschart() {
        var data = google.visualization.arrayToDataTable([
            ['Objectives', 'Level Capability', 'Priority for Dev'],
            <?php
                   //$result = RPMSDB\RPMSdb::teacherSYcbc($conn);
                   $mtlvlcap = RPMSDB\RPMSdb::mtlvlcap2($conn);
                    foreach ($mtlvlcap as $mtlvlres) :
                      //  if ($(tyear2)
                            
                            
                       //     $row["tyear2"])
                        //{
                            $data = "['" . $mtlvlres['OBJECTIVES'] . " '," . $mtlvlres['lvlcap'] . "," .      $mtlvlres['priodev'] . "],";
                       // }
                        echo ($data);
                    endforeach;
            ?>
        
        ]);

        var options = {
            title: 'Assessment of Capabilities and Priority',
            chartArea: {width: '50%'},
            hAxis: {
            title: 'Score',
            minValue: 0
            },
            vAxis: {    
            title: 'Objectives'
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('mtass_chart_div'));
        chart.draw(data, options);
        }

        // 2nd Chart Assessment
    
       
</script> 


<?php include_once 'samplefooter.php' ?>