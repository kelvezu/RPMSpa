<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $seminar_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM seminar_tbl WHERE seminar_id=$seminar_id");
    $record = mysqli_fetch_array($query);
    $semstart_date = $record['semstart_date'];
    $semend_date = $record['semend_date'];
    $seminar_name = $record['seminar_name'];


    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Seminar Confirmation</div>
                        <input type="hidden" name="seminar_id" value="<?php echo $seminar_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $seminar_id; ?></u></b> MOV from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processseminar.php?delete=<?php echo $seminar_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displayseminar.php" class="btn btn-primary btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
    <?php
    }
    ?>

    <?php

    include '../includes/footer.php';
    ?>