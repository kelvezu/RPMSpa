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

    <!-- JavaScript Syntax -->
    <script>
        // This will load the functions after the web finished loading
        window.addEventListener('DOMContentLoaded', (event) => {
            // let exec_time = setInterval(() => {
            //     fetchAnnouncement();
            // }, 3000);

            // setInterval(() => {
            //     clearInterval(exec_time);
            // }, 60000);
        });
        // Variable Declaration


        const annBtnShow = document.getElementById('ann-btnshow');
        const annBtnPost = document.getElementById('ann-btnpost');
        const showTcountBtn = document.getElementById('show-tcount-btn');
        const fetch_announce = document.getElementById('fetch-announcement');
        const announcement_form = document.getElementById('add_announcement_form');
        const teacherTable = document.getElementById('teacher_count_table');
        const teacherChart = document.getElementById('teacher_count_chart');
        const showNotif = document.getElementById('show-notif');


        announcement_form.addEventListener('submit', postAnn);
        showTcountBtn.addEventListener('click', showTeacherCount);
        annBtnShow.click(fetchAnnouncement());
        teacherTable.style.display = "none";
        teacherChart.style.display = "block";
        showNotif.style.display = "none";

        // Toggle function for Teacher Count Table and Chart
        function showTeacherCount() {
            if (teacherTable.style.display === "none") {
                teacherChart.style.display = "none";
                teacherTable.style.display = "block";
                showTcountBtn.value = "Show Table"
            } else {
                teacherTable.style.display = "none";
                teacherChart.style.display = "block";
                showTcountBtn.value = "Show Chart"
            }
        }


        /* Chart for Teacher Count Chart */
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


                title: 'Live Count of Teachers and Master Teachers',
                chartArea: {
                    width: '45%'
                },
                hAxis: {
                    title: 'Total of Master Teachers and Teachers: <?= $totalCount ?>',
                    minValue: 1,
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
                    // title: 'School',
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
        // ADD NEW ANNOUNCEMENT THRU AJAX 
        function postAnn(e) {
            e.preventDefault();
            let user_id = document.getElementById('user_id').value;
            let sy = document.getElementById('sy').value;
            let position = document.getElementById('position').value;
            let school = document.getElementById('school').value;
            let subject = document.getElementById('subject').value;
            let title = document.getElementById('title').value;
            let message = document.getElementById('message').value;

            let params = `user_id=${user_id}&sy=${sy}&position=${position}&school=${school}&subject=${subject}&title=${title}&message=${message}`;


            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/processannouncement.php', true);
            console.log(xhr.statusText);
            xhr.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');

            xhr.onload = function() {}
            try {
                xhr.send(params);
                showNotif.style.display = "block";
                showNotif.innerHTML = "New Announcement has been added!";
                setInterval(function() {
                    showNotif.style.display = "none"
                }, 3000);
                document.getElementById('subject').value = '';
                document.getElementById('title').value = '';
                document.getElementById('message').value = '';
            } catch (error) {
                console.log(error)
            }

            setInt = setInterval(fetchAnnouncement(), 1000);
            clearInterval(setInt);

        }

        function fetchAnnouncement() {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'ajax/announcement_ajax.php');
            xhr.onload = function() {
                console.log('Fetch_Ann_status: ' + this.statusText);
                let results = this.responseText;
                if (results) {
                    setTimeout(document.getElementById('fetch-announcement').innerHTML = results, 1000);
                } else {
                    document.getElementById('fetch-announcement').innerHTML = 'No Result';
                }
            }
            xhr.send();
        }

        function toggleTeacherCount() {

        }
    </script>

    <!-- Scripts  -->
    <script src="includes/func.lib.js"></script>
    <script src="ajax/updateAnnouncement_ajax.php"></script>
    <script src="bootstrap4/scripts/jquery.min.js"></script>
    <script src="bootstrap4/scripts/bootstrap.min.js"></script>
    <script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
    <script src="bootstrap4/scripts/popper.min.js"></script>

    <!-- End of Scripts -->


</footer>

</html>