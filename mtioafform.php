<?php

include 'includes/conn.inc.php';
include 'includes/header.php';
include_once 'libraries/func.lib.php';

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <form action="includes/processmtioafform.php" method="POST">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
            <h5>COT-RPMS</h5>

            <div class="h3 bg-info text-white">Master Teacher I-IV</div>
            <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

            <h4> Inter-Observer Agreement Form</h4>
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
                                <option value="<?= NULL ?>" disabled selected>Select Observer</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];

                                $queryObserver2 = $conn->query('SELECT * FROM account_tbl WHERE user_id != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("School Head","Principal") ') or die($conn->error);

                                if ($queryObserver2) :
                                    while ($row = $queryObserver2->fetch_assoc()) :
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

                        <div class="col-lg-6">
                            <label>MASTER TEACHER OBSERVED: </label>
                            <select name="mtobserved" required="required">
                                <option value="" disabled selected>Select Master Teacher</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];
                                $queryObserved = $conn->query('SELECT * FROM account_tbl WHERE  rater =  ' . $rater . '  AND  position  IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV") ') or die($conn->error);

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

                                $queryObserver3 = $conn->query('SELECT * FROM account_tbl WHERE user_id != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("School Head","Principal") ') or die($conn->error);

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
                            <select name="mtsubject" required="required">
                                <option value="" disabled selected>Select Subject</option>
                                <?php
                                $querySubject = $conn->query('SELECT * FROM subject_tbl') or die($conn->error);
                                while ($subjrow = $querySubject->fetch_assoc()) :
                                    $subject_id = $subjrow['subject_id'];
                                    $subject = $subjrow['subject_name'];
                                    ?>
                                    <option value="<?php echo $subject_id; ?>"><?php echo $subject; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="gradeleveltaught">
                                GRADE LEVEL TAUGHT:
                            </label>
                            <select name="mtgradelvltaught" required="required">
                                <option value="" disabled selected>Select Grade Level Taught</option>
                                <?php
                                $queryGlt = $conn->query('SELECT * FROM gradelvltaught_tbl') or die($conn->error);
                                while ($gradelvltaught = $queryGlt->fetch_assoc()) :
                                    $glt_id = $gradelvltaught['gradelvltaught_id'];
                                    $glt = $gradelvltaught['gradelvltaught_name'];
                                    ?>
                                    <option value="<?php echo $glt_id; ?>"><?php echo $glt; ?></option>
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
                                    xmlhttp.open("GET", "ajaxmtioaf.php?period=" + str, true);
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

                            <select name="mtobs" onchange="showIndicator(this.value)" required="required">
                                <option value="" disabled selected>Select Period</option>
                                <option value="1">1st</option>
                                <option value="2">2nd</option>
                                <option value="3">3rd</option>
                                <option value="4">4th</option>
                            </select>
                        </div>

                        <br>
                        <div id="show">

                        </div>


                    </div>
                </div>


            </h5>



            <textarea class="form-control" name="mtioaf_comment" rows="5" placeholder="OTHER COMMENTS" required="required"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>

    </div>
</div>
</form>
<br>

<?php

include 'includes/footer.php';
?>