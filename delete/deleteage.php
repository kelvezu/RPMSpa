<?php


if (isset($_GET['delete'])) {
    $age_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM age_tbl WHERE age_id=$age_id");
    $record = mysqli_fetch_array($query);
    $age_name = $record['age_name'];
}
?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Remove Age Confirmation</div>
                    <input type="hidden" name="age_id" value="<?php echo $age_id; ?>" />
                    <p class="h5">Do you want to remove <b><?php echo $age_name; ?></b> from the selection?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deleteAGE=<?php echo $age_id; ?>" class="btn btn-danger btn-block">Remove</a>
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