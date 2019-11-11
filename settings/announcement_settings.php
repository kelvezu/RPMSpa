<?php

use \RPMSdb\RPMSdb;

include 'header.php';

$result = RPMSdb::showAllAnnouncement($conn);

?>

<div class="green-notif-border">ei</div>
<div class="container my-5  d-flex">


	<div class="col">
		<?php foreach ($result as $res) :
			$ann_id = $res['id'];
			$subject = $res['subject'];
			$title = $res['title'];
			$message = $res['message'];
			?>


			<div class="card">
				<div class="card-header">

					<div class="d-flex flex-row">


						<div class="pl-2">
							<div>
								<p><b>Subject:</b> <?= $subject ?></p>
							</div>
						</div>

						<div class="pl-2">
							<div>
								<p><b>Title:</b> <?= $title ?></p>
							</div>
						</div>

						<div class="ml-auto p-2">
							<div class="row">
								<div class="col">
									<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateAnnModal<?= $ann_id ?>" name="update">Update</button>
								</div>
								<div class="col">
									<button type="submit" class="btn btn-sm btn-danger" name="remove">Remove</button>
								</div>
							</div>
						</div>

					</div>
					<!-- End div for flex -->

				</div>

				<div class="card-body">
					<p> <?= $message ?></p>
				</div>
				<div class="card-footer">
					<div class="d-flex">
						<div class="pl-1">
							<p><b>Date Created: </b><?= $res['datetime_stamp'] ?></p>
						</div>
						<div class="pl-1">
							<p><b>Date Updated: </b><?= $res['date_updated'] ?></p>
						</div>
					</div>
				</div>

			</div>
			<!-- End tag of Card -->
			<br>

			<!-- Modal -->
			<div class="modal fade" id="updateAnnModal<?= $ann_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Update Message</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- action="../includes/processannouncement.php" -->
						<div class="modal-body">
							<form id="updateAnnForm" method="post">
								<div class="form-group">
									<input type="text" name="upd_id" id="upd_id" value="<?= $ann_id ?>">
									<label for="recipient-name" class="col-form-label">Subject:</label>
									<input type="text" name="subject" id="subject" class="form-control" value="<?= $subject ?>">
								</div>
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Title:</label>
									<input type="text" name="title" id="title" class="form-control" value="<?= $title ?>">
								</div>
								<div class="form-group">
									<label for="message-text" class="col-form-label">Message:</label>
									<textarea class="form-control" name="message" id="message"><?= $message ?></textarea>
								</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" id="update" name="update">Update</button>
						</div>
						</form>
					</div>
				</div>
			</div>

			<!-- End of Modal -->
		<?php endforeach; ?>
	</div>
	<!-- End tag of col -->



</div>
<!-- End tag of container -->
<script>
	let updateAnnForm = document.getElementById('updateAnnForm');
	updateAnnForm.addEventListener('submit', updateAnnouncement);
	// let annform = document.getElementById('updateAnnForm');
	// UPDATE ANNOUNCEMENT

	function updateAnnouncement(e) {
		e.preventDefault();
		let id = document.getElementById('upd_id').value;
		console.log(id);
		let subject = document.getElementById('subject').value;
		let title = document.getElementById('title').value;
		let message = document.getElementById('message').value;
		let params = `upd_id=${id}&subject=${subject}&title=${title}&message=${message}`;

		const xhr = new XMLHttpRequest();
		xhr.open('POST', '../includes/processannouncement.php', true);
		xhr.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
		xhr.onload = function() {
			console.log(this.statusText);
			console.log(this.responseText);
		}

		xhr.send(params);
	}
</script>




<?php include 'footer.php'; ?>