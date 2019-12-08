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
          <select name="age" id="" class="form-control">
            <option>--Select Age--</option>
            <?php
            $ageresult = $conn->query('SELECT * FROM age_tbl')  or die($conn->error);
            while ($agerow = $ageresult->fetch_assoc()) :
              $age_id = $agerow['age_id'];
              $age_name = $agerow['age_name'];
              ?>
              <option value="<?php echo $age_id ?>"><?php echo $age_name; ?>
              <?php endwhile ?>
              </option>
          </select>
          <br>
          <label><strong>2. Gender Option</strong></label>
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
          <select name="status" id="" class="form-control">
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
          <select name="totalyear" id="" class="form-control">
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
            <?php
            $gradelvlresult = $conn->query('SELECT * FROM gradelvltaught_tbl')  or die($conn->error);
            while ($gralvlrow = $gradelvlresult->fetch_assoc()) :
              $gradelvltaught_id = $gralvlrow['gradelvltaught_id'];
              $gradelvltaught_name = $gralvlrow['gradelvltaught_name'];
              ?>
              <input type="checkbox" name="glt[]" value="<?php echo $gradelvltaught_id ?>"><?php echo $gradelvltaught_name ?>
              </input><br>
            <?php endwhile ?>
          </div>
          <br>


          <label><strong>10. Curricular Classification of the School</strong></label>
          <br>
          <div class="card-body text-dark">
            <select name="curriclass" id="" class="form-control">
              <option value="">--Select Curricular Classification</option>
              <?php
              $curriresult = $conn->query('SELECT * FROM curriclass_tbl')  or die($conn->error);
              while ($currirow = $curriresult->fetch_assoc()) :
                $curriclass_id = $currirow['curriclass_id'];
                $curriclass_name = $currirow['curriclass_name'];
                ?>
                <option value="<?php echo $curriclass_id ?>"><?php echo ' ' . $curriclass_name ?>
                <?php endwhile ?>
                </option>
            </select>
          </div>
          <br>


          <label><strong>11. Region</strong></label>
          <div class="card-body text-dark">
            <input type="text" name="region1" value="<?php echo displayregion($conn, (FetchSchoolRegion($conn, $_SESSION['school_id']))); ?>" class="form-control" readonly>
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