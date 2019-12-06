<?php

include 'sampleheader.php';

if(isset($_POST['view'])):
    if((empty($_POST['sy_id'])) &&(empty($_POST['sch_id']))):
        $sy = $_POST['active_sy'];
       
        $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy'");



?>

<div class="container center">

<div class="card">
    
<!-- Age Chart -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Age</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
        <div class="row">
            <div class="col">
                <div id="agechart" style="width: 300px; height: 350px;"></div>
            </div>
            <div class="col">
                <div id="age2chart" style="width: 700px; height: 350px;"></div>
            </div>
        </div>
    </div>
    </div>
  <!-- End of Age Chart -->

<!-- Gender Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Gender</div>
    </div>
    <div class="card-body">
    <div class="d-flex justify-content-center">
    <div class="row">
        <div class="col">
            <div id="genderchart" style="width: 300px; height: 350px;"></div>
        </div>
        <div class="col">
            <div id="gender2chart" style="width: 700px; height: 350px;"></div>
        </div>
        </div>
    </div>
    </div>
  <!-- End of Gender Chart -->

<!-- Employment Status Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Employment Status</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
        <div id="employmentstatuschart" style="width: 300px; height: 350px;"></div>
        </div>
            <div class="col">
            <div id="employmentstatus2chart" style="width: 700px; height: 350px;"></div>
            </div>
        </div>
        </div>
       
    </div>
  <!-- End of Employment Status Chart -->

  <!-- Position Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Position</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
        <div id="positionchart" style="width: 300px; height: 350px;"></div>
        </div>
                <div class="col">
                <div id="position2chart" style="width: 700px; height: 350px;"></div>
                </div>
        </div>
        </div>
       
    </div>
  <!-- End of Position Chart -->

  <!-- Highest Degree Obtained Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Highest Degree Obtained</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
                     <div id="highestdegreechart" style="width: 300px; height: 350px;"></div>
                </div>
                <div class="col">
                    <div id="highestdegree2chart" style="width: 700px; height: 350px;"></div>
                </div>
            </div>
      
        </div>
       
    </div>
  <!-- End of Highest Degree Obtained Chart -->


  <!-- Total Number of Years in Teaching Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Total Number of Years in Teaching</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
        <div id="totalnumberofyearchart" style="width: 300px; height: 350px;"></div>
        </div>
            <div class="col">
            <div id="totalnumberofyear2chart" style="width: 700px; height: 350px;"></div>
            </div>
        </div>
        </div>
       
    </div>
  <!-- End of Total Number of Years in Teaching Chart -->

  <!-- Subject Taught Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Subject Taught</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
        <div id="subjecttaughtchart" style="width: 300px; height: 350px;"></div>
        </div>
                <div class="col">
                <div id="subjecttaught2chart" style="width: 700px; height: 350px;"></div>
                </div>
        </div>

        </div>
       
    </div>
  <!-- End of Subject Taught Chart -->

  <!-- Grade Level Taught Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Grade Level Taught</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
        <div id="gradelvltaughtchart" style="width: 300px; height: 350px;"></div>
        </div>
        <div class="col">
        <div id="gradelvltaught2chart" style="width: 700px; height: 350px;"></div>
        </div>
        </div>
        </div>
       
    </div>
  <!-- End of Grade Level Taught Chart -->

  <!-- Curricular Class of School Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Curricular Class of School</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
                <div id="curriclasschart" style="width: 300px; height: 350px;"></div>
                </div>
                <div class="col">
                <div id="curriclass2chart" style="width: 700px; height: 350px;"></div>
                </div>
            </div>
       
        </div>
       
    </div>
  <!-- End of Curricular Class of School Chart -->

    <!-- Region Chart -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Region</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col">
                <div id="regionchart" style="width: 300px; height: 350px;"></div>
                </div>
                <div class="col">
                <div id="region2chart" style="width: 700px; height: 350px;"></div>
                </div>
            </div>
       
        </div>
       
    </div>
  <!-- End of Region Chart -->

    <!--SELF ASSESSMENT OF TEACHER I-III  Chart -->
    <div class="card-header bg-success">
        <div class="d-flex justify-content-between">
            <div class="p-2"></div>
            <div class="p-2"> <h4 class="text-white">SELF-ASSESSMENT OF TEACHER I-III</h4></div>
            <div class="p-2"><a href="esatchartself-assessmentAdminT.php"  class="btn btn-outline-dark text-white">View Historical Data</a></div>
        </div>
         
    </div>
    <div class="card-body">
        <div class="row">
        <div id="selfassessmentchart" style="width: 1200px; height: 350px;"></div>
        </div>
        <div class="row">
        <div id="levelofpriority" style="width: 1200px; height: 350px;"></div>
        </div>
        
    </div>
  <!-- End of SELF ASSESSMENT OF TEACHER I-III  Chart -->

 <!--Core Behavioral  Chart -->
 <div class="card-header bg-success">
 <div class="d-flex justify-content-between">
            <div class="p-2"></div>
            <div class="p-2"> <h4 class="text-white">Core Behavioral Competencies</h4></div>
            <div class="p-2"><a href=""  class="btn btn-outline-dark text-white">View Historical Data</a></div>
        </div>

    </div>
    <div class="card-body">
        
    <div class="d-flex justify-content-center">
        <div id="corebehavioral" style="width: 900px; height: 350px;"></div>
        </div>

        
    </div>
  <!-- End of Core Behavioral  Chart -->


  <!-- End tag of card -->
</div>

               
      
<!-- End tag of container -->
  </div>


<!-- Age Chart Function -->
   <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(AgeChart);

function AgeChart() {
    let data = google.visualization.arrayToDataTable([
        ['Age', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT age_tbl.age_name, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl INNER JOIN age_tbl age_tbl on esat1_demographicst_tbl.age = age_tbl.age_id WHERE sy = '$sy' GROUP BY age_tbl.age_name") or die ($conn->error);
            while ($AgeChart = $qry->fetch_assoc()):
                echo "['".$AgeChart['age_name']."', ".$AgeChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Age'};
        let chart = new google.visualization.PieChart(document.getElementById('agechart'));
        chart.draw(data, options);}
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(age2chart);

      function age2chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Age', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $age = AgeDemoFetch($conn);
          foreach ($age as $agedemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE age = ".$agedemo['age_id']."  AND sy = '$sy' group by sy") or die ($conn->error);
            while($AgeQry = $qry->fetch_assoc()):
                echo "['".$agedemo['age_name']."', 
                ".intval($AgeQry['sy1']).",  
                ".intval($AgeQry['sy2']).",   
                ".intval($AgeQry['sy3'])."],";
            endwhile;
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Age Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Age and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('age2chart'));
        chart.draw(data, options);
      }
    </script>


<!-- End of Age Chart Function --> 

<!-- Gender Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(GenderChart);

function GenderChart() {
    let data = google.visualization.arrayToDataTable([
        ['Gender', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT gender_tbl.gender_name, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl INNER JOIN gender_tbl on esat1_demographicst_tbl.gender = gender_tbl.gender_id WHERE sy = '$sy'  GROUP BY gender_tbl.gender_name") or die ($conn->error);
            while ($GenderChart = $qry->fetch_assoc()):
                echo "['".$GenderChart['gender_name']."', ".$GenderChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Gender'};
        let chart = new google.visualization.PieChart(document.getElementById('genderchart'));
        chart.draw(data, options);}
</script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(gender2chart);

      function gender2chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $gender = GenderDemoFetch($conn);
          foreach ($gender as $genderdemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE gender = ".$genderdemo['gender_id']."  AND sy = '$sy' group by sy") or die ($conn->error);
            while($GenderQry = $qry->fetch_assoc()):
                echo "['".$genderdemo['gender_name']."', 
                ".intval($GenderQry['sy1']).",  
                ".intval($GenderQry['sy2']).",
                ".intval($GenderQry['sy3'])."],";
            endwhile; 
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Gender Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Gender and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('gender2chart'));
        chart.draw(data, options);
      }
    </script>

<!-- End of Gender Chart Function -->


<!-- Employment Status Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(EmploymentStatusChart);

function EmploymentStatusChart() {
    let data = google.visualization.arrayToDataTable([
        ['Employment Status', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.employment_status, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy' GROUP BY esat1_demographicst_tbl.employment_status") or die ($conn->error);
            while ($employStatus = $qry->fetch_assoc()):
                echo "['".$employStatus['employment_status']."', ".$employStatus['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Employment Status'};
        let chart = new google.visualization.PieChart(document.getElementById('employmentstatuschart'));
        chart.draw(data, options);}
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(EmploymentStatus2Chart);

      function EmploymentStatus2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Employment Status', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $employ = EmployDemoFetch($conn);
          foreach ($employ as $employdemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE employment_status = '".$employdemo['emp_status']."'  AND sy = '$sy' group by sy") or die ($conn->error);
            while($EmployQry = $qry->fetch_assoc()):
                echo "['".$employdemo['emp_status']."', 
                ".intval($EmployQry['sy1']).",  
                ".intval($EmployQry['sy2']).",
                ".intval($EmployQry['sy3'])."],";
            endwhile; 
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Employment Status Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Employment Status and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('employmentstatus2chart'));
        chart.draw(data, options);
      }
    </script>

<!-- End of Employment Status Chart Chart Function -->

<!--Position Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(PositionChart);

function PositionChart() {
    let data = google.visualization.arrayToDataTable([
        ['Position', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.position, COUNT(esat1_demographicst_tbl.user_id)total FROM  esat1_demographicst_tbl WHERE sy = '$sy' GROUP BY esat1_demographicst_tbl.position ORDER BY esat1_demographicst_tbl.position desc") or die ($conn->error);
            while ($positionQry = $qry->fetch_assoc()):
                echo "['".$positionQry['position']."', ".$positionQry['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Position'};
        let chart = new google.visualization.PieChart(document.getElementById('positionchart'));
        chart.draw(data, options);}
</script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(Position2Chart);

      function Position2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Position', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $position = PositionDemoFetch($conn);
          foreach ($position as $positiondemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE position = '".$positiondemo['position_name']."'  AND sy = '$sy' group by sy") or die ($conn->error);
            while($PositionQry = $qry->fetch_assoc()):
                echo "['".$positiondemo['position_name']."', 
                ".intval($PositionQry['sy1']).",  
                ".intval($PositionQry['sy2']).",
                ".intval($PositionQry['sy3'])."],";
            endwhile; 
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Position Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Position and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('position2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Position Chart Function -->


<!--Highest Degree Obtained Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(HighestDegreeChart);

function HighestDegreeChart() {
    let data = google.visualization.arrayToDataTable([
        ['Highest Degree Obtained', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.highest_degree, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy' GROUP BY esat1_demographicst_tbl.highest_degree") or die ($conn->error);
            while ($highestChart = $qry->fetch_assoc()):
                echo "['".$highestChart['highest_degree']."', ".$highestChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Highest Degree Obtained'};
        let chart = new google.visualization.PieChart(document.getElementById('highestdegreechart'));
        chart.draw(data, options);}
</script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(HighestDegree2Chart);

      function HighestDegree2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Highest Degree', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $highestdegree = HighestDegreeDemoFetch($conn);
          foreach ($highestdegree as $highestdegreedemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE highest_degree = '".$highestdegreedemo['degree_name']."'  AND sy = '$sy' group by sy") or die ($conn->error);
            while($HighestQry = $qry->fetch_assoc()):
                echo "['".$highestdegreedemo['degree_name']."', 
                ".intval($HighestQry['sy1']).",  
                ".intval($HighestQry['sy2']).",
                ".intval($HighestQry['sy3'])."],";
            endwhile; 
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Highest Degree Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Highest Degree and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('highestdegree2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Highest Degree Obtained Chart Function -->

<!--Total Number of Years in Teaching Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(TotalYearChart);

function TotalYearChart() {
    let data = google.visualization.arrayToDataTable([
        ['Total Number of Years in Teaching', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT totalyear_tbl.totalyear_name,COUNT(esat1_demographicst_tbl.user_id)total from esat1_demographicst_tbl INNER JOIN totalyear_tbl on esat1_demographicst_tbl.totalyear=totalyear_tbl.totalyear_id WHERE sy = '$sy' GROUP BY totalyear_tbl.totalyear_name") or die ($conn->error);
            while ($TotalYear = $qry->fetch_assoc()):
                echo "['".$TotalYear['totalyear_name']."', ".$TotalYear['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Total Number of Years in Teaching'};
        let chart = new google.visualization.PieChart(document.getElementById('totalnumberofyearchart'));
        chart.draw(data, options);}
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(TotalYear2Chart);

      function TotalYear2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Total Number of Years Teaching', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $totalyear =TotalYearDemoFetch($conn);
          foreach ($totalyear as $totalyeardemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE totalyear = ".$totalyeardemo['totalyear_id']."  AND sy = '$sy' group by sy") or die ($conn->error);
            while($TotalQry = $qry->fetch_assoc()):
                echo "['".$totalyeardemo['totalyear_name']."', 
                ".intval($TotalQry['sy1']).",  
                ".intval($TotalQry['sy2']).",
                ".intval($TotalQry['sy3'])."],";
            endwhile; 
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Total Number of Years Teaching Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Total Number of Years Teaching and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('totalnumberofyear2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Total Number of Years in Teaching Chart Function -->

<!--Subject Taught Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(SubjectTaughtChart);

function SubjectTaughtChart() {
    let data = google.visualization.arrayToDataTable([
        ['Subject Taught', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT subject_tbl.subject_name, COUNT(esat1_demographicst_tbl.user_id)total, esat1_demographicst_tbl.* FROM esat1_demographicst_tbl INNER JOIN subject_tbl ON esat1_demographicst_tbl.subject_taught LIKE CONCAT('%', subject_tbl.subject_name, '%') WHERE sy = '$sy' GROUP BY subject_tbl.subject_name") or die ($conn->error);
            while ($SubjectTaught = $qry->fetch_assoc()):
                echo "['".$SubjectTaught['subject_name']."', ".$SubjectTaught['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Subject Taught'};
        let chart = new google.visualization.PieChart(document.getElementById('subjecttaughtchart'));
        chart.draw(data, options);}
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(SubjectTaught2Chart);

      function SubjectTaught2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Subject Taught', 'School Year 1','School Year 2','School Year 3'],
          <?php
       
            $qry = $conn->query("SELECT subject_tbl.subject_name, COUNT(esat1_demographicst_tbl.user_id)total, 
            CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
           FROM esat1_demographicst_tbl INNER JOIN subject_tbl ON esat1_demographicst_tbl.subject_taught LIKE CONCAT('%', subject_tbl.subject_name, '%') WHERE sy = 17 GROUP BY subject_tbl.subject_name") or die ($conn->error);
            while($SubjectTaughtQry = $qry->fetch_assoc()):
                echo "['".$SubjectTaughtQry['subject_name']."', 
                ".intval($SubjectTaughtQry['sy1']).",  
                ".intval($SubjectTaughtQry['sy2']).",
                ".intval($SubjectTaughtQry['sy3'])."],";
            endwhile; 
         
          ?>
        ]);

        var options = {
          title : 'Subject Taught Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Subject Taught and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('subjecttaught2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Subject Taught Chart Function -->

<!--Grade Level Taught Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(GradeLvlTaughtChart);

function GradeLvlTaughtChart() {
    let data = google.visualization.arrayToDataTable([
        ['Grade Level Taught', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT gradelvltaught_tbl.gradelvltaught_name, COUNT(esat1_demographicst_tbl.user_id)total FROM gradelvltaught_tbl INNER JOIN esat1_demographicst_tbl ON esat1_demographicst_tbl.grade_lvl_taught LIKE CONCAT('%', gradelvltaught_tbl.gradelvltaught_id, '%') WHERE sy = '$sy' GROUP BY gradelvltaught_tbl.gradelvltaught_name") or die ($conn->error);
            while ($GradelvlTaught = $qry->fetch_assoc()):
                echo "['".$GradelvlTaught['gradelvltaught_name']."', ".$GradelvlTaught['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Grade Level Taught'};
        let chart = new google.visualization.PieChart(document.getElementById('gradelvltaughtchart'));
        chart.draw(data, options);}
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(GradeLvlTaught2Chart);

      function GradeLvlTaught2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Grade Level Taught', 'School Year 1','School Year 2','School Year 3'],
          <?php
       
            $qry = $conn->query("SELECT gradelvltaught_tbl.gradelvltaught_name, COUNT(esat1_demographicst_tbl.user_id)total,
            CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
                FROM gradelvltaught_tbl INNER JOIN esat1_demographicst_tbl ON esat1_demographicst_tbl.grade_lvl_taught LIKE CONCAT('%', gradelvltaught_tbl.gradelvltaught_id, '%') WHERE sy = 17 GROUP BY gradelvltaught_tbl.gradelvltaught_name") or die ($conn->error);
            while($GradelvlTaughtQry = $qry->fetch_assoc()):
                echo "['".$GradelvlTaughtQry['gradelvltaught_name']."', 
                ".intval($GradelvlTaughtQry['sy1']).",  
                ".intval($GradelvlTaughtQry['sy2']).",
                ".intval($GradelvlTaughtQry['sy3'])."],";
            endwhile; 
         
          ?>
        ]);

        var options = {
          title : 'Grade Level Taught Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Grade Level Taught and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('gradelvltaught2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Grade Level Taught Chart Function -->


<!--Curricular Class of School Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(CurriClassChart);

function CurriClassChart() {
    let data = google.visualization.arrayToDataTable([
        ['Curricular Class of School', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT curriclass_tbl.curriclass_name,COUNT(DISTINCT esat1_demographicst_tbl.user_id)total FROM esat1_demographicst_tbl INNER JOIN curriclass_tbl ON esat1_demographicst_tbl.curri_class = curriclass_tbl.curriclass_id WHERE sy = '$sy' GROUP BY curriclass_tbl.curriclass_name") or die ($conn->error);
            while ($CurriClass = $qry->fetch_assoc()):
                echo "['".$CurriClass['curriclass_name']."', ".$CurriClass['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Curricular Class of School'};
        let chart = new google.visualization.PieChart(document.getElementById('curriclasschart'));
        chart.draw(data, options);}
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(CurriClass2Chart);

      function CurriClass2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Curricular class of School', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $curri = CurriclassDemoFetch($conn);
          foreach ($curri as $curridemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE curri_class = ".$curridemo['curriclass_id']."  AND sy = '$sy' group by sy") or die ($conn->error);
            while($CurriQry = $qry->fetch_assoc()):
                echo "['".$curridemo['curriclass_name']."', 
                ".intval($CurriQry['sy1']).",  
                ".intval($CurriQry['sy2']).",   
                ".intval($CurriQry['sy3'])."],";
            endwhile;
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Curricular Class of School Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Curricular Class and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('curriclass2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- End of Curricular Class of School Chart Function -->


<!--Region Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(RegionChart);

function RegionChart() {
    let data = google.visualization.arrayToDataTable([
        ['Region', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT *,region_tbl.region_name, COUNT(esat1_demographicst_tbl.user_id)total from region_tbl INNER JOIN esat1_demographicst_tbl ON region_tbl.reg_id = esat1_demographicst_tbl.region WHERE sy = '$sy' GROUP BY region_tbl.region_name") or die ($conn->error);
            while ($Region = $qry->fetch_assoc()):
                echo "['".$Region['region_name']."', ".$Region['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Region'};
        let chart = new google.visualization.PieChart(document.getElementById('regionchart'));
        chart.draw(data, options);}
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(Region2Chart);

      function Region2Chart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Region', 'School Year 1','School Year 2','School Year 3'],
          <?php
          $region = RegionDemoFetch($conn);
          foreach ($region as $regiondemo):
          $qry = $conn->query("SELECT COUNT(`user_id`) AS T_COUNT, 
          CASE WHEN sy = '".$_SESSION['active_sy_id']."' THEN  COUNT(`user_id`)  END AS sy1,
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-1 THEN COUNT(`user_id`) END AS sy2, 
          CASE WHEN sy = ('".$_SESSION['active_sy_id']."')-2 THEN COUNT(`user_id`) END AS sy3  
          FROM esat1_demographicst_tbl WHERE region = ".$regiondemo['reg_id']."  AND sy = '$sy' group by sy") or die ($conn->error);
            while($regionQry = $qry->fetch_assoc()):
                echo "['".$regiondemo['region_name']."', 
                ".intval($regionQry['sy1']).",  
                ".intval($regionQry['sy2']).",   
                ".intval($regionQry['sy3'])."],";
            endwhile;
          endforeach;
          ?>
        ]);

        var options = {
          title : 'Curricular Class of School Count Historical Data',
          vAxis: {title: 'No. of Teachers'},
          hAxis: {title: 'Curricular Class and School Year'},
            explorer: {axis: 'horizontal', keepInBounds: true},
          seriesType: 'bars',
          bar: { groupWidth: 50 },
          series: {3: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('region2chart'));
        chart.draw(data, options);
      }
    </script>
<!-- Region Chart Function -->


<!--SELF ASSESSMENT OF TEACHER I-III Level of Capability Chart Function -->
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
            bar: { groupWidth: 50 },
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
            bar: { groupWidth: 50 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('levelofpriority'));
        chart.draw(data, options)
        
        
        };
</script>
<!-- SELF ASSESSMENT OF TEACHER I-III Level of Priority Chart Function -->


<!--Core Behavioral Competencies Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(CoreBehavioralChart);

function CoreBehavioralChart() {
    let data = google.visualization.arrayToDataTable([
       ['Core Behavioral','Scale 1','Scale 2','Scale 3','Scale 4','Scale 5'],

        <?php
        
        $CoreBehavioralqry = mysqli_query($conn,"SELECT *,b.cbc_name, 
		CASE WHEN(a.score)=1 THEN COUNT(a.user_id) end as score1,
        CASE WHEN(a.score)=2 THEN COUNT(a.user_id) end as score2,
        CASE WHEN(a.score)=3 THEN COUNT(a.user_id) end as score3,
        CASE WHEN(a.score)=4 THEN COUNT(a.user_id) end as score4,
        CASE WHEN(a.score)=5 THEN COUNT(a.user_id) end as score5
		FROM
		(
		select sy,school,cbc_id, user_id,sum(cbc_score)score from esat3_core_behavioralt_tbl GROUP BY cbc_id
		) a
		INNER JOIN core_behavioral_tbl b on a.cbc_id=b.cbc_id WHERE sy = '$sy' GROUP BY b.cbc_name") or die ($conn->error.$qry);
    
            foreach($CoreBehavioralqry as $resultQry):
             echo "
                [".json_encode($resultQry['cbc_name']) .", 
                ".intval($resultQry['score1']) ." ,
                ".intval($resultQry['score2']) .",
                ".intval($resultQry['score3'])  .",
                ".intval($resultQry['score4'])  .",
                ".intval($resultQry['score5'])  .",],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : 'Core Behavioral Competencies',
            vAxis: {title: 'No. of Teachers', maxValue: 10},
            hAxis: {title: 'Core Behavioral and Scale',},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 50 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('corebehavioral'));
        chart.draw(data, options)
        
        
        };
</script>
<!-- Core Behavioral Competencies Chart Function -->

<?php


    else:
        $sy_id = $_POST['sy_id'];
        $school = $_POST['sch_id'];

?>




<div class="container center">

<div class="card">
    
<!-- Age Chart -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Age</div>
    </div>
    <div class="card-body ">
    <div class="d-flex justify-content-center">
        <div id="agechart" style="width: 350px; height: 350px;"></div>
    </div>
    </div>
  <!-- End of Age Chart -->

<!-- Gender Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Gender</div>
    </div>
    <div class="card-body">
    <div class="d-flex justify-content-center">
        <div id="genderchart" style="width: 350px; height: 350px;"></div>
    </div>
    </div>
  <!-- End of Gender Chart -->

<!-- Employment Status Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Employment Status</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="employmentstatuschart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Employment Status Chart -->

  <!-- Position Chart -->
<div class="card-header bg-success">
        <div class=" text-center h4 text-white">Position</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="positionchart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Position Chart -->

  <!-- Highest Degree Obtained Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Highest Degree Obtained</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="highestdegreechart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Highest Degree Obtained Chart -->


  <!-- Total Number of Years in Teaching Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Total Number of Years in Teaching</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="totalnumberofyearchart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Total Number of Years in Teaching Chart -->

  <!-- Subject Taught Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Subject Taught</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="subjecttaughtchart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Subject Taught Chart -->

  <!-- Grade Level Taught Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Grade Level Taught</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="gradelvltaughtchart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Grade Level Taught Chart -->

  <!-- Curricular Class of School Chart -->
  <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Curricular Class of School</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="curriclasschart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Curricular Class of School Chart -->

    <!-- Region Chart -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Region</div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
        <div id="regionchart" style="width: 350px; height: 350px;"></div>
        </div>
       
    </div>
  <!-- End of Region Chart -->

    <!--SELF ASSESSMENT OF TEACHER I-III  Chart -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">SELF ASSESSMENT OF TEACHER I-III</div>
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
  <!-- End of SELF ASSESSMENT OF TEACHER I-III  Chart -->

 <!--Core Behavioral  Chart -->
 <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Core Behavioral Competencies</div>
    </div>
    <div class="card-body">
        
    <div class="d-flex justify-content-center">
        <div id="corebehavioral" style="width: 800px; height: 500px;"></div>
        </div>

        
    </div>
  <!-- End of Core Behavioral  Chart -->


  <!-- End tag of card -->
</div>

               
      
<!-- End tag of container -->
  </div>


<!-- Age Chart Function -->
   <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(AgeChart);

function AgeChart() {
    let data = google.visualization.arrayToDataTable([
        ['Age', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT age_tbl.age_name, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl INNER JOIN age_tbl age_tbl on esat1_demographicst_tbl.age = age_tbl.age_id WHERE sy = '$sy_id' AND school = '$school' GROUP BY age_tbl.age_name") or die ($conn->error);
            while ($AgeChart = $qry->fetch_assoc()):
                echo "['".$AgeChart['age_name']."', ".$AgeChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Age'};
        let chart = new google.visualization.PieChart(document.getElementById('agechart'));
        chart.draw(data, options);}
</script>
<!-- End of Age Chart Function -->

<!-- Gender Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(GenderChart);

function GenderChart() {
    let data = google.visualization.arrayToDataTable([
        ['Gender', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT gender_tbl.gender_name, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl INNER JOIN gender_tbl on esat1_demographicst_tbl.gender = gender_tbl.gender_id WHERE sy = '$sy_id' AND school = '$school' GROUP BY gender_tbl.gender_name") or die ($conn->error);
            while ($GenderChart = $qry->fetch_assoc()):
                echo "['".$GenderChart['gender_name']."', ".$GenderChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Gender'};
        let chart = new google.visualization.PieChart(document.getElementById('genderchart'));
        chart.draw(data, options);}
</script>
<!-- End of Gender Chart Function -->


<!-- Employment Status Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(EmploymentStatusChart);

function EmploymentStatusChart() {
    let data = google.visualization.arrayToDataTable([
        ['Employment Status', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.employment_status, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy_id' AND school = '$school' GROUP BY esat1_demographicst_tbl.employment_status") or die ($conn->error);
            while ($employStatus = $qry->fetch_assoc()):
                echo "['".$employStatus['employment_status']."', ".$employStatus['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Employment Status'};
        let chart = new google.visualization.PieChart(document.getElementById('employmentstatuschart'));
        chart.draw(data, options);}
</script>
<!-- End of Employment Status Chart Chart Function -->

<!--Position Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(PositionChart);

function PositionChart() {
    let data = google.visualization.arrayToDataTable([
        ['Position', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.position, COUNT(esat1_demographicst_tbl.user_id)total FROM  esat1_demographicst_tbl WHERE sy = '$sy_id' AND school = '$school' GROUP BY esat1_demographicst_tbl.position ORDER BY esat1_demographicst_tbl.position desc") or die ($conn->error);
            while ($positionQry = $qry->fetch_assoc()):
                echo "['".$positionQry['position']."', ".$positionQry['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Position'};
        let chart = new google.visualization.PieChart(document.getElementById('positionchart'));
        chart.draw(data, options);}
</script>
<!-- End of Position Chart Function -->


<!--Highest Degree Obtained Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(HighestDegreeChart);

function HighestDegreeChart() {
    let data = google.visualization.arrayToDataTable([
        ['Highest Degree Obtained', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT esat1_demographicst_tbl.highest_degree, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy_id' AND school = '$school' GROUP BY esat1_demographicst_tbl.highest_degree") or die ($conn->error);
            while ($highestChart = $qry->fetch_assoc()):
                echo "['".$highestChart['highest_degree']."', ".$highestChart['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Highest Degree Obtained'};
        let chart = new google.visualization.PieChart(document.getElementById('highestdegreechart'));
        chart.draw(data, options);}
</script>
<!-- End of Highest Degree Obtained Chart Function -->

<!--Total Number of Years in Teaching Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(TotalYearChart);

function TotalYearChart() {
    let data = google.visualization.arrayToDataTable([
        ['Total Number of Years in Teaching', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT totalyear_tbl.totalyear_name,COUNT(esat1_demographicst_tbl.user_id)total from esat1_demographicst_tbl INNER JOIN totalyear_tbl on esat1_demographicst_tbl.totalyear=totalyear_tbl.totalyear_id WHERE sy = '$sy_id' AND school = '$school' GROUP BY totalyear_tbl.totalyear_name") or die ($conn->error);
            while ($TotalYear = $qry->fetch_assoc()):
                echo "['".$TotalYear['totalyear_name']."', ".$TotalYear['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Total Number of Years in Teaching'};
        let chart = new google.visualization.PieChart(document.getElementById('totalnumberofyearchart'));
        chart.draw(data, options);}
</script>
<!-- End of Total Number of Years in Teaching Chart Function -->

<!--Subject Taught Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(SubjectTaughtChart);

function SubjectTaughtChart() {
    let data = google.visualization.arrayToDataTable([
        ['Subject Taught', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT subject_tbl.subject_name, COUNT(esat1_demographicst_tbl.user_id)total, esat1_demographicst_tbl.* FROM esat1_demographicst_tbl INNER JOIN subject_tbl ON esat1_demographicst_tbl.subject_taught LIKE CONCAT('%', subject_tbl.subject_name, '%') WHERE sy = '$sy_id' AND school = '$school' GROUP BY subject_tbl.subject_name") or die ($conn->error);
            while ($SubjectTaught = $qry->fetch_assoc()):
                echo "['".$SubjectTaught['subject_name']."', ".$SubjectTaught['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Subject Taught'};
        let chart = new google.visualization.PieChart(document.getElementById('subjecttaughtchart'));
        chart.draw(data, options);}
</script>
<!-- End of Subject Taught Chart Function -->

<!--Grade Level Taught Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(GradeLvlTaughtChart);

function GradeLvlTaughtChart() {
    let data = google.visualization.arrayToDataTable([
        ['Grade Level Taught', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT gradelvltaught_tbl.gradelvltaught_name, COUNT(esat1_demographicst_tbl.user_id)total FROM gradelvltaught_tbl INNER JOIN esat1_demographicst_tbl ON esat1_demographicst_tbl.grade_lvl_taught LIKE CONCAT('%', gradelvltaught_tbl.gradelvltaught_id, '%') WHERE sy = '$sy_id' AND school = '$school' GROUP BY gradelvltaught_tbl.gradelvltaught_name") or die ($conn->error);
            while ($GradelvlTaught = $qry->fetch_assoc()):
                echo "['".$GradelvlTaught['gradelvltaught_name']."', ".$GradelvlTaught['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Grade Level Taught'};
        let chart = new google.visualization.PieChart(document.getElementById('gradelvltaughtchart'));
        chart.draw(data, options);}
</script>
<!-- End of Grade Level Taught Chart Function -->


<!--Curricular Class of School Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(CurriClassChart);

function CurriClassChart() {
    let data = google.visualization.arrayToDataTable([
        ['Curricular Class of School', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT curriclass_tbl.curriclass_name,COUNT(DISTINCT esat1_demographicst_tbl.user_id)total FROM esat1_demographicst_tbl INNER JOIN curriclass_tbl ON esat1_demographicst_tbl.curri_class = curriclass_tbl.curriclass_id WHERE sy = '$sy_id' AND school = '$school' GROUP BY curriclass_tbl.curriclass_name") or die ($conn->error);
            while ($CurriClass = $qry->fetch_assoc()):
                echo "['".$CurriClass['curriclass_name']."', ".$CurriClass['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Curricular Class of School'};
        let chart = new google.visualization.PieChart(document.getElementById('curriclasschart'));
        chart.draw(data, options);}
</script>
<!-- End of Curricular Class of School Chart Function -->


<!--Region Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(RegionChart);

function RegionChart() {
    let data = google.visualization.arrayToDataTable([
        ['Region', 'No. of Teacher'],
        <?php
        $qry = $conn->query("SELECT *,region_tbl.region_name, COUNT(esat1_demographicst_tbl.user_id)total from region_tbl INNER JOIN esat1_demographicst_tbl ON region_tbl.reg_id = esat1_demographicst_tbl.region WHERE sy = '$sy_id' AND school = '$school' GROUP BY region_tbl.region_name") or die ($conn->error);
            while ($Region = $qry->fetch_assoc()):
                echo "['".$Region['region_name']."', ".$Region['total']."],";
            endwhile;?>
]); 
    let options = {
        title: 'Region'};
        let chart = new google.visualization.PieChart(document.getElementById('regionchart'));
        chart.draw(data, options);}
</script>
<!-- Region Chart Function -->


<!--SELF ASSESSMENT OF TEACHER I-III Level of Capability Chart Function -->
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
        FROM esat2_objectivest_tbl WHERE sy = '$sy_id' and school = '$school' GROUP BY tobj_id") or die ($conn->error.$qry);
    
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
        FROM esat2_objectivest_tbl WHERE sy = '$sy_id' and school = '$school' GROUP BY tobj_id") or die ($conn->error.$qry);
    
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
<!-- SELF ASSESSMENT OF TEACHER I-III Level of Priority Chart Function -->


<!--Core Behavioral Competencies Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(CoreBehavioralChart);

function CoreBehavioralChart() {
    let data = google.visualization.arrayToDataTable([
       ['Core Behavioral','Scale 1','Scale 2','Scale 3','Scale 4','Scale 5'],

        <?php
        
        $CoreBehavioralqry = mysqli_query($conn,"SELECT *,b.cbc_name, 
		CASE WHEN(a.score)=1 THEN COUNT(a.user_id) end as score1,
        CASE WHEN(a.score)=2 THEN COUNT(a.user_id) end as score2,
        CASE WHEN(a.score)=3 THEN COUNT(a.user_id) end as score3,
        CASE WHEN(a.score)=4 THEN COUNT(a.user_id) end as score4,
        CASE WHEN(a.score)=5 THEN COUNT(a.user_id) end as score5
		FROM
		(
		select sy,school,cbc_id, user_id,sum(cbc_score)score from esat3_core_behavioralt_tbl GROUP BY cbc_id
		) a
		INNER JOIN core_behavioral_tbl b on a.cbc_id=b.cbc_id WHERE sy = '$sy_id' AND school = '$school' GROUP BY b.cbc_name") or die ($conn->error.$qry);
    
            foreach($CoreBehavioralqry as $resultQry):
             echo "
                [".json_encode($resultQry['cbc_name']) .", 
                ".intval($resultQry['score1']) ." ,
                ".intval($resultQry['score2']) .",
                ".intval($resultQry['score3'])  .",
                ".intval($resultQry['score4'])  .",
                ".intval($resultQry['score5'])  .",],
                ";
            endforeach;
            
        ?>
]); 
    let options = {
        title : 'Core Behavioral Competencies',
            vAxis: {title: 'No. of Teachers', maxValue: 10},
            hAxis: {title: 'Core Behavioral and Scale',},
            explorer: {axis: 'horizontal', keepInBounds: true},
            seriesType: 'bars',
            bar: { groupWidth: 100 },
            series: {5: {type: 'line'}}        };

        let chart = new google.visualization.ComboChart(document.getElementById('corebehavioral'));
        chart.draw(data, options)
        
        
        };
</script>
<!-- Core Behavioral Competencies Chart Function -->

<?php

    endif;
endif;

include 'samplefooter.php';

?>