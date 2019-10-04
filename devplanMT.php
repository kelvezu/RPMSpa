    <?php
    include_once 'includes/header.php';
    include_once 'includes/constants.inc.php';
    include_once 'includes/classautoloader.inc.php';
    include_once 'libraries/db.library.php';
    include_once 'libraries/func.lib.php';
    include_once 'includes/security.php';

    //QUERIES FOR FETCHING DATA


    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $form2_lvlcap_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.lvlcap = 4';
    $esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);

    $form2_priodev_query = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE esat2_objectivesmt_tbl.user_id = "' . $_SESSION['user_id'] . '" AND esat2_objectivesmt_tbl.lvlcap <= 2';
    $esatForm2_priodev_results = fetchAll($dbcon, $form2_priodev_query);

    $form3_cbc_strength_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) >= 3 ORDER BY esat3_core_behavioral_tbl.cbc_id';
    $esatForm3_strength_results = fetchAll($dbcon, $form3_cbc_strength_query);

    $form3_cbc_devneeds_query = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE esat3_core_behavioral_tbl.user_id = ' . $_SESSION['user_id'] . ' AND esat3_core_behavioral_tbl.school = ' . $_SESSION['school_id'] . ' group by core_behavioral_tbl.cbc_name HAVING SUM(esat3_core_behavioral_tbl.cbc_score) <= 2 ORDER BY esat3_core_behavioral_tbl.cbc_id';
    $esatForm3_devneeds_results = fetchAll($dbcon, $form3_cbc_devneeds_query);




    // getting the score of core behavioral compentencies
    // SELECT esat3_core_behavioral_tbl.cbc_id, COUNT(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM esat3_core_behavioral_tbl group by esat3_core_behavioral_tbl.cbc_id

    //GET THE SCORE FOR COMPETENCIES
    // SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioral_tbl.cbc_score) as CBC_scores FROM (esat3_core_behavioral_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioral_tbl.cbc_id = core_behavioral_tbl.cbc_id) group by core_behavioral_tbl.cbc_name ORDER BY esat3_core_behavioral_tbl.cbc_id



    //pre_r($esatForm2_LvlCap_results);
    // echo '<hr>';
    // pre_r($esatForm2_priodev_results);


    $form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '"';
    $esatForm3results = fetchAll($dbcon, $form3query);
    ?>

    <main>
        <div class="container">

            <div class="row">


            </div>



            <table class="table table-bordered text-center fixed">

                <thead class="bg-dark text-white">
                    <tr>
                        <th rowspan="2" class="text-center">Strengths</th>
                        <th rowspan="2" class="text-center">Development Needs</th>
                        <th colspan="2" class="text-center">Action plan</th>
                        <th rowspan="2" class="text-center">Timelines</th>
                        <th rowspan="2" class="text-center">Resources needed</th>
                    </tr>

                    <tr>
                        <th class="text-center">Learning Objectives</th>
                        <th class="text-center">Intervention</th>
                    </tr>
                </thead>

                <thead class="bg-light ">
                    <tr>
                        <th colspan="6" class="text-center">A. Functional Competencies</th>
                    </tr>
                </thead>
                <tr>
                    <td id="a_strength">
                        <!--A. Strengths -->

                    </td>
                    <td id="a_devneed">
                        <!--A. Dev Needs -->
                        <ol type='I' class="text-nowrap">
                            <?php
                            if (count($esatForm2_priodev_results)) :
                                foreach ($esatForm2_priodev_results as $PrioDev_result) :
                                    ?>
                                    <li><?php echo 'KRA_id:' . $PrioDev_result['kra_id'] . ' Objective ID: ' . $PrioDev_result['mtobj_id']; ?>
                                <?php
                                    endforeach;
                                else :
                                    echo 'No record!';
                                endif; ?>

                                    </li>
                        </ol>

                    </td>




                    <td contenteditable="true">
                        <!--A. Learning Objectives -->
                        <textarea name="" id="a_learn_objectives" cols="30" rows="10" wrap="hard"></textarea>
                        </textarea>
                    </td>
                    <td>
                        <!--A. Intervention -->
                        Applying new
                        learning from
                        attending
                        courses/seminars/
                        workshops/
                        Learning Action
                        Cells (LAC)/ Elearning
                        Using feedback to
                        try a new approach
                        to an old practice
                        Coaching and
                        mentoring

                        Equipping myself
                        with pedagogical
                        skills to develop
                        activities that will
                        promote critical
                        and creative
                        thinking skills of
                        my students </td>
                    <td>
                        <!--A. Timelines -->
                        Year-round</td>
                    <td>
                        <!--A. Resources Needed -->
                        Learning and
                        Development
                        Team
                        Supervisors /
                        School Heads
                        /
                        Master
                        Teachers
                        Local Funds</td>
                </tr>

                <thead class="bg-light ">
                    <tr>
                        <th colspan="6" class="text-center">B. Core Behavioral Competencies</th>
                    </tr>

                </thead>
                <tr>
                    <td>
                        <!--B. Strenths -->
                        •Professionalism
                        and Ethics
                        •Teamwork
                        •Service
                        Orientation
                        •Results Focus</td>
                    <td>
                        <!--B. Dev Needs -->
                        Innovation;
                        particularly on
                        conceptualizing
                        “Out of the Box”
                        ideas/approach
                    </td>
                    <td>
                        <!--B. Learning Objectives -->
                        Focus on
                        personal
                        productivity
                        to create
                        higher value
                        and results</td>
                    <td>
                        <!--B. Intervention -->
                        Coaching
                        Incorporating in
                        the next in-service
                        training (INSET) the
                        training on
                        conceptualization
                        of innovative and
                        ingenious methods
                        and solutions</td>
                    <td>
                        <!--B. Timelines -->
                        BRegular
                        coaching
                        In-service
                        training in
                        April and
                        May</td>
                    <td>
                        <!--B. Resources Needed -->
                        HRTD Funds</td>
                </tr>

                <tr>
                    <td colspan="6">
                        <h5>
                            <!--Feedback -->
                            Feedback</h5>
                        <textarea name="feedback" id="" cols="100" rows="10"></textarea>

                    </td>

                </tr>

            </table>
            <div class="text-center">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>

        </div>

        <div class="container ">
            <div class="breadcome-list shadow-reset">
                <h2 class="text-center"><strong>PART IV: Development Plan</strong></h2>
                <form action="" class="form-group">
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
                                            $userLvlCap = '<li><b>KRA name: </b><br/>'  . $LvlCap_result['kra_name'] . '<br/>' . '<b>Objective name: </b><br/>'  . $LvlCap_result['mtobj_name'] . '</br></br>';
                                            trim($userLvlCap);
                                            ?>
                                            <input type="hidden" name="kra_id[]" value="<?php echo  $LvlCap_result['kra_id'] ?>">
                                            <input type="hidden" name="mtobj_id[]" value="<?php echo $LvlCap_result['mtobj_id'] ?>">

                                            <?php echo $userLvlCap; ?>

                                        <?php
                                            endforeach;
                                            ?>



                                </ul>
                            <?php
                            else :
                                echo '<p text-danger>No record!</p>';
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
                                        $userPrioDev = '<li><b>KRA name: </b></br>'  . $PrioDev_result['kra_name'] . '</li>' . '<b>Objective name: </b></br>&nbsp'  . $PrioDev_result['mtobj_name'] . '</br></br>';
                                        trim($userPrioDev);
                                        ?>
                                        <input type="hidden" name="kra_id[]" value="<?php echo  $PrioDev_result['kra_id'] ?>">
                                        <input type="hidden" name="mtobj_id[]" value="<?php echo $PrioDev_result['mtobj_id'] ?>">
                                        <?php echo $userPrioDev; ?>
                                    <?php
                                        endforeach;
                                        ?>
                            </ul>
                        <?php
                        else :
                            echo '<p text-danger>No record!</p>';
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
                                <textarea name="" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="intervention">Interventions:</label>
                                <textarea name="" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
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
                                <textarea name="" id="" cols="30" rows="10" placeholder="Enter Timelines." class="form-control textarea"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="resources_needed">Resources needed:</label>
                                <textarea name="" id="" cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <legend><strong>B. Core Behavioral Competencies</strong></legend>


                    <div id="B">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Strengths</label></div>
                                <ul class="ul">
                                    <?php
                                    if (count($esatForm3_strength_results)) :
                                        foreach ($esatForm3_strength_results as $cbc_strength) :
                                            $userCbcStr = '<li>'  . $cbc_strength['cbc_name'];
                                            trim($userCbcStr);
                                            ?>
                                            <input type="hidden" name="kra_id[]" value="<?php echo  $cbc_strength['cbc_id'] ?>">
                                            <?php echo $userCbcStr; ?>
                                        <?php
                                            endforeach;
                                            ?>
                                </ul>
                            <?php
                            else :
                                echo '<p text-danger>No record!</p>';
                            endif;
                            ?>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Development Needs</label></div>
                                <ul class="ul">
                                    <?php
                                    if (count($esatForm3_devneeds_results)) :
                                        foreach ($esatForm3_devneeds_results as $cbc_devneeds) :
                                            $userCbcDevNeeds = '<li>'  . $cbc_devneeds['cbc_name'];
                                            trim($userCbcDevNeeds);
                                            ?>
                                            <input type="hidden" name="kra_id[]" value="<?php echo  $cbc_devneeds['cbc_id'] ?>">
                                            <?php echo $userCbcDevNeeds; ?>
                                        <?php
                                            endforeach;
                                            ?>
                                </ul>
                            <?php
                            else :
                                echo '<p text-danger>No record!</p>';
                            endif;
                            ?>
                            </div>
                        </div>


                    </div>
            </div>
            </fieldset>

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