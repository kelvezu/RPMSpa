<?php

include_once 'includes/header.php';
// include_once 'includes/conn.inc.php';
// include_once 'libraries/func.lib.php';
// include_once 'includes/constants.inc.php';
// include_once 'libraries/db.library.php';
// $user_id = $_SESSION['user_id'];

?>


<?php
$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
$query = "SELECT a.CBC_NAME,c.indicator FROM core_behavioral_tbl a 
			INNER JOIN 
			esat3_core_behavioral_tbl b  on a.cbc_id = b.cbc_id
			INNER JOIN cbc_indicators_tbl c on b.cbc_ind_id=c.cbc_ind_id
			WHERE b.status='active' GROUP BY a.CBC_NAME,c.indicator order by a.cbc_id;";
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
							<th width="20%">CBC Indicator</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['CBC_NAME'] . '</td>
									<td>' . $row['indicator'] . '</td>
								</tr>
								';
					}

					?>
				</table>
			</div>
		</div>
	</div>


	<!-- End of Core Behavioral Competencies -->

	<!-- Start of Assessment of Capabilities and Prioties -->


	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT CONCAT(a.kra_id,'.',b.mtobj_id,'.',b.mtobj_name) 
					AS OBJECTIVES, 
					CASE 
						WHEN a.lvlcap = 1 THEN 'Low'
						WHEN a.lvlcap = 2 THEN 'Moderate'
						WHEN a.lvlcap = 3 THEN 'High'
						WHEN a.lvlcap = 4 THEN 'Very High'
											end as lvlcap,
					CASE 
						WHEN a.priodev = 1 THEN 'Low'
						WHEN a.priodev = 2 THEN 'Moderate'
						WHEN a.priodev = 3 THEN 'High'
						WHEN a.priodev = 4 THEN 'Very High'
											END AS priodev 
					FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
					WHERE a.status='Active'
					group by a.mtobj_id,b.mtobj_name;";

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
		</div>
	</div>
</body>

</html>


<!-- Start of Assessment of Capabilities and Prioties -->