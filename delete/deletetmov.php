<?php
include_once 'includes.php';

if (isset($_GET['delete'])) {
    $tmov_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM tmov_tbl WHERE tmov_id=$tmov_id");
    $record = mysqli_fetch_array($query);
    $kra_id = $record['kra_id'];
    $tobj_id = $record['tobj_id'];
    $main_mov = $record['main_mov'];
    $supp_mov = $record['supp_mov'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete MOV Confirmation</div>
                        <input type="hidden" name="tmov_id" value="<?php echo $tmov_id; ?>" />
                        <p class="h5">Do you want to delete <b><u><?php echo $tmov_id; ?></u></b> MOV from the database?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processtmov.php?delete=<?php echo $tmov_id; ?>" class="btn btn-danger btn-block">Delete</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaytmov.php" class="btn btn-primary btn-block">Cancel</a>
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