    <?php

    use DevPlan\DevPlan;
    use FilterUser\FilterUser;


    include_once 'sampleheader.php';
    devplan::checkDevPlanT($conn);
   $lvlcap_str =  displayLVLcapObjT($conn,$_SESSION['active_sy_id'],$_SESSION['school_id']);
   $priodev_devneeds = displayPrioDevObjT($conn,$_SESSION['active_sy_id'],$_SESSION['school_id']);
   $cbc_str =  displayCBCstrT($conn,$_SESSION['active_sy_id'],$_SESSION['school_id']);
   $cbc_devneeds =  displayCBCdevneedt($conn,$_SESSION['active_sy_id'],$_SESSION['school_id']);
    FilterUser::filterDevplanTUsers($_SESSION['position']);

    // A.CHECK IF USER DID NOT TAKEN ESAT
    $userESATstats =  isTakenEsat($conn, $_SESSION['position'], $_SESSION['user_id']);
    //A.1 DISPLAY ERRORS IF THE USER DID NOT TAKE ESAT 
    if ($userESATstats) :
        echo  '<ul class="red-notif-border">';
        foreach ($userESATstats as $esatStatNotif) :
            echo  $esatStatNotif;
        endforeach;
        echo '</ul>';

    //A.2 DISPLAY THE DEVPLAN IF USER HAS TAKEN ESAT
    else :
        /* THIS CONDITION WILL HIDE THE DEVELOPMENT PLAN IF USER ALREADY SUBMITTED  */
        $notifsss = (isSubmit($conn));
        if (!$notifsss) :
            ?>
            <main>
                <div class="container ">
                    <div class="breadcome-list shadow-reset">
                        <h2 class="text-center"><strong>PART IV: General Teacher Development Plan</strong></h2>
                        <div>
                            <div class="bg-black"><label for="a_strength" class="form-control-label">Select Rater and the Approving Authority: </label>
                            </div>
                            <form action="includes/processgendevplant.php" method="post" class="form-group">
                                <div>
                                    <div class="row black-border">
                                        <div class="col-sm-6">
                                            <label for="select-rater" class="form-control-label">Select Rater: </label>
                                            <select name="rater" id="" class="form-control " required>
                                                <?php
                                                        $raterformt = DevPlan::showAllAvailRaterforT($conn);
                                                        foreach ($raterformt as $res) :
                                                            ?>
                                                    <option value="<?= $res['user_id'] ?>"><?= fullnameFormat($res['firstname'], $res['middlename'], $res['surname']) . ' - ' . $res['position'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="select-app-auth" class="form-control-label">Select Approving Authority: </label>

                                            <select name="app_auth" id="" class="form-control" required>
                                            <?php
                                               
                                               $app_auth = $conn->query('SELECT * FROM account_tbl WHERE school_id = '.$_SESSION['school_id'].' AND `status` = "Active" AND position IN ("Superintendent","Assistant Superintendent","Principal","School Head","Principal Assistant" )') or die ($conn->error);
                                                   while ($sup = $app_auth->fetch_assoc()): ?>
                                                    <option value="<?php echo $sup['user_id'] ?>"><?php echo displayName($conn,$sup['user_id']) . ' - ' . $sup['position'] ?></option>
                                               
                                           
                                            <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6"></div>
                                    </div>
                                </div>
                                <hr>

                                <input type="hidden" name="sy" value=<?php echo $_SESSION['active_sy_id']; ?> />
                                <input type="hidden" name="school_id" value=<?php echo $_SESSION['school_id']; ?> />
                                <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />
                                <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id'] ?> />
                                <!-- <input type="hidden" name="rater" value="<?php //echo $_SESSION['rater'] 
                                                                                        ?>" /> -->
                                <input type="hidden" name="approving_authority" value="<?php echo $_SESSION['approving_authority'] ?>" />
                                <div id="A">
                                    <fieldset>
                                        <div class="bg-black">
                                            <label><strong>A. Functional Competencies</strong></label>
                                        </div>

                                        <!--A. Strengths -->
                                        <div class="black-border">
                                            <div class="bg-black">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2">
                                                        <label for="a_strength" class="form-control-label">Strengths</label>
                                                    </div>
                                                    <div class="p-2"></div>
                                                 </div>
                                            </div>
                                            <?php if($lvlcap_str):
                                                    foreach($lvlcap_str as $str):?>
                                            <p>
                                                <p class="tomato-color">
                                                    <?php echo displayKRA($conn,$str['kra_id']) ?>
                                                </p>

                                                <p>
                                                <input type="hidden" name="lvlcapkra_id[]" value="<?php echo $str['kra_id'] ?>">
                                                <input type="checkbox" name="lvlcapobj_id[]" value="<?php echo $str['tobj_id'] ?>">
                                                    <?php echo displayObjectiveT($conn,$str['tobj_id']) ?>
                                                </p>
                                            </p>
                                         <?php endforeach;
                                         else: ?> 
                                         <p class="red-notif-border">
                                             No ESAT record yet!
                                         </p>

                                         <?php endif; ?>
                                     
                                                
                                        </div>

                                        <!-- A. Development Needs -->
                                        <div class="black-border">
                                            <div class="bg-black">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"><label for="a_strength" class="form-control-label">Development Needs</label></div>
                                                    <div class="p-2"><a href="gendevplanT.php?btn=editdev" class="btn btn-primary text-white">Edit</a></div>
                                                    </div>
                                            </div>
                                           
                                                <!-- ------------------------------- -->
                                                <?php if($priodev_devneeds):
                                                    foreach($priodev_devneeds as $dev_needs):?>
                                            <p>
                                                <p class="tomato-color">
                                                    <?php echo displayKRA($conn,$dev_needs['kra_id']) ?>
                                                </p>

                                                <p>
                                                <input type="hidden" name="priodevkra_id[]" value="<?php echo $dev_needs['kra_id'] ?>">
                                                <input type="checkbox" name="priodevmtobj_id[]" value="<?php echo $dev_needs['tobj_id'] ?>">
                                                    <?php echo displayObjectiveT($conn,$dev_needs['tobj_id']) ?>
                                                </p>
                                            </p>
                                         <?php endforeach; else:?>
                                            <p class="red-notif-border">
                                             No ESAT record yet!
                                         </p>
                                        
                                      <?php  endif; ?>
                                                <!-- ----------------------------------- -->
                                        </div>
                                        <!-- Action Plan -->
                                        <div class="black-border">
                                            <div class="bg-black">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"><label for="a_strength" class="form-control-label">Action Plan</label></div>
                                                    <div class="p-2"></div>
                                                    </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="a_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="a_intervention">Interventions:</label>
                                                    <textarea name="a_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline and Resources needed -->
                                        <div class="black-border">
                                            <div class="bg-black">
                                                <div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"><label for="a_strength" class="form-control-label">Timelines and Resources Needed</label></div>
                                                    <div class="p-2"></div>
                                                    </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="timelines">Timelines:</label>
                                                    <textarea name="a_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." class="form-control textarea"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="a_resources_needed" id="" cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- B. Compentencies -->

                                        <div class="bg-black">
                                            <label><strong>B. Core Behavioral Competencies</strong></label>
                                        </div>
                                        <div class="black-border">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="bg-black">
                                                    <div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"><label for="b_strength" class="form-control-label ">Strengths</label></div>
                                                    <div class="p-2"><a href="gendevplanT.php?btn=editstrcbc" class="btn btn-primary text-white">Edit</a></div>
                                                    </div>
                                                    </div>
                                                <!-- ----------------------------- -->
                                                <?php if($cbc_str):
                                                    foreach($cbc_str as $str_cbc):
                                                    // pre_r($cbc_str);
                                                    ?>
                                                    
                                            <p>
                                                <p class="tomato-color">
                                                    <?php echo displayCBCname($conn,$str_cbc['cbc_id']) ?>
                                                </p>

                                                <p>
                                                <input type="hidden" name="strength_cbc_id[]" value="<?php echo $str_cbc['cbc_id'] ?>">
                                                <input type="checkbox" name="strength_cbc_ind_id[]" value="<?php echo $str_cbc['cbc_ind_id'] ?>">
                                                    <?php echo displayCBCind($conn,$str_cbc['cbc_ind_id']) ?>
                                                </p>
                                            </p>
                                         <?php endforeach; else: ?>
                                            <p class="red-notif-border">
                                             No ESAT record yet!
                                         </p>

                                         <?php endif; ?>
                                                </div>
                        
                                                <!-- -------------------------------- -->
                                                <div class="col-md-6">
                                                    <div class="bg-black"><div class="d-flex justify-content-between">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"><label for="b_strength" class="form-control-label ">Development Needs</label></div>
                                                    <div class="p-2"><a href="gendevplanT.php?btn=editdevcbc" class="btn btn-primary text-white">Edit</a></div>
                                                    </div>
                                                    </div>
<!-- ------------------------------------------------------------------------ -->
<?php if($cbc_devneeds):
                                                    foreach($cbc_devneeds as $devneed_cbc):
                                                    // pre_r($cbc_str);
                                                    ?>
                                                    
                                            <p>
                                                <p class="tomato-color">
                                                    <?php echo displayCBCname($conn,$devneed_cbc['cbc_id']) ?>
                                                </p>

                                                <p>
                                                <input type="hidden" name="devneed_cbc_id[]" value="<?php echo $devneed_cbc['cbc_id'] ?>">
                                                <input type="checkbox" name="devneed_cbc_ind_id[]" value="<?php echo $devneed_cbc['cbc_ind_id'] ?>">
                                                    <?php echo displayCBCind($conn,$devneed_cbc['cbc_ind_id']) ?>
                                                </p>
                                            </p>
                                         <?php endforeach; else: ?>

                                            <p class="red-notif-border">
                                             No ESAT record yet!
                                         </p>
                                        
                                        <?php endif; ?>
                                                </div>
                        
                                                        <!-- ------------------------------------------ -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Action Plan</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="b_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="intervention">Interventions:</label>
                                                    <textarea name="b_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Timelines, Resources needed and Feedback</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="timelines">Timelines:</label>
                                                    <textarea name="b_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." class="form-control textarea"></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="b_resources_needed" id="" cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"></textarea>
                                                </div>
                                            </div>

                                            <div>
                                                <label for="learn-objectives" class="form-control-label">Feedback: </label>
                                                <textarea name="feedback" id="" cols="30" rows="10" class="form-control textarea" placeholder=" _______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________"></textarea>
                                            </div>
                                        </div>

                                        <br>
                                        <center>
                                            <div class="row">
                                                <div>
                                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                                                    <input type="submit" name="save" class="btn btn-success" value="Save" />
                                                    <input type="submit" name="edit" class="btn btn-info" value="Edit" />
                                                    <?php directLastPage() ?>
                                                </div>
                                            </div>
                                        </center>

                            </form>
                        </div>
                        <!--end breadcome -->
                    </div><!-- end of container -->

                    <br>
                    <main>
                    <?php
                        /* ELSE FOR NOTIFICATION */
                        else :
                            echo  '<ul class="red-notif-border">';
                            foreach ($notifsss as $notifs) :
                                echo  $notifs;
                            endforeach;
                            echo '</ul>';
                            ?>
                <?php
                    /* END IF */
                    endif;
                /*--------------------------------------*/
                endif;
                include 'samplefooter.php';
                ?>