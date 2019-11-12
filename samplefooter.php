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
                <div class="p-2 bd-highlight"> <small><b>SY:</b> <?= $_SESSION['active_sy'] ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>Start of Class:</b> <?= displayDate($_SESSION['start_date']) ?? "N/A" ?></small></div>
                <div class="p-2 bd-highlight"><small><b>End of Class:</b> <?= displayDate($_SESSION['end_date']) ?? "N/A" ?></small></div>
            </div>
        </div>
        <div class="p-1">

        </div>
        <div class="p-1">
            <small>Copyright &#169; <?= date('Y') ?> All rights reserved. Team Guerra.</small>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Sample Chart for DbAdmin -->
    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAxisTickColors);

        function drawAxisTickColors() {
            var data = google.visualization.arrayToDataTable([
                ['School', 'Teacher', 'Master Teacher'],
                // ['New York City, NY', 8175000, 8008000],
                // ['Los Angeles, CA', 3792000, 3694000],
                // ['Chicago, IL', 2695000, 2896000],
                // ['Houston, TX', 2099000, 1953000],
                // ['Philadelphia, PA', 1526000, 1517000]
                <?php
                // GET THE DATA FROM dbadmin.php
                foreach ($t_total as $total) :
                    $data = "['" . displaySchool($conn, $total['school_id']) . " '," . $total['T'] . "," . $total['MT'] . "],";
                    echo ($data);
                endforeach;
                ?>
            ]);

            var options = {
                title: 'List of Teachers and Master Teachers',
                chartArea: {
                    width: '60%'
                },
                hAxis: {
                    title: 'Total of Master Teachers and Teachers: <?= $totalCount ?>',
                    minValue: 0,
                    maxValue: <?= $totalCount / 2 ?>,
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
                },
                vAxis: {
                    title: 'School',
                    textStyle: {
                        fontSize: 12,
                        bold: true,
                        color: '#848484'
                    },
                    titleTextStyle: {
                        fontSize: 14,
                        bold: false,
                        color: '#848484'
                    }
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <!-- End of Sample Chart for Admin -->
    <script src="includes/func.lib.js"></script>
    <script src="ajax/updateAnnouncement_ajax.php"></script>
    <script src="bootstrap4/scripts/jquery.min.js"></script>
    <script src="bootstrap4/scripts/bootstrap.min.js"></script>
    <script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
    <script src="bootstrap4/scripts/popper.min.js"></script>
</footer>

</html>