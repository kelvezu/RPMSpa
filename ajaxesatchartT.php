<?php
include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';
 
if(isset($_GET['sy']) AND isset($_GET['sch'])  ):
    $sy = $_GET['sy'];
    $school = $_GET['sch'];
    $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
    
endif;

?>

<div class="card text-center">
     <!-- Age Table -->
 
        <div class="card-header bg-success">
            <div class=" text-center h4 text-white">Age</div>
        </div>
        <div class="card-body">
            <div id="piechart" style="width: 400px; height: 400px;"></div>
                </div>
       
  <!-- End of Age Table -->
  </div>

  
