    <?php
    include_once 'includes/header.php';
    include_once 'includes/constants.inc.php';
    include_once 'includes/classautoloader.inc.php';
    include_once 'libraries/db.library.php';
    include_once 'libraries/func.lib.php';
    include_once 'includes/security.php';

    //QUERIES FOR FETCHING DATA
    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $form2_lvlcap_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.lvlcap >= 3 AND esat2_objectivesmt_tbl.priodev  <= 2   GROUP by kra_tbl.kra_id';
    $esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);

    $form2_priodev_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.priodev >= 3 AND esat2_objectivesmt_tbl.lvlcap  <= 2 GROUP by kra_tbl.kra_id';
    $esatForm2_priodev_results = fetchAll($dbcon, $form2_priodev_query);

    $form3_cbc_strength_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) >= 3 ORDER BY esat3_core_behavioral_tbl.cbc_id';
    $esatForm3_strength_results = fetchAll($dbcon, $form3_cbc_strength_query);

    $form3_cbc_devneeds_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) <= 2 ORDER BY esat3_core_behavioral_tbl.cbc_id';
    $esatForm3_devneeds_results = fetchAll($dbcon, $form3_cbc_devneeds_query);

    $form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '" AND school =  "' . $_SESSION['school_id'] . '"';
    $esatForm3results = fetchAll($dbcon, $form3query);

    echo pre_r($_POST['submit']);
    ?>

    <main>
        <div class="container ">
            <div class="breadcome-list shadow-reset">
                <h2 class="text-center"><strong>PART IV: Development Plan</strong></h2>
                <!-- action="includes/processdevplant.php" -->
                <form action="" method="post" class="form-group">
                    <input type="hidden" name="sy" value=<?php echo $_SESSION['sy_id']; ?> />
                    <input type="hidden" name="school_id" value=<?php echo $_SESSION['school_id']; ?> />
                    <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" />
                    <input type="hidden" name="rater" value="<?php echo $_SESSION['rater'] ?>" />
                    <div id="A">
                        <fieldset>
                            <legend><strong>A. Functional Competencies</strong></legend>
                            <!--A. Strengths -->
                            <div>
                                <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Strengths</label></div>
                                <ul class="ul">
                                    <?php
                                    if (count($esatForm2_LvlCap_results)) :
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
                                                <?php endforeach; ?>
                                            </ul><br>
                                            <input type="hidden" name="lvlcapkra_id[]" value="<?php echo  $LvlCap_result['kra_id'] ?>" />
                                            <input type="hidden" name="lvlcapmtobj_id[]" value="<?php echo $LvlCap_result['mtobj_id'] ?>" />
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
                                            <?php endforeach; ?>
                                        </ul><br>
                                        <input type="hidden" name="priodevkra_id[]" value="<?php echo  $PrioDev_result['kra_id'] ?>">
                                        <input type="hidden" name="priodevmtobj_id[]" value="<?php echo $PrioDev_result['mtobj_id'] ?>">
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
                                <textarea name="a_action_plan" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="a_intervention">Interventions:</label>
                                <textarea name="a_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
                            </div>
                        </div>
                    </div>

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
                                                <?php $queryIndicatorStrength = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioral_tbl.* FROM esat3_core_behavioral_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioral_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioral_tbl.cbc_id =  "' . $cbc_strength['cbc_id'] . '" AND esat3_core_behavioral_tbl.cbc_score = 1';
                                                        $indicatorStrengthResults = fetchAll($dbcon, $queryIndicatorStrength);
                                                        foreach ($indicatorStrengthResults as $indicatorStrength) :
                                                            ?>
                                                    <li><?php echo $indicatorStrength['indicator']  ?></li>
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
                                                        $queryIndicatorDevneeds = 'SELECT cbc_indicators_tbl.*,esat3_core_behavioral_tbl.* FROM esat3_core_behavioral_tbl INNER JOIN cbc_indicators_tbl ON esat3_core_behavioral_tbl.cbc_ind_id = cbc_indicators_tbl.cbc_ind_id WHERE esat3_core_behavioral_tbl.cbc_id =  "' . $cbc_devneeds['cbc_id'] . '" AND esat3_core_behavioral_tbl.cbc_score = 0';
                                                        $IndicatorDevNeedsResults = fetchAll($dbcon, $queryIndicatorDevneeds);
                                                        foreach ($IndicatorDevNeedsResults as $indicatorDevneeds) :
                                                            ?>
                                                    <li><?php echo $indicatorDevneeds['indicator'] ?></li>
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

                    </fieldset>

            </div>
            <br>
            <div align="center">
                <input type="button" name="submit" class="btn btn-primary" value="Submit" />
            </div>
            </form>
        </div>
        <!--end breadcome -->
        </div><!-- end of container -->

        <br>
        <main>
            <?php
            include 'includes/footer.php';
            ?>