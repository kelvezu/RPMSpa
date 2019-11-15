      
    <head>  
        <title>Create Dynamic Column Chart using PHP Ajax with Google Charts</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
        <script type="text/javascript" src="includes/scripts.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(draw_complete_esat_chart);
        </script>
    </head>  
<body>
                
        <!-- <div class="container">  
            <div class="panel panel-default"> -->
                <div class="panel-heading">
                    <div class="row">
                        <div class="analytics-rounded-content">
                            
                            <h3 class="panel-title"><b>ESAT Progress</b></h3>
                        </div>
                        <div class="col-sm-9">
                        <select name="sy_esat" class="form-control" id="sy_esat">
                                <option value="">Select School Year</option>
                                <?php
                                    $result = RPMSDB\RPMSdb::esatSY($conn);
                                    foreach($result as $row)
                                        {
                                            echo '<option value="'.$row["sy_esat"].'">'.$row["sy_esat"].'</option>';
                                        }
                                ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="esat_chart"></div>
                </div>
            <!-- </div>
        </div> -->
</body>

