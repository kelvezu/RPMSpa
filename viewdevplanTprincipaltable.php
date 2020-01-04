<?php

include 'classes/rpmsdb/rpmsdb.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';

$sy = $_GET['sy'];
$user = $_GET['user'];
$school = $_GET['sch'];

?>


<div class="container">
    <!-- action="submit_devplan_mt.php" -->
    <form method="post">
        <div class="card border-dark">
            <div class="card-header  bg-success text-white font-weight-bold">
                <h3>View Development Plan </h3>

            </div>
           

            <div class="card-body">
                <!-- A -->
                <div class="card mb-5">
                    <div class="card-header bg-dark text-white font-weight-bold">
                        <h5>A. Functional Competencies</h5>
                    </div>
                    <div class="body">
                        <div class="row p-2">
                            <div class="col form-group">
                             
                                <!-- STRENGTH -->
                                <ul>
                                    <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_a1_strength_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>           
                                        
                                        <p class="black-border"> <?php echo displayObjectiveT($conn, $str_obj['strengths_mtobj']); ?></p>
     
                                
                                    <?php endforeach; ?>
                                   
                                    <ul>
                            </div>

                            <div class="col form-group">
                                 <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_a2_devneeds_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>    
                                  
                                       <p class="black-border"> <?php echo displayObjectiveT($conn, $str_obj['devneeds_mtobj']); ?></p>
                                       
                                <?php endforeach; ?>
                               
                            </div>
                        </div>
                        <div class="bg-dark text-white">
                            <p class="p-2 font-weight-bold">Action Plan (Recommended Developmental Intervention )</p>
                        </div>

                        <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_a3_actionplan_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>    

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="a_learning_objectives">Learning Objectives</label>
                                <p class="black-border"><?php echo  $str_obj['a_learning_objectives'] ?></p>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="a_intervention">Intervention</label>
                                <p class="black-border"><?php echo  $str_obj['a_intervention'] ?></p>
                                
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="a_timeline">Timeline</label>
                                 <p class="black-border"><?php echo  $str_obj['a_timeline'] ?></p>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="a_resources_needed">Resources Needed</label>
                                 <p class="black-border"><?php echo  $str_obj['a_resources_needed'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF A -->
                                         <?php endforeach; ?>
                <!-- B -->
                <div class="card">
                    <div class="card-header bg-dark text-white font-weight-bold">
                        <h5>B. Core Behavioral Competencies</h5>
                    </div>
                    <div class="body">
                        <div class="row p-2">
                            <div class="col form-group">
                              
                                <!-- STRENGTH COMPETENCIES -->
                                <ul>
                                    <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_b1_strength_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>           
                                        
                                        <p class="black-border"> <?php echo displayObjectiveT($conn, $str_obj['strength_cbc_id']); ?></p>
     
                                
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="col form-group">
                               
                                <!-- DEVNEEDS -->
                                <ul>
                                    <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_b2_devneeds_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>           
                                        
                                        <p class="black-border"> <?php echo displayObjectiveT($conn, $str_obj['devneed_cbc_id']); ?></p>
     
                                
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-dark text-white">
                            <p class="p-2 font-weight-bold">Action Plan (Recommended Developmental Intervention )</p>
                        </div>

                         <?php 
                                    $strQry = $conn->query("SELECT * FROM devplant_b3_actionplan_tbl WHERE `user_id` = '$user' AND sy = '$sy' ");
                                         foreach ($strQry as $str_obj) :
                                             ?>    
                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="b_learning_objectives">Learning Objectives</label>
                                <p class="black-border"><?php echo  $str_obj['b_learning_objectives'] ?></p>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="b_intervention">Intervention</label>
                                <p class="black-border"><?php echo  $str_obj['b_intervention'] ?></p>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="b_timeline">Timeline</label>
                               <p class="black-border"><?php echo  $str_obj['b_timeline'] ?></p>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="b_resources_needed">Resources Needed</label>
                               <p class="black-border"><?php echo  $str_obj['b_resources_needed'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF B -->
                                         <?php endforeach; ?>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    
                    <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
                </div>

            </div>

        </div>
    </form>
</div>
