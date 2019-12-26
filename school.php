<?php

include 'sampleheader.php';


if(isset($_GET['notif'])):
    if(($_GET['notif']) == 'taken'):
    echo "<div class='red-notif-border'>Duplicate entry found. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'whitespace'):
    echo "<div class='red-notif-border'>Too much space. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'duplicate'):
    echo "<div class='red-notif-border'>Telephone number should be unique. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'success'):
     echo "<div class='green-notif-border'>School has been added!</div>";
    elseif (($_GET['notif']) == 'error'):
    echo "<div class='red-notif-border'>Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'charNumber'):
    echo "<div class='red-notif-border'>Lack of Characters!</div>";
    endif;
endif;


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script>


     $(document).ready(function() {
        $('#sgl').on('change', function() {
            var sgl = $(this).val(); 
            if (sgl) {
                $.ajax({
                    type: 'POST',
                    url: 'ajaxschoollevel.php',
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
                    url: 'ajaxschool.php',
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
                    url: 'ajaxschool.php',
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


<div class="modal fade" id="school-modal" tabindex="-1" role="dialog" aria-labelledby="schoolModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add School Information</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processschool.php" method="POST" id="schoolForm">
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Grade Level</strong></label>
                            <select class="form-control" name="sgl" id="sgl" required>
                                <option value="" disabled selected>--Select--</option>
                               <?php
                                    $levelqry = $conn->query("SELECT * FROM school_grade_level_tbl");
                                        while ($schoolLevel = $levelqry->fetch_assoc()):
                                            $lvlid = $schoolLevel['schoollevel_id'];
                                            $lvlname = $schoolLevel['schoollevel_name'];
                                ?>
                                <option value="<?php echo $lvlid; ?>"><?php echo $lvlname; ?></option>
                                        <?php endwhile;?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Curricular Classification</strong></label>
                            <select class="form-control" name="school_curri" id="school_curri" required>
                                <option value="" disabled selected>Select School Grade Level first</option>
                            </select>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Number</strong></label>
                            <input type="number" name="school_no" id="schoolno" class="form-control" placeholder="Enter the School No..." required pattern="[0-9]{3,}" title="Input three or more numbers and input should not include special characters">
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-name" class="col-form-label"><strong>School Name</strong></label>
                            <input type="text" name="school_name" id="schoolname" class="form-control" placeholder="Enter the School Name..." required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include numbers and special characters" >
                             <div id="errorName"></div>
                              <div id="errorName2"></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="tel-no" class="col-form-label"><strong>Telephone Number</strong></label>
                            <input type="number" name="tel_no" id="telno" class="form-control" placeholder="Enter the Telephone Number..." required pattern="[0-9-]{8}" title="Input eight digit number">
                            <div id="errortelNo"></div>
                            <input type="number" name="tel_no2" id="telno2" class="form-control" placeholder="Enter the Telephone Number..." pattern="[0-9-]{8}" title="Input eight digit number">
                            <div id="errortelNo2"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="sel-reg" class=" col-form-label"><strong>Select Region</strong></label>

                            <?php

                            include 'includes/conn.inc.php';
                            $query = $conn->query("SELECT * FROM region_tbl");

                            $rowCount = $query->num_rows;
                            ?>
                            <select name="region" id="region" class="form-control" required>
                                <option value="">Select Region</option>
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
                            <select name="division" id="division" class="form-control" required>
                                <option value="">Select Region first</option>
                            </select>
                            <label for="sel-reg" class=" col-form-label"><strong>Select Municipality</strong></label>
                            <select name="municipality" id="municipality" class="form-control">
                                <option value="">Select Division first</option>
                               
                            </select>


                            <div class="m-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Add School</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



<script>

$(document).ready(function() {
        $('#schoolno').on('change', function() {
            var schoolno = $(this).val(); 
            if (schoolno) {
                $.ajax({
                    type: 'POST',
                    url: 'validateschool.php',
                    data: 'school_no=' + schoolno,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
     });

$(document).ready(function() {
        $('#schoolname').on('change', function() {
            var schoolname = $(this).val(); 
            if (schoolname) {
                $.ajax({
                    type: 'POST',
                    url: 'validateschool.php',
                    data: 'school_name=' + schoolname,
                    success: function(html) {
                         $('#errorName').html(html);
                    }
                });
            } else {
                return "Please enter school name";
            }
        });
     });

$(document).ready(function() {
        $('#telno').on('change', function() {
            var telno = $(this).val(); 
            if (telno) {
                $.ajax({
                    type: 'POST',
                    url: 'validateschool.php',
                    data: 'telno=' + telno,
                    success: function(html) {
                         $('#errortelNo').html(html);
                    }
                });
            } else {
                return "Please enter telephone number";
            }
        });
     });

$(document).ready(function() {
        $('#telno2').on('change', function() {
            var telno = $('#telno').val(); 
            var telno2 = $(this).val(); 
            if (telno2) {
                $.ajax({
                    type: 'POST',
                    url: 'validateschool1.php',
                    data: 'telno2=' + telno2 + '&telno='+ telno,
                    success: function(html) {
                         $('#errortelNo2').html(html);
                    }
                });
            } else {
                return "Please enter telephone number";
            }
        });
     });




</script>

<div class="right">

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
    <?php endif ?>


        <div class="container">
         
                <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#school-modal">Add School</button>


                <div class="h4 breadcrumb bg-dark text-white ">School Information </div>
                <?php

                $query2 = mysqli_query($conn, "SELECT region_tbl.region_name,division_tbl.divi_name,municipality_tbl.muni_name, school_tbl.* FROM (((school_tbl INNER JOIN region_tbl ON school_tbl.reg_id = region_tbl.reg_id) INNER JOIN division_tbl ON school_tbl.div_id = division_tbl.div_id) INNER JOIN municipality_tbl ON school_tbl.muni_id = municipality_tbl.muni_id) ORDER BY school_id") or die($conn->error);

                ?>
<small>
                <table class="table table-sm table-bordered">
                    <caption>School Information</caption>
                    <thead class="bg-success text-white text-nowrap ">
                        <tr>
                            <th>School Grade Level</th>
                             <th>School Curricular Classification</th>
                            <th>School Number</th>
                            <th>School Name</th>
                            <th>Tel No.</th>
                            <th>Alt No.</th>
                            <th>Region</th>
                            <th>Division</th>
                            <th>Municipality</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                    while ($rows = mysqli_fetch_array($query2)) {
                        ?>
                        <tbody class="text-justify">
                            <tr>
                                <td><?php echo displaySchoolGradeLevel($conn, $rows['school_grade_lvl']); ?></td>
                                 <td><?php echo  displaySchoolCurriClass($conn, $rows['school_curriclass']); ?></td>
                                <td><?php echo $rows['school_no']; ?></td>
                                <td><?php echo $rows['school_name']; ?></td>
                                <td><?php echo $rows['tel_no']; ?></td>
                                <td><?php echo $rows['tel_no2']; ?></td>
                                <td><?php echo $rows['region_name']; ?></td>
                                <td><?php echo $rows['divi_name']; ?></td>
                                <td><?php echo $rows['muni_name']; ?></td>
                                <td><a href="update/updateschool.php?edit=<?php echo $rows['school_id']; ?>" class="btn btn-outline-primary btn-sm">Update</a></td>
                                <td><a href="delete/deleteschool.php?delete=<?php echo $rows['school_id']; ?>" class="btn btn-outline-danger btn-sm">Delete</a></td>



                            <?php } ?>
                            </tr>

                        </tbody>
                </table>    
                </small>
            </div>
        </div>
</div>




<br>
<?php

include 'samplefooter.php';

?>