<!DOCTYPE html>
<html lang="en-US">

<?php
include 'includes/conn.inc.php';
$qry = "SELECT * FROM tbl_rptwithesat ORDER BY `school_id`";
$result = mysqli_query($conn, $qry);

?>

<body>

    <h1>ESAT</h1>

    <div id="piechart"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Account Name', 'User Id'],

                // ['Eat', 2],
                // ['TV', 4],
                // ['Gym', 2],
                // ['Sleep', 8]

                <?php
                foreach ($result as $res) :
                    echo "['" . $res['school_id'] . "'," . $res['With_ESAT'] . "],";
                endforeach;
                ?>

                <?php  ?>

            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'ESAT Completion',
                'width': 550,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>



<!DOCTYPE html>
<html lang="en-US">

<?php
include 'includes/conn.inc.php';
$qry = "SELECT * FROM total_teachers_per_school ORDER BY `school_id`";
$result = mysqli_query($conn, $qry);

?>

<body>

    <h1>Total Teacher per School</h1>

    <div id="piechart1"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart1);

        // Draw the chart and set the chart values
        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Account Name', 'User Id'],

                // ['Eat', 2],
                // ['TV', 4],
                // ['Gym', 2],
                // ['Sleep', 8]

                <?php
                foreach ($result as $res) :
                    echo "['" . $res['school_id'] . "'," . $res['T'] . "],";
                endforeach;
                ?>

                <?php  ?>

            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Teacher Count',
                'width': 550,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>



<!DOCTYPE html>
<html lang="en-US">

<?php
include 'includes/conn.inc.php';
$qry = "SELECT * FROM total_teachers_per_school ORDER BY `school_id`";
$result = mysqli_query($conn, $qry);

?>

<body>

    <h1>Total Master Teacher per School</h1>

    <div id="piechart2"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart2);

        // Draw the chart and set the chart values
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Account Name', 'User Id'],

                // ['Eat', 2],
                // ['TV', 4],
                // ['Gym', 2],
                // ['Sleep', 8]

                <?php
                foreach ($result as $res) :
                    echo "['" . $res['school_id'] . "'," . $res['MT'] . "],";
                endforeach;
                ?>

                <?php  ?>

            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Master Teacher Count',
                'width': 550,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>