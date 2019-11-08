<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $indicator_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM tindicator_tbl WHERE indicator_id=$indicator_id");
    $record = mysqli_fetch_array($query);
    $indicator_no = $record['indicator_no'];
    $indicator_name = $record['indicator_name'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Indicator Confirmation</div>
                        <input type="hidden" name="indicator_id" value="<?php echo $indicator_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $indicator_no; ?></u></b> indicator from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processtindicator.php?delete=<?php echo $indicator_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaytindicator.php" class="btn btn-primary btn-block">Cancel</a>
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