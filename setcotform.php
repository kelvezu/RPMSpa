<?php

include 'includes/conn.inc.php';
include 'includes/header.php';
include_once 'libraries/func.lib.php';

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <form action="includes/processtioafform.php" method="POST">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
            <h5>COT-RPMS</h5>

            <div class="h3 bg-success text-white">Teacher I-III</div>
            <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

            <h4> Classroom Observation Rating Form</h4>
            <h5 class="text-left">

                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 1: </label>&nbsp;
                            <?php echo $fullname; ?>
                        </div>

                        <div class="col-lg-6">
                            <label>DATE:</label>
                            <?php echo date("Y/m/d"); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 2: </label>&nbsp;
                            <select name="observer2">
                                <option value="<?= NULL ?>">Select Observer</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];

                                $queryObserver2 = mysqli_query($conn, 'SELECT * FROM account_tbl WHERE `user_id` != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV","School Head","Principal") ') or die($conn->error);

                                if ($queryObserver2) :
                                    while ($row = $queryObserver2->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'];
                                        ?>

                                        <option value="<?= $row['user_id'] ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>
                                <?php
                                endif; ?>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label>TEACHER OBSERVED: </label>
                            <select name="tobserved" required="required">
                                <option value="" disabled selected>--Select Teacher--</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];
                                $queryObserved = $conn->query('SELECT * FROM account_tbl WHERE  rater =  ' . $rater . '  AND  position  IN ("Teacher I","Teacher II","Teacher III") ') or die($conn->error);

                                if ($queryObserved) :
                                    while ($row = $queryObserved->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'];
                                        ?>

                                        <option value="<?php echo $row['user_id']; ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>
                                <?php
                                endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 3: </label>&nbsp;
                            <select name="observer3">
                                <option value="<?= NULL ?>">Select Observer</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];

                                $queryObserver3 = $conn->query('SELECT * FROM account_tbl WHERE user_id != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV","School Head","Principal") ') or die($conn->error);

                                if ($queryObserver3) :
                                    while ($row = $queryObserver3->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'];
                                        ?>

                                        <option value="<?php echo $row['user_id']; ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>
                                <?php
                                endif; ?>
                            </select>
                            </select>
                        </div>



                        <div class="col-lg-6">
                            <label>
                                SUBJECT:
                            </label>
                            <select name="tsubject" required="required">
                                <option value="" disabled selected>--Select Subject--</option>
                                <?php
                                $querySubject = $conn->query('SELECT * FROM subject_tbl') or die($conn->error);
                                while ($subjrow = $querySubject->fetch_assoc()) :
                                    $subject_id = $subjrow['subject_id'];
                                    $subject = $subjrow['subject_name'];
                                    ?>
                                    <option value=" <?php echo $subject_id; ?>"><?php echo $subject; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="gradeleveltaught">
                                GRADE LEVEL TAUGHT:
                            </label>
                            <select name="tgradelvltaught" required="required">
                                <option value="" disabled selected>--Select Grade Level Taught--</option>
                                <?php
                                $queryGlt = $conn->query('SELECT * FROM gradelvltaught_tbl') or die($conn->error);
                                while ($gradelvltaught = $queryGlt->fetch_assoc()) :
                                    $glt_id = $gradelvltaught['gradelvltaught_id'];
                                    $glt = $gradelvltaught['gradelvltaught_name'];
                                    ?>
                                    <option value=" <?php echo $glt_id; ?>"><?php echo $glt; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <script>
                            function showIndicator(str) {
                                if (str == "") {
                                    document.getElementById("show").innerHTML = "";
                                    return;
                                } else {
                                    if (window.XMLHttpRequest) {
                                        // code for IE7+, Firefox, Chrome, Opera, Safari
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        // code for IE6, IE5
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("show").innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    // getuser.php is seprate php file. q is parameter 
                                    xmlhttp.open("GET", "ajaxtioaf.php?period=" + str, true);
                                    xmlhttp.send();
                                }
                            }

                            var $observer2 = $("select[name='observer2']");
                            var $observer3 = $("select[name='observer3']");
                            $observer2.change(function() {
                                var selectedItem = $(this).val();
                                var $options = $("select[name='observer2'] > option").clone();
                                $("select[name='observer3']").html($options);
                                $("select[name='observer3'] > option[value=" + selectedItem + "]").remove();
                            });
                        </script>
                        <div class="col-lg-6">

                            <label for="obsperiod" class="col-form-label">
                                OBSERVATION PERIOD:
                            </label>

                            <?php
                            $date = date('Y/m/d');
                            $intdate = intval(strtotime($date));
                            $first_period_int = intval(strtotime($_SESSION['first_period']));
                            $second_period_int = intval(strtotime($_SESSION['second_period']));
                            $third_period_int = intval(strtotime($_SESSION['third_period']));
                            $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                            if ($intdate >= $fourth_period_int) :
                                $period = "4th";
                            elseif ($intdate >= $third_period_int) :
                                $period = "3rd";
                            elseif ($intdate >= $second_period_int) :
                                $period = "2nd";
                            elseif ($intdate >= $first_period_int) :
                                $period = "1st";
                            else :
                                $period = "Invalid Period";
                            endif;
                            ?>

                            <input type="text" name="obs" value="<?php echo $period; ?>" disabled />
                        </div>

                        <br>

                        <?php
                        $date = date('Y/m/d');
                        $intdate = intval(strtotime($date));
                        $first_period_int = intval(strtotime($_SESSION['first_period']));
                        $second_period_int = intval(strtotime($_SESSION['second_period']));
                        $third_period_int = intval(strtotime($_SESSION['third_period']));
                        $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                        if ($intdate >= $fourth_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period4=1';
                        elseif ($intdate >= $third_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period3=1';
                        elseif ($intdate >= $second_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period2=1';
                        elseif ($intdate >= $first_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period1=1';
                        else :
                            echo 'invalid period!';
                        endif;

                        $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                        $resultqry = $conn->query($periodqry)  or die($conn->error);
                        ?>


                        <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                            <thead class="legend-control bg-success text-white ">
                                <tr>
                                    <th>Indicator No</th>
                                    <th>Indicator Name</th>
                                    <th>COT Rating</th>
                                </tr>
                            </thead>

                            <?php
                            $indicator_no = 1;
                            while ($row = $resultqry->fetch_assoc()) :
                                ?>


                                <input type="hidden" name="indicator_id[]" value="<?php echo $row['indicator_id']; ?>" />
                                <input type="hidden" name="indicator_name[]" value="<?php echo $row['indicator_name']; ?>" />

                                <tbody>
                                    <tr>
                                        <td><?php echo $row['indicator_id']; ?></td>
                                        <td><?php echo $row['indicator_name']; ?></td>
                                        <td>
                                            <select name="rating[]" required="required">
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="3">NO*</option>
                                            </select>

                                        </td>


                                    <?php
                                        $indicator_no++;
                                    endwhile;
                                    ?>
                                </tbody>
                                </tr>
                        </table>
                    </div>
                </div>


            </h5>



            <textarea class="form-control" name="ioaf_comment" rows="5" placeholder="OTHER COMMENTS" required="required"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>

    </div>
</div>
</form>
<br>

<?php

include 'includes/footer.php';
?>