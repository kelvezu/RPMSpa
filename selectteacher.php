    <?php

    use RPMSdb\RPMSdb;

    include_once 'sampleheader.php';
    $school_id = $_SESSION['school_id'];
    $user_id = $_SESSION['user_id'];
    $dbcon = connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    ?>

    <body>
        <div class="container">
            <div class="row">
            <div class="col mx-5 mb-5">
                    <!-- Without rater -->
                    <form action="includes/processselectteacher.php" method="POST">
                        <div>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                            <!-- <input type="hidden" name="school_id" value=<?php //echo $_SESSION['school_id']; ?> /> -->
                            <div>
                                <div class="font-weight-bold">
                                    <h3 class="text-nowrap">Assign Teacher to School</h3>
                                </div>
                                <?php
                                $teacherresults = RPMSdb::displayVacantList($conn);
                                if (!empty($teacherresults)) :
                                    ?> <table class="table table-hover table-borderless table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Teacher's Name</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Select School</th>
                                            </tr>
                                        </thead>
                                        <div class="card-body text-dark">
                                            <?php
                                                foreach ($teacherresults as $teacher) : ?>
                                                <tr>
                                                    <td class="text-nowrap"><input  type="checkbox" class=" form-check-input" name="teacher[]" value="<?php echo $teacher['user_id'] ?>" /> <?php echo '- ' . $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname']; ?></td>
                                                    <td><?php echo $teacher['position']; ?></td>
                                                    <td><?= $teacher['status'] ?></td>
                                                    <td>
                                                        <select required name="school_id[]" class="form-control-sm">
                                                            <option>Select School</option>
                                                    <?php $school = showSchool($conn); foreach ($school as $sch):?>
                                                     <option value="<?= $sch['school_id'] ?>"> <?= $sch['school_name'] ?></option>
                                                    <?php endforeach; ?>
                                                        </select>
                                                    </td>
                                                <?php endforeach; ?>
                                                </tr>
                                                <tr>
                                                    <?php echo !empty($teacherresults) ? '<td colspan="4" align="center"><button name="btn-t" class="btn btn-info btn-block btn-sm"><b>Submit</b></button></td>' : false ?>
                                                </tr>
                                        </div>
                                    </table>
                                <?php
                                elseif (empty($teacherresults)) :
                                    echo  '<p class="red-notif-border text-center"><b>No Record.</b></p>';
                                else :
                                    echo '<p class="red-notif-border text-center"><b>No Teachers to Rate.</b></p>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col mx-5">
                    <!-- With rater -->
                    <form action="includes/processselectteacher.php" method="POST">
                        <div>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                            <input type="hidden" name="school_id" value=<?php echo $_SESSION['school_id']; ?> />
                            <div>
                                <div class=" h3"><strong>
                                        Master List of Teachers
                                </div>
                                <!-- INSERT THE CONDITION AND THE TABLE HERE! -->
                                <form action="includes/processselectteacher.php" method="POST">
                                    <?php

                                    $fetchRateeresults = RPMSdb::displayMasterList($conn, $_SESSION['school_id']);
                                    if (!empty($fetchRateeresults)) :
                                        ?>
                                        <table class="table table-hover table-borderless table-sm">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Teacher's Name</th>
                                                    <th>Position </th>
                                                    <th>School</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($fetchRateeresults as $rateeresult) : ?>
                                                        <td class="text-nowrap"> <?= fullnameFormat($rateeresult['firstname'], $rateeresult['middlename'], $rateeresult['surname']) ?> </td>
                                                        <td class="text-nowrap"><?php echo $rateeresult['position'] ?></td>
                                                        <td class="text-nowrap"><?=  displaySchool($conn,$rateeresult['school_id']) ?></td>

                                                        <td>
                                                            <form action="includes/processselectteacher.php" method="post">
                                                                <input type="hidden" name="remove_user" value="<?php echo $rateeresult['user_id']; ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm" name="remove"><b>Remove</b></button>
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
             
            </div>




        </div>
        <br> <br>
    </body>
    <?php

    include 'samplefooter.php';
    ?>

    </html>