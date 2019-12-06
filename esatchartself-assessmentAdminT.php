<?php

include 'sampleheader.php';

?>

<div class="card-header bg-success">
    
        <div class=" text-center h4 text-white">SELF-ASSESSMENT OF TEACHER I-III</div>
    </div>
         

    <div class="card-body">
        <div class="row">
        <div class="col">
        <div id="selfassessmentchart" style="width: 500px; height: 500px;"></div>
        </div>
        <div class="col">
        <div id="levelofpriority" style="width: 500px; height: 500px;"></div>
        </div>
        </div>
    </div>


    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(SelfAssessmentChart);

function SelfAssessmentChart() {
    let data = google.visualization.arrayToDataTable([
       ['Objective','Low','Moderate','High','Very High'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT tobj_id AS Objective, 
        CASE WHEN lvlcap = 1 THEN COUNT(user_id) END  AS caplow,
        CASE WHEN lvlcap = 2 THEN COUNT(user_id) END  AS capmoderate,
        CASE WHEN lvlcap = 3 THEN COUNT(user_id) END  AS caphigh,
        CASE WHEN lvlcap = 4 THEN COUNT(user_id) END  AS capveryhigh,
        CASE WHEN priodev = 1 THEN COUNT(user_id) END  AS priolow,
        CASE WHEN priodev = 2 THEN COUNT(user_id) END  AS priomoderate,
        CASE WHEN priodev = 3 THEN COUNT(user_id) END  AS priohigh,
        CASE WHEN priodev = 4 THEN COUNT(user_id) END  AS prioveryhigh
        FROM esat2_objectivest_tbl WHERE sy = '$sy' GROUP BY tobj_id") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                [".$result['Objective'] .", 
                ".intval($result['caplow']) ." ,
                ".intval($result['capmoderate']) .",
                ".intval($result['caphigh'])  .",
                ".intval($result['capveryhigh'])  .",],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : 'Level of Capability',
            vAxis: {title: 'No. of Teachers', maxValue: 10},
            hAxis: {title: 'Objective and Level of Capability', maxValue: 13, minValue: 1, 
            ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 100 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('selfassessmentchart'));
        chart.draw(data, options)
        
        
        };
</script>
<!-- SELF ASSESSMENT OF TEACHER I-III  Level of Capability Chart Function -->

<!--SELF ASSESSMENT OF TEACHER I-III Level of Priority  Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(LevelofPriority);

function LevelofPriority() {
    let data = google.visualization.arrayToDataTable([
       ['Objective','Low','Moderate','High','Very High'],

        <?php
        
        $qry = mysqli_query($conn,"SELECT tobj_id AS Objective, 
        CASE WHEN lvlcap = 1 THEN COUNT(user_id) END  AS caplow,
        CASE WHEN lvlcap = 2 THEN COUNT(user_id) END  AS capmoderate,
        CASE WHEN lvlcap = 3 THEN COUNT(user_id) END  AS caphigh,
        CASE WHEN lvlcap = 4 THEN COUNT(user_id) END  AS capveryhigh,
        CASE WHEN priodev = 1 THEN COUNT(user_id) END  AS priolow,
        CASE WHEN priodev = 2 THEN COUNT(user_id) END  AS priomoderate,
        CASE WHEN priodev = 3 THEN COUNT(user_id) END  AS priohigh,
        CASE WHEN priodev = 4 THEN COUNT(user_id) END  AS prioveryhigh
        FROM esat2_objectivest_tbl WHERE sy = '$sy' GROUP BY tobj_id") or die ($conn->error.$qry);
    
            foreach($qry as $result):
             echo "
                [".$result['Objective'] .", 
                ".intval($result['priolow']) ." ,
                ".intval($result['priomoderate']) .",
                ".intval($result['priohigh'])  .",
                ".intval($result['prioveryhigh'])  .",],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : 'Level of Priority',
            vAxis: {title: 'No. of Teachers', maxValue: 10},
            hAxis: {title: 'Objective and Level of Priority', maxValue: 13, minValue: 1, 
            ticks: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 100 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofpriority'));
        chart.draw(data, options)
        
        
        };
</script>

<?php

include 'samplefooter.php';

?>