<?php

include 'sampleheader.php';

if(isset($_POST['view'])):
    $sy_id = $_POST['sy_id'];
    $school_id = $_POST['school_id'];


$cot_array = [];
$qry = $conn->query("SELECT * FROM cot_mt_indicator_ave_tbl  WHERE sy = $sy_id AND school = $school_id  ") or die ($conn->error);
    if(mysqli_num_rows($qry) == 0):
        echo '<div class="red-notif-border">Average COT is not available</div>';
        exit();
    else:
        foreach ($qry as $cot):
            array_push($cot_array,$cot);
        endforeach;
    endif;

endif;


?>

<div class="container">

<div class="card-header bg-info">
        <div class=" text-center h4 text-white">COT Average</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
    <div id="cotchart" style="width: 1200px; height: 500px;"></div>
    </div>
    </div>

    <div class="card-header bg-info">
        <div class=" text-center h4 text-white">Classroom Observation Period Average</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
    <div id="cot2chart" style="width: 1200px; height: 500px;"></div>
    </div>
    </div>

</div>


<!-- COT Chart Function -->

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(chartCoT);

      function chartCoT() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Indicator No.', 'School Year 1','School Year 2','School Year 3','Average'],
          <?php
           $tIndi = fetchMTindicator($conn);
           foreach($tIndi as $indi):
        $qry = $conn->query("SELECT AVG(average) AS MT_AVERAGE, 
        CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  average  END AS sy1,
        CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN average END AS sy2, 
        CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN average END AS sy3
        FROM cot_mt_indicator_ave_tbl WHERE indicator_id = ".$indi['mtindicator_id']."  AND school = '$school_id' group by sy") or die ($conn->error);
            while ($cotQry = $qry->fetch_assoc()):
                echo "['".$indi['mtindicator_id']."', 
                ".intval($cotQry['sy1']).",  
                ".intval($cotQry['sy2']).",   
                ".intval($cotQry['sy3']).", 
                ".intval($cotQry['MT_AVERAGE'])."],";
            endwhile;
        endforeach;?>
        ]);

        var options = {
          title : 'Classroom Observation',
          vAxis: {title: 'Rating'},
          hAxis: {title: 'Indicator and Period No.'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('cotchart'));
        chart.draw(data, options);
      }
    </script>

<!-- End of COT Chart Function -->


<!-- COT Average Chart Function -->

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Indicator No.', 'Period 1', 'Period 2', 'Period 3', 'Period 4', 'Average'],
         <?php
         $tIndi = fetchMTindicator($conn);
         foreach($tIndi as $indi):
            
            $cot2Qry = $conn->query("SELECT AVG(rating) AS MT_RATING, 
            CASE WHEN obs_period = 1 THEN rating END AS Period1,
            CASE WHEN obs_period = 2 THEN rating END AS Period2, 
            CASE WHEN obs_period = 3 THEN rating END AS Period3, 
            CASE WHEN obs_period = 4 THEN rating END AS Period4 
            FROM cot_mt_rating_a_tbl WHERE indicator_id = ".$indi['mtindicator_id']." AND sy = '$sy_id' AND school_id = '$school_id' group by obs_period");   
            while ($rowQry = $cot2Qry->fetch_assoc()):
                echo "[".$indi['mtindicator_id'].",
                 ".intval($rowQry['Period1']).", 
                 ".intval($rowQry['Period2']).",
                 ".intval($rowQry['Period3']).",
                 ".intval($rowQry['Period4']).",
                 ".intval(fetchIndicatorAVGAdminMt($conn, $indi['mtindicator_id'], $sy_id, $school_id)).",],";
            endwhile;
        endforeach;
         ?>
        ]);

        var options = {
          title : 'Classroom Observation',
          vAxis: {title: 'Rating'},
          hAxis: {title: 'Indicator and Period No.'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {4: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('cot2chart'));
        chart.draw(data, options);
      }
    </script>

<!-- End of COT Average Chart Function -->



<?php

include 'samplefooter.php';
?>