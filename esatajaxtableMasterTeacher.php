<?php
include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';

if(empty($_GET['sy'])):
        $sy = $_GET['activesy'];    
        $teacher = $_GET['user'];
        $school = $_GET['sch'];

    if(($_GET['activesy']) == 'N/A'):
        echo '<div class="red-notif-border">No record! Please select school year!</div>';
        include 'samplefooter.php';
        exit();
    endif;
?>

<div class="card text-center">
     <!-- Age Table -->
 
        <div class="card-header bg-info">
            <div class=" text-center h4 text-white">Core Behavioral Competencies Rating</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                            <th>CBC Name</th>
                            <th>CBC Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $qry = $conn->query("SELECT a.cbc_name,sum(b.cbc_score) AS cbc_score FROM core_behavioral_tbl a 
                            INNER JOIN esat3_core_behavioralmt_tbl b  on a.cbc_id = b.cbc_id WHERE b.user_id = $teacher AND sy = $sy group by a.cbc_name order by a.cbc_id");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <tr>
                            <td><?php echo $esatresult['cbc_name']; ?></td>
                            <td><?php echo $esatresult['cbc_score']; ?></td>
                            <?php endwhile;?>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
       
  <!-- End of Age Table -->

   <!-- Gender Table -->
   <div class="card-header bg-info">
            <div class=" text-center h4 text-white">Assessment of Capabilities and Priorities</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    
                    <table class="table table-bordered hover table-sm">
                            <thead>
                                <tr>
                                <th>Objectives</th>
                                <th>Level of Capabilities</th>
                                <th>Level of Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  $qry = $conn->query("SELECT CONCAT(a.kra_id,'.',a.mtobj_id) as Objectives, lvlcap, priodev 
                                  FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id WHERE a.user_id = $teacher AND sy = $sy group by a.mtobj_id,b.mtobj_name");
                                while ($esatresult = $qry->fetch_assoc()):?>
                                <tr>
                                <td><?php echo $esatresult['Objectives']; ?></td>
                                <td><?php echo $esatresult['lvlcap']; ?></td>
                                <td><?php echo $esatresult['priodev']; ?></td>
                                <?php endwhile;?>
                                </tr>
                                
                            </tbody>
                          
                        </table>
                </div>
            </div>
        </div> 
       
  <!-- End of Gender Table -->




<!-- End tag of card -->
</div>

<?php
    else:
        $sy_id = $_GET['sy'];
        $teacher = $_GET['user'];
        $school = $_GET['sch'];

?>


<div class="card text-center">
     <!-- Age Table -->
 
        <div class="card-header bg-info">
            <div class=" text-center h4 text-white">Core Behavioral Competencies Rating</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                            <th>CBC Name</th>
                            <th>CBC Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $qry = $conn->query("SELECT a.cbc_name,sum(b.cbc_score) AS cbc_score FROM core_behavioral_tbl a 
                            INNER JOIN esat3_core_behavioralmt_tbl b  on a.cbc_id = b.cbc_id WHERE b.user_id = $teacher AND sy = $sy_id group by a.cbc_name order by a.cbc_id");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <tr>
                            <td><?php echo $esatresult['cbc_name']; ?></td>
                            <td><?php echo $esatresult['cbc_score']; ?></td>
                            <?php endwhile;?>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
       
  <!-- End of Age Table -->

   <!-- Gender Table -->
   <div class="card-header bg-info">
            <div class=" text-center h4 text-white">Assessment of Capabilities and Priorities</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    
                    <table class="table table-bordered hover table-sm">
                            <thead>
                                <tr>
                                <th>Objectives</th>
                                <th>Level of Capabilities</th>
                                <th>Level of Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  $qry = $conn->query("SELECT CONCAT(a.kra_id,'.',a.mtobj_id) as Objectives, lvlcap, priodev 
                                  FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id WHERE a.user_id = $teacher AND sy = $sy_id group by a.mtobj_id,b.mtobj_name");
                                while ($esatresult = $qry->fetch_assoc()):?>
                                <tr>
                                <td><?php echo $esatresult['Objectives']; ?></td>
                                <td><?php echo $esatresult['lvlcap']; ?></td>
                                <td><?php echo $esatresult['priodev']; ?></td>
                                <?php endwhile;?>
                                </tr>
                                
                            </tbody>
                          
                        </table>
                </div>
            </div>
        </div> 

<?php
    endif;
?>

