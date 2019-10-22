    <?php
    include_once 'includes/header.php';
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];
    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    ?>

    <body>
        <div class="container-fluid breadcome-list shadow-reset">
            <div class=" row">
                <div class="col-sm-6">
                    <!-- With rater -->
                    <form action="includes/processratee.php" method="POST">
                        <div>
                            <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                            <div>
                                <div class=" h3"><strong>
                                        <u><?php echo $position ? switchRateeWord($position) : 'Teachers' ?> that you rate </u>
                                </div>
                                <div>
                                    <small><i>List of <?php echo  $position ? switchRateeWord($position) : 'Teachers' ?> that you handle for <?php echo $_SESSION['sy'] ?? 'this year.' ?> </i> </small>
                                </div>
                                <!-- INSERT THE CONDITION AND THE TABLE HERE! -->
                                <form action="includes/processratee.php" method="POST">
                                    <?php
                                    $showratee = showRatee($_SESSION['position']);
                                    $fetchRateeresults = fetchAll($dbcon, $showratee);
                                    if (!empty($fetchRateeresults)) :
                                        ?>
                                        <table class="table table-hover table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Teacher's Name</th>
                                                    <th>Position </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($fetchRateeresults as $rateeresult) : ?>
                                                        <td> <?php echo  $rateeresult['firstname'] . ' ' . substr($rateeresult['middlename'], 0, 1) . '. ' . $rateeresult['surname']; ?> </td>
                                                        <td><?php echo $rateeresult['position'] ?></td>

                                                        <td>
                                                            <form action="includes/processratee.php" method="post">
                                                                <input type="hidden" name="remove_user" value="<?php echo $rateeresult['user_id']; ?>">
                                                                <button class="btn btn-danger btn-sm" name="remove"><b>Remove</b></button>
                                                            </form>
                                                        </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    else :
                                        ?>
                                        <p class="red-notif-border text-center"><b>No Teacher Record.</b></p>

                                    <?php

                                    endif;
                                    ?>
                                    <!-- <p class="red-notif-border text-center"><b>No Teacher Record.</b></p>
                                    <?php
                                    //endif;
                                    ?> -->
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <!-- Without rater -->
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
                                <?php

                                $teacherresults = fetchAll($dbcon, showNoRater($_SESSION['position']));
                                if (!empty($teacherresults)) :
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
                                    echo  '<p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                                else :
                                    echo '<p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
        <br> <br>
    </body>
    <?php

    include 'includes/footer.php';
    ?>

    </html>