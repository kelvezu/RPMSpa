  <?php
  include_once 'sampleheader.php';

  RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']);
  FilterUser\FilterUser::filterEsatDemo($conn, $_SESSION['position']);

  ?>


  <div class="container">

    <form action="includes/processESATsurvey.php" method="POST">

      <div class="card">
        <div class="card-header text-center h4 bg-dark text-white ">
          Self Assessment Tool Form / Part I / Demographic Profile
        </div>
        <div class="card-body">


          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
          <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>">
          <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'] ?>" />
          <input type="hidden" name="employee_position" value="<?= $_SESSION['position'] ?>">


          <label><strong>1. Age Option</strong></label>
          <br>
          <?php
            $qry = $conn->query("SELECT * FROM account_tbl WHERE `user_id` = ".$_SESSION['user_id']." ");
              while($agerow = $qry->fetch_assoc()):
                $birthdate = $agerow['birthdate'];
                $from = new DateTime($birthdate);
                $to   = new DateTime('today');
                $age = $from->diff($to)->y;
              endwhile;
              if($age > 55) : $AgeRange = "Over 55 years old";
              elseif ($age >= 51 && $age <= 55) : $AgeRange = "51-55 years old";
              elseif ($age >= 46 && $age <= 50) : $AgeRange = "46-50 years old";
              elseif ($age >= 41 && $age <= 45) : $AgeRange = "41-45 years old";
              elseif ($age >= 36 && $age <= 40) : $AgeRange = "36-40 years old";
              elseif ($age >= 31 && $age <= 35) : $AgeRange = "31-35 years old";
              elseif ($age >= 25 && $age <= 30) : $AgeRange = "25-30 years old";
              elseif ($age < 25 ): $AgeRange = "Under 25";
              else:  $AgeRange = "Invalid Age";
              endif;
          ?>
          <input type="text" name="age" value="<?php echo $AgeRange; ?>" class="form-control" readonly>
          <br>
          
          <label><strong>2. Sex Option</strong></label>
          <br>
          <?php
          $genderresult = $conn->query('SELECT * FROM account_tbl WHERE `user_id` = "' . $_SESSION['user_id'] . '"')  or die($conn->error);
          while ($genderrow = $genderresult->fetch_assoc()) :
            $gender = $genderrow['gender'];

            ?>
            <input type="text" name="gender" value="<?php echo $gender ?>" class="form-control" readonly>
          <?php endwhile; ?>

          <br>
          <label><strong>3. Employment Status</strong></label>
          <br>
          <select name="status" id="" class="form-control" required>
            <option value="">--Select Employment Status</option>
            <option value="Regular Permanent">Regular Permanent</option>
            <option value="Substitute">Substitute</option>
            <option value="Provisional">Provisional</option>
            <option value="Contractual">Contractual</option>
          </select>

          <br>
          <label><strong>4. Position</strong></label>
          <br>

          <input type="text" name="position" value="<?php echo $_SESSION['position']; ?>" class="form-control" readonly>

          <br>


          <label><strong>5. Highest Degree Obtained</strong></label>
          <br>
          <select name="hdo" id="" class="form-control my-1">
            <option value="Bachelor Degree">Bachelor Degree</option>
            <option value="Master Degree">Master Degree</option>
            <option value="Doctorate Degree">Doctorate Degree</option>
          </select>
          <span><input type="text" name="course" id="" class="form-control" placeholder="Enter Course Degree taken"></span>
          <br>
          <label><strong>6. Total Number of Years in Teaching</strong></label>
          <br>
          <select name="totalyear" id="" class="form-control" required>
            <option>--Select Total Years in Teaching--</option>
            <?php
            $totalyrresult = $conn->query('SELECT * FROM totalyear_tbl')  or die($conn->error);
            while ($totalrow = $totalyrresult->fetch_assoc()) :
              $totalyear_id = $totalrow['totalyear_id'];
              $totalyear_name = $totalrow['totalyear_name'];
              ?>
              <option value="<?php echo $totalyear_id ?>"><?php echo $totalyear_name; ?>
              <?php endwhile ?>
              </option>
          </select>
          <br>


          <label><strong>7. Area of Specialization</strong></label>
          <br>
          <div class="card-body text-dark">
            <?php
            $assubjectresult = $conn->query('SELECT * FROM subject_tbl')  or die($conn->error);
            while ($assubjrow = $assubjectresult->fetch_assoc()) :
              $assubject_id = $assubjrow['subject_id'];
              $assubject_name = $assubjrow['subject_name'];
              ?>
              <input type="checkbox" name="areaspec[]" value="<?php echo $assubject_name ?>"><?php echo $assubject_name ?><br>
            <?php endwhile ?>
            </input>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Others(specify)</span>
              </div>
              <input type="text" class="form-control" name="areaspec[]" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>


          <br>
          <label><strong>8. Subject(s) Taught</strong></label>
          <br>
          <div class="card-body text-dark">
            <?php
            $subjectresult = $conn->query('SELECT * FROM subject_tbl')  or die($conn->error);
            while ($subjrow = $subjectresult->fetch_assoc()) :
              $subject_id = $subjrow['subject_id'];
              $subject_name = $subjrow['subject_name'];
              ?>
              <input type="checkbox" name="subject[]" value="<?php echo $subject_name ?>"><?php echo $subject_name ?></input><br>
            <?php endwhile ?>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Others(specify)</span>
              </div>
              <input type="text" name="subject[]" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
            </div>
          </div>
          <br>


          <label><strong>9. Grade Level Taught</strong></label>
          <br>
          <div class="card-body text-dark">
            <input type="text" class="form-control" value="<?php echo displaySchoolLevelName($conn,displaySchoolLevel($conn, $_SESSION['school_id']));?>"  readonly>
            <input type="hidden" name="glt" class="form-control" value="<?php echo displaySchoolLevel($conn, $_SESSION['school_id']);?>"  readonly>
          </div>
          <br>


          <label><strong>10. Curricular Classification of the School</strong></label>
          <br>
          <div class="card-body text-dark">
            <input type="text" class="form-control" value="<?php echo displaySchoolCurriClass($conn,displaySchoolCurri($conn, $_SESSION['school_id']));?>" readonly>
            <input type="hidden" name="curriclass" class="form-control" value="<?php echo displaySchoolCurri($conn, $_SESSION['school_id']);?>" readonly>

          </div>
          <br>


          <label><strong>11. Region</strong></label>
          <div class="card-body text-dark">
            <input type="text"  value="<?php echo displayregion($conn, (FetchSchoolRegion($conn, $_SESSION['school_id']))); ?>" class="form-control" readonly>
            <input type="hidden" name="region" value="<?php echo FetchSchoolRegion($conn, $_SESSION['school_id']); ?>" class="form-control" readonly>
          </div>



          <br>


          <button class="btn btn-success btn-block my-2" name="submitESAT1">Submit</button>
          <button class="btn btn-danger btn-block my-2" name="cancelb">Cancel</button>
        </div>
      </div>









  </div><!-- End tag of card -->

  </form>

  </div><!-- End tag of container -->




  <br>


  <?php

  include 'samplefooter.php';
  ?>