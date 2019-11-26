
<?php

include 'includes/conn.inc.php';
include 'libraries/func.lib.php';

 
if(isset($_GET['sy']) AND isset($_GET['sch'])  ):
    $sy = $_GET['sy'];
    $school = $_GET['sch'];
    $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
    
endif;

?>

<div class="card text-center">
     <!-- Age Chart -->
 
        <div class="card-header bg-success">
            <div class=" text-center h4 text-white">Age</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <th>Age</th>
                            <th>No. of Teacher</th>
                        </thead>
                        <tbody>
                            <?php while ($esatresult = $qry->fetch_assoc()):?>
                            <td><?php echo displayAgeDesc($conn,$esatresult['age']); ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Age Chart -->

   <!-- Gender Chart -->
   <div class="card-header bg-success">
            <div class=" text-center h4 text-white">Gender</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                            <thead>
                                <th>Gender</th>
                                <th>No. of Teacher</th>
                            </thead>
                            <tbody>
                                <?php 
                                  $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                                while ($esatresult = $qry->fetch_assoc()):?>
                                <td><?php echo displaygenderDesc($conn,$esatresult['gender']); ?></td>
                                <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
  <!-- End of Gender Chart -->
   
<!-- Employment Status Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Employment Status</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <th>Employment Status</th>
                            <th>No. of Teacher</th>
                        </thead>
                        <tbody>
                            <?php 
                                $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <td><?php echo $esatresult['employment_status']; ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Employment Status Chart -->

<!-- Position Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Position</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <th>Position</th>
                            <th>No. of Teacher</th>
                        </thead>
                        <tbody>
                            <?php 
                                $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <td><?php echo $esatresult['position']; ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Position Chart -->

<!-- Highest Degree Obtained Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Highest Degree Obtained</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <th>Highest Degree Obtained</th>
                            <th>No. of Teacher</th>
                        </thead>
                        <tbody>
                            <?php 
                                $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <td><?php echo $esatresult['highest_degree']; ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Highest Degree Obtained Chart -->

  <!-- Total Number of Years in Teaching Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Total Number of Years in Teaching</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <th>Total Number of Years in Teaching</th>
                            <th>No. of Teacher</th>
                        </thead>
                        <tbody>
                            <?php 
                                $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                            while ($esatresult = $qry->fetch_assoc()):?>
                            <td><?php echo displayTotalyear($conn,$esatresult['totalyear']); ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Total Number of Years in Teaching Chart -->

  <!-- Subject Taught Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Subject Taught</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                                <th>Subject Taught</th>
                                <th>No. of Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php 
                                $qry = $conn->query("SELECT subject_tbl.subject_name, COUNT(esat1_demographicst_tbl.user_id)total, esat1_demographicst_tbl.* FROM esat1_demographicst_tbl INNER JOIN subject_tbl ON esat1_demographicst_tbl.subject_taught LIKE CONCAT('%', subject_tbl.subject_name, '%') WHERE sy='$sy' AND school = '$school' GROUP BY subject_tbl.subject_name ");
                               
                            foreach($qry as $row):

                            ?>  
                            <tr>
                            <td><?php echo $row['subject_name']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <?php endforeach;?>

                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Subject Taught Chart -->

  <!-- Grade Level Taught Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Grade Level Taught</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                                <th>Grade Level Taught</th>
                                <th>No. of Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php 
                               $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                               while ($esatresult = $qry->fetch_assoc()):?>
                            <tr>
                            <td><?php echo displayGradelvltaught($conn,$esatresult['grade_lvl_taught']); ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Grade Level Taught Chart -->


   <!-- Curricular Class of School Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Curricular Class of School</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                                <th>Curricular Class</th>
                                <th>No. of Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php 
                               $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                               while ($esatresult = $qry->fetch_assoc()):?>
                            <tr>
                            <td><?php echo displaycurri($conn,$esatresult['curri_class']); ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- End of Curricular Class of School Chart -->

  <!-- Region Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">Region</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm">
                        <thead>
                            <tr>
                                <th>Region</th>
                                <th>No. of Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php 
                               $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");
                               while ($esatresult = $qry->fetch_assoc()):?>
                            <tr>
                            <td><?php echo displayregion($conn,$esatresult['region']); ?></td>
                            <td><?php echo countDB($conn,$sy,$school,'esat1_demographicst_tbl'); ?></td>
                            <?php endwhile;?>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!--Region -->

 <!-- SELF ASSESSMENT OF TEACHER I-III Chart -->
 <div class="card-header bg-success">
            <div class=" text-center h4 text-white">SELF ASSESSMENT OF TEACHER I-III</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <table class="table table-bordered hover table-sm text-nowrap">
                    <thead>
                        <tr>
                        <td></td>
                            <td colspan="4"><strong>LEVEL OF CAPABILITY</strong></td>
                            <td colspan="4"><strong>LEVEL OF PRIORITY</strong></td>
                        </tr>
                        <tr>
                            <th width="auto">OBJECTIVES</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto">VERY HIGH</th>
							<th width="auto">LOW</th>
							<th width="auto">MODERATE</th>
							<th width="auto">HIGH</th>
							<th width="auto	">VERY HIGH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $qry = $conn->query("SELECT CONCAT(tobj_tbl.kra_id,'.',tobj_tbl.tobj_id) 
                            AS OBJECTIVES, 
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 1 then count(DISTINCT user_id) END AS L_LOW,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 2 then count(DISTINCT user_id) END AS L_MODERATE,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 3 then count(DISTINCT user_id) END AS L_HIGH,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 4 then count(DISTINCT user_id) END AS L_VERY_HIGH,
                            
                            CASE WHEN esat2_objectivest_tbl.priodev = 1 then count(DISTINCT user_id) END AS P_LOW,
                            CASE WHEN esat2_objectivest_tbl.priodev = 2 then count(DISTINCT user_id) END AS P_MODERATE,
                            CASE WHEN esat2_objectivest_tbl.priodev = 3 then count(DISTINCT user_id) END AS P_HIGH,
                            CASE WHEN esat2_objectivest_tbl.priodev = 4 then count(DISTINCT user_id) END AS P_VERY_HIGH
                           
                            from tobj_tbl INNER JOIN esat2_objectivest_tbl ON tobj_tbl.tobj_id = esat2_objectivest_tbl.tobj_id
                            
                        group by tobj_tbl.kra_id,tobj_tbl.tobj_id") or die ($conn->error.$qry);
                            foreach($qry as $result):
                        ?>
                        <tr>
                            <td><?php echo $result['OBJECTIVES']; ?></td>
                            <td><?php echo $result['L_LOW']; ?></td>
                            <td><?php echo $result['L_MODERATE']; ?></td>
                            <td><?php echo $result['L_HIGH']; ?></td>
                            <td><?php echo $result['L_VERY_HIGH']; ?></td>
                            <td><?php echo $result['P_LOW']; ?></td>
                            <td><?php echo $result['P_MODERATE']; ?></td>
                            <td><?php echo $result['P_HIGH']; ?></td>
                            <td><?php echo $result['P_VERY_HIGH']; ?></td>
                        </tr>
                            <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!-- SELF ASSESSMENT OF TEACHER I-III -->

   <!-- CORE BEHAVIORAL COMPETENCIES Chart -->
<div class="card-header bg-success">
            <div class=" text-center h4 text-white">CORE BEHAVIORAL COMPETENCIES</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered hover table-sm text-nowrap">
                        <thead>
                            <tr>
                                <th width="auto">Core Behavioral Competencies</th>
                                <th width="auto">1-SCALE</th>
                                <th width="auto">2-SCALE</th>
                                <th width="auto">3-SCALE</th>
                                <th width="auto">4-SCALE</th>
                                <th width="auto">5-SCALE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $qry = $conn->query("SELECT core_behavioral_tbl.cbc_name, 
                                CASE WHEN(a.score)=1 THEN COUNT(a.user_id) end as score1,
                                CASE WHEN(a.score)=2 THEN COUNT(a.user_id) end as score2,
                                CASE WHEN(a.score)=3 THEN COUNT(a.user_id) end as score3,
                                CASE WHEN(a.score)=4 THEN COUNT(a.user_id) end as score4,
                                CASE WHEN(a.score)=5 THEN COUNT(a.user_id) end as score5
                                FROM
                                (
                                select cbc_id, user_id,sum(cbc_score)score from esat3_core_behavioralt_tbl GROUP BY cbc_id
                                ) a
                                INNER JOIN core_behavioral_tbl on a.cbc_id = core_behavioral_tbl.cbc_id
                                GROUP BY core_behavioral_tbl.cbc_name") or die ($conn->error.$qry);
                                foreach ($qry as $result):
                            ?>
                            <tr>
                                    <td><?php echo $result['cbc_name']; ?></td>
                                    <td><?php echo $result['score1']; ?></td>
                                    <td><?php echo $result['score2']; ?></td>
                                    <td><?php echo $result['score3']; ?></td>
                                    <td><?php echo $result['score4']; ?></td>
                                    <td><?php echo $result['score5']; ?></td>
                            </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                       
                </div>
            </div>
        </div> 
       
    
  <!--CORE BEHAVIORAL COMPETENCIES -->

<!-- End tag of card -->
</div>
