<?php
include 'includes.php';


if (isset($_GET['delete'])) {
    $totalyear_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM totalyear_tbl WHERE totalyear_id=$totalyear_id");
    $record = mysqli_fetch_array($query);
    $totalyear_name = $record['totalyear_name'];
}




?>

<main>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
            <div class="card">
                <div class="card-body">
                    <div class="h4 breadcrumb alert alert-danger text-center">Remove Total Year Confirmation</div>
                    <input type="hidden" name="totalyear_id" value="<?php echo $totalyear_id; ?>" />
                    <p class="h5">Do you want to remove <b><?php echo $totalyear_name; ?></b> from the selection?</p>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <a href="../includes/processESAT.php?deleteTY=<?php echo $totalyear_id; ?>" class="btn btn-danger btn-block">Remove</a>
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