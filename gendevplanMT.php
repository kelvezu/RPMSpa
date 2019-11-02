    <?php

    use DevPlan\DevPlan;
    use FilterUser\FilterUser;


    include_once 'includes/header.php';
    devplan::checkDevPlanMT($conn);
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
                        <h2 class="text-center"><strong>PART IV: General Master Teacher Development Plan</strong></h2>
                        <div>
                            <div class="bg-black"><label for="a_strength" class="form-control-label">Select Rater and the Approving Authority: </label>
                            </div>
                            <div>
                                <div class="row black-border">
                                    <form action="includes/processgendevplanmt.php" method="post" class="form-group">
                                        <div class="col-sm-6">
                                            <label for="select-rater" class="form-control-label">Select Rater: </label>
                                            <select name="rater" id="" class="form-control" required>
                                                <?php
                                                        $raterformt = DevPlan::showAllAvailRaterforMT($conn);
                                                        foreach ($raterformt as $res) : ?>
                                                    <option value="<?= $res['user_id'] ?>"><?= fullnameFormat($res['firstname'], $res['middlename'], $res['surname']) . ' - ' . $res['position'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="select-app-auth" class="form-control-label">Select Approving Authority: </label>

                                            <select name="app_auth" id="" class="form-control required">
                                                <?php
                                                        $app_auth = DevPlan::showAllAppAuthforMT($conn);
                                                        foreach ($app_auth as $sup) :
                                                            ?>
                                                    <option value="<?= $sup['user_id'] ?>"><?= fullnameFormat($sup['firstname'], $sup['middlename'], $sup['surname']) . ' - ' . $sup['position'] ?></option>
                                                <?php endforeach; ?>
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
                                        <div class="bg-black"><label for="a_strength" class="form-control-label">Strengths</label>

                                        </div>
                                        <ul class="ul">
                                            <?php

                                                    $esatForm2_LvlCap_results = DevPlan::showStrDevplanMT($conn);
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

                                                                        $queryMTobjlvlcap = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE kra_tbl.kra_id = "' . $LvlCap_result['kra_id'] . '" AND esat2_objectivesmt_tbl.user_id = "' . $LvlCap_result['user_id'] . '" AND esat2_objectivesmt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat2_objectivesmt_tbl.school = "' . $LvlCap_result['school'] . '" AND esat2_objectivesmt_tbl.status = "Active" AND esat2_objectivesmt_tbl.lvlcap >= 3  LIMIT 2';
                                                                        $mtobjLvlcapResults = mysqli_query($dbcon, $queryMTobjlvlcap);
                                                                        if ($mtobjLvlcapResults) :
                                                                            foreach ($mtobjLvlcapResults as $mtobjLvlcap) :
                                                                                ?>
                                                                <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjLvlcap['mtobj_name'] ?></i></li><br />
                                                                <input type="hidden" name="lvlcapmtobj_id[]" value="<?php echo $mtobjLvlcap['mtobj_id'] ?>" />
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
                                                    $esatForm2_priodev_results = DevPlan::showPrioDevplanMT($conn);
                                                    if (!empty($esatForm2_priodev_results)) :
                                                        foreach ($esatForm2_priodev_results as $PrioDev_result) :
                                                            ?>
                                                    <li><b class="tomato-color">Key Result Area: </b><u><?php echo $PrioDev_result['kra_name'] ?></u> </li>

                                                    <ul class="ul-square">
                                                        <?php
                                                                        $queryMTobjpriodev = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE kra_tbl.kra_id = "' . $PrioDev_result['kra_id'] . '"  AND esat2_objectivesmt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat2_objectivesmt_tbl.school = "' . $PrioDev_result['school'] . '" AND esat2_objectivesmt_tbl.priodev >= 3  LIMIT 2';
                                                                        $mtobjPrioDevResults = mysqli_query($dbcon, $queryMTobjpriodev) or die($dbcon->error);
                                                                        if (isset($mtobjPrioDevResults)) :
                                                                            foreach ($mtobjPrioDevResults as $mtobjPriodev) :
                                                                                ?>
                                                                <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjPriodev['mtobj_name']  ?></i></li><br />
                                                                <input type="hidden" name="priodevmtobj_id[]" value="<?php echo $mtobjPriodev['mtobj_id'] ?>">
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
                                        <div class="form-control-label bg-black">
                                            <label for="learn-objectives" class="form-control-label">Action Plan</label>
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
                                        <div class="form-control-label bg-black">
                                            <label for="learn-objectives" class="form-control-label">Timelines and Resources needed</label>
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
                                                <div class="bg-black"><label for="b_strength" class="form-control-label ">Strengths</label></div>
                                                <ul class="ul">
                                                    <?php
                                                            $esatForm3_strength_results = DevPlan::showStrIndicatorMT($conn);
                                                            if (!empty($esatForm3_strength_results)) :
                                                                foreach ($esatForm3_strength_results as $cbc_strength) :
                                                                    ?>
                                                            <li><b><?php echo $cbc_strength['cbc_name'] ?></b></li>
                                                            <ul class="ul-square">
                                                                <?php $queryIndicatorStrength = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioralmt_tbl.* FROM esat3_core_behavioralmt_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioralmt_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioralmt_tbl.cbc_id =  "' . $cbc_strength['cbc_id'] . '" AND esat3_core_behavioralmt_tbl.user_id = "' . $cbc_strength['user_id'] . '" AND esat3_core_behavioralmt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat3_core_behavioralmt_tbl.school = "' . $_SESSION['school_id'] . '" AND esat3_core_behavioralmt_tbl.status = "Active" AND cbc_score = 1  LIMIT 3';
                                                                                $indicatorStrengthResults = mysqli_query($dbcon, $queryIndicatorStrength) or die($dbcon->error);
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
                                                    <?php $esatForm3_devneeds_results = DevPlan::showDevNeedsIndicatorMT($conn);
                                                            if (!empty($esatForm3_devneeds_results)) :
                                                                foreach ($esatForm3_devneeds_results as $cbc_devneeds) :
                                                                    ?>
                                                            <input type="hidden" name="cbc_id[]" value="<?php echo  $cbc_devneeds['cbc_id'] ?>" />
                                                            <li><b><?php echo $cbc_devneeds['cbc_name'] ?></b></li>
                                                            <ul class="ul-square">
                                                                <?php
                                                                                $queryIndicatorDevneeds = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioralmt_tbl.* FROM esat3_core_behavioralmt_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioralmt_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioralmt_tbl.cbc_id =  "' . $cbc_devneeds['cbc_id'] . '" AND esat3_core_behavioralmt_tbl.user_id = "' . $cbc_devneeds['user_id'] . '" AND esat3_core_behavioralmt_tbl.sy = "' . $_SESSION['active_sy_id'] . '" AND esat3_core_behavioralmt_tbl.school = "' . $cbc_devneeds['school'] . '" AND esat3_core_behavioralmt_tbl.status = "Active" AND cbc_score = 0  LIMIT 2';
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
                    include 'includes/footer.php';
                    ?>