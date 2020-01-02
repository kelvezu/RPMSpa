<?php
include 'sampleheader.php';
RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']);
$verifyEsat = FilterUser\FilterUser::filterEsatCbc($conn, $_SESSION['position']);

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
//QUERY FOR CORE BEHAVIORAL COMPETENCIES 
$result = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
$numcbc = 1;
$numind = 1;


$user_id = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];



?>



<?php

if(isset($_POST['submitESAT3'])):
     
?>


<?php showModal('myModal') ?>


<div id="myModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <?php

                    $cbc_id = $_POST['cbc_id'];
                    $cbc_ind_id = $_POST['cbc_ind_id'];
                    $cbc_score = $_POST['cbc_score'];
                    

                    $esat1_query = $conn->query("SELECT * FROM esat1_demographicst_tbl WHERE `user_id` = '$user_id' AND sy = '$sy' ");
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
                    <form action="includes/processESATsurvey.php" method="POST">
       
                        <input type="hidden" name="sy_id" value="<?php echo $sy ?>">
                        <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">
                        <input type="hidden" name="school_id" value="<?php echo $user_id; ?>">

                        <table class="table table-bordered table-sm">
                            <tr>
                                <th>Age</th>
                                <td><input type="text" name="age" value="<?php echo $age; ?>"></td>
                            </tr>
                            <tr>
                                <th>Sex</th>
                                <td><input type="text" name="gender" value="<?php echo $gender; ?>"></td>
                            </tr>
                            <tr>
                                <th>Employment Status</th>
                                <td><input type="text" name="emp_status" value="<?php echo $emp_status; ?>"></td>
                            </tr>
                             <tr>
                                <th>Position</th>
                                <td><input type="text" name="position" value="<?php echo $position; ?>"></td>
                            </tr>
                             <tr>
                                <th>Highest Degree Obtained</th>
                                <td><input type="text" name="highest_degree" value="<?php echo $highest_degree; ?>"></td>
                            </tr>
                            <tr>
                                <th>Course Degree Taken</th>
                                <td><input type="text" name="course" value="<?php echo $course; ?>"></td>
                            </tr>
                            <tr>
                                <th>Total Number of Years in Teaching</th>
                                <td><input type="text" name="totalyear" value="<?php echo $totalyear; ?>"></td>
                            </tr>
                            <tr>
                                <th>Area of Specialization</th>
                                <td><input type="text" name="area_spec[]" value="<?php echo $area_spec; ?>"></td>
                            </tr>
                            <tr>
                                <th>Subject Taught</th>
                                <td><input type="text" name="subj_taught[]" value="<?php echo $subject_taught; ?>"></td>
                            </tr>
                             <tr>
                                <th>Grade Level Taught</th>
                                <td><input type="text" name="grade_lvl" value="<?php echo $grade_lvl; ?>"></td>
                            </tr>
                            <tr>
                                <th>Curriculum Classification of the School</th>
                                <td><input type="text" name="curri_class" value="<?php echo $curri; ?>"></td>
                            </tr>   
                             <tr>
                                <th>Region</th>
                                <td><input type="text" name="region" value="<?php echo $region; ?>"></td>
                            </tr> 
                         </table>

                        <?php 
                        endwhile;

                        
                        ?> 
                       
      <table class="table table-borderless table-hover table-responsive-sm table-sm ">

       
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
                
                $indresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
                while ($rows = $indresult->fetch_assoc()) :
                    $tobj_id = $rows['tobj_id'];
                  ?>
                <td>
                  <?php
                     
                      echo '<strong>' . $tobj_num++ . ".</strong> " . $tobj_name = $rows['tobj_name'];
                      ?>
                </td>
                <?php
                $objective_Query = $conn->query("SELECT * FROM esat2_objectivest_tbl WHERE kra_id = '$kra_id' AND tobj_id = '$tobj_id' AND `user_id` = '$user_id' ");
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

                <input type="hidden" name="esat2_id[]" value="<?php echo $esat2_id;?>">
                <td>
                  <select name="lvlcap[]" id="lvlcapp" onChange="change_cap()" class="form-control font-weight-bold" required>
                    <option value="<?php echo $lvlcap ?>"><?php echo $lvlcap_desc ?></option>
                   
                  </select>
                </td>
                <td>
                  <div id="priodev">
                    <select name="priodev[]" class="form-control font-weight-bold" required>
                      <option value="<?php echo $priodev ?>"><?php echo $priodev_desc ?></option>
                      
                    </select>
                  </div>

                </td>
            </tr>

                <?php endwhile; ?>
           
                <?php endwhile; ?>
          </tbody>
          
        <?php
          $tobj_num = 1;
        endwhile
        ?>



                        
                        </table>
                      
                               <tfoot>
                                        <td colspan="10">
                                        <div class="d-flex justify-content-center">
                                            <?php if (empty($error_array)) : ?>
                                                <div class="p-2"><button name="submit" class="btn btn-success">Submit</button></div>
                                            <?php endif; ?>
                                            <div class="p-2"><button class="btn btn-danger" data-dismiss="modal">Cancel</button></div>
                                        </div>
                                        </td>
                                </tfoot>
                       
                    
                    </form>
                    </div>
            </div>
        </div>


<?php 
 
endif; ?>




<div class="container">

    <div class="card">
        <div class="card-header h4 text-center text-white bg-dark">
            Self Assessment Tool Form / Part III / Core Behavioral Competencies
        </div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />
                <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />

                <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  Core Behavioral Competencies -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB  
                    while ($row = $result->fetch_assoc()) :
                        $cbc_id = $row['cbc_id'];
                        $cbc_name = $row['cbc_name'];
                        ?>
                        <thead class="bg-dark text-white">
                            <tr>
                                <!-- ASSIGN THE VALUE FROM THE DB  -->
                                <th colspan='3'> <?php echo $numcbc++ . '. ' . $row['cbc_name'] ?></th>
                                </th>
                            </tr>
                        </thead>


                        <tbody class="text-dark">
                            <tr>
                                <!-- START OF LOOP FROM CBC INDICATOR -->
                                <?php
                                    //QUERY FOR INDICATORS TABLE 
                                    $num = 1;
                                    $indresult = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_id = '$cbc_id'")  or die($conn->error);
                                    //FETCH THE DATA FROM INDICATOR TABLE
                                    while ($rows = $indresult->fetch_assoc()) :
                                        ?>
                                    <td>
                                        <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id']; ?>">
                                        <input type="hidden" name="cbc_id[]" value="<?php echo $cbc_id; ?>">
                                        <input type="hidden" name="cbc_ind_id[]" value="<?php echo $cbc_ind_id = $rows['cbc_ind_id'] ?>">
                                        <!-- ASSIGN THE VALUE FROM THE DB  -->
                                        <select name="cbc_score[]" id="cbcselect<?php echo $num; ?>" class=" text-center font-weight-bold form-control-sm " maxlength="1" onchange="selectcbc<?php echo $num; ?>()">
                                            <option value="0">--select--</option>
                                            <option value="1">
                                                <p class="text-center"><strong>✓</strong></p>
                                            </option>
                                        </select>
                                        <input type="text" id="selectedcbc<?php echo $num; ?>">
                                    </td>

                                     <script>

                                        function selectcbc<?php echo $num; ?>(){
                                            var cbc = document.getElementById("cbcselect<?php echo $num ?>");
                                            var selected = cbc.options[cbc.selectedIndex].text;
                                            document.getElementById("selectedcbc<?php echo $num; ?>").value = selected;

                                        }
                                    </script>
                                    <td>
                                        <strong> <?php echo $numind++ ?></strong> <?php echo $indicator = $rows['indicator'] ?>
                                    </td>
                            </tr>
                            <!-- END LOOP FOR THE CBC INDICATORS -->
                        <?php $num++; endwhile ?>




                        </tbody>
                        <!-- END LOOP FOR THE CORE BEHAVIORAL COMPETENCIES -->
                    <?php
                        $numind = 1;
                    endwhile


                    ?>

                </table>
                <div class="card-footer text-muted ">
                    <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success" name="submitESAT3">Submit</button>
                    <button type="submit" class="btn btn-danger" name="cancel">Cancel</button>
                </div>
            </form>
        </div>

    </div>
    <!--End tag of container -->

</div>








<br>
<?php

include 'includes/scripts.php';
include 'samplefooter.php';
?>