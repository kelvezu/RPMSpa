  <?php
  include_once 'sampleheader.php';

  RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']);
  FilterUser\FilterUser::filterEsatDemo($conn, $_SESSION['position']);

  ?>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <form action="includes/processESATsurvey.php" method="POST">
        <div class="text-center bg-primary font-weight-bolder"></div>
        <strong>
          <h3> Self Assessment Tool Form / Part I / Demographic Profile </h3>
        </strong>
    </div>
  </div>
  </div>



  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
  <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>">
  <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'] ?>" />
  <input type="hidden" name="employee_position" value="<?= $_SESSION['position'] ?>">



  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>1. Age Option</strong></div>
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
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>2. Gender Option</strong></div>
      <select name="gender" id="" class="form-control">
        <option>--Select Gender--</option>
        <?php
        $genderresult = $conn->query('SELECT * FROM gender_tbl')  or die($conn->error);
        while ($genderrow = $genderresult->fetch_assoc()) :
          $gender_id = $genderrow['gender_id'];
          $gender_name = $genderrow['gender_name'];
          ?>
          <option value="<?php echo $gender_id ?>"><?php echo $gender_name; ?>
          <?php endwhile ?>
          </option>
      </select>
    </div>
  </div>

  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>3. Employment Status</strong></div>
      <select name="status" id="" class="form-control">
        <option value="">--Select Employment Status</option>
        <option value="Regular Permanent">Regular Permanent</option>
        <option value="Substitute">Substitute</option>
        <option value="Provisional">Provisional</option>
        <option value="Contractual">Contractual</option>
      </select>
    </div>
  </div>

  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>4. Position</strong></div>

      <select name="position" id="" class="form-control">
        <?php
        $positions = positionQuery($conn, $_SESSION['position']);
        if (!empty($positions)) :
          foreach ($positions as $position) : ?>
            <option value="<?php echo $_SESSION['position'] ?>"><?php echo $position['position_name'] ?></option>
          <?php
            endforeach;
          else :
            ?>
          <option>--No Record--</option>
        <?php
        endif;
        ?>
      </select>
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>5. Highest Degree Obtained</strong></div>
      <select name="hdo" id="" class="form-control my-1">
        <option value="Bachelor Degree">Bachelor Degree</option>
        <option value="Master Degree">Master Degree</option>
        <option value="Doctorate Degree">Doctorate Degree</option>
      </select>
      <span><input type="text" name="course" id="" class="form-control" placeholder="Enter Course Degree taken"></span>
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>6. Total Number of Years in Teaching</strong></div>
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
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>7. Area of Specialization</strong></div>
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
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>8. Subject(s) Taught</strong></div>
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
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>9. Grade Level Taught</strong></div>
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
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>10. Curricular Classification of the School</strong></div>
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
    </div>
  </div>


  <div class="container">
    <div class="breadcome-list shadow-reset">
      <div class="bg-info"><strong>11. Region</strong></div>
      <div class="card-body text-dark">
        <select name="region" id="" class="form-control">
          <option value="">--Select Region--</option>
          <?php
          $regionresult = $conn->query('SELECT * FROM region_tbl')  or die($conn->error);
          while ($regionrow = $regionresult->fetch_assoc()) :
            $reg_id = $regionrow['reg_id'];
            $region_name = $regionrow['region_name'];
            ?>
            <option value="<?php echo $reg_id ?>"><?php echo $region_name ?></option>
          <?php endwhile ?>
        </select>
      </div>
    </div>


    <br>


    <button class="btn btn-success btn-block my-2" name="submitESAT1">Submit</button>
    <button class="btn btn-danger btn-block my-2" name="cancelb">Cancel</button>


  </div><!-- End tag of card -->

  </form>

  </div><!-- End tag of container -->




  <br>


  <?php
  include 'includes/scripts.php';
  include 'samplefooter.php';
  ?>