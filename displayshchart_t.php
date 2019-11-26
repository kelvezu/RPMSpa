<?php

include_once 'sampleheader.php';

$user_id = $_SESSION['user_id'];

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


	<!--Demographic Age -->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT b.age_name, COUNT(a.user_id) total,c.sy_desc FROM esat1_demographicst_tbl a 
     			INNER JOIN age_tbl b on a.age = b.age_id
				INNER JOIN sy_tbl c on a.sy = c.sy_id
				GROUP BY b.age_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>


	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Age</strong></h3>
			<br />
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart1">
					<thead>
						<tr>
							<th width="10%">Age</th>
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['age_name'] . '</td>
									<td>' . $row['total'] . '</td>
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
	$query = "SELECT b.gender_name, COUNT(a.user_id) total,c.sy_desc FROM esat1_demographicst_tbl a

				INNER JOIN sy_tbl c on a.sy = c.sy_id
				INNER JOIN gender_tbl b on a.gender = b.gender_id
				GROUP BY b.gender_name";
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
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
								<tr>

									<td>' . $row['gender_name'] . '</td>
									<td>' . $row['total'] . '</td>
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
	$query = "SELECT a.employment_status, COUNT(a.user_id) total,b.sy_desc FROM esat1_demographicst_tbl a
				INNER JOIN sy_tbl b on a.sy = b.sy_id
				GROUP BY a.employment_status";
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
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['employment_status'] . '</td>
											<td>' . $row['total'] . '</td>
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
	$query = "SELECT a.position, COUNT(a.user_id)total,b.sy_desc from  esat1_demographicst_tbl a
				INNER JOIN sy_tbl b on a.sy = b.sy_id
				GROUP BY a.position
				order BY a.position desc";
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
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['position'] . '</td>
											<td>' . $row['total'] . '</td>
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
	$query = "SELECT a.highest_degree, COUNT(a.user_id) total,b.sy_desc from esat1_demographicst_tbl a
							
				INNER JOIN sy_tbl b on a.sy=b.sy_id
				
				GROUP BY a.highest_degree";
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
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['highest_degree'] . '</td>
											<td>' . $row['total'] . '</td>
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
	$query = "SELECT c.totalyear_name,COUNT(a.user_id)total,b.sy_desc from esat1_demographicst_tbl a
	INNER JOIN sy_tbl b on a.sy = b.sy_id
	INNER JOIN totalyear_tbl c on a.totalyear=c.totalyear_id
	
	GROUP BY c.totalyear_name";
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
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['totalyear_name'] . '</td>
											<td>' . $row['total'] . '</td>
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
	$query = "SELECT a.subject_name, COUNT(b.user_id)total,c.sy_desc from subject_tbl a 
	INNER JOIN esat1_demographicst_tbl b on b.subject_taught LIKE CONCAT('%', a.subject_name, '%')
	INNER JOIN sy_tbl c on b.sy = c.sy_id
	GROUP BY a.subject_name";
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
							<th width="50%">Subject Taught</th>
							<th width="auto">No. of Teacher</th>

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
	$query = "SELECT a.gradelvltaught_name, COUNT(b.user_id)total,c.sy_desc from gradelvltaught_tbl a 
	INNER JOIN esat1_demographicst_tbl b on b.grade_lvl_taught LIKE CONCAT('%', a.gradelvltaught_id, '%') 
	INNER JOIN sy_tbl c on b.sy = c.sy_id
	GROUP BY a.gradelvltaught_name";
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
							<th width="10%">No. of Teacher</th>

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


	<!-- End of Grade Level Taught-->

	<!-- Start of Curricular Class-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT c.curriclass_name,COUNT(DISTINCT a.user_id)total,b.sy_desc FROM esat1_demographicst_tbl a
	INNER JOIN sy_tbl b on a.sy=b.sy_id
	INNER JOIN curriclass_tbl c on a.curri_class = c.curriclass_id
	GROUP BY c.curriclass_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>




	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>Curricular Class of School</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart18">
					<thead>
						<tr>
							<th width="10%">Curricular Class</th>
							<th width="10%">No. of Teacher</th>

						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>

											<td>' . $row['curriclass_name'] . '</td>
											<td>' . $row['total'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area18" title="Curricular Classification">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart18" id="view_chart18" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />


	<!-- End of Curricular Class-->


	<!-- Start of Region-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.region_name, COUNT(b.user_id)total,c.sy_desc from region_tbl a 
	INNER JOIN esat1_demographicst_tbl b on a.reg_id = b.region
	INNER JOIN sy_tbl c on b.sy = c.sy_id
	GROUP BY a.region_name";
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
							<th width="10%">No. of Teacher</th>

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
				CASE WHEN b.priodev = 4 then count(DISTINCT user_id) END AS P_VERY_HIGH,
				c.sy_desc
				
				from tobj_tbl a INNER JOIN esat2_objectivest_tbl b ON a.tobj_id = b.tobj_id
				
			INNER JOIN sy_tbl c on b.sy = c.sy_id
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
							<td></td>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF CAPABILITY</strong> </td>
							<td colspan="4" ALIGN="CENTER"><strong>LEVEL OF PRIORITY</strong> </td>
							</th>
						</tr>
						<tr>
							<th width="auto">OBJECTIVES</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto">VERY HIGH</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto	">VERY HIGH</th>



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
	
	<!--Start of Core Behavioral Self Assessment-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
		$query = "SELECT b.cbc_name, 
		CASE WHEN(a.score)=1 THEN COUNT(a.user_id) end as score1,
        CASE WHEN(a.score)=2 THEN COUNT(a.user_id) end as score2,
        CASE WHEN(a.score)=3 THEN COUNT(a.user_id) end as score3,
        CASE WHEN(a.score)=4 THEN COUNT(a.user_id) end as score4,
        CASE WHEN(a.score)=5 THEN COUNT(a.user_id) end as score5
		FROM
		(
		select cbc_id, user_id,sum(cbc_score)score from esat3_core_behavioralt_tbl GROUP BY cbc_id
		) a
		INNER JOIN core_behavioral_tbl b on a.cbc_id=b.cbc_id
		GROUP BY b.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL COMPETENCIES</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart10">
					<thead>
						<tr>
							<th width="auto">Core Behavioral Competencies</th>
							<th width="auto">1-SCALE</th>
							<th width="auto">2-SCALE</th>
							<th width="auto">3-SCALE</th>
							<th width="auto">4-SCALE</th>
							<th width="auto">5-SCALE</th>
						</tr>
					</thead>
					<?php

					foreach ($result as $row) {

						echo '
										<tr>
											<td>' . $row['cbc_name'] . '</td>
											<td>' . $row['score1'] . '</td>
											<td>' . $row['score2'] . '</td>
											<td>' . $row['score3'] . '</td>
											<td>' . $row['score4'] . '</td>
											<td>' . $row['score5'] . '</td>
										</tr>
										';
					}

					?>
				</table>
			</div>
			<br />
			<div id="chart_area10" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart10" id="view_chart10" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />



	<!--end of Core Behavioral Self Assessment-->


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

		$(document).ready(function() {

			$('#view_chart13').click(function() {
				$('#for_chart13').data('graph-container', '#chart_area13');
				$('#for_chart13').data('graph-type', 'column');
				$("#chart_area13").dialog('open');
				$('#for_chart13').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area13').html('');
			});

			$("#chart_area13").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
		});

		$(document).ready(function() {

			$('#view_chart14').click(function() {
				$('#for_chart14').data('graph-container', '#chart_area14');
				$('#for_chart14').data('graph-type', 'column');
				$("#chart_area14").dialog('open');
				$('#for_chart14').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area14').html('');
			});

			$("#chart_area14").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
		});

		$(document).ready(function() {

			$('#view_chart15').click(function() {
				$('#for_chart15').data('graph-container', '#chart_area15');
				$('#for_chart15').data('graph-type', 'column');
				$("#chart_area15").dialog('open');
				$('#for_chart15').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area15').html('');
			});

			$("#chart_area15").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
		});

		$(document).ready(function() {

			$('#view_chart16').click(function() {
				$('#for_chart16').data('graph-container', '#chart_area16');
				$('#for_chart16').data('graph-type', 'column');
				$("#chart_area16").dialog('open');
				$('#for_chart16').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area16').html('');
			});

			$("#chart_area16").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
		});

		$(document).ready(function() {

			$('#view_chart17').click(function() {
				$('#for_chart17').data('graph-container', '#chart_area17');
				$('#for_chart17').data('graph-type', 'column');
				$("#chart_area17").dialog('open');
				$('#for_chart17').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area17').html('');
			});

			$("#chart_area17").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
		});

		$(document).ready(function() {

			$('#view_chart18').click(function() {
				$('#for_chart18').data('graph-container', '#chart_area18');
				$('#for_chart18').data('graph-type', 'column');
				$("#chart_area18").dialog('open');
				$('#for_chart18').highchartTable();

				$('#remove_chart').attr('disabled', false);
			});

			$('#remove_chart').click(function() {
				$('#chart_area18').html('');
			});

			$("#chart_area18").dialog({
				autoOpen: false,
				width: 900,
				height: 600
			});
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


<?php
include 'samplefooter.php';
?>