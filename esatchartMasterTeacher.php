<?php

include 'sampleheader.php';

if(isset($_POST['view'])):

    if(empty($_POST['sy_id'])):
       $sy = $_POST['active_sy'];
       $school = $_POST['school_id'];
       $user_id = $_POST['user_id'];
 
?>


<div class="container center">

<div class="card">
    
<!-- CBC Chart -->
    <div class="card-header bg-info">
        <div class=" text-center h4 text-white">Core Behavioral Competencies Rating</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
        <div id="cbcchart" style="width: 900px; height: 500px;"></div>
    </div>
    </div>
  <!-- End of CBC Chart -->

<!-- Objective Chart -->
<div class="card-header bg-info">
        <div class=" text-center h4 text-white">Assessment of Capabilities and Priorities</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
                <div id="levelofcapability" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>
  <!-- End of Objective Chart -->



  <!-- End tag of card -->
</div>

               
      
<!-- End tag of container -->
  </div>


<!--CBC  Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(cbcChart);

function cbcChart() {
    let data = google.visualization.arrayToDataTable([
       ['CBC Name','CBC Score'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT a.CBC_NAME,sum(b.cbc_score) AS cbc_score FROM core_behavioral_tbl a INNER JOIN     esat3_core_behavioralmt_tbl b  on a.cbc_id = b.cbc_id  WHERE b.user_id = '$user_id' AND  b.sy = '$sy' AND b.school = '$school' group by a.cbc_name order by a.cbc_id") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                [".json_encode($result['CBC_NAME']) .", 
                ".intval($result['cbc_score']) .",],
                ";
            endforeach;
            
        ?>
]); 
let options = {
        title : 'Level of Priority',
            vAxis: {title: 'No. of Master Teachers', maxValue: 10},
            hAxis: {title: 'Objective and Level of Priority', maxValue: 13, minValue: 1 },
            seriesType: 'bars',
            bar: { groupWidth: 30 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('cbcchart'));
        chart.draw(data, options)
        
        
        };
</script>
<!--CBC Chart Function -->


<!--Assessment of Capabilities and Priorities  Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(LevelofPriority);

function LevelofPriority() {
    let data = google.visualization.arrayToDataTable([
       ['Objective','Level of Capability','Level of Priority'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT CONCAT(a.kra_id,'.',a.mtobj_id) as OBJECTIVES, lvlcap, priodev 
        FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
        WHERE a.user_id = '$user_id' AND  a.sy = '$sy' AND a.school = '$school'
        group by a.mtobj_id,b.mtobj_name") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                ['".$result['OBJECTIVES']."', 
                ".intval($result['lvlcap']) ." ,
                ".intval($result['priodev']) ." ,
            ],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : 'Level of Priority',
            vAxis: {title: 'No. of Master Teachers', maxValue: 10},
            hAxis: {title: 'Objective and Level of Priority', maxValue: 13, minValue: 1, 
            ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 30 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofcapability'));
        chart.draw(data, options)
        
        
        };
</script>

<!-- Assessment of Capabilities and Priorities Chart Function -->



<?php

    else:
        $sy_id = $_POST['sy_id'];
        $user = $_POST['user_id'];
        $school = $_POST['school_id'];

?>



<div class="container center">

<div class="card">
    
<!-- CBC Chart -->
    <div class="card-header bg-info">
        <div class=" text-center h4 text-white">Core Behavioral Competencies Rating</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
        <div id="cbcchart" style="width: 900px; height: 500px;"></div>
    </div>
    </div>
  <!-- End of CBC Chart -->

<!-- Objective Chart -->
<div class="card-header bg-info">
        <div class=" text-center h4 text-white">Assessment of Capabilities and Priorities</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
                <div id="levelofcapability" style="width: 900px; height: 500px;"></div>
            </div>
        </div>
    </div>
  <!-- End of Objective Chart -->



  <!-- End tag of card -->
</div>

               
      
<!-- End tag of container -->
  </div>


<!--CBC  Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(cbcChart);

function cbcChart() {
    let data = google.visualization.arrayToDataTable([
       ['CBC Name','CBC Score'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT a.CBC_NAME,sum(b.cbc_score) AS cbc_score FROM core_behavioral_tbl a INNER JOIN     esat3_core_behavioralmt_tbl b  on a.cbc_id = b.cbc_id  WHERE b.user_id = '$user' AND  b.sy = '$sy_id' AND b.school = '$school' group by a.cbc_name order by a.cbc_id") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                [".json_encode($result['CBC_NAME']) .", 
                ".intval($result['cbc_score']) .",],
                ";
            endforeach;
            
        ?>
]); 
let options = {
        title : 'Core Behavioral Competencies',
            vAxis: {title: 'No. of Master Teachers', maxValue: 10},
            hAxis: {title: 'Core Behavior', maxValue: 13, minValue: 1 },
            seriesType: 'bars',
            bar: { groupWidth: 30 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('cbcchart'));
        chart.draw(data, options)
        
        
        };
</script>
<!--CBC Chart Function -->


<!--Assessment of Capabilities and Priorities  Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(LevelofPriority);

function LevelofPriority() {
    let data = google.visualization.arrayToDataTable([
       ['Objective','Level of Capability','Level of Priority'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT CONCAT(a.kra_id,'.',a.mtobj_id) as OBJECTIVES, lvlcap, priodev 
        FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
        WHERE a.user_id = '$user' AND  a.sy = '$sy_id' AND a.school = '$school'
        group by a.mtobj_id,b.mtobj_name") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                ['".$result['OBJECTIVES']."', 
                ".intval($result['lvlcap']) ." ,
                ".intval($result['priodev']) ." ,
            ],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : '-Assessment of Capabilities and Priorities',
            vAxis: {title: 'No. of Master Teachers', maxValue: 10},
            hAxis: {title: 'KRA and Objectives', maxValue: 13, minValue: 1, 
            ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 30 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofcapability'));
        chart.draw(data, options)
        
        
        };
</script>

<!-- Assessment of Capabilities and Priorities Chart Function -->

<?php

    endif;
endif;


include 'samplefooter.php';

?>