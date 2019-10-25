<?php
include 'includes.php';

if (isset($_GET['delete'])) {
    $position_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM position_tbl WHERE position_id=$position_id");
    $record = mysqli_fetch_array($query);
    $position_name = $record['position_name'];
}




?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Delete Position Confirmation</div>
                    <input type="hidden" name="position_id" value="<?php echo $position_id; ?>" />
                    <p class="h5">Do you want to delete <b><?php echo $position_name; ?></b> from the database?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deletePST=<?php echo $position_id; ?>" class="btn btn-danger btn-block">Delete</a>
                        </div>
                        <div class="col-md-6">
                            <a href="../ESAT.php" class="btn btn-primary btn-block">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <br>


</main>
<?php

include '../includes/footer.php';
?>