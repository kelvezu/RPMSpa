<?php

include_once 'includes.php';


if (isset($_GET['delete'])) {
    $rubric_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM mtrubric_tbl WHERE rubric_id=$rubric_id");
    $record = mysqli_fetch_array($query);
    $rubric_lvl = $record['rubric_lvl'];
    $level_name = $record['level_name'];
    $rubric_description = $record['rubric_description'];
    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Rubric Confirmation</div>
                        <input type="hidden" name="rubric_id" value="<?php echo $rubric_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $level_name; ?></u></b> rubric from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processmtrubric.php?delete=<?php echo $rubric_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaymtrubric.php" class="btn btn-primary btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
    <?php
    }

    include '../includes/footer.php';

    ?>