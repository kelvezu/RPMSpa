<?php
session_start();
$user_id = $_SESSION['user_id'];

?>


<?php
$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
$query = "SELECT a.CBC_NAME,sum(b.cbc_score) 
			AS cbc_score FROM core_behavioral_tbl a 
			INNER JOIN 
			esat3_core_behavioral_tbl b  on a.cbc_id = b.cbc_id 
			WHERE b.user_id = $user_id 
			group by a.cbc_name ORDER BY a.cbc_id;";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="includes/chart/jquery.min.js"></script>
		<link rel="stylesheet" href="includes/chart/bootstrap.min.css" />
		<link rel="stylesheet" href="includes/chart/jquery-ui.css">
		<script src="includes/chart/bootstrap.min.js"></script>
		<script src="includes/chart/jquery.highchartTable.js"></script>
		<script src="includes/chart/highcharts.js"></script>
		<script src="includes/chart/jquery-ui.js"></script>

</head>
<body>
<!-- Core Behavioral Competencies -->
		<div class="container">
				<h3 align="center"><strong>Core Behavioral Competencies Rating</strong></h3>
					<br />

			<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="for_chart1">
					<thead>
						<tr>
							<th width="20%">CBC Name</th>
							<th width="20%">CBC Score</th>

						</tr>
					</thead>
					<?php
						
							foreach($result as $row)
							{

								echo '
								<tr>

									<td>'.$row['CBC_NAME'].'</td>
									<td>'.$row['cbc_score'].'</td>
								</tr>
								';
							}
						
					?>
				</table>
			</div>
			<br />
			<div id="chart_area1" title="The Rating of Core Behavioral Competencies">
				
			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart1" id="view_chart1" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>

			<br />
			<br />

		</div>



<!-- End of Core Behavioral Competencies -->

<!-- Start of Assessment of Capabilities and Prioties -->


<?php
$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
$query = "SELECT a.tobj_id, b.tobj_name, lvlcap as lvlcap, priodev 
			FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
			WHERE a.user_id = $user_id 
			group by a.tobj_id,b.tobj_name;";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
		<br />
		<!-- The Assessment of Capabilities and Prioties -->
		<div class="container">
			<h3 align="center"><strong>Assessment of Capabilities and Priorities</strong></h3>
			<br />
			
			<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover" id="for_chart2">
					<thead>
						<tr>
							<th width="20%">Objectives</th>
							<th width="20%">Level of Capabilities</th>
                            <th width="20%">Level of Priority</th>

						</tr>
					</thead>
					<?php
						
							foreach($result as $row)
							{

								echo '
								<tr>

									<td>'.$row['tobj_id'].' '.$row['tobj_name'].'</td>
                                    <td>'.$row['lvlcap'].'</td>
                                    <td>'.$row['priodev'].'</td>
								</tr>
								';
							}
						
					?>
				</table>
			</div>
			<br />
			<div id="chart_area2" title="The Assessment of Capabilities and Priorities">
				
			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart2" id="view_chart2" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>

			<br />
			<br />

		</div>
	</body>
</html>

<script>


$(document).ready(function(){
		
	$('#view_chart1').click(function(){
		$('#for_chart1').data('graph-container', '#chart_area1');
		$('#for_chart1').data('graph-type', 'column');
		$("#chart_area1").dialog('open');
		$('#for_chart1').highchartTable();
		
		$('#remove_chart').attr('disabled', false);
	});
	
	$('#remove_chart').click(function(){
		$('#chart_area1').html('');
	});
	
	$("#chart_area1").dialog({
		autoOpen:false,
		width: 1000,
		height:600
	});
});


$(document).ready(function(){
		
	$('#view_chart2').click(function(){
		$('#for_chart2').data('graph-container', '#chart_area2');
		$('#for_chart2').data('graph-type', 'column');
		$("#chart_area2").dialog('open');
		$('#for_chart2').highchartTable();
		
		$('#remove_chart').attr('disabled', false);
	});
	
	$('#remove_chart').click(function(){
		$('#chart_area2').html('');
	});
	
	$("#chart_area2").dialog({
		autoOpen:false,
		width: 2000,
		height:600
	});
});
</script>



