<?php
include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';
 
if(isset($_GET['sy']) AND isset($_GET['sch'])  ):
    $sy = $_GET['sy'];
    $school = $_GET['sch'];
    $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
    
endif;

?>

<div class="card text-center">
     <!-- Age Table -->
 
        <div class="card-header bg-success">
            <div class=" text-center h4 text-white">Age</div>
        </div>
        <div class="card-body">
            <div id="piechart" style="width: 400px; height: 400px;"></div>
                </div>
       
  <!-- End of Age Table -->
  </div>

  <!-- Age Chart Function -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(AgeChart);

function AgeChart() {
    let data = google.visualization.arrayToDataTable([
        ['Age', 'No. of Teacher'],
        <?php $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'") or die ($conn->error);
            while ($AgeChart = $qry->fetch_assoc()):
                echo "['".displayAgeDesc($conn,$AgeChart['age'])."', ".countDB($conn,17,14,'esat1_demographicst_tbl')."],";
            endwhile;?>
]);

    let options = {
        title: 'Age'};
        let chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);}

</script>
