    <?php
    include_once 'includes/header.php';
    //A.CHECK IF USER DID NOT TAKEN ESAT
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
                        <h2 class="text-center"><strong>PART IV: Development Plan</strong></h2>
                        <form action="includes/processdevplan.php" method="post" class="form-group">
                            <input type="hidden" name="sy" value=<?php echo $_SESSION['sy_id']; ?> />
                            <input type="hidden" name="school_id" value=<?php echo $_SESSION['school_id']; ?> />
                            <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />
                            <input type="hidden" name="rater" value="<?php echo $_SESSION['rater'] ?>" />
                            <input type="hidden" name="approving_authority" value="<?php echo $_SESSION['approving_authority'] ?>" />
                            <div id="A">
                                <fieldset>
                                    <legend><strong>A. Functional Competencies</strong></legend>
                                    <!--A. Strengths -->
                                    <div>
                                        <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Strengths</label></div>
                                        <ul class="ul">
                                            <?php

                                                    /* TURN THIS INTO FUNCTION */
                                                    if (!$form2_lvlcap_query) :
                                                        $esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);
                                                        echo !$form2_lvlcap_query;
                                                    else :
                                                        echo 'no record of level of capability! :D';
                                                    endif;

                                                    if (isset($esatForm2_LvlCap_results)) :
                                                        foreach ($esatForm2_LvlCap_results as $LvlCap_result) :
                                                            ?>
                                                    <li><b class="tomato-color">Key Result Area: </b><u><?php echo $LvlCap_result['kra_name'] ?></u> </li>
                                                    <ul class="ul-square">
                                                        <?php
                                                                        $queryMTobjlvlcap = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE kra_tbl.kra_id = "' . $LvlCap_result['kra_id'] . '"';
                                                                        $mtobjLvlcapResults = fetchAll($dbcon, $queryMTobjlvlcap);

                                                                        foreach ($mtobjLvlcapResults as $mtobjLvlcap) :
                                                                            ?>
                                                            <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjLvlcap['mtobj_name'] ?></i></li><br />
                                                            <input type="hidden" name="lvlcapmtobj_id[]" value="<?php echo $mtobjLvlcap['mtobj_id'] ?>" />
                                                            <input type="hidden" name="lvlcapkra_id[]" value="<?php echo  $mtobjLvlcap['kra_id'] ?>" />
                                                        <?php endforeach; ?>
                                                    </ul><br>

                                                <?php
                                                            endforeach;
                                                            ?>
                                        </ul>
                                    <?php
                                            else :
                                                echo 'Error in devplan LvlCapResults ';
                                            endif;
                                            ?>
                                    </div>

                                    <!-- A. Development Needs -->
                                    <div class="indentcontent"></div>
                                    <div class="bg-black"><label for="a_devneeds" class="form-control-label bg-black">Development Needs</label></div>
                                    <ul class="ul">
                                        <?php
                                                if (count($esatForm2_priodev_results)) :
                                                    foreach ($esatForm2_priodev_results as $PrioDev_result) :
                                                        ?>
                                                <li><b class="tomato-color">Key Result Area: </b><u><?php echo $PrioDev_result['kra_name'] ?></u> </li>

                                                <ul class="ul-square">
                                                    <?php
                                                                    $queryMTobjpriodev = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE kra_tbl.kra_id = "' . $PrioDev_result['kra_id'] . '"';
                                                                    $mtobjPrioDevResults = fetchAll($dbcon, $queryMTobjpriodev);
                                                                    foreach ($mtobjPrioDevResults as $mtobjPriodev) :
                                                                        ?>
                                                        <li><b class="darkred-color">Objective: </b><i><?php echo $mtobjPriodev['mtobj_name']  ?></i></li><br />
                                                        <input type="hidden" name="priodevmtobj_id[]" value="<?php echo $mtobjPriodev['mtobj_id'] ?>">
                                                        <input type="hidden" name="priodevkra_id[]" value="<?php echo  $mtobjPriodev['kra_id'] ?>">
                                                    <?php endforeach; ?>
                                                </ul><br>
                                            <?php
                                                        endforeach;
                                                        ?>
                                    </ul>
                                <?php
                                        else :
                                            echo '<p class="no-record">No record!</p>';
                                        endif;
                                        ?>
                            </div>
                            <!-- Action Plan -->
                            <div>
                                <div class="form-control-label bg-black">
                                    <label for="learn-objectives" class="form-control-label bg-black">Action Plan</label>
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
                            <div>
                                <div class="form-control-label bg-black">
                                    <label for="learn-objectives" class="form-control-label bg-black">Timelines and Resources needed</label>
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
                            <hr>
                            <legend><strong>B. Core Behavioral Competencies</strong></legend>
                            <div id="B">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bg-black"><label for="b_strength" class="form-control-label bg-black">Strengths</label></div>
                                        <ul class="ul">
                                            <?php
                                                    if (count($esatForm3_strength_results)) :
                                                        foreach ($esatForm3_strength_results as $cbc_strength) :
                                                            ?>
                                                    <li><b><?php echo $cbc_strength['cbc_name'] ?></b></li>
                                                    <ul class="ul-square">
                                                        <?php $queryIndicatorStrength = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioral_tbl.* FROM esat3_core_behavioral_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioral_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioral_tbl.cbc_id =  "' . $cbc_strength['cbc_id'] . '"';
                                                                        $indicatorStrengthResults = fetchAll($dbcon, $queryIndicatorStrength);
                                                                        foreach ($indicatorStrengthResults as $indicatorStrength) :
                                                                            ?>
                                                            <li><?php echo $indicatorStrength['indicator']  ?></li>
                                                            <input type="hidden" name="strength_cbc_id[]" value="<?php echo $indicatorStrength['cbc_id'] ?>" />
                                                            <input type="hidden" name="strength_cbc_ind_id[]" value="<?php echo $indicatorStrength['cbc_ind_id'] ?>" />
                                                        <?php endforeach; ?>
                                                    </ul><br>
                                                <?php
                                                            endforeach;
                                                            ?>
                                        </ul>
                                    <?php
                                            else :
                                                echo '<p class="no-record">No record!</p>';
                                            endif;
                                            ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Development Needs</label></div>
                                        <ul class="ul">
                                            <?php
                                                    if (count($esatForm3_devneeds_results)) :
                                                        foreach ($esatForm3_devneeds_results as $cbc_devneeds) :
                                                            ?>
                                                    <input type="hidden" name="cbc_id[]" value="<?php echo  $cbc_devneeds['cbc_id'] ?>" />
                                                    <li><b><?php echo $cbc_devneeds['cbc_name'] ?></b></li>
                                                    <ul class="ul-square">
                                                        <?php
                                                                        $queryIndicatorDevneeds = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioral_tbl.* FROM esat3_core_behavioral_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioral_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioral_tbl.cbc_id =  "' . $cbc_devneeds['cbc_id'] . '"';
                                                                        $IndicatorDevNeedsResults = fetchAll($dbcon, $queryIndicatorDevneeds);
                                                                        foreach ($IndicatorDevNeedsResults as $indicatorDevneeds) :
                                                                            ?>
                                                            <li><?php echo $indicatorDevneeds['indicator'] ?></li>
                                                            <input type="hidden" name="devneed_cbc_id[]" value="<?php echo $indicatorDevneeds['cbc_id'] ?>" />
                                                            <input type="hidden" name="devneed_cbc_ind_id[]" value="<?php echo $indicatorDevneeds['cbc_ind_id'] ?>" />
                                                        <?php endforeach;
                                                                        ?>
                                                    </ul><br>
                                                <?php
                                                            endforeach;
                                                            ?>
                                        </ul>
                                    <?php
                                            else :
                                                echo '<p class="no-record">No record!</p>';
                                            endif;
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-label bg-black">
                                <label for="learn-objectives" class="form-control-label bg-black">Action Plan</label>
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
                            <div>
                                <div class="form-control-label bg-black">
                                    <label for="learn-objectives" class="form-control-label bg-black">Timelines and Resources needed</label>
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
                            </div>
                            <!-- <div>
                        <label for="learn-objectives" class="form-control-label">Feedback: </label>
                        <textarea name="feedback" id="" cols="30" rows="10" class="form-control textarea" placeholder=" ________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________"></textarea>
                    </div> -->
                            <br>
                            <center>
                                <div class="row">
                                    <div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                                        <input type="submit" name="save" class="btn btn-success" value="Save" />
                                        <a href="includes/processdevplan.php?pos=<?php echo $_SESSION['position']; ?>" name="cancel" class="btn btn-danger">Cancel </a>
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