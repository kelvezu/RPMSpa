    <?php
    include_once 'includes/header.php';
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];
    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $cotrating = mysqli_query($conn,'SELECT a_tcotrating_tbl.*,b_tcotrating_tbl.subject_id,b_tcotrating_tbl.gradelvltaught_id,b_tcotrating_tbl.comment FROM (a_tcotrating_tbl INNER JOIN b_tcotrating_tbl ON a_tcotrating_tbl.user_id = b_tcotrating_tbl.user_id AND a_tcotrating_tbl.obs_period = b_tcotrating_tbl.obs_period)') or die ($conn->error);
        while ($resultcot = mysqli_fetch_array($cotrating)){
            $rater = $resultcot['rater_id'];
            $date = $resultcot['date'];
            $tobserved = $resultcot['user_id'];
            $obs_period = $resultcot['obs_period'];
            $indicator_id = $resultcot['indicator_id'];
            $tcotrating = $resultcot['tcotrating'];
            $subject_id = $resultcot['subject_id'];
            $gradelvltaught = $resultcot['gradelvltaught_id'];
            $comment = $resultcot['comment'];
        }

    ?>

    <!-- MODAL VIEW FOR RATING -->
    <div class="modal fade" id="cot-modal" tabindex="-1" role="dialog" aria-labelledby="cotModal" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title " id="exampleModalLabel">COT Teacher Rating Sheet</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                   

                    <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br><br>
                    <h5><strong>COT-RPMS</strong></h5>


                    <div class="h3 bg-success">Teacher I-III
                    </div>

                    <h4>Rating Sheet</h4>

                </div>
                <table>
 
                        <tr>
                            <td class="h5">OBSERVER</td>
                            <td><?= $user_id ?? 'no name' ?></td>
                        </tr>
                        <tr>
                            <td class="h5">DATE</td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <tr>
                            <td class="h5">TEACHER OBSERVED</td>
                            <td><?php echo $tobserved; ?></td>
                        </tr>
                        <tr>
                            <td class="h5"> SUBJECT</td>
                        </tr>
                        <tr>
                            <td class="h5"> GRADE LEVEL TAUGHT</td>
                        </tr>
                        <tr>
                            <td class="h5">OBSERVATION PERIOD</td>
                        </tr>
                </table>
                    <br>
                
            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                <thead class="legend-control bg-success text-white ">

                
                <tr>
                            <th>Indicator No</th>
                            <th>Indicator Name</th>
                            <th>COT Rating</th>
                        </tr>
                    </thead>
                    <?php

                    ?>
                    <tbody>

                        <tr>
                            <td><?php echo $indicator_id; ?></td>
                           
                            <td>
                                <select name="rating">
                                    <option value="">--select--</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="3">NO*</option>
                                </select>

                            </td>

                        </tr>
                  
                    </tbody>

                    <?php

                    ?>

                </table>
                <textarea class="form-control" name="cot_comment" rows="5" placeholder="OTHER COMMENTS"><?php ?></textarea>
            </div>
        </div>
    </div>

    <body>
        <div class="container-fluid breadcome-list shadow-reset">
            <div class=" row">
                <div class="col-sm-6">
                    <!-- With rater -->

                    <div>
                        <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                        <div>
                            <div class=" h3"><strong>
                                    <u><?php echo $position ? switchRateeWord($position) : 'Teachers' ?> that you rate in Period 1 </u>
                            </div>

                            <!-- INSERT THE CONDITION AND THE TABLE HERE! -->

                            <?php
                            $results = RPMSDB\RPMSdb::teachersWithCOT1($conn);

                            if (!empty($results)) :
                                ?>
                                <table class="table table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Teacher's Name</th>
                                            <th>Position </th>
                                            <th>View COT</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php foreach ($results as $result) : ?>
                                                <td> <?php echo  $result['firstname'] . ' ' . substr($result['middlename'], 0, 1) . '. ' . $result['surname']; ?> </td>
                                                <td><?php echo $result['position'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary m-1 " data-toggle="modal" data-target="#cot-modal">View Rating </button>
                                                </td>

                                        </tr> <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php
                            else :
                                ?> <p class="red-notif-border text-center"><b>No Teacher Record.</b></p>

                            <?php

                            endif;
                            ?>
                            <!-- <p class="red-notif-border text-center"><b>No Teacher Record.</b></p>
                                    <?php
                                    //endif;
                                    ?> -->

                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <!-- Without rater -->

                    <div>
                        <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                        <div>
                            <div class=" h3"><strong>
                                    <u>
                                        <?php switchRateeWord($position) ?> with no rating in Period 1
                                    </u>
                            </div>

                            <?php

                            $noCotresults = RPMSDB\RPMSdb::teachersnoCOT1($conn);
                            if (!empty($noCotresults)) :
                                ?>

                                <table class="table table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Teacher's Name</th>
                                            <th>Position</th>
                                        </tr>
                                    </thead>
                                    <div class="card-body text-dark">
                                        <?php
                                            foreach ($noCotresults as $noCotresult) :
                                                ?>
                                            <tr>
                                                <td><?php echo $noCotresult['firstname'] . ' ' . substr($noCotresult['middlename'], 0, 1) . '. ' . $noCotresult['surname']; ?></td>
                                                <td><?php echo $noCotresult['position']; ?></td>
                                            <?php
                                                endforeach;
                                                ?>
                                            </tr>

                                    </div>
                                </table>
                            <?php
                            elseif (empty($noCotresult)) :
                                echo  '<p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                            else :
                                echo '<p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                            endif;
                            ?>
                        </div>
                    </div>

                </div>
            </div>




        </div>
        <br> <br>
    </body>

    <?php

    include 'includes/footer.php';
    ?>

    </html>