<?php

include 'sampleheader.php';

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script>

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
                <form action="includes/processschool.php" method="POST">
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Grade Level</strong></label>
                            <select class="form-control" name="sgl" id="">
                                <option value="">--Select--</option>
                                <option value="Elementary School">Elementary School</option>
                                <option value="Secondary School">Secondary School</option>
                                <option value="Division Office">Division Office</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Number</strong></label>
                            <input type="number" name="school_no" id="school-no" class="form-control" placeholder="Enter the School No..." required pattern="[0-9]{3,}" title="Input three or more numbers and input should not include special characters">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-name" class="col-form-label"><strong>School Name</strong></label>
                            <input type="text" name="school_name" id="school-name" class="form-control" placeholder="Enter the School Name..." required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include numbers and special characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="tel-no" class="col-form-label"><strong>Telephone Number</strong></label>
                            <input type="number" name="tel_no" id="tel-no" class="form-control" placeholder="Enter the Telephone Number..." required pattern="[0-9-]{8}" title="Input eight digit number">
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
                            <select name="region" id="region" class="form-control">
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
                            <select name="division" id="division" class="form-control">
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
<div class="right">

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
    <?php endif ?>

    <main>
        <div class="container">
         
                <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#school-modal">Add School</button>


                <div class="h4 breadcrumb bg-dark text-white ">School Information </div>
                <?php

                $query2 = mysqli_query($conn, "SELECT region_tbl.region_name,division_tbl.divi_name,municipality_tbl.muni_name,school_tbl.* FROM (((school_tbl INNER JOIN region_tbl ON school_tbl.reg_id = region_tbl.reg_id) INNER JOIN division_tbl ON school_tbl.div_id = division_tbl.div_id) INNER JOIN municipality_tbl ON school_tbl.muni_id = municipality_tbl.muni_id) ORDER BY school_id") or die($conn->error);

                ?>

                <table class="table table-sm">
                    <caption>School Information</caption>
                    <thead class="bg-success text-white text-nowrap ">
                        <tr>
                            <th>School Grade Level</th>
                            <th>School Number</th>
                            <th>School Name</th>
                            <th>Telephone Number</th>
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
                                <td><?php echo $rows['school_grade_lvl']; ?></td>
                                <td><?php echo $rows['school_no']; ?></td>
                                <td><?php echo $rows['school_name']; ?></td>
                                <td><?php echo $rows['tel_no']; ?></td>
                                <td><?php echo $rows['region_name']; ?></td>
                                <td><?php echo $rows['divi_name']; ?></td>
                                <td><?php echo $rows['muni_name']; ?></td>
                                <td><a href="update/updateschool.php?edit=<?php echo $rows['school_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                <td><a href="delete/deleteschool.php?delete=<?php echo $rows['school_id']; ?>" class="btn btn-outline-danger">Delete</a></td>



                            <?php } ?>
                            </tr>

                        </tbody>
                </table>
            </div>
        </div>
</div>




<br>
<?php

include 'samplefooter.php';

?>