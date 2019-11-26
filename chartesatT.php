<?php


include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';


?>



    <!-- Script for Charts  -->
    <script src="bootstrap4/scripts/googlechart.js"></script>

    

 <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(AgeChart);

                function AgeChart() {
                    let data = google.visualization.arrayToDataTable([
                        ['Age', 'No. of Teacher'],
                        <?php
                            $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = 17 AND school = 14") or die ($conn->error);
                            while ($AgeChart = $qry->fetch_assoc()):
                                echo "['".displayAgeDesc($conn,$AgeChart['age'])."', ".countDB($conn,17,14,'esat1_demographicst_tbl')."],";
                            endwhile;?>
                ]);
                    let options = {
                title: 'Age'};
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);}
</script>

                    <div id="piechart" style="width: 400px; height: 400px;"></div>

