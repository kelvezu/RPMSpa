<?php

include_once 'includes/header.php';
include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';
include_once 'includes/constants.inc.php';
include_once 'libraries/db.library.php';
$user_id = $_SESSION['user_id'];

?>

<?php
$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
$query = "SELECT a.CBC_NAME,sum(b.cbc_score) 
			AS cbc_score FROM core_behavioral_tbl a 
			INNER JOIN 
			esat3_core_behavioralt_tbl b  on a.cbc_id = b.cbc_id 
			WHERE b.user_id = $user_id 
			group by a.cbc_name order by a.cbc_id;";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
	<script src="js/charts/jquery.min.js"></script>
	<link rel="stylesheet" href="js/charts/bootstrap.min.css" />
	<link rel="stylesheet" href="js/charts/jquery-ui.css">
	<script src="js/charts/bootstrap.min.js"></script>
	<script src="js/charts/jquery.highchartTable.js"></script>
	<script src="js/charts/highcharts.js"></script>
	<script src="js/charts/jquery-ui.js"></script>

</head>

<body>
	<!-- Core Behavioral Competencies -->
	<div class="container">
		<div class="breadcome-list shadow-reset">
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

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['CBC_NAME'] . '</td>
									<td>' . $row['cbc_score'] . '</td>
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
	</div>


	<!-- End of Core Behavioral Competencies -->

	<!-- Start of Assessment of Capabilities and Prioties -->


	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT CONCAT(a.kra_id,'.',a.tobj_id) 
			AS OBJECTIVES, lvlcap, priodev 
			FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
			WHERE a.user_id = $user_id and status='active'
			group by a.tobj_id,b.tobj_name;";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>
	<br />
	<!-- The Assessment of Capabilities and Prioties -->
	<div class="container">
		<div class="breadcome-list shadow-reset">
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

					foreach ($result as $row) {

						echo '
									<tr>

										<td>' . $row['OBJECTIVES'] . '</td>
										<td>' . $row['lvlcap'] . '</td>
										<td>' . $row['priodev'] . '</td>
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
	</div>
</body>

</html>

<script>
	$(document).ready(function() {

		$('#view_chart1').click(function() {
			$('#for_chart1').data('graph-container', '#chart_area1');
			$('#for_chart1').data('graph-type', 'column');
			$("#chart_area1").dialog('open');
			$('#for_chart1').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area1').html('');
		});

		$("#chart_area1").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});


	$(document).ready(function() {

		$('#view_chart2').click(function() {
			$('#for_chart2').data('graph-container', '#chart_area2');
			$('#for_chart2').data('graph-type', 'column');
			$("#chart_area2").dialog('open');
			$('#for_chart2').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area2').html('');
		});

		$("#chart_area2").dialog({
			autoOpen: false,
			width: 1000,
			height: 600
		});

		Highcharts.setOptions({
			chart: {
				backgroundColor: {
					linearGradient: [0, 0, 500, 500],
					stops: [
						[0, 'rgb(255, 255, 255)'],
						[1, 'rgb(240, 240, 255)']
					]
				},
				borderWidth: 2,
				plotBackgroundColor: 'rgba(255, 255, 255, .9)',
				plotShadow: false,
				plotBorderWidth: 2,


			},

			plotOptions: {
				series: {
					pointWidth: 30,
					dataLabels: {
						enabled: true
					}


				}

			},

		});

	});
</script>