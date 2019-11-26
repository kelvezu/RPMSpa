<?php  
include 'sampleheader.php';
?>

<!DOCTYPE html>  
<html>  
    <head>  
        <title>Create Dynamic Column Chart using PHP Ajax with Google Charts</title>
        <script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
        <script src="bootstrap4/scripts/bootstrap.min.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(draw_cbc_chart_mt);
        google.charts.setOnLoadCallback(draw_ass_chart_mt);
        </script>
    </head>  
    <body> 
        <br /><br />
<!-- START 1ST CHART -->
        <div class="container">  
            <h3 align="center">Electronic Self Assessment Tool - Chart</h3>  
            <br />  
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="panel-title">Core Behavioral Competencies</h3>
                        </div>
                        <div class="col-md-3">
                            <select name="mtyear1" class="form-control" id="mtyear1">
                                <option value="">Select School Year</option>
                            <?php
                            $result = RPMSDB\RPMSdb::mteacherSYcbc($conn);
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["mtyear1"].'">'.$row["mtyear1"].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="cbc_chart" style="width: 1000px; height: 620px;"></div>
                </div>
            </div>
        </div>
<!-- END 1ST CHART -->
<!-- START 2ND CHART --> 
<div class="container">              
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="panel-title">Self Asseessment of Capabilities and Priorities</h3>
                        </div>
                        <div class="col-md-3">
                            <select name="mtyear2" class="form-control" id="mtyear2">
                                <option value="">Select School Year</option>
                            <?php
                            $result2 = RPMSDB\RPMSdb::mteacherSYass($conn);
                            foreach($result2 as $row)
                            {
                                echo '<option value="'.$row["mtyear2"].'">'.$row["mtyear2"].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="ass_chart" style="width: 1000px; height: 620px;"></div>
                </div>
            </div>
</div>                       
<!-- END 2ND CHART -->
</body>  
</html>
<!-- <?php include 'samplefooter' ?> -->
