<?php
include 'includes.php';


//DATABASE 
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $school_id = $_GET['edit'];
    $query = mysqli_query($conn, "SELECT region_tbl.region_name,division_tbl.divi_name,municipality_tbl.muni_name,school_tbl.* FROM (((school_tbl INNER JOIN region_tbl ON school_tbl.reg_id = region_tbl.reg_id) INNER JOIN division_tbl ON school_tbl.div_id = division_tbl.div_id) INNER JOIN municipality_tbl ON school_tbl.muni_id = municipality_tbl.muni_id) WHERE school_id =" . $school_id . " ");

    $record = mysqli_fetch_array($query);
    $school_id = $record['school_id'];
    $school_grade_lvl = $record['school_grade_lvl'];
    $school_curriclass =  $record['school_curriclass'];
    $school_name = $record['school_name'];
    $school_no = $record['school_no'];
    $tel_no = $record['tel_no'];
    $tel_no2 = $record['tel_no2'];
    $reg_id = $record['reg_id'];
    $div_id = $record['div_id'];
    $muni_id = $record['muni_id'];
    $region_name = $record['region_name'];
    $divi_name = $record['divi_name'];
    $muni_name = $record['muni_name'];
}

?>




<div class="container col-sm-6">
    <div class="breadcome-list shadow-reset">

        <form action="../includes/processschool.php" class="form-group sm" method="POST">
            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
            <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update School</strong></legend>
            <div>
                <div class="form-group-sm">
                    <input type="hidden" name="school_id" id="school_id" value="<?php echo $school_id  ?>">


                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="school-name" class="col-form-label"><strong>School Name</strong></label>
                            <input type="text" name="school_name" id="school-name" class="form-control" value="<?php echo $school_name; ?>" placeholder="Enter the School Name..." required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include numbers and special characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Grade Level</strong></label>
                           <?php

                    $query = $conn->query("SELECT * FROM  school_grade_level_tbl");
                    $rowCount = $query->num_rows;
                    ?>
                    <select name="sgl" id="sgl" class="form-control">
                        <option value="<?php echo $school_grade_lvl; ?>"><?php echo displaySchoolGradeLevel($conn,$school_grade_lvl); ?></option>
                        <?php
                        if ($rowCount > 0) {
                            while ($row = $query->fetch_assoc()) {
                                echo '<option value="' . $row['schoollevel_id'] . '">' . $row['schoollevel_name'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Curricular Classification not available</option>';
                        }
                        ?>
                    </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Curricular Classification</strong></label>
                            <select class="form-control" name="school_curri" id="school_curri">
                                 <option value="<?php echo $school_curriclass; ?>"><?php echo displaySchoolCurriClass($conn,$school_curriclass); ?></option>
                            </select>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="school-no" class="col-form-label"><strong>School Number</strong></label>
                            <input type="number" name="school_no" id="school-no" class="form-control" value="<?php echo $school_no; ?>" placeholder="Enter the School No..." required pattern="[0-9]{3,}" title="Input three or more numbers and input should not include special characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="tel-no" class="col-form-label"><strong>Telephone Number</strong></label>
                            <input type="number" name="tel_no" id="tel-no" class="form-control" value="<?php echo $tel_no; ?>" placeholder="Enter the Telephone Number..." required pattern="[0-9 -]{8}" title="Input eight numbers">
                            <input type="number" name="tel_no" id="tel-no" class="form-control" value="<?php echo $tel_no2; ?>" placeholder="Enter the Telephone Number..." required pattern="[0-9 -]{8}" title="Input eight numbers">
                        </div>
                    </div>

                    <label for="reg"><strong>Select Region</strong></label>
                    <?php

                    $query = $conn->query("SELECT * FROM region_tbl");
                    $rowCount = $query->num_rows;
                    ?>
                    <select name="region" id="region" class="form-control">
                        <option value="<?php echo $reg_id; ?>"><?php echo $region_name; ?></option>
                        <?php
                        if ($rowCount > 0) {
                            while ($row = $query->fetch_assoc()) {
                                echo '<option value="' . $row['reg_id'] . '">' . $row['region_name'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Region not available</option>';
                        }
                        ?>

                    </select>
                    <label for="sel-reg" class=" col-form-label"><strong>Select Division</strong></label>
                    <select name="division" id="division" class="form-control">
                        <option value="<?php echo $div_id; ?>"><?php echo $divi_name; ?></option>
                    </select>

                    <label for="sel-reg" class=" col-form-label"><strong>Select Municipality</strong></label>
                    <select name="municipality" id="municipality" class="form-control">
                        <option value="<?php echo $muni_id; ?>"><?php echo $muni_name; ?></option>
                    </select>


                    <div class="m-2">
                        <button type="submit" class="btn btn-secondary  my-4" name="update">Update</button>&nbsp
                        <a class="btn btn-danger my-4" href="../school.php" role="button">Cancel</a>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
<br>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
        $('#sgl').on('change', function() {
            var sgl = $(this).val(); 
            if (sgl) {
                $.ajax({
                    type: 'POST',
                    url: '../ajaxschoollevel.php',
                    data: 'schoollevel_id=' + sgl,
                    success: function(html) {
                        $('#school_curri').html(html);
                    }
                });
            } else {
                $('#school_curri').html('<option value="">Select School Grade Level first</option>');
            }
        });
     });

    $(document).ready(function() {
        $('#region').on('change', function() {
            var regionID = $(this).val();
            if (regionID) {
                $.ajax({
                    type: 'POST',
                    url: '../ajaxschool.php',
                    data: 'reg_id=' + regionID,
                    success: function(html) {
                        $('#division').html(html);
                        $('#municipality').html('<option value="">Select Division first</option>');
                    }
                });
            } else {
                $('#division').html('<option value="">Select region first</option>');
                $('#municipality').html('<option value="">Select division first</option>');
            }
        });

        $('#division').on('change', function() {
            var divisionID = $(this).val();
            if (divisionID) {
                $.ajax({
                    type: 'POST',
                    url: '../ajaxschool.php',
                    data: 'div_id=' + divisionID,
                    success: function(html) {
                        $('#municipality').html(html);
                    }
                });
            } else {
                $('#municipality').html('<option value="">Select division first</option>');
            }
        });
    });
</script>

<footer>
    <?php
    include '../includes/footer.php';
    ?>
</footer>