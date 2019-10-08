    <?php
    include_once 'includes/header.php';
    include_once 'includes/constants.inc.php';
    include_once 'includes/classautoloader.inc.php';
    include_once 'libraries/db.library.php';
    include_once 'libraries/func.lib.php';
    include_once 'includes/security.php';
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];
    ?>

    <body>
        <form action="includes/processratee.php" method="POST">
            <div class="container">
                <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                <div class="breadcome-list shadow-reset">

                    <div class="text-center h3"><strong>
                            <u>

                                Click Checkbox ☑ to select the Teacher(s) you want to Rate for SY <?php echo !empty($sy = $_SESSION['sy']) ?  $sy : $sy = ''; ?> </u>
                    </div>
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Teacher's Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <div class="card-body text-dark">
                            <?php
                            $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                            $query = 'SELECT * FROM account_tbl WHERE position IN ("Teacher I","Teacher II","Teacher III") AND rater IS NULL AND school_id = "' . $school_id . '"  AND `user_id` <> " ' . $user_id . ' "';
                            $teacherresults = fetchAll($dbcon, $query);
                            if (count($teacherresults)) :
                                foreach ($teacherresults as $teacher) :
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" class=" form-check-input" name="teacher[]" value="<?php echo $teacher['user_id'] ?>" /> <?php echo '- ' . $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname']; ?></td>
                                        <td><?php echo $teacher['position']; ?></td>
                                        <td><?php echo $teacher['email']; ?></td>
                                        <td><?php echo $teacher['contact']; ?></td>

                                <?php
                                    endforeach;
                                else :
                                    echo '<td colspan="4" align="center" class="text-danger"><b>No Data Record!</b></td>';
                                endif;
                                ?>

                                    </tr>

                                    <tr>
                                        <td colspan="4" align="center"><button name="btn-t" class="btn btn-info btn-block"><b>Submit</b></button></td>
                                    </tr>

                        </div>

                    </table>

                </div>
            </div>


        </form>
        <br> <br>

    </body>
    <?php

    include 'includes/footer.php';
    ?>

    </html>