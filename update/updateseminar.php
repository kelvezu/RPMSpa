<?php
include_once 'includes.php';

//DATABASE 
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $seminar_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM seminar_tbl WHERE seminar_id=$seminar_id");
    $record = mysqli_fetch_array($query);
    $semstart_date = $record['semstart_date'];
    $semend_date = $record['semend_date'];
    $seminar_name = $record['seminar_name'];
}
?>

<div class="container">
    <div class="breadcome-list  shadow-reset">
        <form action="../includes/processseminar.php" class="form-group sm" method="POST">
            <input type="hidden" name="seminar_id" value="<?php echo $seminar_id; ?>" />
            <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Seminar</strong></legend>
            <div>

                <div class="form-group-sm">
                    <input type="hidden" name="seminar_id" id="seminar-id" value="<?php echo $seminar_id;  ?>">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="start-date" class="col-form-label"><strong>Select Start Date</strong></label>
                            <input type="date" name="semstart_date" class="form-control" value="<?php echo $semstart_date; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="end-date" class="col-form-label"><strong>Select End Date</strong></label>
                            <input type="date" name="semend_date" class="form-control" value="<?php echo $semend_date; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="sem-name" class="col-form-label"><strong>Seminar Name</strong></label>
                            <textarea name="seminar_name" id="sem-name" cols="5" rows="5" class="form-control" placeholder="Enter the seminar name..." required><?php echo $seminar_name; ?></textarea>
                        </div>
                    </div>
                    <div class="m-2"><br>
                        <a href="../displayseminar.php" class="btn btn-danger" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="update">Update Seminar</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
<br>
<?php

include '../includes/footer.php';
?>