<?php
include 'includes/conn.inc.php';
include 'includes/header.php';
include_once 'libraries/func.lib.php';

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
?>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <form action="includes/processtcotform.php" method="POST" name="myForm">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br><br>
            <h5><strong>COT-RPMS</strong></h5>
            <div class="h3 bg-success">Teacher I-III</div>
            <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="sy" value="<?php echo $_SESSION['sy_id']; ?>" />
            <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

            <h4>Rating Sheet</h4>
            <h5 class="text-left">

                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER:</label>&nbsp;
                            <?php echo $fullname; ?>
                        </div>

                        <div class="col-lg-6">
                            <label>DATE:</label>
                            <?php echo date("Y/m/d"); ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">

                            <label>
                                TEACHER OBSERVED:
                            </label>
                            <select name="tobserved">
                                <option value="" disabled selected>Select Teacher</option>
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




                        <div class="col-lg-6">
                            <label>
                                SUBJECT:
                            </label>
                            <select name="tsubject">
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
                            <select name="tgradelvltaught">
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
                                    xmlhttp.open("GET", "ajaxobs.php?period=" + str, true);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        <div class="col-lg-6">

                            <label for="obsperiod" class="col-form-label">
                                OBSERVATION PERIOD:
                            </label>

                            <select name="obs" onchange="showIndicator(this.value)">
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



            <textarea class="form-control" name="cot_comment" rows="5" placeholder="OTHER COMMENTS"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>
    </div>
</div>
</div>
</form>
<br>

<?php
include 'includes/footer.php';
?>