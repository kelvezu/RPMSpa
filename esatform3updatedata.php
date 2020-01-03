<?php

include 'sampleheader.php';


$result = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
$numcbc = 1;
$numind = 1;
?>



<div class="container">

    <div class="card">
        <div class="card-header h4 text-center text-white bg-dark">
            Self Assessment Tool Form / Part III / Core Behavioral Competencies
        </div>
        <div class="card-body">
            <form method="POST" action="includes/processESATsurvey.php">
       
               
                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />
                <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />

                <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  Core Behavioral Competencies -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB 
                    $num = 1; 
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
                                    
                                    $indresult = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_id = '$cbc_id'")  or die($conn->error);
                                    //FETCH THE DATA FROM INDICATOR TABLE
                                    while ($rows = $indresult->fetch_assoc()) :
                                        $cbc_indi = $rows['cbc_ind_id'];
                                        ?>
                                    <td>
                                        
                                        <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id']; ?>">
                                        <input type="hidden" name="cbc_id[]" value="<?php echo $cbc_id; ?>">
                                        <input type="hidden" name="cbc_ind_id[]" value="<?php echo $cbc_indi; ?>">
                                        <!-- ASSIGN THE VALUE FROM THE DB  -->
                                        <select name="cbc_score[]" id="cbcselect<?php echo $num; ?>" class=" text-center font-weight-bold form-control-sm " maxlength="1" onchange="selectcbc<?php echo $num; ?>()">
                                            <?php 

                                            $position = $_SESSION['position'];

                                            if(($position == "Teacher I") || ($position == "Teacher II") || ($position == "Teacher III")):
                                                $cbc_qry = $conn->query("SELECT * FROM esat3_core_behavioralt_tbl WHERE cbc_id = '$cbc_id' AND cbc_ind_id = '$cbc_indi'");
                                            elseif(($position == "Master Teacher I") || ($position == "Master Teacher II") || ($position == "Master Teacher III") || ($position == "Master Teacher IV") ):
                                                $cbc_qry = $conn->query("SELECT * FROM esat3_core_behavioralmt_tbl WHERE cbc_id = '$cbc_id' AND cbc_ind_id = '$cbc_indi'");
                                            endif; 

                                                
                                                    while($cbc = $cbc_qry->fetch_assoc()):
                                                        $score = $cbc['cbc_score'];
                                                        $esat3_id =$cbc['esat3_id'];
                                                    if($score == 0):
                                                        $score_result = "";
                                                    elseif($score == 1):
                                                        $score_result = "✓";
                                                    endif;
                                            ?>
                                            <option value="<?php echo $score;?>"><?php echo $score_result;?></option>
                                            <option value="0"><?php echo " "; ?></option>
                                            <option value="1">
                                                <p class="text-center"><strong>✓</strong></p>
                                            </option>
                                        </select>
                                          <input type="hidden" name="esat3_id[]" value="<?php echo $esat3_id; ?>" />
                                                <?php endwhile; ?>
                                        <input type="hidden" id="selectedcbc<?php echo $num; ?>">
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
                        <?php
                        $num++;  
                        endwhile ?>
                        </tbody>
                        <!-- END LOOP FOR THE CORE BEHAVIORAL COMPETENCIES -->
                    <?php
                        $numind = 1;
                    endwhile;
              
                    ?>
                </table>
                <div class="card-footer">
                    <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success" name="updateESAT3">Submit</button>
                    <button type="submit" class="btn btn-danger" name="cancel">Cancel</button>
                </div>
            </form>
        </div>

    </div>
    <!--End tag of container -->

</div>




<?php

include 'samplefooter.php';

?>