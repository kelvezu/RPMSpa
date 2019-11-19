<?php

include 'includes/header.php';

// if (isset($_GET['view'])) {
//     $user_id = $_GET['view'];



$query = $conn->query('SELECT tindicator_tbl.indicator_id,tindicator_tbl.indicator_name,a_tioafrating_tbl.* FROM (a_tioafrating_tbl INNER JOIN tindicator_tbl ON a_tioafrating_tbl.indicator_id = tindicator_tbl.indicator_id) WHERE a_tioafrating_tbl.user_id = 32 ');
while ($row = $query->fetch_assoc()) :
    $rater_id = $row['rater_id1'];
    $rater_id2 = $row['rater_id2'] ?? "NULL";
    $rater_id3 = $row['rater_id3'] ?? "NULL";
    $date = $row['date'];
    $tobserved = $row['user_id'];
    $obs_period = $row['obs_period'];
    $sy = $row['sy'];
    $school = $row['school_id'];

endwhile;
?>

<div class="container">
    <div class="breadcome-list shadow-reset">
        <form action="" method="POST" name="myForm">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br><br>
            <h5><strong>COT-RPMS</strong></h5>
            <div class="h3 bg-success">Teacher I-III</div>
            <input type="hidden" name="rater_id" value="<?php echo $rater_id; ?>" />
            <input type="hidden" name="sy" value="<?php echo $sy; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $school; ?>" />

            <h4>Rating Sheet</h4>
            <h5 class="text-left">

                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>
                                TEACHER OBSERVED:
                            </label>
                            <input type="text" name="tobserved" value="<?php echo displayname($conn, $tobserved); ?>">

                        </div>
                        <div class="col-lg-6">
                            <label>OBSERVER:</label>&nbsp;
                            <input type="text" name="rater" value="<?php echo displayname($conn, $rater_id); ?>">

                        </div>

                    </div>


                </div>
            </h5>


            <table class="table table-responsive-sm">
                <thead class="bg-success text-left ">

                    <tr>

                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th rowspan="2">1</th>
                        <th rowspan="2">2</th>
                        <th rowspan="2">3</th>
                        <th rowspan="2">4</th>
                        <th>Average</th>

                    </tr>

                </thead>
                <?php
                $query1 = $conn->query('SELECT * FROM tindicator_tbl ');
                while ($rows = $query1->fetch_assoc()) :
                    $indicator_no = $rows['indicator_id'];
                    $indicator_name = $rows['indicator_name'];



                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $indicator_no; ?></td>
                            <td><?php echo $indicator_name; ?></td>
                            <td><?= $obs1 = showObsRating($conn, 1, $indicator_no) ?? "-" ?></td>
                            <td><?= $obs2 = showObsRating($conn, 2, $indicator_no) ?? "-" ?></td>
                            <td><?= $obs3 = showObsRating($conn, 3, $indicator_no) ?? "-" ?></td>
                            <td><?= $obs4 = showObsRating($conn, 4, $indicator_no) ?? "-" ?></td>
                            <td><?= showObsAverage($obs1, $obs2, $obs3, $obs4)  ?></td>

                        </tr>
                    </tbody>
                <?php
                    $indicator_no++;
                endwhile; ?>
            </table>




    </div>
</div>

</form>
<br>
<?php
include 'includes/footer.php';
?>