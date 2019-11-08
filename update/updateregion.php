<?php
include_once 'includes.php';

if (isset($_GET['edit'])) {
    $reg_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM region_tbl WHERE reg_id=$reg_id");
    $record = mysqli_fetch_array($query);
    $region_name = $record['region_name'];
}
?>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">

        <div class="h4 breadcrumb bg-dark text-white ">Update Region Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>" />

            <div class="form-group ">
                <label for="region">Region Option</label>
                <input type="text" class="form-control" id="region" name="region_name" value="<?php echo $region_name;  ?>" />
            </div>

            <div class="form-row">
                <button type="submit" name="updateREG" class="btn btn-primary btn-block">Update</button>
                <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
    </div>
</div>
<br>
</form>


<?php

include '../includes/footer.php';
?>