<?php

include_once 'includes.php';



if (isset($_GET['edit'])) {
    $mtindicator_id = $_GET['edit'];
    $query = mysqli_query($conn, "SELECT * FROM mtindicator_tbl WHERE mtindicator_id=$mtindicator_id");
    $record = mysqli_fetch_array($query);
    $mtindicator_no = $record['mtindicator_no'];
    $mtindicator_name = $record['mtindicator_name'];
    $obs1_period = $record['period1'];
    $obs2_period = $record['period2'];
    $obs3_period = $record['period3'];
    $obs4_period = $record['period4'];
}

?>


<main>

    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processmtindicator.php" class="form-group sm" method="POST">
                <input type="hidden" name="mtindicator_id" value="<?php echo $mtindicator_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Indicator</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <label for="indicator-no" class="control-label"><strong>Indicator Number</strong></label>
                        <input type="number" name="newmtindicator_no" id="indicator-no" class="form-control" value="<?php echo $mtindicator_no; ?>" width="500" required pattern="[0-9]" title="Input number only">
                    </div>
                </div>
                <div>
                    <label for="indicator-name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                    <textarea name="newmtindicator_name" value="" id="indicator-name" cols="5" rows="5" class="form-control" required><?php echo $mtindicator_name; ?></textarea>
                </div>
                <div>
                    <label for="obs" class="control-label w-25 "><strong>Observation Period</strong></label>
                    <input type="checkbox" name="new_obs1" id="" class="form-control-sm" value="1" <?php if ($obs1_period == 1) echo 'checked="checked"'; ?>>1st
                    <input type="checkbox" name="new_obs2" id="" class="form-control-sm" value="1" <?php if ($obs2_period == 1) echo 'checked="checked"'; ?>>2nd
                    <input type="checkbox" name="new_obs3" id="" class="form-control-sm" value="1" <?php if ($obs3_period == 1) echo 'checked="checked"'; ?>>3rd
                    <input type="checkbox" name="new_obs4" id="" class="form-control-sm" value="1" <?php if ($obs4_period == 1) echo 'checked="checked"'; ?>>4th
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary my-4" name="update">Update</button>&nbsp
                    <a class="btn btn-danger my-4" href="../displaymtindicator.php" role="button">Cancel</a>
                </div>


        </div>

    </div>
    </form>
    <br>
</main>
<?php

include '../includes/footer.php';
?>