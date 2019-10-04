    <?php
    include_once 'includes/header.php';
    include_once 'includes/constants.inc.php';
    include_once 'includes/classautoloader.inc.php';
    include_once 'libraries/db.library.php';
    include_once 'libraries/func.lib.php';
    include_once 'includes/security.php';

    //QUERIES FOR FETCHING DATA
    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $form2_lvlcap_query = 'SELECT * FROM esat2_objectivesmt_tbl WHERE user_id = ' . $_SESSION['user_id'] . ' AND lvlcap = 4';
    $esatForm2_LvlCap_results = fetchAll($dbcon, $form2_lvlcap_query);

    $form2_priodev_query = 'SELECT * FROM esat2_objectivesmt_tbl WHERE user_id = ' . $_SESSION['user_id'] . ' AND priodev <= 2';
    $esatForm2_priodev_results = fetchAll($dbcon, $form2_priodev_query);

    //pre_r($esatForm2_LvlCap_results);
    //echo '<hr>';
    //pre_r($esatForm2_priodev_results);
    $form3query = 'SELECT * FROM esat3_core_behavioral_tbl WHERE user_id = "' . $_SESSION['user_id'] . '"';
    $esatForm3results = fetchAll($dbcon, $form3query);
    ?>




    </div>



    <table class="table table-bordered text-center fixed" style="">

        <thead class="bg-info">
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
                <textarea class="textarea" id="a_strength" cols="24" rows="10" wrap="hard" diabled>
                                <?php
                                if (count($esatForm2_LvlCap_results)) :
                                    foreach ($esatForm2_LvlCap_results as $LvlCap_result) :
                                        ?>
                                        <?php echo 'KRA_id:' . $LvlCap_result['kra_id'] . ' Objective ID: ' . $LvlCap_result['mtobj_id']; ?>
                                    <?php
                                        endforeach;
                                    else :
                                        echo 'No record!';
                                    endif;
                                    ?>
                                        
                            </textarea>
            </td>
            <td>
                <!--A. Dev Needs -->
                <select id="a_devneeds">
                    <?php
                    if (count($esatForm2_priodev_results)) :
                        foreach ($esatForm2_priodev_results as $PrioDev_result) :
                            ?>
                            <option><?php echo 'KRA_id:' . $PrioDev_result['kra_id'] . ' Objective ID: ' . $PrioDev_result['mtobj_id']; ?>
                        <?php
                            endforeach;
                        else :
                            echo 'No record!';
                        endif; ?>

                            </option>
                </select>

            </td>




            <td contenteditable="true">
                <!--A. Learning Objectives -->
                <textarea class="textarea" id="a_learn_objectives" cols="24" rows="10" wrap="hard">
                        </textarea>
            </td>
            <td>
                <!--A. Intervention -->
                <textarea class="textarea" id="a_intervention" cols="24" rows="10" wrap="hard">
                            </textarea>

            </td>
            <td>
                <!--A. Timelines -->
                <textarea class="textarea" id="a_timelines" cols="24" rows="10" wrap="hard">
                            </textarea>


            </td>
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


    <br>
    <main>
        <?php
        include 'includes/footer.php';
        ?>



        <div class="container">

            <form action="">
                <h4 class="text-center"><strong>PART IV: Development Plan</strong></h4>
                <div class="">

                </div>
            </form>
        </div>