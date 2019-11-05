<title>Charts</title>
<?php
    include_once 'conn.inc.php'; 
    $query = "SELECT school_name, (With_ESAT/total_teacher) as x from tbl_rptwithesat group by school_name";
    $result = mysqli_query($conn,$query)
    
    
?>

           
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script>  
            google.charts.load('current', {'packages':['corechart']});  
            google.charts.setOnLoadCallback(drawChart);  
            function drawChart()  
            {  
                var data = google.visualization.arrayToDataTable([  
                            ['school_name', 'esat'],  
                            <?php  
                            while($row = mysqli_fetch_array($result))  
                            {  
                                echo "['".$row["school_name"]."', ".$row["x"]."],";  
                            }  
                            ?>  
                        ]);  
                var options = {  

                        //is3D:true,  
                        pieHole: 0.4  
                        };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
            }  
</script>    
<body>
           <div id="piechart"></div>  
           
</body>
