<?php

include_once 'sampleheader.php';
include_once 'libraries/func.lib.php';
$position = $_SESSION['position'];

$resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);

if (isset($_POST['save'])) :
    showModal('myModal')
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <style>
        .mystyle {
            width: 600px;
        }

        .shortinput {
            width: 30px;
        }

        .select-style {
            position: relative;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            width: 330px;
            height: 30px;
            overflow: hidden;
            background: transparent;
        }

        .select-style select {
            padding: 5px 8px;
            width: 150%;
            border: none;
            background-color: transparent;
            background-image: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .select-style select:focus {
            outline: none;
        }

        .select-style:after {
            position: absolute;
            content: "";
            width: 50px;
            height: 100%;
            background-color: #77d800;
            top: 0;
            right: -1px;
            z-index: -1;
            border-radius: 0 1px 1px 0;
        }

        #form {

            display: none;

        }
    </style>

    <div id="myModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <?php
                $error_array = [];

                $rater_id = $_POST['rater_id'];
                $rater2 = $_POST['observer2'] ?? "";
                $rater3 = $_POST['observer3'] ?? "";
                $date = date("Y/m/d");
                $user_id = $_POST['tobserved'] ?? "";
                $subject = $_POST['tsubject'] ?? "";
                $gradelvltaught = $_POST['tgradelvltaught'] ?? "";
                $obs_period = intval($_POST['obs']);
                $indicator_id = $_POST['mtindicator_id'];
                $indicator_name = $_POST['mtindicator_name'];
                $tcotrating = $_POST['mtrating'];
                $comment = $_POST['ioaf_comment'];
                $sy_id = $_POST['sy'];
                $school_id = $_POST['school_id'];

                $cot_qry = $conn->query("SELECT * FROM cot_mt_rating_a_tbl WHERE sy = '$sy_id' AND obs_period = '$obs_period' AND school_id= '$school_id' AND `user_id` = '$user_id'");
                $cot_exist = $cot_qry->num_rows;

                if (empty($subject)) :
                    $error_array[] = "Please select a subject!";
                endif;

                if (empty($gradelvltaught)) :
                    $error_array[] = "Please select Grade Level Taught!";
                endif;

                if ($cot_exist > 0) :
                    $error_array[] = "Teacher has been rated for the specific observation period.";
                endif;

                if (empty($user_id)) :
                    $error_array[] = "Please select a teacher to rate!";
                endif;

                if (!empty($error_array)) :
                    echo '<ul class="red-notif-border text-justify">';
                    foreach ($error_array as $errors) :
                        echo '<li>' . $errors . '</li>';
                    endforeach;
                    echo '</ul>';
                endif;

                ?>

                <form action="includes/processcotformMT.php" method="POST">

                    <div class="tomato-color h4 font-italic">
                        Are you sure you want to submit the following details for Classroom Observation?
                    </div>
                    <center>
                        <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
                        <h5>COT-RPMS</h5>

                        <div class="h3 bg-info text-white">Master Teacher I-IV</div>
                    </center>
                    <input type="hidden" name="sy_id" value="<?php echo $_SESSION['active_sy_id'] ?>">
                    <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">

                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Observer 1:</th>
                            <td><input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id'] ?>" readonly class="form-control">
                                <?php echo displayName($conn, $_SESSION['user_id']); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Observer 2:</th>
                            <td><input type="hidden" name="observer2" value="<?php echo $rater2; ?>" readonly class="form-control">
                                <?php echo displayName($conn, $rater2); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Observer 3:</th>
                            <td><input type="hidden" name="observer3" value="<?php echo $rater3; ?>" readonly class="form-control">
                                <?php echo displayName($conn, $rater3); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><input type="hidden" name="date" value="<?php echo $date; ?>" readonly class="form-control">
                                <?php echo $date; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Teacher Observed:</th>
                            <td><input type="hidden" name="tobserved" value="<?php echo $user_id; ?>" readonly class="form-control">
                                <?php echo displayName($conn, $user_id); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Subject:</th>
                            <td><input type="hidden" name="tsubject" value="<?php echo $subject; ?>" readonly class="form-control">
                                <?php echo displaySubject($conn, $subject); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Grade Level Taught:</th>
                            <td><input type="hidden" name="tgradelvltaught" value="<?php echo $gradelvltaught; ?>" readonly class="form-control">
                                <?php echo displayGradelvltaught($conn, $gradelvltaught); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Observation Period:</th>
                            <td><input type="hidden" name="obs" value="<?php echo $obs_period; ?>" readonly class="form-control">
                                <?php echo $obs_period; ?>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <thead class="bg-info text-white">
                            <tr>
                                <th>Indicator ID</th>
                                <th>Indicator Name</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($count = 0; $count < count($indicator_id); $count++) : ?>
                                <tr>
                                    <td><input type="hidden" name="indicator_id[]" value="<?php echo $indicator_id[$count]; ?>" readonly class="shortinput">
                                        <?php echo $indicator_id[$count]; ?>
                                    </td>
                                    <td><input type="hidden" name="indicator_name[]" value="<?php echo $indicator_name[$count]; ?>" readonly class="mystyle">
                                        <?php echo $indicator_name[$count]; ?>
                                    </td>
                                    <td><input type="hidden" name="rating[]" value="<?php echo $tcotrating[$count]; ?>" readonly class="shortinput">
                                        <?php echo rawRate($tcotrating[$count], 'Master Teacher I'); ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                    <textarea name="ioaf_comment" cols="10" rows="5" readonly class="form-control"><?php echo $comment; ?></textarea>
                    <br>

                    <tfoot>
                        <td colspan="10">
                            <div class="d-flex justify-content-center">
                                <?php if (empty($error_array)) : ?>
                                    <div class="p-2"><button name="submit" class="btn btn-info">Submit</button></div>
                                <?php endif; ?>
                                <div class="p-2"><button class="btn btn-danger" data-dismiss="modal">Cancel</button></div>
                            </div>
                        </td>
                    </tfoot>
                </form>


            </div>
        </div>
    </div>




<?php endif; ?>

<div class="container">
    <a href="teachercotrate.php" class="btn btn-outline-primary">Cot Status</a>
    <?php
    if ($position == "Principal") :
        echo '<a href="cotstatus.php" class="btn btn-outline-primary">Cot Status</a>';
    else :
        echo '<a href="teachercotrate.php" class="btn btn-outline-primary">Cot Status</a>';
    endif;
    ?>

    <div>
        <?php
        if (isset($_GET['notif'])) :
            if ($_GET['notif'] == "success") :
                echo '<div class="green-notif-border">Classroom Observation has been submitted!</div>';
            elseif ($_GET['notif'] == "recordexist") :
                echo '<div class="red-notif-border">Classroom Observation already exists!</div>';
            endif;
        endif;
        ?>
    </div>


    <div class="card">
        <div class="card-header text-center">

            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
            <h5>COT-RPMS</h5>
            <div class="h3 bg-info text-white">Master Teacher I-IV</div>
            <h4> Classroom Observation Rating Form</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />

                <div class="row">
                    <div class="col-lg-6">
                        <label><b>OBSERVER 1: </b></label>&nbsp;
                        <input type="text" id="observe" value="<?php echo displayName($conn, $_SESSION['user_id']); ?>" readonly class="form-control-sm">
                        <input type="hidden" name="observer1" id="observer1" value="<?php echo $_SESSION['user_id'] ?? ""; ?>">
                    </div>

                    <div class="col-lg-6">
                        <label><b>DATE:</b></label>
                        <input type="text" name="date" id="date" value="<?php echo date("Y/m/d") ?? ""; ?>" readonly class="form-control-sm">

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <label><b>OBSERVER 2: </b></label>&nbsp;
                        <select name="observer2" class="form-control-sm">
                            <?php if (isset($rater2)) : ?>
                                <option value="<?php echo $rater2 ?? ""; ?>" disabled selected><?php echo displayName($conn, $rater2) ?? "Select Observer"; ?></option>
                            <?php else : ?>
                                <option disabled selected>Select Observer</option>
                            <?php endif ?>
                            <?php
                            $school = $_SESSION['school_id'];
                            $rater = $_SESSION['user_id'];

                            $queryObserver2 = mysqli_query($conn, 'SELECT * FROM account_tbl WHERE `user_id` != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("School Head","Principal","Principal-OIC") ') or die($conn->error);

                            if ($queryObserver2) :
                                while ($row = $queryObserver2->fetch_assoc()) :
                                    $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'] . ' - ' . $row['position'];
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
                        <label><b>TEACHER OBSERVED:</b> </label>
                        <select name="tobserved" class="form-control-sm" required>
                            <?php if (isset($user_id)) : ?>
                                <option value="<?php echo $user_id ?? ""; ?>" disabled selected><?php echo displayName($conn, $user_id) ?? "Select Teacher"; ?></option>
                            <?php else : ?>
                                <option disabled selected>Select Teacher</option>
                            <?php endif; ?>
                            <?php
                            $school = $_SESSION['school_id'];
                            $rater = $_SESSION['user_id'];
                            $queryObserved = $conn->query('SELECT * FROM account_tbl WHERE  rater =  ' . $rater . '  AND  position  IN ("Master Teacher I","Master Teacher II","Master Teacher III","Master Teacher IV") ') or die($conn->error);

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
                        <label><b>OBSERVER 3: </b></label>&nbsp;
                        <select name="observer3" class="form-control-sm">
                            <?php if (isset($rater3)) : ?>
                                <option value="<?php echo $rater3 ?? ""; ?>" disabled selected><?php echo displayName($conn, $rater3); ?></option>
                            <?php else : ?>
                                <option disabled selected>Select Observer</option>
                            <?php endif ?>
                            <?php
                            $school = $_SESSION['school_id'];
                            $rater = $_SESSION['user_id'];

                            $queryObserver3 = $conn->query('SELECT * FROM account_tbl WHERE user_id != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("School Head","Principal","Principal-OIC") ') or die($conn->error);

                            if ($queryObserver3) :
                                while ($row = $queryObserver3->fetch_assoc()) :
                                    $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'] . ' - ' . $row['position'];
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
                            <b>SUBJECT:</b>
                        </label>
                        <select name="tsubject" class="form-control-sm" required>
                            <?php if (isset($subject)) : ?>
                                <option value="<?php echo $subject ?? ""; ?>" disabled selected><?php echo displaySubject($conn, $subject) ?? "Select Subject"; ?></option>
                            <?php else : ?>
                                <option disabled selected>Select Subject</option>
                            <?php endif ?>
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
                            <b>GRADE LEVEL TAUGHT:</b>
                        </label>
                        <select name="tgradelvltaught" class="form-control-sm" required>
                            <?php if (isset($gradelvltaught)) : ?>
                                <option value="<?php echo $gradelvltaught ?? ""; ?>" disabled selected><?php echo displayGradelvltaught($conn, $gradelvltaught) ?? "Select Grade Level Taught"; ?></option>
                            <?php else : ?>
                                <option disabled selected>Select Grade Level Taught</option>
                            <?php endif ?>
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
                            <b>OBSERVATION PERIOD:</b>
                        </label>

                        <select name="obs" onchange="showIndicator(this.value)" required class="form-control-sm">
                            <option value="<?php echo $obs_period ?? ""; ?>" disabled selected><?php echo $obs_period ?? "Select Period"; ?></option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                        </select>
                    </div>

                    <br>
                    <!-- LEGEND OF COT RUBRICS-->
                    <div class="container">

                        <div class="right">
                            <div class="h4 breadcrumb bg-dark text-white " style="font-size: 12px;">COT Rubric for Teacher I-III</div>
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
                                            <td style="font-size: 12px; font-style: italic;"><?php echo $row['level_name']; ?></td>
                                            <td style="font-size: 12px; font-style: italic;"><?php echo $row['rubric_description']; ?></td>

                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- END OF LEGEND-->

                    <div id="show">

                    </div>

                </div>


                <textarea class="form-control" name="ioaf_comment" rows="5" placeholder="OTHER COMMENTS" required="required"></textarea><br>
                <a href="javascript:history.back(1)" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary" name="save">Submit</button>

        </div>
    </div>
    </form>




    <br>

    <?php

    include 'samplefooter.php';
    ?>