<?php

use DevPlan\DevPlan;

include 'sampleheader.php';
$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$school = $_SESSION['school_id'];
$position = $_SESSION['position'];
$rater = $_SESSION['rater'];
$approving_authority = $_SESSION['approving_authority'];
$objective_table = 'esat2_objectivesmt_tbl';
$core_behavioral_table = 'esat3_core_behavioralmt_tbl';
$devplan = new DevPlan($user, $sy, $school, $position);
$strength_objective = $devplan->fetchStrengthOBJ($objective_table);
$devneed_objective = $devplan->fetchDevNeedOBJ($objective_table);
$strength_behavioral = $devplan->fetchCoreBehavioralStr($core_behavioral_table);
$devneed_behavioral = $devplan->fetchCoreBehavioralDevNeed($core_behavioral_table);

// pre_r($strength_objective);
?>

<?php
if (isset($_GET['notif'])) :
    $notif = $_GET['notif'];

    if ($notif == 'recordexist') :
        echo '<p class="green-notif-border">You have already submitted your Development Plan</p>';
        include 'samplefooter.php';
        exit();

    elseif ($notif == 'success') :
        echo '<p class="green-notif-border">Development Plan has been created!</p>';
        include 'samplefooter.php';
        exit();
    endif;
endif;

?>

<?php if (isset($_POST['create_dp_mt'])) :
?>
    <?php showModal('myModal') ?>

    <div id="myModal" class="modal container-fluid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <?php
                $error_array = [];
                $obj_str = !empty($_POST['strength_objective']) ? $_POST['strength_objective'] : false;
                $obj_devneed = !empty($_POST['devneed_objective']) ? $_POST['devneed_objective'] : false;
                $a_learn_obj = $_POST['a_learning_objectives'];
                $a_intervention = $_POST['a_intervention'];
                $a_timeline = $_POST['a_timeline'];
                $a_resource_needed = $_POST['a_resources_needed'];
                $behavioral_str = !empty($_POST['strength_behavioral']) ?  $_POST['strength_behavioral'] : false;
                $behavioral_devneed = !empty($_POST['devneed_behavioral']) ? $_POST['devneed_behavioral'] : false;
                $b_learn_obj = $_POST['b_learning_objectives'];
                $b_intervention = $_POST['b_intervention'];
                $b_timeline = $_POST['b_timeline'];
                $b_resource_needed = $_POST['b_resources_needed'];
                if (!$obj_str) :
                    $error_array[] = "Please choose your Strength in objective!";
                endif;

                if (!$obj_devneed) :
                    $error_array[] = "Please choose your Development Need in objective!";
                endif;

                if (!$behavioral_str) :
                    $error_array[] = "Please choose your Strength in Core Behaioral Competencies!";
                endif;

                if (!$behavioral_devneed) :
                    $error_array[] = "Please choose your Development Need in Core Behaioral Competencies!";
                endif;

                if (!empty($error_array)) :
                    echo '<ul class="red-notif-border text-justify">';
                    foreach ($error_array as $errors) :
                        echo '<li>' . $errors . '</li>';
                    endforeach;
                    echo '</ul>';
                endif;
                ?>
                <form action="includes/processdevplan_mt.php" method="post">
                    <input type="hidden" name="user" value="<?php echo $user ?? null ?>">
                    <input type="hidden" name="sy" value="<?php echo $sy ?? null ?>">
                    <input type="hidden" name="school" value="<?php echo $school ?? null ?>">
                    <input type="hidden" name="rater" value="<?php echo $rater ?? null ?>">
                    <input type="hidden" name="approving_authority" value="<?php echo $approving_authority ?? null ?>">
                    <input type="hidden" name="position" value="<?php echo $position ?? null ?>">

                    <div class="m-3">
                        <table class="table table-sm table-bordered text-justify">
                            <thead class="text-center bg-light font-weight-bold">
                                <tr>
                                    <th rowspan="2">
                                        <p>Strength</p>
                                    </th>
                                    <th rowspan="2" class="text-nowrap">
                                        <p>Development Needs</p>
                                    </th>

                                    <th colspan="2">
                                        <p>Action Plan</p>
                                    </th>


                                    <th rowspan="2">
                                        <p>Timeline</p>
                                    </th>
                                    <th rowspan="2">
                                        <p>Resources needed</p>
                                    </th>

                                <tr>
                                    <th>
                                        <p>Learning Objectives</p>
                                    </th>
                                    <th>
                                        <p>Intervention</p>
                                    </th>
                                </tr>

                                <tr>
                                    <th class="text-left bg-dark text-white" colspan="6">
                                        <small class="font-weight-bold">A. Functional Competencies</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <!-- STRENGTH -->
                                            <?php if ($obj_str) : foreach ($obj_str as $strobj) :
                                            ?>
                                                    <input type="hidden" name="strobj[]" value="<?= $strobj ?>">
                                                    <li><?= displayObjectiveMT($conn, $strobj); ?></li>
                                            <?php endforeach;
                                            else : echo "<p class='text-center'>---</p>";
                                            endif; ?>
                                            <ul>
                                    </td>

                                    <td>
                                        <ul>
                                            <!-- DEVNEEDS -->
                                            <?php if ($obj_devneed) : foreach ($obj_devneed as $devneedobj) : ?>
                                                    <input type="hidden" name="devneedobj[]" value="<?= $devneedobj ?>">
                                                    <li><?= displayObjectiveMT($conn, $devneedobj); ?></li>
                                            <?php endforeach;
                                            else : echo "<p class='text-center'>---</p>";
                                            endif; ?>
                                        </ul>
                                    </td>

                                    <td>
                                        <input type="hidden" name="a_learn_obj" value="<?= $a_learn_obj ?>">
                                        <p><?= $a_learn_obj ?></p>
                                    </td>

                                    <td>
                                        <input type="hidden" name="a_intervention" value="<?= $a_intervention ?>">
                                        <p class="text-break"><?= $a_intervention ?></p>
                                    </td>

                                    <td> <input type="hidden" name="a_timeline" value="<?= $a_timeline ?>">
                                        <?= $a_timeline ?>
                                    </td>

                                    <td>
                                        <input type="hidden" name="a_resource_needed" value="<?= $a_resource_needed ?>">
                                        <p><?= $a_resource_needed ?></p>
                                    </td>
                                </tr>
                            </tbody>

                            <thead class="text-center bg-light font-weight-bold">
                                <tr>
                                    <th class="text-left bg-dark text-white" colspan="6">
                                        <small class="font-weight-bold">B. Core Behavioral Competencies</small>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <!-- STRENGTH -->
                                            <?php if ($behavioral_str) : foreach ($behavioral_str as $strbehavioral) : ?>
                                                    <input type="hidden" name="strbehavioral[]" value="<?= $strbehavioral ?>">
                                                    <li><?= displayCoreComp($conn, $strbehavioral); ?></li>
                                            <?php endforeach;
                                            else : echo "<p class='text-center'>---</p>";
                                            endif; ?>
                                            <ul>
                                    </td>

                                    <td>
                                        <?php if ($behavioral_devneed) : foreach ($behavioral_devneed as $devneedbehavioral) : ?>
                                                <input type="hidden" name="devneedbehavioral[]" value="<?= $devneedbehavioral ?>">
                                                <li><?= displayCoreComp($conn, $devneedbehavioral); ?></li>
                                        <?php endforeach;
                                        else : echo "<p class='text-center'>---</p>";
                                        endif; ?>
                                        <ul>
                                    </td>

                                    <td>
                                        <input type="hidden" name="b_learn_obj" value="<?= $b_learn_obj ?>">
                                        <p><?= $b_learn_obj ?></p>
                                    </td>

                                    <td>
                                        <p>
                                            <input type="hidden" name="b_intervention" value="<?= $b_intervention ?>">
                                            <?= $b_intervention ?>
                                        </p>
                                    </td>

                                    <td>
                                        <input type="hidden" name="b_timeline" value="<?= $b_timeline ?>">
                                        <p><?= $b_timeline ?></p>
                                    </td>

                                    <td>
                                        <input type="hidden" name="b_resource_needed" value="<?= $b_resource_needed ?>">
                                        <p><?= $b_resource_needed ?></p>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div class="d-flex justify-content-center">
                                            <?php if (empty($error_array)) : ?>
                                                <div class="p-2"><button name="submit_dp" class="btn btn-success">Submit</button></div>
                                            <?php endif; ?>
                                            <div class="p-2"><button class="btn btn-danger" data-dismiss="modal">Cancel</button></div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif;
?>





<div class="container">
    <!-- action="submit_devplan_mt.php" -->
    <form method="post">
        <div class="card border-dark">
            <div class="card-header  bg-primary text-white font-weight-bold">
                <h3>Create Development Plan for Master Teacher I-IV</h3>

            </div>
            <div class="p-2">
                <p>
                    <b>Note:</b> <i>the generated data suggestions are based on your E-SAT survey.</i>
                </p>
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
                                <label class="font-weight-bold">Select your strength: </label>
                                <!-- STRENGTH -->
                                <ul>
                                    <?php if ($strength_objective) : foreach ($strength_objective as $str_obj) :
                                            $obj = $str_obj['mtobj_id'];
                                            $kra = $str_obj['kra_id']; ?>
                                            <li class="black-border mb-1">
                                                <span> <input class="form-check-inline" type="checkbox" name="strength_objective[]" value="<?php echo $obj; ?>" /></span>
                                                KRA: <span class=" text-justify font-italic font-weight-normal"><?= displayKRA($conn, $kra) ?></span><br>
                                                Objective: <span class=" text-justify font-italic font-weight-normal"><?= displayObjectiveMT($conn, $obj) ?></span>
                                            </li>
                                    <?php endforeach;
                                    else : echo "<p class='text-center'>---</p>";
                                    endif; ?>
                                    <ul>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold">Select your Development Needs: </label>
                                <!-- DEVNEEDS -->
                                <?php if ($devneed_objective) : foreach ($devneed_objective as $str_obj) :
                                        $obj = $str_obj['mtobj_id'];
                                        $kra = $str_obj['kra_id'];  ?>
                                        <p class="black-border">
                                            <span> <input class="form-check-inline" type="checkbox" name="devneed_objective[]" value="<?php echo $obj; ?>" /></span>
                                            KRA: <span class=" text-justify font-italic font-weight-normal"><?= displayKRA($conn, $kra) ?></span><br>
                                            Objective: <span class=" text-justify font-italic font-weight-normal"><?= displayObjectiveMT($conn, $obj) ?></span>
                                        </p>
                                <?php endforeach;
                                else : echo "<p class='text-center'>---</p>";
                                endif; ?>
                            </div>
                        </div>
                        <div class="bg-dark text-white">
                            <p class="p-2 font-weight-bold">Action Plan (Recommended Developmental Intervention )</p>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="a_learning_objectives">Learning Objectives</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="a_learning_objectives" cols="30" rows="10" placeholder="Enter the Learning Objectives" required><?php echo  $a_learn_obj ?? "" ?></textarea>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="a_intervention">Intervention</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="a_intervention" cols="30" rows="10" placeholder="Enter the Interventions" required><?php echo $a_intervention ?? "" ?></textarea>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="a_timeline">Timeline</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="a_timeline" cols="30" rows="10" placeholder="Enter the Timeline" required><?php echo $a_timeline ?? "" ?></textarea>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="a_resources_needed">Resources Needed</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="a_resources_needed" cols="30" rows="10" placeholder="Enter the Resources Needed" required><?php echo $a_resource_needed ?? "" ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF A -->

                <!-- B -->
                <div class="card">
                    <div class="card-header bg-dark text-white font-weight-bold">
                        <h5>B. Core Behavioral Competencies</h5>
                    </div>
                    <div class="body">
                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold">Select your strength: </label>
                                <!-- STRENGTH COMPETENCIES -->
                                <ul>
                                    <input type="hidden" name="strength_kra[]" value="<?= $kra ?>">
                                    <?php if ($strength_behavioral) : foreach ($strength_behavioral as $str_comp) :
                                            $cbc_id = $str_comp['cbc_id'];  ?>
                                            <li class="black-border mb-1"> <input type="checkbox" name="strength_behavioral[]" value="<?php echo $cbc_id; ?>" /> <?= displayCoreComp($conn, $cbc_id) ?></li>
                                    <?php endforeach;


                                    else : echo "<p class='text-center'>---</p>";
                                    endif; ?>
                                </ul>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold">Select your Development Needs: </label>
                                <!-- DEVNEEDS -->
                                <ul>
                                    <?php if ($devneed_behavioral) : foreach ($devneed_behavioral as $devneed_comp) :
                                            $cbc_id = $devneed_comp['cbc_id'];
                                    ?>

                                            <li class="black-border mb-1"> <input type="checkbox" name="devneed_behavioral[]" value="<?php echo $cbc_id; ?>" /> <?= displayCoreComp($conn, $cbc_id) ?></li>
                                    <?php endforeach;
                                    else : echo "<p class='text-center'>---</p>";
                                    endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-dark text-white">
                            <p class="p-2 font-weight-bold">Action Plan (Recommended Developmental Intervention )</p>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="b_learning_objectives">Learning Objectives</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="b_learning_objectives" cols="30" rows="10" placeholder="Enter the Learning Objectives" required><?php echo $b_learn_obj ?? "" ?></textarea>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="b_intervention">Intervention</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="b_intervention" cols="30" rows="10" placeholder="Enter the Interventions" required><?php echo $b_intervention ?? "" ?></textarea>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col form-group">
                                <label class="font-weight-bold" for="b_timeline">Timeline</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="b_timeline" cols="30" rows="10" placeholder="Enter the Timeline" required><?php echo $b_timeline ?? "" ?></textarea>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold " for="b_resources_needed">Resources Needed</label>
                                <textarea wrap="soft" class="form-control border border-dark" name="b_resources_needed" cols="30" rows="10" placeholder="Enter the Resources Needed" required><?php echo $b_resource_needed ?? "" ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF B -->

            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <div class="p-3"><button name="create_dp_mt" class="font-weight-bold btn btn-success">Submit</button></div>
                    <div class="p-3"><button class="font-weight-bold btn btn-danger">Cancel</button></div>
                </div>

            </div>

        </div>
    </form>
</div>



<?php include 'samplefooter.php'; ?>