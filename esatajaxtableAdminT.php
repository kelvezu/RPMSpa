<?php
include_once 'includes/conn.inc.php';
include_once 'libraries/func.lib.php';

if (isset($_GET['sy']) and isset($_GET['sch'])) :
    $sy = $_GET['sy'];
    $school = $_GET['sch'];
    $qry = $conn->query("SELECT * FROM `esat1_demographicst_tbl` WHERE sy = '$sy' AND school = '$school'");

endif;



?>

<div class="card text-center">
    <!-- Age Table -->

    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Age</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Age</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT age_tbl.age_name, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl INNER JOIN age_tbl age_tbl on esat1_demographicst_tbl.age = age_tbl.age_name WHERE sy = '$sy' AND school = '$school' GROUP BY age_tbl.age_name");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['age_name']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- End of Age Table -->

    <!-- Gender Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Gender</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">

                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Gender</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT esat1_demographicst_tbl.gender, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl  WHERE sy = '$sy' AND school = '$school' GROUP BY gender");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['gender']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- End of Gender Table -->

    <!-- Employment Status Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Employment Status</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Employment Status</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT esat1_demographicst_tbl.employment_status, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy' AND school = '$school' GROUP BY esat1_demographicst_tbl.employment_status");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['employment_status']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Employment Status Table -->

    <!-- Position Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Position</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT esat1_demographicst_tbl.position, COUNT(esat1_demographicst_tbl.user_id)total FROM  esat1_demographicst_tbl WHERE sy = '$sy' AND school = '$school' GROUP BY esat1_demographicst_tbl.position ORDER BY esat1_demographicst_tbl.position desc");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['position']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Position Table -->

    <!-- Highest Degree Obtained Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Highest Degree Obtained</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Highest Degree Obtained</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT esat1_demographicst_tbl.highest_degree, COUNT(esat1_demographicst_tbl.user_id) total FROM esat1_demographicst_tbl WHERE sy = '$sy' AND school = '$school' GROUP BY esat1_demographicst_tbl.highest_degree");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['highest_degree']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Highest Degree Obtained Table -->

    <!-- Total Number of Years in Teaching Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Total Number of Years in Teaching</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Total Number of Years in Teaching</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT totalyear_tbl.totalyear_name,COUNT(esat1_demographicst_tbl.user_id)total from esat1_demographicst_tbl INNER JOIN totalyear_tbl on esat1_demographicst_tbl.totalyear=totalyear_tbl.totalyear_id WHERE sy = '$sy' AND school = '$school' GROUP BY totalyear_tbl.totalyear_name");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['totalyear_name']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Total Number of Years in Teaching Table -->

    <!-- Subject Taught Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Subject Taught</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Subject Taught</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $qry = $conn->query("SELECT subject_tbl.subject_name, COUNT(esat1_demographicst_tbl.user_id)total, esat1_demographicst_tbl.* FROM esat1_demographicst_tbl INNER JOIN subject_tbl ON esat1_demographicst_tbl.subject_taught LIKE CONCAT('%', subject_tbl.subject_name, '%') WHERE sy = '$sy' AND school = '$school' GROUP BY subject_tbl.subject_name ");

                        foreach ($qry as $row) :

                            ?>
                            <tr>
                                <td><?php echo $row['subject_name']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                            <?php endforeach; ?>

                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Subject Taught Table -->

    <!-- Grade Level Taught Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Grade Level Taught</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Grade Level Taught</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $qry = $conn->query("SELECT gradelvltaught_tbl.gradelvltaught_name, COUNT(esat1_demographicst_tbl.user_id)total FROM gradelvltaught_tbl INNER JOIN esat1_demographicst_tbl ON esat1_demographicst_tbl.grade_lvl_taught LIKE CONCAT('%', gradelvltaught_tbl.gradelvltaught_id, '%') WHERE sy = '$sy' AND school = '$school' GROUP BY gradelvltaught_tbl.gradelvltaught_name");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['gradelvltaught_name']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            <?php endwhile; ?>
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Grade Level Taught Table -->


    <!-- Curricular Class of School Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Curricular Class of School</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Curricular Class</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $qry = $conn->query("SELECT curriclass_tbl.curriclass_name,COUNT(DISTINCT esat1_demographicst_tbl.user_id)total FROM esat1_demographicst_tbl INNER JOIN curriclass_tbl ON esat1_demographicst_tbl.curri_class = curriclass_tbl.curriclass_id WHERE sy = '$sy' AND school = '$school' GROUP BY curriclass_tbl.curriclass_name");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['curriclass_name']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            <?php endwhile; ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- End of Curricular Class of School Table -->

    <!-- Region Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">Region</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm">
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th>No. of Teacher</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $qry = $conn->query("SELECT *,region_tbl.region_name, COUNT(esat1_demographicst_tbl.user_id)total from region_tbl INNER JOIN esat1_demographicst_tbl ON region_tbl.reg_id = esat1_demographicst_tbl.region WHERE sy = '$sy' AND school = '$school' GROUP BY region_tbl.region_name");
                        while ($esatresult = $qry->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $esatresult['region_name']; ?></td>
                                <td><?php echo $esatresult['total']; ?></td>
                            <?php endwhile; ?>
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--End of Region Table -->

    <!-- SELF ASSESSMENT OF TEACHER I-III Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">SELF ASSESSMENT OF TEACHER I-III</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm text-nowrap">
                    <thead>
                        <tr>
                            <td></td>
                            <td colspan="4"><strong>LEVEL OF CAPABILITY</strong></td>
                            <td colspan="4"><strong>LEVEL OF PRIORITY</strong></td>
                        </tr>
                        <tr>
                            <th width="auto">OBJECTIVES</th>
                            <th width="auto">LOW</th>
                            <th width="auto">MODERATE</th>
                            <th width="auto">HIGH</th>
                            <th width="auto">VERY HIGH</th>
                            <th width="auto">LOW</th>
                            <th width="auto">MODERATE</th>
                            <th width="auto">HIGH</th>
                            <th width="auto	">VERY HIGH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT *,CONCAT(tobj_tbl.kra_id,'.',tobj_tbl.tobj_id) 
                            AS OBJECTIVES, 
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 1 then count(DISTINCT user_id) END AS L_LOW,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 2 then count(DISTINCT user_id) END AS L_MODERATE,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 3 then count(DISTINCT user_id) END AS L_HIGH,
                            CASE WHEN esat2_objectivest_tbl.lvlcap = 4 then count(DISTINCT user_id) END AS L_VERY_HIGH,
                            
                            CASE WHEN esat2_objectivest_tbl.priodev = 1 then count(DISTINCT user_id) END AS P_LOW,
                            CASE WHEN esat2_objectivest_tbl.priodev = 2 then count(DISTINCT user_id) END AS P_MODERATE,
                            CASE WHEN esat2_objectivest_tbl.priodev = 3 then count(DISTINCT user_id) END AS P_HIGH,
                            CASE WHEN esat2_objectivest_tbl.priodev = 4 then count(DISTINCT user_id) END AS P_VERY_HIGH
                           
                            FROM tobj_tbl INNER JOIN esat2_objectivest_tbl ON tobj_tbl.tobj_id = esat2_objectivest_tbl.tobj_id
                            WHERE sy = '$sy' AND school = '$school'
                        group by tobj_tbl.kra_id,tobj_tbl.tobj_id") or die($conn->error . $qry);
                        foreach ($qry as $result) :
                            ?>
                            <tr>
                                <td><?php echo $result['OBJECTIVES']; ?></td>
                                <td><?php echo $result['L_LOW']; ?></td>
                                <td><?php echo $result['L_MODERATE']; ?></td>
                                <td><?php echo $result['L_HIGH']; ?></td>
                                <td><?php echo $result['L_VERY_HIGH']; ?></td>
                                <td><?php echo $result['P_LOW']; ?></td>
                                <td><?php echo $result['P_MODERATE']; ?></td>
                                <td><?php echo $result['P_HIGH']; ?></td>
                                <td><?php echo $result['P_VERY_HIGH']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- SELF ASSESSMENT OF TEACHER I-III Table-->

    <!-- CORE BEHAVIORAL COMPETENCIES Table -->
    <div class="card-header bg-success">
        <div class=" text-center h4 text-white">CORE BEHAVIORAL COMPETENCIES</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered hover table-sm text-nowrap">
                    <thead>
                        <tr>
                            <th width="auto">Core Behavioral Competencies</th>
                            <th width="auto">1-SCALE</th>
                            <th width="auto">2-SCALE</th>
                            <th width="auto">3-SCALE</th>
                            <th width="auto">4-SCALE</th>
                            <th width="auto">5-SCALE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT *,core_behavioral_tbl.cbc_name, 
                                CASE WHEN(a.score)=1 THEN COUNT(a.user_id) end as score1,
                                CASE WHEN(a.score)=2 THEN COUNT(a.user_id) end as score2,
                                CASE WHEN(a.score)=3 THEN COUNT(a.user_id) end as score3,
                                CASE WHEN(a.score)=4 THEN COUNT(a.user_id) end as score4,
                                CASE WHEN(a.score)=5 THEN COUNT(a.user_id) end as score5
                                FROM
                                (
                                select sy,school,cbc_id, user_id,sum(cbc_score)score FROM esat3_core_behavioralt_tbl GROUP BY cbc_id
                                ) a
                                INNER JOIN core_behavioral_tbl on a.cbc_id = core_behavioral_tbl.cbc_id
                                WHERE sy = '$sy' AND school = '$school'
                                GROUP BY core_behavioral_tbl.cbc_name") or die($conn->error . $qry);
                        foreach ($qry as $result) :
                            ?>
                            <tr>
                                <td><?php echo $result['cbc_name']; ?></td>
                                <td><?php echo $result['score1']; ?></td>
                                <td><?php echo $result['score2']; ?></td>
                                <td><?php echo $result['score3']; ?></td>
                                <td><?php echo $result['score4']; ?></td>
                                <td><?php echo $result['score5']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--CORE BEHAVIORAL COMPETENCIES -->


    <!-- End tag of card -->
</div>