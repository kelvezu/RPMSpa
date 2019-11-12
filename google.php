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
                'title': 'My Average Day',
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