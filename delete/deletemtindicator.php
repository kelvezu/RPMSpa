<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $mtindicator_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM mtindicator_tbl WHERE mtindicator_id=$mtindicator_id");
    $record = mysqli_fetch_array($query);
    $mtindicator_no = $record['mtindicator_no'];
    $mtindicator_name = $record['mtindicator_name'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Indicator Confirmation</div>
                        <input type="hidden" name="mtindicator_id" value="<?php echo $mtindicator_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $mtindicator_no; ?></u></b> indicator from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processmtindicator.php?delete=<?php echo $mtindicator_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaymtindicator.php" class="btn btn-primary btn-block">Cancel</a>
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