<?php

include 'sampleheader.php';

?>

    <div class="container text-center">
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
                                <label>OBSERVER:</label>&nbsp;
                                <input type="text" name="rater" value="<?php echo displayname($conn, $rater_id); ?>">
                            </div>

                            <div class="col-lg-6">
                                <label>DATE:</label>
                                <?php echo $date; ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label>OBSERVER 2:</label>&nbsp;
                                <input type="text" name="rater" value="<?php echo displayname($conn, $rater_id2); ?>">
                            </div>

                            <div class="col-lg-6">
                               
                            <label>
                                    TEACHER OBSERVED:
                                </label>
                                <input type="text" name="tobserved" value="<?php echo displayname($conn, $tobserved); ?>">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                            <label>OBSERVER 3:</label>&nbsp;
                                <input type="text" name="rater" value="<?php echo displayname($conn, $rater_id3); ?>">
                            </div>

                            <div class="col-lg-6">
                                <label>
                                    SUBJECT:
                                </label>
                                <input type="text" name="subject" value="<?php echo $subject; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="gradeleveltaught">
                                    GRADE LEVEL TAUGHT:
                                </label>
                                <input type="text" name="subject" value="<?php echo $gradelvltaught; ?>">
                            </div>

                            <div class="col-lg-6">

                                <label for="obsperiod" class="col-form-label">
                                    OBSERVATION PERIOD:
                                </label>

                                <input type="text" name="subject" value="<?php echo $obs_period; ?>">
                            </div>
                            <br>
                        </div>
                    </div>
                </h5>


                <table class="table table-responsive-sm">
                    <thead class="bg-success text-left ">
                        <tr>
                            <th>Indicator No</th>
                            <th>Indicator Name</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <?php
                        $indicator_no = 1;
                        $query1 = $conn->query('SELECT tindicator_tbl.indicator_name,a_tioafrating_tbl.* FROM (a_tioafrating_tbl INNER JOIN tindicator_tbl ON a_tioafrating_tbl.indicator_id = tindicator_tbl.indicator_id) WHERE a_tioafrating_tbl.user_id = ' . $user_id . '');
                        while ($rows = $query1->fetch_assoc()) :

                            $indicator_name = $rows['indicator_name'];
                            $tcotrating = $rows['tioafrating'];
                            ?>
                        <tbody>
                            <tr>
                                <td><?php echo $indicator_no; ?></td>
                                <td><?php echo $indicator_name; ?></td>
                                <td><?php echo $tcotrating; ?></td>
                            </tr>
                        </tbody>
                    <?php
                            $indicator_no++;
                        endwhile; ?>
                </table>
                <textarea class="form-control" name="cot_comment" rows="5" placeholder="OTHER COMMENTS"><?php echo $comment; ?></textarea><br>

        </div>
    </div>

    </form>
    <br>
<?php 
include 'samplefooter.php';
?>