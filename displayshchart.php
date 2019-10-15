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
$query = "SELECT a.cbc_name,count(b.cbc_score) 
			AS cbc_score FROM core_behavioral_tbl a 
			INNER JOIN 
			esat3_core_behavioral_tbl b  on a.cbc_id = b.cbc_id 
			group by a.cbc_name ORDER BY a.cbc_id;";
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
			<h3 align="center"><strong>Core Behavioral Competencies</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart10">
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

									<td>' . $row['cbc_name'] . '</td>
									<td>' . $row['cbc_score'] . '</td>
								</tr>
								';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area10" title="The Rating of Core Behavioral Competencies">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart10" id="view_chart10" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>

		</div>
	</div>

	<br />
	<br />

	<!-- End of Core Behavioral Competencies -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT age_name,COUNT(age) as age_count from age_tbl 
					a LEFT JOIN esat1_demographics_tbl b on 
					a.age_id = b.age group by a.age_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>

	<!-- Demographic Age -->
	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Age</strong></h3>
			<br />
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart1">
					<thead>
						<tr>
							<th width="10%">Age</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['age_name'] . '</td>
									<td>' . $row['age_count'] . '</td>
								</tr>
								';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area1" title="Age">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart1" id="view_chart1" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />

	<!-- End of Demographic Age -->

	<!-- Start of Demographic Gender -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.gender_name,COUNT(b.gender) as gender_count from gender_tbl a 
					LEFT JOIN esat1_demographics_tbl b 
					on a.gender_id = b.gender group by a.gender_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>


	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Gender</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart2">
					<thead>
						<tr>
							<th width="10%">Gender</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['gender_name'] . '</td>
									<td>' . $row['gender_count'] . '</td>
								</tr>
								';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area2" title="Gender">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart2" id="view_chart2" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Gender -->
	<!-- Start of Demographic Employment Status -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT employment_status,COUNT(employment_status) as emp_count from 
					esat1_demographics_tbl GROUP by employment_status";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>

	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Employment Status</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart3">
					<thead>
						<tr>
							<th width="10%">Employment_status</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['employment_status'] . '</td>
											<td>' . $row['emp_count'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area3" title="Employment Status">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart3" id="view_chart3" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Employment Status -->

	<!-- Start of Demographic Position -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.position_name,COUNT(b.position) as position_count from  
					position_tbl a LEFT JOIN esat1_demographics_tbl b on a.position_id = b.position 
					WHERE A.position_id NOT IN (1,2)
					GROUP by a.position_name;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>

	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Position</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart4">
					<thead>
						<tr>
							<th width="10%">Position</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['position_name'] . '</td>
											<td>' . $row['position_count'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area4" title="Position">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart4" id="view_chart4" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Position -->

	<!-- Start of Demographic Highest Degree -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT highest_degree,COUNT(highest_degree) as deg_count 
					from esat1_demographics_tbl
					GROUP by highest_degree;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>




	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Highest Degree Obtained</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart5">
					<thead>
						<tr>
							<th width="10%">Highest Degree Obtained</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['highest_degree'] . '</td>
											<td>' . $row['deg_count'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area5" title="Highest Degree Obtained">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart5" id="view_chart5" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Highest Degree Obtained -->


	<!-- Start of Demographic Total Number of Years in Teaching -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.totalyear_name,COUNT(b.totalyear) as totalyear 
					from totalyear_tbl a LEFT JOIN esat1_demographics_tbl
					b on a.totalyear_id = b.totalyear
					GROUP by a.totalyear_name;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>




	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Total Number of Years in Teaching</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart6">
					<thead>
						<tr>
							<th width="10%">Total Number of Years in Teaching</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['totalyear_name'] . '</td>
											<td>' . $row['totalyear'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area6" title="Total Number of Years in Teaching">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart6" id="view_chart6" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Total Number of Years in Teaching -->

	<!-- Start of Demographic Subject Taught-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.subject_name,COUNT(b.subject_taught) as total 
					from subject_tbl a LEFT JOIN esat1_demographics_tbl
					b on b.subject_taught LIKE CONCAT('%', a.subject_name, '%') 
					GROUP by a.subject_name;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>




	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Subject Taught</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart7">
					<thead>
						<tr>
							<th width="10%">Subject Taught</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['subject_name'] . '</td>
											<td>' . $row['total'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area7" title="Subject Taught">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart7" id="view_chart7" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>
	<br />
	<br />


	<!-- End of Demographic Subject Taught-->

	<!-- Start of Grade Level Taught-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.gradelvltaught_name,COUNT(b.grade_lvl_taught) as total 
					from gradelvltaught_tbl a LEFT JOIN esat1_demographics_tbl
					b on b.grade_lvl_taught LIKE CONCAT('%', a.gradelvltaught_id, '%') 
					GROUP by a.gradelvltaught_id;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>




	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Grade Level Taught</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart8">
					<thead>
						<tr>
							<th width="10%">Grade Level Taught</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['gradelvltaught_name'] . '</td>
											<td>' . $row['total'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area8" title="Start of Grade Level Taught">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart8" id="view_chart8" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />


	<!-- End of Demographic Start of Grade Level Taught-->


	<!-- Start of Region-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.region_name,COUNT(b.region) as total 
					from region_tbl a LEFT JOIN esat1_demographics_tbl b on a.reg_id = b.region 
					GROUP by a.region_name;";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Region</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart9">
					<thead>
						<tr>
							<th width="10%">Region</th>
							<th width="10%">Total</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['region_name'] . '</td>
											<td>' . $row['total'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area9" title="Region">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart9" id="view_chart9" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />


	<!-- End of Demographic Start Region-->
	<!-- Start of Teacher Objective-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT CONCAT(a.kra_id,'.',a.tobj_id) 
					AS OBJECTIVES, 
					CASE WHEN b.lvlcap = 1 then count(DISTINCT user_id) END AS L_LOW,
					CASE WHEN b.lvlcap = 2 then count(DISTINCT user_id) END AS L_MODERATE,
					CASE WHEN b.lvlcap = 3 then count(DISTINCT user_id) END AS L_HIGH,
					CASE WHEN b.lvlcap = 4 then count(DISTINCT user_id) END AS L_VERY_HIGH,
					
					CASE WHEN b.priodev = 1 then count(DISTINCT user_id) END AS P_LOW,
					CASE WHEN b.priodev = 2 then count(DISTINCT user_id) END AS P_MODERATE,
					CASE WHEN b.priodev = 3 then count(DISTINCT user_id) END AS P_HIGH,
					CASE WHEN b.priodev = 4 then count(DISTINCT user_id) END AS P_VERY_HIGH
					from tobj_tbl a LEFT JOIN esat2_objectivest_tbl b ON a.tobj_id = b.tobj_id
					
					group by a.kra_id,a.tobj_id";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>


	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>SELF ASSESSMENT OF TEACHER I-III</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart11">
					<thead>
						<tr>
							<th>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF CAPABILITY</strong> </td>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF PRIORITY</strong> </td>
							</th>
						</tr>
						<tr>
							<th width="30%">OBJECTIVES</th>
							<th width="10%">LOW</th>
							<th width="10%">MODERATE</th>
							<th width="10%">HIGH</th>
							<th width="10%">VERY HIGH</th>
							<th width="10%">LOW</th>
							<th width="10%">MODERATE</th>
							<th width="10%">HIGH</th>
							<th width="10%">VERY HIGH</th>


						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>
											<td>' . $row['OBJECTIVES'] . '</td>
											<td>' . $row['L_LOW'] . '</td>
											<td>' . $row['L_MODERATE'] . '</td>
											<td>' . $row['L_HIGH'] . '</td>
											<td>' . $row['L_VERY_HIGH'] . '</td>
											<td>' . $row['P_LOW'] . '</td>
											<td>' . $row['P_MODERATE'] . '</td>
											<td>' . $row['P_HIGH'] . '</td>
											<td>' . $row['P_VERY_HIGH'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area11" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart11" id="view_chart11" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />


	<!-- End Teacher Objective-->
	<!-- Start of Master Teacher Objective-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT CONCAT(a.kra_id,'.',a.mtobj_id) 
					AS OBJECTIVES, 
					CASE WHEN b.lvlcap = 1 then count(DISTINCT user_id) END AS L_LOW,
					CASE WHEN b.lvlcap = 2 then count(DISTINCT user_id) END AS L_MODERATE,
					CASE WHEN b.lvlcap = 3 then count(DISTINCT user_id) END AS L_HIGH,
					CASE WHEN b.lvlcap = 4 then count(DISTINCT user_id) END AS L_VERY_HIGH,
					
					CASE WHEN b.priodev = 1 then count(DISTINCT user_id) END AS P_LOW,
					CASE WHEN b.priodev = 2 then count(DISTINCT user_id) END AS P_MODERATE,
					CASE WHEN b.priodev = 3 then count(DISTINCT user_id) END AS P_HIGH,
					CASE WHEN b.priodev = 4 then count(DISTINCT user_id) END AS P_VERY_HIGH
					from mtobj_tbl a LEFT JOIN esat2_objectivesmt_tbl b ON a.mtobj_id = b.mtobj_id
					group by a.kra_id,a.mtobj_id";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>SELF ASSESSMENT OF MASTER TEACHER I-IV</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart12">
					<thead>
						<tr>
							<th>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF CAPABILITY</strong> </td>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF PRIORITY</strong></td>
							</th>
						</tr>
						<tr>
							<th width="30%">OBJECTIVES</th>
							<th width="10%">LOW</th>
							<th width="10%">MODERATE</th>
							<th width="10%">HIGH</th>
							<th width="10%">VERY HIGH</th>
							<th width="10%">LOW</th>
							<th width="10%">MODERATE</th>
							<th width="10%">HIGH</th>
							<th width="10%">VERY HIGH</th>


						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>
											<td>' . $row['OBJECTIVES'] . '</td>
											<td>' . $row['L_LOW'] . '</td>
											<td>' . $row['L_MODERATE'] . '</td>
											<td>' . $row['L_HIGH'] . '</td>
											<td>' . $row['L_VERY_HIGH'] . '</td>
											<td>' . $row['P_LOW'] . '</td>
											<td>' . $row['P_MODERATE'] . '</td>
											<td>' . $row['P_HIGH'] . '</td>
											<td>' . $row['P_VERY_HIGH'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area12" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart12" id="view_chart12" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />


	<!-- End Master Teacher Objective-->


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
			width: 900,
			height: 600
		});
	});

	$(document).ready(function() {

		$('#view_chart3').click(function() {
			$('#for_chart3').data('graph-container', '#chart_area3');
			$('#for_chart3').data('graph-type', 'column');
			$("#chart_area3").dialog('open');
			$('#for_chart3').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area3').html('');
		});

		$("#chart_area3").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});



	$(document).ready(function() {

		$('#view_chart4').click(function() {
			$('#for_chart4').data('graph-container', '#chart_area4');
			$('#for_chart4').data('graph-type', 'column');
			$("#chart_area4").dialog('open');
			$('#for_chart4').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area4').html('');
		});

		$("#chart_area4").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});


	$(document).ready(function() {

		$('#view_chart5').click(function() {
			$('#for_chart5').data('graph-container', '#chart_area5');
			$('#for_chart5').data('graph-type', 'column');
			$("#chart_area5").dialog('open');
			$('#for_chart5').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area5').html('');
		});

		$("#chart_area5").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});


	});


	$(document).ready(function() {

		$('#view_chart6').click(function() {
			$('#for_chart6').data('graph-container', '#chart_area6');
			$('#for_chart6').data('graph-type', 'column');
			$("#chart_area6").dialog('open');
			$('#for_chart6').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area6').html('');
		});

		$("#chart_area6").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});


	$(document).ready(function() {

		$('#view_chart7').click(function() {
			$('#for_chart7').data('graph-container', '#chart_area7');
			$('#for_chart7').data('graph-type', 'column');
			$("#chart_area7").dialog('open');
			$('#for_chart7').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area7').html('');
		});

		$("#chart_area7").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});

	$(document).ready(function() {

		$('#view_chart8').click(function() {
			$('#for_chart8').data('graph-container', '#chart_area8');
			$('#for_chart8').data('graph-type', 'column');
			$("#chart_area8").dialog('open');
			$('#for_chart8').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area8').html('');
		});

		$("#chart_area8").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});


	$(document).ready(function() {

		$('#view_chart9').click(function() {
			$('#for_chart9').data('graph-container', '#chart_area9');
			$('#for_chart9').data('graph-type', 'column');
			$("#chart_area9").dialog('open');
			$('#for_chart9').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area9').html('');
		});

		$("#chart_area9").dialog({
			autoOpen: false,
			width: 900,
			height: 600

		});
	});

	$(document).ready(function() {

		$('#view_chart10').click(function() {
			$('#for_chart10').data('graph-container', '#chart_area10');
			$('#for_chart10').data('graph-type', 'column');
			$("#chart_area10").dialog('open');
			$('#for_chart10').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area10').html('');
		});

		$("#chart_area10").dialog({
			autoOpen: false,
			width: 900,
			height: 600
		});
	});

	$(document).ready(function() {

		$('#view_chart11').click(function() {
			$('#for_chart11').data('graph-container', '#chart_area11');
			$('#for_chart11').data('graph-type', 'column');
			$("#chart_area11").dialog('open');
			$('#for_chart11').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area11').html('');
		});

		$("#chart_area11").dialog({
			autoOpen: false,
			width: 1000,
			height: 600

		});
	});

	$(document).ready(function() {

		$('#view_chart12').click(function() {
			$('#for_chart12').data('graph-container', '#chart_area12');
			$('#for_chart12').data('graph-type', 'column');
			$("#chart_area12").dialog('open');
			$('#for_chart12').highchartTable();

			$('#remove_chart').attr('disabled', false);
		});

		$('#remove_chart').click(function() {
			$('#chart_area12').html('');
		});

		$("#chart_area12").dialog({
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