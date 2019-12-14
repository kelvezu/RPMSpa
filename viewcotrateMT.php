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

                    <div>
                        <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id']; ?> />
                        <div>
                            <div class=" h3"><strong>
                                    <u><?php echo $position ? switchRateeWord($position) : 'Teachers' ?> that you rate in Period 1 </u>
                            </div>

                            <!-- INSERT THE CONDITION AND THE TABLE HERE! -->

                            <?php
                            $results = RPMSDB\RPMSdb::masterteachersWithCOT1($conn);

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
                                                    <a href="viewmtcotrate.php?view=<?php echo $result['user_id']; ?>" class="btn btn-primary" role="button">View Rating </a>
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

                            $noCotresults = RPMSDB\RPMSdb::masterteachersnoCOT1($conn);
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