<?php include_once 'includes/header.php';

use DevPlan\DevPlan;
?>
<div class="container ">
    <div class="breadcome-list shadow-reset">
        <h2 class="text-center"><strong>PART IV: General Development Plan</strong></h2>
        <form action="includes/processeditdevplan.php" method="post" class="form-group">
            <input type="text" name="sy" value=<?php echo $_SESSION['active_sy_id']; ?> />
            <input type="text" name="school_id" value=<?php echo $_SESSION['school_id']; ?> />
            <input type="text" name="position" value="<?php echo $_SESSION['position']; ?>" />
            <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="text" name="rater" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="text" name="approving_authority" value="<?php echo $_SESSION['user_id']; ?>" />
            <div id="A">
                <fieldset>
                    <legend><strong>A. Functional Competencies</strong></legend>
                    <!--A. Strengths -->
                    <div>
                        <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Strengths</label>

                        </div>

                        <label for="sel-kra" class="col-form-label"><strong>Select Key Result Areas</strong></label>
                        <select name="kra_name" id="kradd" onChange="change_kra()" class="form-control">
                            <option>Select KRA</option>
                            <?php
                            $queryObjectives = $conn->query('SELECT * FROM kra_tbl') or die($conn->error);
                            while ($row = $queryObjectives->fetch_assoc()) :
                                $kra_id = $row['kra_id'];
                                $kra_name = $row['kra_name'];
                                ?>
                                <option value="<?php echo $kra_id ?>"><?php echo $kra_name; ?></option>
                            <?php
                            endwhile;
                            ?>
                        </select>
                        <label for="sel-mov" class=" col-form-label"><strong>Select Objective</strong></label>
                        <div id="objective">
                            <select class="form-control">
                                <option>Select Objective</option>
                            </select>
                        </div>

                        <script type="text/javascript">
                            function change_kra() {
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "ajaxmov.php?kra=" + document.getElementById("kradd").value, false);
                                xmlhttp.send(null);
                                document.getElementById("objective").innerHTML = xmlhttp.responseText;

                            }
                        </script>

                        <!-- A. Development Needs -->
                        <div class="indentcontent"></div>
                        <div class="bg-black"><label for="a_devneeds" class="form-control-label bg-black">Development Needs</label></div>

                        <label for="sel-kra" class="col-form-label"><strong>Select Key Result Areas</strong></label>
                        <select name="kra_name1" id="kradd1" onChange="change_kra1()" class="form-control">
                            <option>Select KRA</option>
                            <?php
                            $queryObjectives = $conn->query('SELECT * FROM kra_tbl') or die($conn->error);
                            while ($row = $queryObjectives->fetch_assoc()) :
                                $kra_id = $row['kra_id'];
                                $kra_name = $row['kra_name'];
                                ?>
                                <option value="<?php echo $kra_id ?>"><?php echo $kra_name; ?></option>
                            <?php
                            endwhile;
                            ?>
                        </select>
                        <label for="sel-mov" class=" col-form-label"><strong>Select Objective</strong></label>
                        <div id="objective1">
                            <select class="form-control">
                                <option>Select Objective</option>
                            </select>
                        </div>

                        <script type="text/javascript">
                            function change_kra1() {
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("GET", "update/ajaxdevplan.php?kra=" + document.getElementById("kradd1").value, false);
                                xmlhttp.send(null);
                                document.getElementById("objective1").innerHTML = xmlhttp.responseText;

                            }
                        </script>
                        <!-- Action Plan -->
                        <div>
                            <div class="form-control-label bg-black">
                                <label for="learn-objectives" class="form-control-label bg-black">Action Plan</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="learning_objectives">Learning Objectives:</label>
                                    <textarea name="a_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="a_intervention">Interventions:</label>
                                    <textarea name="a_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Timeline and Resources needed -->
                        <div>
                            <div class="form-control-label bg-black">
                                <label for="learn-objectives" class="form-control-label bg-black">Timelines and Resources needed</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="timelines">Timelines:</label>
                                    <textarea name="a_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." class="form-control textarea"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="resources_needed">Resources needed:</label>
                                    <textarea name="a_resources_needed" id="" cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- B. Compentencies -->
                        <hr>
                        <legend><strong>B. Core Behavioral Competencies</strong></legend>
                        <div id="B">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-black"><label for="b_strength" class="form-control-label bg-black">Strengths</label></div>

                                    <select name="strength_cbc" id="cbcadd" onChange="change_cbc()" class="form-control">
                                        <?php
                                        $addresult = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
                                        while ($addrow = $addresult->fetch_assoc()) :
                                            $addcbcid = $addrow['cbc_id'];
                                            $addcbcname = $addrow['cbc_name'];

                                            ?>
                                            <option value="<?php echo $addcbcid ?>"><?php echo $addcbcname ?>

                                            </option>

                                        <?php
                                        endwhile;
                                        ?>
                                    </select>

                                    <label for="sel-mov" class=" col-form-label"><strong>Select Indicator</strong></label>
                                    <div id="indicator">
                                        <select class="form-control">
                                            <option>Select Indicator</option>
                                        </select>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    function change_cbc() {
                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.open("GET", "update/ajaxcbc.php?cbc=" + document.getElementById("cbcadd").value, false);
                                        xmlhttp.send(null);
                                        document.getElementById("indicator").innerHTML = xmlhttp.responseText;

                                    }
                                </script>
                                <div class="col-md-6">
                                    <div class="bg-black"><label for="a_strength" class="form-control-label bg-black">Development Needs</label></div>


                                    <select name="dev_cbc" id="cbcadd2" onChange="change_cbc2()" class="form-control">
                                        <?php
                                        $addresult = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
                                        while ($addrow = $addresult->fetch_assoc()) :
                                            $addcbcid = $addrow['cbc_id'];
                                            $addcbcname = $addrow['cbc_name'];

                                            ?>
                                            <option value="<?php echo $addcbcid; ?>"><?php echo $addcbcname; ?>

                                            </option>

                                        <?php
                                        endwhile;
                                        ?>
                                    </select>

                                    <label for="sel-mov" class=" col-form-label"><strong>Select Indicator</strong></label>
                                    <div id="indicator2">
                                        <select class="form-control">
                                            <option>Select Indicator</option>
                                        </select>
                                    </div>
                                    <script type="text/javascript">
                                        function change_cbc2() {
                                            var xmlhttp = new XMLHttpRequest();
                                            xmlhttp.open("GET", "update/ajaxcbc2.php?cbc=" + document.getElementById("cbcadd2").value, false);
                                            xmlhttp.send(null);
                                            document.getElementById("indicator2").innerHTML = xmlhttp.responseText;

                                        }
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="form-control-label bg-black">
                            <label for="learn-objectives" class="form-control-label bg-black">Action Plan</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="learning_objectives">Learning Objectives:</label>
                                <textarea name="b_learning_objectives" id="" cols="30" rows="10" placeholder="Enter the Learning Objectives" class="form-control textarea"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="intervention">Interventions:</label>
                                <textarea name="b_intervention" id="" cols="30" rows="10" placeholder="Enter the Interventions" class="form-control textarea"></textarea>
                            </div>
                        </div>
                        <div>
                            <div class="form-control-label bg-black">
                                <label for="learn-objectives" class="form-control-label bg-black">Timelines and Resources needed</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="timelines">Timelines:</label>
                                    <textarea name="b_timeline" id="" cols="30" rows="10" placeholder="Enter Timelines." class="form-control textarea"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="resources_needed">Resources needed:</label>
                                    <textarea name="b_resources_needed" id="" cols="30" rows="10" placeholder="Enter the Resources needed." class="form-control textarea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="learn-objectives" class="form-control-label">Feedback: </label>
                            <textarea name="feedback" id="" cols="30" rows="10" class="form-control textarea" placeholder=" _______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________"></textarea>
                        </div>
                        <br>
                        <center>
                            <div class="row">
                                <div>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                                    <input type="submit" name="save" class="btn btn-success" value="Save" />
                                    <?php directLastPage() ?>
                                </div>
                            </div>
                        </center>

        </form>
    </div>
    <!--end breadcome -->
</div><!-- end of container -->

<br>
</main>

<?php




include 'includes/footer.php';
?>