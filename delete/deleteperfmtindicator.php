<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $perfmtindicator_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM perfmtindicator_tbl WHERE perfmtindicator_id=$perfmtindicator_id");
    $record = mysqli_fetch_array($query);
    $indicator_name = $record['indicator_name'];
    $qet = $record['qet'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Indicator Confirmation</div>
                        <input type="hidden" name="perfmtindicator_id" value="<?php echo $perfmtindicator_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $indicator_name; ?></u></b> under <b><u><?php echo $qet; ?></u></b> indicator from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processperfmtindicator.php?delete=<?php echo $perfmtindicator_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displayperfmtindicator.php" class="btn btn-primary btn-block">Cancel</a>
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