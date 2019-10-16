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
            <h4 class="text-left">

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
                    
                    

               
                    <div class="col-lg-6">
                        <label>
                            SUBJECT:
                        </label>
                        <select name="tsubject">
                            <option value="" disabled selected>--Select Subject--</option>
                            <?php
                            $querySubject = $conn->query('SELECT * FROM subject_tbl') or die($conn->error);
                            while ($subjrow = $querySubject->fetch_assoc()) :
                                $subject = $subjrow['subject_name'];
                                ?>
                                <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
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
                            <option value="" disabled selected>--Select Grade Level Taught--</option>
                            <?php
                            $queryGlt = $conn->query('SELECT * FROM gradelvltaught_tbl') or die($conn->error);
                            while ($gradelvltaught = $queryGlt->fetch_assoc()) :
                                $glt = $gradelvltaught['gradelvltaught_name'];
                                ?>
                                <option value="<?php echo $glt; ?>"><?php echo $glt; ?></option>
                            <?php endwhile; ?>
                        </select>
                    
            <?php
                if(isset($_GET['period'])):
                    $period = $_GET['period'];
                    if($period == 1 ):
                        $periodqry = 'SELECT * FROM tindicator_tbl WHERE period1=1';
                    elseif($period == 2 ):
                        $periodqry = 'SELECT * FROM tindicator_tbl WHERE period2=1';
                    elseif($period == 3 ):
                        $periodqry = 'SELECT * FROM tindicator_tbl WHERE period3=1';
                    elseif($period == 4 ):
                        $periodqry = 'SELECT * FROM tindicator_tbl WHERE period4=1';
                    endif;
                else :
                    $periodqry = 'SELECT * FROM tindicator_tbl';
                endif;

                $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                $resultqry = $conn->query($periodqry)  or die($conn->error);
            ?>
                    </div>
            
                <div class="col-lg-6">
                    <div class="dropdown">
                        <label for="obsperiod" class="col-form-label">
                            OBSERVATION PERIOD:
                        </label>
                           <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Observation Period
                               <span class="caret"></span>
                           </button>

                            <ul name="obs_period" class="dropdown-menu">
                                <li><a href="?period=1" value="1">1st</a></li>&nbsp
                                <li><a href="?period=2" value="2">2nd</a></li>&nbsp
                                <li><a href="?period=3" value="3">3rd</a></li>&nbsp
                                <li><a href="?period=4" value="4">4th</a></li>&nbsp
                            </ul>
                    </div>
                    </div>
                    </div>
            </h4>



            


            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                <thead class="legend-control bg-success text-white ">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>COT Rating</th>
                    </tr>
                </thead>
                <?php
              
                    while ($row = $resultqry->fetch_assoc()) :
                ?>
                        <input type="hidden" name="indicator_id[]" value="<?php echo $row['indicator_id']; ?>" />
                        <input type="hidden" name="indicator_name[]" value="<?php echo $row['indicator_name']; ?>" />
                        <tbody>
                            <tr>
                                <th><div id="observation"><?php echo $row['indicator_id']; ?></th>
                                <th><?php echo $row['indicator_name']; ?></th>
                                <th>
                                    <select name="rating[]">
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
                    endwhile;
                ?>

            </table>
            <textarea class="form-control" name="cot_comment" rows="5" placeholder="OTHER COMMENTS"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Disregard</a>
            <button type="submit" class="btn btn-primary" name="save">Submit</button>
    </div>
</div> 
</form>
<br>

<?php
include 'includes/footer.php';
?>