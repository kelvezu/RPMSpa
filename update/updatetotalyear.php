<?php
include 'includes.php';

if (isset($_GET['edit'])) {
    $totalyear_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM totalyear_tbl WHERE totalyear_id=$totalyear_id");
    $record = mysqli_fetch_array($query);
    $totalyear_name = $record['totalyear_name'];
}
?>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
        <div class="h4 breadcrumb bg-dark text-white ">Update Total Year Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="totalyear_id" value="<?php echo $totalyear_id; ?>" />

            <div class="form-group ">
                <label for="totalyear">Total Year Option</label>
                <input type="text" class="form-control" id="totalyear" name="totalyear_name" value="<?php echo $totalyear_name;  ?>" required pattern="[0-9A-Za-z -]{3,}" title="Input three or more characters and input should not include special characters" />
            </div>

            <div class="form-row">
                <button type="submit" name="updateTY" class="btn btn-primary btn-block">Update</button>
                <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
    </div>
</div>
<br>
</form>

<?php

include '../includes/footer.php';
?>