<?php
include_once 'includes.php';


if (isset($_GET['delete'])) {
    $reg_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM region_tbl WHERE reg_id=$reg_id");
    $record = mysqli_fetch_array($query);
    $region_name = $record['region_name'];
}




?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Delete Region Confirmation</div>
                    <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>" />
                    <p class="h5">Do you want to delete <b><?php echo $region_name; ?></b> from the database?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deleteREG=<?php echo $reg_id; ?>" class="btn btn-danger btn-block">Delete</a>
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