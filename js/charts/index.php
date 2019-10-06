<?php
$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
$query = "SELECT a.CBC_NAME,SUM(b.cbc_score) 
		  AS cbc_score FROM core_behavioral_tbl a 
		  LEFT JOIN 
		  esat3_core_behavioral_tbl as b on a.cbc_id = b.cbc_id group by a.cbc_name;";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Make Chart from Table by using Ajax with PHP HighchartTable</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<link rel="stylesheet" href="jquery-ui.css">
		<script src="bootstrap.min.js"></script>
		<script src="jquery.highchartTable.js"></script>
		<script src="highcharts.js"></script>
		<script src="jquery-ui.js"></script>

	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">The Rating of Core Behavioral Competencies</h3>
			<br />
			
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="for_chart">
					<thead>
						<tr>
							<th width="20%">CBC Name</th>
							<th width="20%">CBC Score</th>

	

						</tr>
					</thead>
					<?php
						//if(isset($_POST['cbc_name'])){
						//$cbc_name = $_POST['cbc_name'];
					
							foreach($result as $row)
							{

								echo '
								<tr>

									<td>'.$row['CBC_NAME'].'</td>
									<td>'.$row['cbc_score'].'</td>


								

								</tr>
								';
							}
						//}
					?>
				</table>
			</div>
			<br />
			<div id="chart_area" title="The Rating of Core Behavioral Competencies">
				
			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart" id="view_chart" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
			<br />
			<br />
		</div>
	</body>
</html>

<script>
$(document).ready(function(){
		
	$('#view_chart').click(function(){
		$('#for_chart').data('graph-container', '#chart_area');
		$('#for_chart').data('graph-type', 'column');
		$("#chart_area").dialog('open');
		$('#for_chart').highchartTable();
		
		$('#remove_chart').attr('disabled', false);
	});
	
	$('#remove_chart').click(function(){
		$('#chart_area').html('');
	});
	
	$("#chart_area").dialog({
		autoOpen:false,
		width: 800,
		height:500
	});
});
</script>



