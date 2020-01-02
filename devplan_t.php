<?php

use DevPlan\DevPlan;

include 'sampleheader.php';
$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$school = $_SESSION['school_id'];
$position = $_SESSION['position'];
$str_objective_table = 'devplanmt_a1_strength_tbl';
$devneed_objective_table = 'devplanmt_a2_devneeds_tbl';
$devplan = new DevPlan($user, $sy, $school, $position);
$strength_objective = $devplan->fetch_dp($str_objective_table);
$devneed_objective = $devplan->fetch_dp($devneed_objective_table);


// pre_r($strength_objective);
?>


<div class="container">
    <div class="card">
        <div class="card-header">
            header
        </div>
        <div class="card-body">
            <table class="table table-sm table-responsive-sm table-bordered text-justify">
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
                    </tr>

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
                            <!-- STRENGTH -->
                            <?php if ($strength_objective) : foreach ($strength_objective as $str_obj) : ?>

                            <?php endforeach;
                            else : echo "<p class='text-center'>---</p>";
                            endif; ?>
                        </td>

                        <td>
                            <!-- DEVNEEDS -->
                            <?php if ($devneed_objective) : foreach ($devneed_objective as $str_obj) : ?>

                            <?php endforeach;
                            else : echo "<p class='text-center'>---</p>";
                            endif; ?>
                        </td>

                        <td>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores placeat libero error quaerat, sit illum ab atque consequuntur iste similique!</p>
                        </td>

                        <td>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi sunt quaerat, quia ipsa corporis impedit ipsam illo obcaecati rem quis?</p>
                        </td>

                        <td>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </td>

                        <td>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor earum ad incidunt vel animi maiores quidem repudiandae, consequatur, eum at asperiores cum ut et quasi ea, beatae consequuntur neque delectus?</p>
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
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil nesciunt dolores, nobis incidunt necessitatibus assumenda ex animi corporis culpa ad deserunt veniam voluptatem recusandae voluptates dicta repudiandae, autem laborum alias!
                            </p>
                        </td>

                        <td>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, maiores!</p>
                        </td>

                        <td>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores placeat libero error quaerat, sit illum ab atque consequuntur iste similique!</p>
                        </td>

                        <td>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi sunt quaerat, quia ipsa corporis impedit ipsam illo obcaecati rem quis?</p>
                        </td>

                        <td>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </td>

                        <td>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor earum ad incidunt vel animi maiores quidem repudiandae, consequatur, eum at asperiores cum ut et quasi ea, beatae consequuntur neque delectus?</p>
                        </td>
                    </tr>
                </tbody>



            </table>
        </div>
    </div>

    <div class="card-footer">

    </div>

</div>



<?php include 'samplefooter.php'; ?>