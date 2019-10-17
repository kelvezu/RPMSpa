    <?php
    include_once 'includes/header.php';
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];
    ?>

    <body>

        <div class="container breadcome-list shadow-reset">
            <div class=" row">
                <div class="col-sm-6">
                    <!-- With rater -->
                    <form action="includes/processratee.php" method="POST">
                        <div>
                            <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                            <div>
                                <div class=" h3"><strong>
                                        <u><?php echo switchRateeWord($position) ?> that you rate: </u>
                                </div>
                                <!-- INSERT THE CONDITION AND THE TABLE HERE! -->
                                <div>
                                    <small><b>Direction: </b><i>Click the checkbox of the teacher you want to rate.</i> </small>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <!-- Without rater -->
                    <?php
                    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    $query = 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $school_id . '"  AND `user_id` <> " ' . $user_id . ' "';
                    $teacherresults = fetchAll($dbcon, $query);
                    if (!empty($teacherresults)) :
                        ?>
                        <form action="includes/processratee.php" method="POST">
                            <div>
                                <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                                <div>
                                    <div class=" h3"><strong>
                                            <u>
                                                <?php switchRateeWord($position) ?> with no Rater
                                                for SY <?php echo !empty($sy = $_SESSION['sy']) ?  $sy : $sy = '';
                                                            ?> </u>
                                    </div>
                                    <div>
                                        <small><b>Direction: </b><i>Click the checkbox of the teacher you want to rate.</i> </small>
                                    </div>
                                    <table class="table table-hover table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Teacher's Name</th>
                                                <th>Position</th>
                                            </tr>
                                        </thead>
                                        <div class="card-body text-dark">
                                            <?php
                                                foreach ($teacherresults as $teacher) :
                                                    ?>
                                                <tr>
                                                    <td><input type="checkbox" class=" form-check-input" name="teacher[]" value="<?php echo $teacher['user_id'] ?>" /> <?php echo '- ' . $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname']; ?></td>
                                                    <td><?php echo $teacher['position']; ?></td>
                                                <?php
                                                    endforeach;
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php echo !empty($teacherresults) ? '<td colspan="4" align="center"><button name="btn-t" class="btn btn-info btn-block"><b>Submit</b></button></td>' : false ?>
                                                </tr>
                                        </div>
                                    </table>
                                <?php
                                elseif (empty($teacherresults)) :
                                    echo '<div class=" h3"><strong><u>';
                                    echo switchRateeWord($position) . ' with no Rater ';
                                    echo  'SY: ' . (!empty($sy = $_SESSION['sy']) ?  $sy : $sy = '');
                                    echo  '</u></div><p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                                else :
                                    echo '<td align="center" class="text-danger text-center"><b>No Data Record!</b></td>';
                                endif;

                                ?>

                                </div>
                            </div>


                        </form>
                </div>
            </div>



            <br> <br>

    </body>
    <?php

    include 'includes/footer.php';
    ?>

    </html>