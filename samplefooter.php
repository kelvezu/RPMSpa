</body>
<!-- Logout Modal -->
<div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Logout Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="tomato-color" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to logout?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="includes/logout.inc.php" class="btn btn-sm btn-danger text-decoration-none">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Logout -->
<!-- Add Announcement Modal  -->
<div class="modal fade" id="AddAnnouncement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="show-notif" class="green-notif-border"></p>
                <form method="post" id="add_announcement_form">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['user_id'] ?>" />
                    <input type="hidden" id="sy" value="<?= $_SESSION['active_sy_id'] ?>" />
                    <input type="hidden" id="position" value="<?= $_SESSION['position'] ?>" />
                    <input type="hidden" id="school" value="<?= $_SESSION['school_id'] ?>" />
                    <div class="form-group-sm">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject">
                    </div>
                    <div class="form-group-sm">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group-sm">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="ann-btnpost" name="submit" class="btn btn-primary">Post Announcement</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Add Announcement Modal -->

<!-- Update Announcement Modal -->
<div class="modal fade" id="updateAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p id="show-notif" class="green-notif-border"></p>
                <form method="post" id="update_announcement_form">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['user_id'] ?>" />
                    <input type="hidden" id="sy" value="<?= $_SESSION['active_sy_id'] ?>" />
                    <input type="hidden" id="position" value="<?= $_SESSION['position'] ?>" />
                    <input type="hidden" id="school" value="<?= $_SESSION['school_id'] ?>" />
                    <div class="form-group-sm">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" id="update-subject">
                    </div>
                    <div class="form-group-sm">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="update-title">
                    </div>
                    <div class="form-group-sm">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="update-message"></textarea>
                    </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
           </form>
      </div>
    </div>
  </div>
</div>

<!-- End of Update Announcement Modal -->


<footer class="fixed-bottom bg-dark text-white">
    <div class="d-flex justify-content-between">

        <div class="p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="p-2 bd-highlight"> <small><b>SY:</b> <?= $_SESSION['active_sy'] ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>Start of Class:</b> <?= displayDate($_SESSION['start_date']) ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>End of Class:</b> <?= displayDate($_SESSION['end_date']) ?? "N/A" ?></small></div>
            </div>
        </div>
        <div class="p-1">

        </div>
        <div class="p-1">
            <small>Copyright &#169; 2019 All rights reserved. Team Guerra.</small>
        </div>
    </div>
    <script src="includes/func.lib.js"></script>
    <script src="bootstrap4/scripts/jquery.min.js"></script>
    <script src="bootstrap4/scripts/bootstrap.min.js"></script>
    <script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
    <script src="bootstrap4/scripts/popper.min.js"></script>
</footer>

</html>