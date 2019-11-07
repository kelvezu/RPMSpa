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
	$query = "SELECT a.age_name, b.count as total FROM age_tbl a 
                INNER JOIN
                ( SELECT age, COUNT(DISTINCT user_id) as  count FROM esat1_demographicst_tbl
                
                UNION
                
                SELECT age, COUNT(DISTINCT user_id) as  count FROM esat1_demographicsmt_tbl
                )as b on a.age_id=b.age
                ";
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
	$query = "SELECT a.gender_name, b.total FROM gender_tbl a 
                INNER JOIN
                ( SELECT gender, COUNT(DISTINCT user_id) as total,sy FROM esat1_demographicst_tbl
                
                UNION
                
                SELECT gender, COUNT(DISTINCT user_id) as total,sy FROM esat1_demographicsmt_tbl
                )as b on a.gender_id=b.gender
                ";
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
	$query = "SELECT DISTINCT employment_status, COUNT(DISTINCT user_id) total FROM esat1_demographicst_tbl 
                    UNION
              SELECT DISTINCT employment_status, COUNT(DISTINCT user_id) total FROM esat1_demographicsmt_tbl 
            ";
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
	$query = "SELECT DISTINCT position, COUNT(DISTINCT user_id) total FROM esat1_demographicst_tbl 
                UNION
                
                SELECT DISTINCT position, COUNT(DISTINCT user_id) total FROM esat1_demographicsmt_tbl 
                
                WHERE 
                position LIKE '%Master Teacher%' or position LIKE 'Teacher%'
                GROUP by position
            ";
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
	$query = "SELECT degree_name,sum(b.total) as total FROM degree_obtained_tbl a
                INNER JOIN
                (
                SELECT DISTINCT highest_degree, COUNT(DISTINCT user_id) total FROM esat1_demographicst_tbl 
                                UNION
                
                                SELECT DISTINCT highest_degree, COUNT(DISTINCT user_id) total FROM esat1_demographicsmt_tbl 
                
                                WHERE 
                                                                highest_degree LIKE '%Bachelor%' 
                                                                or highest_degree LIKE 'Master%' 
                                                                or highest_degree LIKE '%Doctorate%'
                                GROUP by highest_degree
                    
                ) as b on a.degree_name = b.highest_degree
                
                GROUP BY degree_name";
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

											<td>' . $row['degree_name'] . '</td>
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
	$query = "SELECT a.totalyear_name, sum(b.total) as total from totalyear_tbl a
                INNER JOIN
                (
                SELECT DISTINCT totalyear, COUNT(DISTINCT user_id) total FROM esat1_demographicst_tbl 
                
                UNION
                
                SELECT DISTINCT totalyear, COUNT(DISTINCT user_id) total FROM esat1_demographicsmt_tbl 
                GROUP by totalyear
                ) as b on a.totalyear_id = b.totalyear";
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
	$query = "SELECT a.subject_name, sum(b.total) as total from subject_tbl a
                    INNER JOIN
                    (
                    
                        SELECT a.subject_name, b.total from subject_tbl a
                        INNER JOIN
                        (
                        SELECT subject_taught, COUNT(user_id) total FROM esat1_demographicst_tbl 
                    
                        UNION
                    
                        SELECT subject_taught, COUNT(user_id) total FROM esat1_demographicsmt_tbl 
                    
                    
                        ) as b on b.subject_taught LIKE CONCAT('%', a.subject_name, '%')
                    
                        GROUP by a.subject_name,b.total
                    )  as b on a.subject_name = b.subject_name
                    
                    GROUP BY  a.subject_name
                    ";
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
	$query = "SELECT a.gradelvltaught_name, sum(b.total) as total from gradelvltaught_tbl a
                INNER JOIN
                (
                
                    SELECT a.gradelvltaught_name, b.total from gradelvltaught_tbl a
                    INNER JOIN
                    (
                    SELECT grade_lvl_taught, COUNT(user_id) total FROM esat1_demographicst_tbl 
                
                    UNION
                
                    SELECT grade_lvl_taught, COUNT(user_id) total FROM esat1_demographicsmt_tbl 
                    ) as b on b.grade_lvl_taught LIKE CONCAT('%', a.gradelvltaught_id, '%')
                
                    GROUP by a.gradelvltaught_name,b.total
                )  as b on a.gradelvltaught_name = b.gradelvltaught_name
                
                GROUP BY  a.gradelvltaught_name";
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
	$query = "SELECT a.curriclass_name, SUM(b.count) total FROM curriclass_tbl a
                INNER JOIN 
                (
                SELECT curri_class,COUNT(DISTINCT user_id)count FROM esat1_demographicst_tbl
                UNION
                SELECT curri_class,COUNT(DISTINCT user_id)count FROM esat1_demographicsmt_tbl
                GROUP BY curri_class
                ) AS b on a.curriclass_id = b.curri_class
                GROUP BY a.curriclass_name";
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
	$query = "SELECT a.region_name, SUM(b.count) total FROM region_tbl a
                INNER JOIN 
                (
                SELECT region,COUNT(DISTINCT user_id)count FROM esat1_demographicst_tbl
                UNION
                SELECT region,COUNT(DISTINCT user_id)count FROM esat1_demographicsmt_tbl
                GROUP BY curri_class
                ) AS b on a.reg_id = b.region
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
							<th width="auto">OBJECTIVES</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto">VERY HIGH</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto">VERY HIGH</th>


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

	<!--Start of Core Behavioral Self Assessment-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,sum(b.score4)score4,sum(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
	(
		SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptselfmanagementt
	
		UNION
	
		SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptselfmanagementmt
	) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - SELF ASSESSMENT</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart10">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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

	<!--Start of Core Behavioral Professionalism and Ethics-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,SUM(b.score4)score4,SUM(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
	(
		SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptprofessionalismethicst
	
		UNION
	
		SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptprofessionalismethicsmt
	) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - Professionalism and Ethics</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart13">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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
			<div id="chart_area13" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart13" id="view_chart13" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />



	<!--end of Core Behavioral Professionalism and Ethics-->

	<!--Start of Core Behavioral Results Focus-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,SUM(b.score4)score4,SUM(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
	(
	SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptresultfocust
	UNION
	SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptresultfocusmt
	) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - Results Focus</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart14">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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
			<div id="chart_area14" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart14" id="view_chart14" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />



	<!--end of Core Behavioral Results Focus-->

	<!--Start of Core Behavioral Teamwork-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,SUM(b.score4)score4,			SUM(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
				(
					SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptteamworkt
				
					UNION
				
					SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptteamworkmt
				) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - Teamwork</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart15">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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
			<div id="chart_area15" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart15" id="view_chart15" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />



	<!--end of Core Behavioral Teamwork-->

	<!--Start of Core Behavioral Service Orientation-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,SUM(b.score4)score4,		  SUM(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
			(
				SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptserviceorientationt
			
				UNION
			
				SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptserviceorientationmt
			) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - Service Orientation</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart16">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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
			<div id="chart_area16" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart16" id="view_chart16" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />

	<!--end of Core Behavioral Service Orientation-->

	<!--Start of Core Behavioral Innovation-->

	<?php
	$connect = new PDO('mysql:host=localhost;dbname=rpms', 'root', '');
	$query = "SELECT a.cbc_name, SUM(b.score1)score1,SUM(b.score2)score2,SUM(b.score3)score3,SUM(b.score4)score4,				SUM(b.score5)score5 FROM core_behavioral_tbl a INNER JOIN
					(
						SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptinnovationt
					
						UNION
					
						SELECT cbc_name, score1, score2,score3, score4, score5 FROM tbl_rptinnovationmt
					) as b on a.cbc_name = b.cbc_name GROUP BY a.cbc_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	?>



	<div class="container">
		<div class="breadcome-list shadow-reset">
			<h3 align="center"><strong>CORE BEHAVIORAL - Innovation</strong></h3>
			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover" id="for_chart17">
					<thead>
						<tr>
							<th width="auto">CBC_NAME</th>
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
			<div id="chart_area17" title="Objectives">

			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart17" id="view_chart17" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
		</div>
	</div>

	<br />
	<br />



	<!--end of Core Behavioral Innovation-->


</body>



<?php
   
   include 'includes/footer.php';
?>
