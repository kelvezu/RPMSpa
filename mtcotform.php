    <?php
    include 'includes/conn.inc.php';
    include 'includes/header.php';
    include_once 'libraries/func.lib.php';

    $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
    $resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);
    ?>

    <div class="container text-center">
        <div class="breadcome-list shadow-reset">
            <form action="includes/processmtcotform.php" method="POST">
                <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br><br>
                    <h5><strong>COT-RPMS</strong></h5>
                        <div class="h3 bg-info">Master Teacher I-IV</div>
                        <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>"/>
                        <input type="hidden" name="sy" value="<?php echo $_SESSION['sy_id']; ?>"/>
                        <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>"/>

            <h4>Rating Sheet</h4>
            <h4 class="text-left">

                <div class="form-group">
                    <div class="form-control">
                        <label>OBSERVER:</label>&nbsp; 
                        <?php echo $fullname; ?>
                    </div>

                    <div class="form-control"> 
                        <label>DATE:</label> 
                        <?php echo date("Y/m/d");?>
                    </div>
              
               <div class="form-control">
                   <label>
                    MASTER TEACHER OBSERVED:
                   </label>
                        <select name="mtobserved">
                            <option value="" disabled selected>--Select Master Teacher--</option>
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
                
                <div class="form-control">
                    <label>
                        SUBJECT:
                    </label>
                        <select name="mtsubject">
                        <option value="" disabled selected>--Select Subject--</option>
                            <?php
                            $querySubject = $conn->query('SELECT * FROM subject_tbl') or die($conn->error);
                                while($subjrow = $querySubject->fetch_assoc()):
                                    $subject = $subjrow['subject_name'];
                            ?>
                            <option value="<?php echo $subject;?>"><?php echo $subject;?></option>
                                <?php endwhile; ?>
                        </select>
                </div>

                <div class="form-control">
                    <label for="gradeleveltaught">
                        GRADE LEVEL TAUGHT:
                    </label>
                        <select name="mtgradelvltaught">
                        <option value="" disabled selected>--Select Grade Level Taught--</option>
                            <?php
                            $queryGlt = $conn->query('SELECT * FROM gradelvltaught_tbl') or die($conn->error);
                                while($gradelvltaught = $queryGlt->fetch_assoc()):
                                    $glt = $gradelvltaught['gradelvltaught_name'];
                            ?>
                            <option value="<?php echo $glt; ?>"><?php echo $glt; ?></option>
                                <?php endwhile; ?>
                        </select>
                </div>

                <div class="form-control">
                    <label for="obs_period" class="col-form-label">
                        OBSERVATION PERIOD:
                    </label>
                        <select name="mtobsperiod">
                            <option value="" disabled selected>--Select Period--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                </div>

            </h4>
            
            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                <thead class="legend-control bg-info text-white ">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>COT Rating</th>
                    </tr>
                </thead>
                <?php
                if ($resultquery) {
                    while ($row = mysqli_fetch_array($resultquery)) {
                        ?>
                        <input type="hidden" name = "mtindicator_id[]" value="<?php echo $row['mtindicator_id']; ?>"/>
                        <input type="hidden" name = "mtindicator_name[]" value="<?php echo $row['mtindicator_name']; ?>"/>
                        <tbody>
                            <tr>
                                <th><?php echo $row['mtindicator_id']; ?></th>
                                <th><?php echo $row['mtindicator_name']; ?></th>
                                <th>
                                    <select name="mtrating[]">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="3">NO*</option>
                                    </select>

                                </th>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>

            </table>
            <textarea class="form-control" name="mtcot_comment" rows="5" placeholder="OTHER COMMENTS"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>
        </div>
    </div>
    </form>
    <br>

    <?php
    include 'includes/footer.php';
    ?>