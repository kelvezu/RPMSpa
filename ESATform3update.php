<?php

include 'sampleheader.php';


$result = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
$numcbc = 1;
$numind = 1;
$user_id = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];


if(isset($_GET['notif'])):
    if($_GET['notif'] == 'show'):
        showModal('myModal');
    
endif;



?>



<div id="myModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
         
            <div class="container">
                <div class="card">
                    <div class="card-header text-center bg-dark">
                        <div class="tomato-color font-italic "><h5>Are you sure you want to submit the following details for your ESAT? Please be advised that you can no longer update your answers once confirmed.</h5></div>
                    </div>
                    <div class="card-body">
                        <small>
                    <?php
                    
                     if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                        $esat1_query = $conn->query("SELECT * FROM esat1_demographicst_tbl WHERE `user_id` = '$user_id' AND sy = '$sy' ") or die($conn->error);
                    elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV") ):
                        $esat1_query = $conn->query("SELECT * FROM esat1_demographicsmt_tbl WHERE `user_id` = '$user_id' AND sy = '$sy' ") or die($conn->error);
                    endif; 
            
                
                        while ($esat = $esat1_query->fetch_assoc()):
                            $age = $esat['age'];
                            $gender = $esat['gender'];
                            $emp_status = $esat['employment_status'];
                            $position = $esat['position'];
                            $highest_degree = $esat['highest_degree'];
                            $course = $esat['course_taken'];
                            $totalyear = $esat['totalyear'];
                            $area_spec = $esat['area_specialization'];
                            $subject_taught = $esat['subject_taught'];
                            $grade_lvl = $esat['grade_lvl_taught'];
                            $curri = $esat['curri_class'];
                            $region = $esat['region']; 
                ?>

                  
                        <input type="hidden" name="sy_id" value="<?php echo $sy ?>">
                        <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">
                        <input type="hidden" name="school_id" value="<?php echo $user_id; ?>">

                        <table class="table table-bordered table-sm">
                            <div class="bg-success text-white h4 text-center"> Self Assessment Tool Form / Part I / Demographic Profile</div>
                            <tr>
                                <th>Age</th>
                                <td><input type="text" name="age" value="<?php echo $age; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td><input type="text" name="gender" value="<?php echo $gender; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Employment Status</th>
                                <td><input type="text" name="emp_status" value="<?php echo $emp_status; ?>" class="form-control" readonly></td>
                            </tr>
                             <tr>
                                <th>Position</th>
                                <td><input type="text" name="position" value="<?php echo $position; ?>" class="form-control" readonly></td>
                            </tr>
                             <tr>
                                <th>Highest Degree Obtained</th>
                                <td><input type="text" name="highest_degree" value="<?php echo $highest_degree; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Course Degree Taken</th>
                                <td><input type="text" name="course" value="<?php echo $course; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Total Number of Years in Teaching</th>
                                <td><input type="text" name="totalyear" value="<?php echo displayTotalyear($conn,$totalyear); ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Area of Specialization</th>
                                <td><input type="text" name="area_spec[]" value="<?php echo $area_spec; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Subject Taught</th>
                                <td><input type="text" name="subj_taught[]" value="<?php echo $subject_taught; ?>" class="form-control" readonly></td>
                            </tr>
                             <tr>
                                <th>Grade Level Taught</th>
                                <td><input type="text" name="grade_lvl" value="<?php echo displayGradelvltaught($conn,$grade_lvl); ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th>Curriculum Classification of the School</th>
                                <td><input type="text" name="curri_class" value="<?php echo displaycurri($conn,$curri); ?>" class="form-control" readonly></td>
                            </tr>   
                             <tr>
                                <th>Region</th>
                                <td><input type="text" name="region" value="<?php echo displayregion($conn,$region); ?>" class="form-control" readonly></td>
                            </tr> 
                         </table>

                        <?php 
                        endwhile;

                        
                        ?> 
                       
      <table class="table table-borderless table-hover table-responsive-sm table-sm ">
         <div class="bg-success text-white h4 text-center"> Self Assessment Tool Form / Part II / Teacher / Objectives</div>
        <?php
        $kra_num = 0;
        $tobj_num = 1;
        $result = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error);
        while ($row = $result->fetch_assoc()) :
          $kra_id = $row['kra_id'];
          $kra_name = $row['kra_name'];
          $kra_num++;
          ?>
          <thead class="thead-dark text-nowrap">
        
            <th class="bg-dark"><?php echo "KRA " . $kra_num . ": " . $row['kra_name'] ?></th>
            <th class="bg-dark">Level of Capability</th>
            <th class="bg-dark">Priority for Development</th>
            </tr>
          </thead>
          <tbody class="text-dark">
            <tr>

              <?php

            if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                $indresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
            elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV") ):
                 $indresult = $conn->query("SELECT * FROM mtobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
            endif; 
                
             
                while ($rows = $indresult->fetch_assoc()) :
                   if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                        $obj = $rows['tobj_id'];
                        $obj_name = $rows['tobj_name'];
                    elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV")):
                        $obj = $rows['mtobj_id'];
                        $obj_name = $rows['mtobj_name'];
                    endif;

                  ?>
                <td><?php echo '<strong>' . $tobj_num++ . ".</strong> " . $obj_name; ?></td>
                <?php

                if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                    $objective_Query = $conn->query("SELECT * FROM esat2_objectivest_tbl WHERE kra_id = '$kra_id' AND tobj_id = '$obj' AND `user_id` = '$user_id' ") or die($conn->error);
                elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV") ):
                    $objective_Query = $conn->query("SELECT * FROM esat2_objectivesmt_tbl WHERE kra_id = '$kra_id' AND mtobj_id = '$obj' AND `user_id` = '$user_id' ") or die($conn->error);
                endif; 


                        while($res = $objective_Query->fetch_assoc()):
                            $lvlcap = $res['lvlcap'];
                            $priodev = $res['priodev'];
                            $esat2_id = $res['esat2_id'];
                    
                    if($lvlcap == 4):
                        $lvlcap_desc = "Very High";
                    elseif($lvlcap == 3):
                        $lvlcap_desc = "High";
                    elseif($lvlcap == 2):
                        $lvlcap_desc = "Moderate";
                    elseif($lvlcap == 1):
                        $lvlcap_desc = "Low";
                    endif;

                    if($priodev == 4):
                        $priodev_desc = "Very High";
                    elseif($priodev == 3):
                        $priodev_desc = "High";
                    elseif($priodev == 2):
                        $priodev_desc = "Moderate";
                    elseif($priodev == 1):
                        $priodev_desc = "Low";
                    endif;

                ?>

               
                <td>
                  <input type="hidden" name="lvlcap[]" value="<?php echo $lvlcap ?>">
                  <input type="text" value="<?php echo $lvlcap_desc ?>" class="form-control-sm" readonly >  
                </td>
                <td>
                    <input type="hidden" name="priodev[]" value="<?php echo $priodev ?>">
                    <input type="text" value="<?php echo $priodev_desc ?>" class="form-control-sm" readonly>
                    </select>
                  </div>
                </td>
            </tr>
                <?php endwhile; ?>
                <?php endwhile; ?>
          </tbody>
        <?php
          $tobj_num = 1;
                endwhile; ?>
        </table>
  <form method="POST" action="includes/processESATsurvey.php">
        <table class="table table-hover table-responsive-sm table-sm ">
              <div class="bg-success text-white h4 text-center">Self Assessment Tool Form / Part III / Core Behavioral Competencies</div>
            <?php
                $query = $conn->query("SELECT * FROM core_behavioral_tbl");
                    while($query_res = $query->fetch_assoc()):
                        $cbc_id = $query_res['cbc_id'];
            ?>
            <thead class="bg-dark text-white">
                <tr>
                   <th colspan='3'> <?php echo $numcbc++ . '. ' . displayCBCname($conn,$cbc_id); ?></th>
                </tr>
            </thead>
            <tbody class="text-dark">
                 <tr>
                      <?php
                      $num = 1;
                    $indresult = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_id = '$cbc_id'")  or die($conn->error);
                    while ($rows = $indresult->fetch_assoc()) :
                        $cbc_indi = $rows['cbc_ind_id'];
                ?>
                <td>
                    <?php 
                            if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                                 $cbc_qry = $conn->query("SELECT * FROM esat3_core_behavioralt_tbl WHERE cbc_id = '$cbc_id' AND cbc_ind_id = '$cbc_indi'");
                            elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV") ):
                                 $cbc_qry = $conn->query("SELECT * FROM esat3_core_behavioralmt_tbl WHERE cbc_id = '$cbc_id' AND cbc_ind_id = '$cbc_indi'");
                            endif; 
                       
                            while($cbc = $cbc_qry->fetch_assoc()):
                                $score = $cbc['cbc_score'];
                            
                            if($score == 0):
                                $score_result = "";
                            elseif($score == 1):
                                $score_result = "✓";
                            endif;
                    ?>
                    <input type="text" value="<?php echo $score_result;?>" class="form-control-sm" readonly>
                        <?php endwhile; ?>
                </td>
                <td>
                    <strong> <?php echo $numind++ ?></strong> <?php echo $indicator = $rows['indicator'] ?>
                </td>
                </tr>
                           
        <?php $num++;  endwhile; ?>
        </tbody>
    <?php $numind = 1;
    endwhile; ?>
</table>
</small>

                               <tfoot>
                                        <td colspan="10">
                                        <div class="d-flex justify-content-center">
                                                <div class="p-2"><button type="submit" name="submit" class="btn btn-success">Submit</button></div>
                                                <div class="p-2"><a href="esatform3updatedata.php" class="btn btn-danger">Cancel</a></div>
                                        </div>
                                        </td>
                                </tfoot>
                       
                    
                    </form>
                    </div>
            </div>
        </div>
                    </div>
                </div>
        
            

<?php endif; ?>




<br>
<?php

include 'includes/scripts.php';
include 'samplefooter.php';
?>