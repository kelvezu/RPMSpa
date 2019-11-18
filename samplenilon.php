<?php include 'sampleheader.php' ?>
<div class="col">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-2 w-100">
                                <h6>ESAT Result</h6>
                            </div>
                            <div class="p-2 left-shrink">
                                <input type="button" id="show-tcount-btn" class="btn btn-sm btn-primary" value="Show Table">
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
                        
                             <select name="tyear2" class="form-control" id="tyear2">
                                <option value="">Select School Year</option>
                            <?php
                            $result = RPMSDB\RPMSdb::teacherSYass($conn);
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["tyear2"].'">'.$row["tyear2"].'</option>';
                            }
                            ?>
                            </select>               
                            <div style="width:max-width; height:1000px;" id="chart_div"></div>
                        
                        </div>
                        <!-- End of Total Chart for Teacher -->

                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>


        </div>

<script>
        
        
        const teacherTable = document.getElementById('teacher_count_table');
        const teacherChart = document.getElementById('teacher_count_chart');
        const showTcountBtn = document.getElementById('show-tcount-btn');                                   
        teacherTable.style.display = "none";
        teacherChart.style.display = "block";
        showTcountBtn.addEventListener('click', showTeacherCount);


        let xhr = new XMLHttpRequest();
        xhr.open('GET','ajax/cbcdisplay_ajax.php');
        console.log(xhr.status);
        xhr.onload = function() {
            console.log('cbc status: ' + this.statusText);
            let result = (this.responseText);
            
            if (result) {
                    setTimeout(document.getElementById('chart_div').innerHTML = result, 1000);
                } else {
                    document.getElementById('chart_div').innerHTML = 'No Result';
                }

        }
        
        xhr.send();

        function showTeacherCount() {
                if (teacherTable.style.display === "none") {
                    teacherChart.style.display = "none";
                    teacherTable.style.display = "block";
                    showTcountBtn.value = "Show Table"
                } else {
                    teacherTable.style.display = "none";
                    teacherChart.style.display = "block";
                    showTcountBtn.value = "Show Chart"
                }
            }    

        
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawMultSeries);

        
        function drawMultSeries() {
        var data = google.visualization.arrayToDataTable([
            ['Objectives', 'Level Capability', 'Priority for Dev'],
            <?php
                   //$result = RPMSDB\RPMSdb::teacherSYcbc($conn);
                   $mtlvlcap = RPMSDB\RPMSdb::mtlvlcap($conn);
                    foreach ($mtlvlcap as $mtlvlres2) :
                      //  if ($(tyear2)
                            
                            
                       //     $row["tyear2"])
                        //{
                            $data = "['" . $mtlvlres2['OBJECTIVES'] . " '," . $mtlvlres2['lvlcap'] . "," .      $mtlvlres2['priodev'] . "],";
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

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        }
</script> 


<?php include_once 'samplefooter.php' ?>