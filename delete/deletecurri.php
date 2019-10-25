<?php
include 'includes.php';

if (isset($_GET['delete'])) {
    $curriclass_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM curriclass_tbl WHERE curriclass_id=$curriclass_id");
    $record = mysqli_fetch_array($query);
    $curriclass_name = $record['curriclass_name'];
}




?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Remove Curricular Classification Taught Confirmation</div>
                    <input type="hidden" name="curriclass_id" value="<?php echo $curriclass_id; ?>" />
                    <p class="h5">Do you want to remove <b><?php echo $curriclass_name; ?></b> from the database?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deleteCURRI=<?php echo $curriclass_id; ?>" class="btn btn-danger btn-block">Remove</a>
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