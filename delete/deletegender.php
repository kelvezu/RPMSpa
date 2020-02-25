<?php
include_once 'includes.php';


if (isset($_GET['delete'])) {
    $gender_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM gender_tbl WHERE gender_id=$gender_id");
    $record = mysqli_fetch_array($query);
    $gender_name = $record['gender_name'];
}




?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Remove Gender Confirmation</div>
                    <input type="hidden" name="gender_id" value="<?php echo $gender_id; ?>" />
                    <p class="h5">Do you want to remove <b><?php echo $gender_name; ?></b> from the database?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deleteGD=<?php echo $gender_id; ?>" class="btn btn-danger btn-block">Remove</a>
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