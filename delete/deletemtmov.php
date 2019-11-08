<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $mtmov_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM mtmov_tbl WHERE mtmov_id=$mtmov_id");
    $record = mysqli_fetch_array($query);
    $kra_id = $record['kra_id'];
    $mtobj_id = $record['mtobj_id'];
    $main_mov = $record['main_mov'];
    $supp_mov = $record['supp_mov'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete MOV Confirmation</div>
                        <input type="hidden" name="mtmov_id" value="<?php echo $mtmov_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $mtmov_id; ?></u></b> MOV from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processmtmov.php?delete=<?php echo $mtmov_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaymtmov.php" class="btn btn-primary btn-block">Cancel</a>
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