<?php

include 'sampleheader.php';

?>


<div class="container col-md-9">

	<div class="bg-dark h4 text-white breadcrumb">My ESAT Result</div>
	<div class="px-3">


		<form action="esatchartTeacher.php" method="POST" class="form-inline">
			<input type="hidden" id="school_id" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">
			<input type="hidden" id="position" name="position" value="<?php echo $_SESSION['position']; ?>">
			<input type="hidden" id="active_sy" name="active_sy" value="<?php echo $_SESSION['active_sy_id']; ?>">
			<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">

			<div class="form-row">
				<div class="form-group mb-2">
					<!-- School Year Dropdown -->
					<label for="sy"><strong>School Year:</strong></label>&nbsp;&nbsp;
					<?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die($conn->error); ?>
					<select id="sy_id" name="sy_id" class="form-control">
						<option value="" disabled selected>--Select School Year--</option>
						<?php while ($syrow = $schoolyr->fetch_assoc()) : ?>
							<option value="<?php echo $syrow['sy_id']; ?>"><?php echo $syrow['sy_desc']; ?></option>
						<?php endwhile; ?>
					</select>&nbsp;&nbsp;
				</div>
				<!-- End of School Year Dropdown -->
				<div class="form-group mb-2">
					<a onclick="showchart()" class="btn btn-success text-white">View</a>&nbsp;&nbsp;
					<button type="submit" name="view" class="btn btn-success">View Data in Charts</button>
				</div>
			</div>
		</form>
		<br>
		<div id="show">

		</div>


	</div>

	<!-- End tag of container -->
</div>
</div>
<script>
	showchart()

	function showchart() {
		let user = document.getElementById('user_id').value;
		let sy_id = document.getElementById('sy_id').value;
		let active_sy_id = document.getElementById('active_sy').value;
		let school_id = document.getElementById('school_id').value;

		let xmlhttp = new XMLHttpRequest();
		xmlhttp.onload = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("show").innerHTML = xmlhttp.responseText;
				console.log(this.responseText);
			}
		}
		xmlhttp.open("GET", "esatajaxtableTeacher.php?activesy=" + active_sy_id + "&sch=" + school_id + "&sy=" + sy_id + "&user=" + user, true);
		xmlhttp.send();
	}
</script>


<?php

include 'samplefooter.php';

?>