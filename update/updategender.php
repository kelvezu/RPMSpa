    <?php

    include_once 'includes.php';


    if (isset($_GET['edit'])) {
        $gender_id = $_GET['edit'];

        $query = mysqli_query($conn, "SELECT * FROM gender_tbl WHERE gender_id=$gender_id");
        $record = mysqli_fetch_array($query);
        $gender_name = $record['gender_name'];
    }
    ?>
    <div class="container">
        <div class="breadcome-list map-mg-t-40-gl shadow-reset">
            <div class="h4 breadcrumb bg-dark text-white ">Update Gender Option</div>
            <form method="post" action="../includes/processESAT.php">
                <input type="hidden" name="gender_id" value="<?php echo $gender_id; ?>" />

                <div class="form-group ">
                    <label for="username">Gender Option</label>
                    <input type="text" class="form-control" id="contact" name="gender_name" value="<?php echo $gender_name;  ?>" />
                </div>

                <div class="form-row">
                    <button type="submit" name="updateGEN" class="btn btn-primary btn-block">Update</button>
                    <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
                </div>
        </div>
    </div>

    <br>
    </form>
    <?php

    include '../includes/footer.php';
    ?>