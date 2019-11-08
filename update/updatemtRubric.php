<?php
include_once 'includes.php';




if (isset($_GET['edit'])) {
    $rubric_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM mtrubric_tbl WHERE rubric_id=$rubric_id");
    $record = mysqli_fetch_array($query);
    $rubric_lvl = $record['rubric_lvl'];
    $level_name = $record['level_name'];
    $rubric_description = $record['rubric_description'];
}

?>



<main>


    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processmtrubric.php" class="form-group sm" method="POST">

                <legend class="legend-control bg-primary text-white ">Rubric Level Summary for Master Teacher I-IV</legend>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" name="rubric_id" value="<?php echo $rubric_id; ?>" />
                        <label for="level" class="control-label"><strong>Rubric Level</strong></label>
                        <input type="number" name="rubric_lvl" id="rubric-lvl" class="form-control" width="500" value="<?php echo $rubric_lvl; ?>" placeholder="Enter the rubric level..." required pattern="[0-9]" title="Input number only">
                    </div>

                    <div class="col-sm-6">
                        <label for="level-name" class="control-label"><strong>Level Name</strong></label>
                        <input type="text" name="level_name" id="level-name" class="form-control" width="500" value="<?php echo $level_name; ?>" placeholder="Enter the Level Name..." required pattern="[A-Za-z]{3,}" title="Input three or more characters and input should not include numbers and special characters" />
                    </div>
                </div>

                <div>
                    <label for="description" class="control-label w-25 "><strong>Description</strong></label>
                    <textarea name="rubric_description" id="policy-content" cols="5" rows="5" class="form-control" value="" placeholder="Enter the description..." required><?php echo $rubric_description ?></textarea>
                </div>
                <div class="row">


                    <button type="submit" class="btn btn-primary my-4" name="update">Update</button> &nbsp
                    <a class="btn btn-danger my-4" href="../displaymtRubric.php" role="button">Cancel</a>

                </div>
            </form>

        </div>
    </div>
    <br>
</main>

<?php

include '../includes/footer.php';
?>