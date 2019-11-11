<?php  
include 'includes/header.php';
include 'includes/conn.inc.php';
//1st query

$query = "SELECT c.sy_desc as tyear1 FROM core_behavioral_tbl a 
            INNER JOIN 
            esat3_core_behavioralt_tbl b  on a.cbc_id = b.cbc_id 
            INNER JOIN sy_tbl c on b.sy = c.sy_id
            group by c.sy_desc";

$result = mysqli_query($conn,$query);
?>
<?php
$query2 = "SELECT c.sy_desc as tyear2
            FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
            INNER JOIN sy_tbl c on a.sy = c.sy_id
            group by c.sy_desc";

$result2 = mysqli_query($conn,$query2);
?>


<!DOCTYPE html>  
<html>  
    <head>  
        <title>Create Dynamic Column Chart using PHP Ajax with Google Charts</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
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

<!-- GOOGLE SCRIPT -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(draw_cbc_chart);
google.charts.setOnLoadCallback(draw_ass_chart);

// START 1ST CHART
function load_cbc_data(tyear1, title)
{
    var temp_title = title + ' '+tyear1+'';
    $.ajax({
        url:"testfetch2.php",
        method:"POST",
        data:{tyear1:tyear1},
        dataType:"JSON",
        success:function(data)
        {
            draw_cbc_chart(data, temp_title);
        }
    });
}

function draw_cbc_chart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'CBC Name');
    data.addColumn('number', 'CBC Score');
    $.each(jsonData, function(i, jsonData){
        var CBC_NAME = jsonData.CBC_NAME;
        var cbc_score =jsonData.cbc_score;
        data.addRows([[CBC_NAME,cbc_score]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'CBC Name'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('cbc_chart'));
    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){

    $('#tyear1').change(function(){
        var tyear1 = $(this).val();
        if(tyear1 != '')
        {
            load_cbc_data(tyear1, 'Core Behavioral Competencies');
        }
    });

});

// END OF 1ST CHART
// START 2ND CHART

function load_ass_data(tyear2, title)
{
    var temp_title = title + ' '+tyear2+'';
    $.ajax({
        url:"testfetch2.php",
        method:"POST",
        data:{tyear2:tyear2},
        dataType:"JSON",
        success:function(data)
        {
            draw_ass_chart(data, temp_title);
        }
    });
}

function draw_ass_chart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Objectives');
    data.addColumn('number', 'Level of Capabilities');
    data.addColumn('number', 'Priorities Development');
    $.each(jsonData, function(i, jsonData){
        var OBJECTIVES = jsonData.OBJECTIVES;
        var lvlcap =jsonData.lvlcap;
        var priodev =jsonData.priodev;
        data.addRows([[OBJECTIVES,lvlcap,priodev]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Score"
        },
        vAxis: {
            title: 'Objectives'
        }
    };

    var chart = new google.visualization.BarChart(document.getElementById('ass_chart'));
    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){

    $('#tyear2').change(function(){
        var tyear2 = $(this).val();
        if(tyear2 != '')
        {
            load_ass_data(tyear2, 'Assessment of Level of Capabilities and Priority Development');
        }
    });

});

// END OF 2ND CHART
</script>





