    <?php

    use DevPlan\DevPlan;
    use FilterUser\FilterUser;


    include_once 'sampleheader.php';
    // devplan::checkDevPlanT($conn);
    // FilterUser::filterDevplanTUsers($_SESSION['position']);
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
                                            <label for="select-rater" class="form-control-label"> Rater: </label>
                                            <?php
                                                    $a1_str = DevPlan::showA1strength($conn);
                                                    foreach ($a1_str as $str) :
                                                        $rater = $str['rater_id'];
                                                        $position = $str['position'];
                                                        $app_auth = $str['approving_authority'];
                                                    endforeach;
                                                    ?>
                                            <input type="text" name="name" id="" value="<?= displayname($conn, $rater) ?>" disabled />

                                        </div>
                                        <div class="col-sm-6">
                                            <label for="select-app-auth" class="form-control-label"> Approving Authority: </label>
                                            <input type="text" name="name" id="" value="<?= displayname($conn, $app_auth) ?>" disabled />

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
                                            <div class="bg-black"><label for="a_strength" class="form-control-label">Strengths</label>

                                            </div>
                                            <ul class="ul">
                                                <?php

                                                        $esatForm2_LvlCap_results = DevPlan::showStrDevplanT($conn);
                                                        /* TURN THIS INTO FUNCTION */
                                                        if (!empty($esatForm2_LvlCap_results)) :
                                                            foreach ($esatForm2_LvlCap_results as $LvlCap_result) :
                                                                ?>
                                                        <li><b class="tomato-color">Key Result Area: </b><u>
                                                                <?php
                                                                                $LvlCap_result['kra_id'];
                                                                                echo $LvlCap_result['kra_name'];
                                                                                ?></u> </li>
                                                        <ul class="ul-square">
                                                            <?php

                                                                            $queryMTobjlvlcap = 'SELECT kra_tbl.kra_name, tobj_tbl.tobj_name, esat2_objectivest_tbl.* FROM ( esat2_objectivest_tbl INNER JOIN kra_tbl ON esat2_objectivest_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN tobj_tbl ON esat2_objectivest_tbl.tobj_id = tobj_tbl.tobj_id WHERE kra_tbl.kra_id = "' . $LvlCap_result['kra_id'] . '" AND esat2_objectivest_tbl.user_id = "' . $LvlCap_result['user_id'] . '" AND esat2_objectivest_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat2_objectivest_tbl.school = "' . $LvlCap_result['school'] . '" AND esat2_objectivest_tbl.status = "Active" AND esat2_objectivest_tbl.lvlcap >= 3  LIMIT 2';
                                                                            $mtobjLvlcapResults = mysqli_query($dbcon, $queryMTobjlvlcap);
                                                                            if ($mtobjLvlcapResults) :
                                                                                foreach ($mtobjLvlcapResults as $mtobjLvlcap) :
                                                                                    ?>
                                                                    <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjLvlcap['tobj_name'] ?></i></li><br />
                                                                    <input type="hidden" name="lvlcapmtobj_id[]" value="<?php echo $mtobjLvlcap['tobj_id'] ?>" />
                                                                    <input type="hidden" name="lvlcapkra_id[]" value="<?php echo  $mtobjLvlcap['kra_id'] ?>" />
                                                            <?php endforeach;
                                                                            else : echo '<p class="tomato-color">No record!</p>';
                                                                            endif; ?>
                                                        </ul><br>

                                                    <?php
                                                                endforeach;
                                                                ?>
                                            </ul>
                                        <?php
                                                endif;
                                                ?>
                                        </div>

                                        <!-- A. Development Needs -->
                                        <div class="black-border">
                                            <div class="bg-black"><label for="a_devneeds" class="form-control-label">Development Needs</label></div>
                                            <ul class="ul">
                                                <?php
                                                        $esatForm2_priodev_results = DevPlan::showPrioDevplanT($conn);
                                                        if (!empty($esatForm2_priodev_results)) :
                                                            foreach ($esatForm2_priodev_results as $PrioDev_result) :
                                                                ?>
                                                        <li><b class="tomato-color">Key Result Area: </b><u><?php echo $PrioDev_result['kra_name'] ?></u> </li>

                                                        <ul class="ul-square">
                                                            <?php
                                                                            $queryMTobjpriodev = 'SELECT kra_tbl.kra_name, tobj_tbl.tobj_name, esat2_objectivest_tbl.* FROM ( esat2_objectivest_tbl INNER JOIN kra_tbl ON esat2_objectivest_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN tobj_tbl ON esat2_objectivest_tbl.tobj_id = tobj_tbl.tobj_id WHERE kra_tbl.kra_id = "' . $PrioDev_result['kra_id'] . '"  AND esat2_objectivest_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat2_objectivest_tbl.school = "' . $PrioDev_result['school'] . '" AND esat2_objectivest_tbl.priodev >= 3  LIMIT 2';
                                                                            $mtobjPrioDevResults = mysqli_query($dbcon, $queryMTobjpriodev);
                                                                            if (!empty($mtobjPrioDevResults)) :
                                                                                foreach ($mtobjPrioDevResults as $mtobjPriodev) :
                                                                                    ?>
                                                                    <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjPriodev['tobj_name']  ?></i></li><br />
                                                                    <input type="hidden" name="priodevmtobj_id[]" value="<?php echo $mtobjPriodev['tobj_id'] ?>">
                                                                    <input type="hidden" name="priodevkra_id[]" value="<?php echo  $mtobjPriodev['kra_id'] ?>">
                                                            <?php endforeach;
                                                                            else : echo '<p class="tomato-color">No record!</p>';
                                                                            endif;
                                                                            ?>
                                                        </ul><br>
                                                    <?php
                                                                endforeach;
                                                                ?>
                                            </ul>
                                        <?php
                                                endif;
                                                ?>
                                        </div>
                                        <!-- Action Plan -->
                                        <div class="black-border">
                                            <?php
                                                    $action = devplan::showA3Action($conn);
                                                    foreach ($action as $act) :
                                                        $inter = $act['a_intervention'];
                                                        $learn = $act['a_learning_objectives'];
                                                        $time = $act['a_timeline'];
                                                        $resource = $act['a_resources_needed'];
                                                    endforeach;
                                                    ?>
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Action Plan</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="a_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" disabled class="form-control textarea"><?php echo $learn ?></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="a_intervention">Interventions:</label>
                                                    <textarea name="a_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" disabled class="form-control textarea"><?php echo $inter ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Timeline and Resources needed -->
                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Timelines and Resources needed</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="timelines">Timelines:</label>
                                                    <textarea name="a_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." disabled class="form-control textarea"><?php echo $time ?></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="a_resources_needed" id="" cols="30" disabled rows="10" placeholder="Enter the Resources needed." class="form-control textarea"><?php echo $resource ?></textarea>
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
                                                    <div class="bg-black"><label for="b_strength" class="form-control-label ">Strengths</label></div>
                                                    <ul class="ul">
                                                        <?php
                                                                $esatForm3_strength_results = DevPlan::showStrIndicatorT($conn);
                                                                if (!empty($esatForm3_strength_results)) :
                                                                    foreach ($esatForm3_strength_results as $cbc_strength) :
                                                                        ?>
                                                                <li><b><?php echo $cbc_strength['cbc_name'] ?></b></li>
                                                                <ul class="ul-square">
                                                                    <?php $queryIndicatorStrength = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioralt_tbl.* FROM esat3_core_behavioralt_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioralt_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioralt_tbl.cbc_id =  "' . $cbc_strength['cbc_id'] . '" AND esat3_core_behavioralt_tbl.user_id = "' . $cbc_strength['user_id'] . '" AND esat3_core_behavioralt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat3_core_behavioralt_tbl.school = "' . $_SESSION['school_id'] . '" AND esat3_core_behavioralt_tbl.status = "Active" AND cbc_score = 1  LIMIT 3';
                                                                                    $indicatorStrengthResults = mysqli_query($dbcon, $queryIndicatorStrength);
                                                                                    if ($indicatorStrengthResults) :
                                                                                        foreach ($indicatorStrengthResults as $indicatorStrength) :
                                                                                            ?>
                                                                            <li><?php echo $indicatorStrength['indicator']  ?></li>
                                                                            <input type="hidden" name="strength_cbc_id[]" value="<?php echo $indicatorStrength['cbc_id'] ?>" />
                                                                            <input type="hidden" name="strength_cbc_ind_id[]" value="<?php echo $indicatorStrength['cbc_ind_id'] ?>" />
                                                                    <?php endforeach;
                                                                                    else : echo '<p class="tomato-color">No record!</p>';
                                                                                    endif; ?>
                                                                </ul><br>
                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                    </ul>
                                                <?php

                                                        endif;
                                                        ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="bg-black"><label for="a_strength" class="form-control-label ">Development Needs</label></div>
                                                    <ul class="ul">
                                                        <?php $esatForm3_devneeds_results = DevPlan::showDevNeedsIndicatorT($conn);
                                                                if (!empty($esatForm3_devneeds_results)) :
                                                                    foreach ($esatForm3_devneeds_results as $cbc_devneeds) :
                                                                        ?>
                                                                <input type="hidden" name="cbc_id[]" value="<?php echo  $cbc_devneeds['cbc_id'] ?>" />
                                                                <li><b><?php echo $cbc_devneeds['cbc_name'] ?></b></li>
                                                                <ul class="ul-square">
                                                                    <?php
                                                                                    $queryIndicatorDevneeds = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioralt_tbl.* FROM esat3_core_behavioralt_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioralt_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioralt_tbl.cbc_id =  "' . $cbc_devneeds['cbc_id'] . '" AND esat3_core_behavioralt_tbl.user_id = "' . $cbc_devneeds['user_id'] . '" AND esat3_core_behavioralt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat3_core_behavioralt_tbl.school = "' . $cbc_devneeds['school'] . '" AND esat3_core_behavioralt_tbl.status = "Active" AND cbc_score = 0  LIMIT 2';
                                                                                    $IndicatorDevNeedsResults = fetchAll($dbcon, $queryIndicatorDevneeds);
                                                                                    if ($IndicatorDevNeedsResults) :
                                                                                        foreach ($IndicatorDevNeedsResults as $indicatorDevneeds) :
                                                                                            ?>
                                                                            <li><?php echo $indicatorDevneeds['indicator'] ?></li>
                                                                            <input type="hidden" name="devneed_cbc_id[]" value="<?php echo $indicatorDevneeds['cbc_id'] ?>" />
                                                                            <input type="hidden" name="devneed_cbc_ind_id[]" value="<?php echo $indicatorDevneeds['cbc_ind_id'] ?>" />
                                                                    <?php endforeach;
                                                                                    else :
                                                                                        echo '<p class="tomato-color">No record!</p>';
                                                                                    endif;
                                                                                    ?>
                                                                </ul><br>
                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                    </ul>
                                                <?php
                                                        else : echo '<p class ="red-notif-border">No data record!</p>';
                                                        endif;
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="black-border">
                                            <div class="form-control-label bg-black">
                                                <label for="learn-objectives" class="form-control-label">Action Plan</label>
                                                <?php
                                                        $action = devplan::showB3Action($conn);
                                                        foreach ($action as $act) :
                                                            $interb = $act['b_intervention'];
                                                            $learnb = $act['b_learning_objectives'];
                                                            $timeb = $act['b_timeline'];
                                                            $resourceb = $act['b_resources_needed'];
                                                        endforeach;
                                                        ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="learning_objectives">Learning Objectives:</label>
                                                    <textarea name="b_learning_objectives" disabled id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"><?php echo $learnb; ?> </textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="intervention">Interventions:</label>
                                                    <textarea name="b_intervention" id="" disabled cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"> <?php echo $interb; ?> </textarea>
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
                                                    <textarea name="b_timeline" id="" cols="30" disabled rows="10" placeholder="Enter Timelines." class="form-control textarea"> <?php echo $timeb; ?></textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="resources_needed">Resources needed:</label>
                                                    <textarea name="b_resources_needed" id="" disabled cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"> <?php echo $resourceb; ?></textarea>
                                                </div>
                                            </div>

                                            <div>
                                                <?php
                                                        $action3 = devplan::showDevC($conn);
                                                        foreach ($action3 as $act3) :
                                                            $act3 = $act3['feedback'];
                                                        endforeach;
                                                        ?>
                                                <label for="learn-objectives" class="form-control-label">Feedback: </label>
                                                <textarea name="feedback" id="" cols="30" disabled rows="10" class="form-control textarea" placeholder=""><?php echo $act3 ?></textarea>
                                            </div>
                                        </div>

                                        <br>
                                        <center>

                                            <?php directLastPage() ?>

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