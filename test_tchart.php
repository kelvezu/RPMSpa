<?php  
include 'includes/header.php';
?>

<!DOCTYPE html>  
<html>  
    <head>  
        <title>Create Dynamic Column Chart using PHP Ajax with Google Charts</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
        <script type="text/javascript" src="includes/scripts.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(draw_cbc_chart_t);
        google.charts.setOnLoadCallback(draw_ass_chart_t);
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
                            <select name="tyear1" class="form-control" id="tyear1">
                                 <option value="">Select School Year</option>
                            <?php
                            $results = RPMSDB\RPMSdb::teacherSYcbc($conn);
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["tyear1"].'">'.$row["tyear1"].'</option>';
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
        <br/>
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
                            <select name="tyear2" class="form-control" id="tyear2">
                                <option value="">Select School Year</option>
                            <?php
                            $result2 = RPMSDB\RPMSdb::teacherSYass($conn);
                            foreach($result2 as $row)
                            {
                                echo '<option value="'.$row["tyear2"].'">'.$row["tyear2"].'</option>';
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
