    <?php
    include 'includes.php';


    if (isset($_GET['edit'])) {
        $position_id = $_GET['edit'];
        $query = mysqli_query($conn, "SELECT * FROM position_tbl WHERE position_id=$position_id") or die($conn->error);
        $record = mysqli_fetch_array($query);
        $position_name = $record['position_name'];
    }
    ?>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset">

            <div class="h4 breadcrumb bg-dark text-white ">Update Position Option</div>
            <form method="post" action="../includes/processESAT.php">
                <input type="hidden" name="position_id" value="<?php echo $position_id; ?>" />

                <div class="form-group ">
                    <label for="username">Position Option</label>
                    <input type="text" class="form-control" id="contact" name="position_name" value="<?php echo $position_name;  ?>" />
                </div>

                <div class="form-row">
                    <button type="submit" name="updatePOS" class="btn btn-primary btn-block">Update</button>
                    <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
                </div>
        </div>
    </div>
    <br>
    </form>
    <?php

    include '../includes/footer.php';
    ?>