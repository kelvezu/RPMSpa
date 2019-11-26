<?php

include 'sampleheader.php';
 
?>
  <!-- Age Chart Function -->
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(AgeChart);

function AgeChart() {
    let sy_id = document.getElementById('sy_id').value;
    let sch_id = document.getElementById('sch_id').value;
    let data = google.visualization.arrayToDataTable([
        ['Age', 'No. of Teacher'],
        <?php
        $sy = ;
        $school = $_GET['sch_id'];
        $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'") or die ($conn->error);
            while ($AgeChart = $qry->fetch_assoc()):
                echo "['".displayAgeDesc($conn,$AgeChart['age'])."', ".countDB($conn,$sy,$school,'esat1_demographicst_tbl')."],";
            endwhile;?>
]); 

    let options = {
        title: 'Age'};
        let chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);}
</script>
  <!-- End of Age Chart Function -->


<div class="container col-md-9">
<div class="bg-dark h4 text-white breadcrumb">General ESAT Teacher Result</div>

<!-- Age Chart Form -->
<form id="form1" name="form1" onchange="AgeChart()">
    <div class="d-flex">    
        <div class="p-2 w-100">
            <!-- School Year Dropdown -->
            <label for="sy"><strong>School Year:</strong></label>
            <?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die ($conn->error); ?>
            <select id="sy_id" class="form-control" >
            <option value="" disabled selected>--Select School Year--</option>
                <?php while($syrow = $schoolyr->fetch_assoc()): ?>
                <option value="<?php echo $syrow['sy_id'];?>"><?php echo $syrow['sy_desc'];?></option>
                <?php endwhile; ?>
            </select>
        </div>
            <!-- End of School Year Dropdown -->
        <div class="p-2 w-100">
            <!-- School Dropdown -->
            <label for="sy"><strong>School:</strong></label>
            <?php $schoolqry = $conn->query("SELECT * FROM school_tbl")or die ($conn->error);?>
            <select id="sch_id" class="form-control">
            <option value="" disabled selected>--Select School--</option>
                <?php while($schoolrow = $schoolqry->fetch_assoc()):?>
                <option value="<?php echo $schoolrow['school_id'];?>"><?php echo $schoolrow['school_name'];?></option>
                <?php endwhile; ?>
            </select>       
           <!-- End of School Dropdown -->
          
        </div>
        </div>
                </form>
<br>
<div id="piechart" style="width: 400px; height: 400px;"></div>
<!--End of Age Chart Form -->
               
      
<!-- End tag of container -->
  </div>




<?php

include 'samplefooter.php';

?>