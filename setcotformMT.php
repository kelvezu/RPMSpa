<?php

include 'sampleheader.php';
include_once 'libraries/func.lib.php';


$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);

if (isset($_GET['notif'])) :
    if ($_GET['notif'] == "success") :
        echo '<div class="green-notif-border">Classroom Observation has been submitted!</div>';
    elseif ($_GET['notif'] == "recordexist") :
        echo '<div class="red-notif-border">Classroom Observation already exists!</div>';
    endif;
endif;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <form action="includes/processcotformMT.php" method="POST">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
            <h5>COT-RPMS</h5>

            <div class="h3 bg-info text-white">Master Teacher I-IV</div>
            <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

            <h4> Classroom Observation Rating Form</h4>
            <h5 class="text-left">

                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 1: </label>&nbsp;
                            <?php echo $_SESSION['fullname']; ?>
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

                                $queryObserver2 = mysqli_query($conn, 'SELECT * FROM account_tbl WHERE `user_id` != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("School Head","Principal") ') or die($conn->error);

                                if ($queryObserver2) :
                                    while ($row = $queryObserver2->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname']. ' - ' .$row['position'];
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
                            <label>MASTER TEACHER OBSERVED: </label>
                            <select name="mtobserved" required="required">
                                <option value="" disabled selected>--Select Teacher--</option>
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
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname']. ' - ' .$row['position'];
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
                            <select name="mtgradelvltaught" required="required">
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

                            <?php
                            $date = date('Y/m/d');
                            $intdate = intval(strtotime($date));
                            $first_period_int = intval(strtotime($_SESSION['first_period']));
                            $second_period_int = intval(strtotime($_SESSION['second_period']));
                            $third_period_int = intval(strtotime($_SESSION['third_period']));
                            $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                            if ($intdate >= $fourth_period_int) :
                                $period = 4;
                            elseif ($intdate >= $third_period_int) :
                                $period = 3;
                            elseif ($intdate >= $second_period_int) :
                                $period = 2;
                            elseif ($intdate >= $first_period_int) :
                                $period = 1;
                            else :
                                $period = "Invalid Period";
                            endif;
                            ?>

                            <input type="text" name="mtobs" value="<?php echo $period; ?>" readonly />
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
                            $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period4=1';
                        elseif ($intdate >= $third_period_int) :
                            $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period3=1';
                        elseif ($intdate >= $second_period_int) :
                            $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period2=1';
                        elseif ($intdate >= $first_period_int) :
                            $periodqry = 'SELECT * FROM mtindicator_tbl WHERE period1=1';
                        else :
                            echo 'invalid period!';
                        endif;

                        $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                        $resultqry = $conn->query($periodqry)  or die($conn->error);
                        ?>
                        
<!-- LEGEND OF COT RUBRICS-->
                <div class="container">
                        
                        <div class="right">
                            <div class="h4 breadcrumb bg-dark text-white " style="font-size: 12px;">COT Rubric for Master Teacher I-IV</div>
                                    <?php
                                    
                                    $result = $conn->query('SELECT * FROM mtrubric_tbl')  or die($conn->error);
                                    ?>

                                    <table class="table table-bordered table-responsive-sm table-sm">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th style="font-size: 13px;">Level</th>
                                                <th style="font-size: 13px;">Level Name</th>
                                                <th style="font-size: 13px;">Level Description</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = $result->fetch_assoc()) :
                                            ?>
                                            <tbody class="text-justify">
                                                <tr>
                                                    <td style="font-size: 12px; font-style: italic;"><?php echo $row['rubric_lvl']; ?></td>
                                                    <td style="font-size: 12px; font-style: italic;" ><?php echo $row['level_name']; ?></td>
                                                    <td style="font-size: 12px; font-style: italic;"><?php echo $row['rubric_description']; ?></td>
                                                    
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>

                
<!-- END OF LEGEND-->                           

                        <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                            <thead class="legend-control bg-info text-white ">
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


                                <input type="hidden" name="mtindicator_id[]" value="<?php echo $row['mtindicator_id']; ?>" />
                                <input type="hidden" name="indicator_name[]" value="<?php echo $row['mtindicator_name']; ?>" />

                                <tbody>
                                    <tr>
                                        <td><?php echo $row['mtindicator_id']; ?></td>
                                        <td><?php echo $row['mtindicator_name']; ?></td>
                                        <td>
                                            <select name="mtrating[]" required="required">
                                                <option value="" disabled selected>--Select--</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>
                                                <option value="3">6</option>
                                                <option value="4">7</option>
                                                <option value="5">8</option>
                                                <option value="1">NO*</option>
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



            <textarea class="form-control" name="mtioaf_comment" rows="5" placeholder="OTHER COMMENTS" required="required"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>

    </div>
</div>
</form>
<br>

<?php

include 'samplefooter.php';
?>