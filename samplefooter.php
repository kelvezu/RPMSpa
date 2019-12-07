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




<footer class="fixed-bottom bg-dark text-white">
    <div class="d-flex justify-content-between">

        <div class="p-1">
            <div class="d-flex flex-row bd-highlight">
                <div class="p-2 bd-highlight"> <small><b>SY:</b> <?php echo $_SESSION['active_sy'] ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>Start of Class:</b> <?php echo displayDate($_SESSION['start_date']) ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>End of Class:</b> <?php echo displayDate($_SESSION['end_date']) ?? "N/A" ?></small></div>
            </div>
        </div>
        <div class="p-1">

        </div>
        <div class="p-1">
            <small>Copyright &#169; <?= date('Y') ?> All rights reserved. Team Guerra.</small>
        </div>
    </div>

    <!-- JavaScript Syntax -->
    <script>
        // Toggle function for Teacher Count Table and Chart


        /* Chart for Teacher Count Chart */
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAxisTickColors);

        function drawAxisTickColors() {
            var data = google.visualization.arrayToDataTable([
                ['School', 'Teacher', 'Master Teacher'],
                <?php
                // GET THE DATA FROM dbadmin.php
                foreach ($t_total as $total) :
                    $data = "['" . displaySchool($conn, $total['school_id']) . " '," . $total['T'] . "," . $total['MT'] . "],";
                    echo ($data);
                endforeach;
                ?>
            ]);

            var options = {


                title: 'Live Count of Teachers and Master Teachers',
                chartArea: {
                    width: '45%'
                },
                hAxis: {
                    title: 'Total of Master Teachers and Teachers: <?= $totalCount ?>',
                    minValue: 1,
                    maxValue: <?php echo intval($totalCount / 2) ?>,
                    textStyle: {
                        bold: false,
                        fontSize: 10,
                        color: '#4d4d4d'
                    },
                    titleTextStyle: {
                        bold: true,
                        fontSize: 12,
                        color: '#4d4d4d'
                    }
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('teacher_chart'));
            chart.draw(data, options);
        }
        //  End of Sample Chart for Admin






        // Functions

        function sendNotif() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'includes/login.inc.php', true);
            xhr.onload = function() {};
        }


        function toggleTeacherCount() {

        }
    </script>

    <!-- Scripts  -->
    <script src="includes/func.lib.js"></script>
    <script src="ajax/updateAnnouncement_ajax.php"></script>
    <script src="bootstrap4/scripts/jquery.min.js"></script>
    <script src="bootstrap4/scripts/bootstrap.min.js"></script>
    <!-- <script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script> -->
    <script src="bootstrap4/scripts/popper.min.js"></script>

    <!-- End of Scripts -->

    <!-- <script src="js/charts/jquery.highchartTable.js"></script>
    <script src="js/charts/highcharts.js"></script>
    <script src="js/charts/jquery-ui.js"></script> -->

    <?php
    include 'includes/conn.inc.php';
    if (isset($_SESSION['active_sy_id'])) :
        rpmsdb\rpmsdb::generateCOTindicatorAVG($conn, $_SESSION['active_sy_id']);
    endif;
    ?>
</footer>

</html>