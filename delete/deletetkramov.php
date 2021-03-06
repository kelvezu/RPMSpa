<?php
include_once 'includes.php';


if (isset($_GET['delete'])) {
    $tobj_id = $_GET['delete'];

    $query = mysqli_query($conn, "SELECT * FROM tobj_tbl WHERE tobj_id=$tobj_id");
    $record = mysqli_fetch_array($query);
    $tobj_name = $record['tobj_name'];

    ?>

    <main>
        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete Objective Confirmation</div>
                        <input type="hidden" name="tobj_id" value="<?php echo $tobj_id; ?>" />
                        <p class="h5">Do you want to remove <b><u><?php echo $tobj_name; ?></u></b> objective from the selection?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processtkramov.php?delete=<?php echo $tobj_id; ?>" class="btn btn-danger btn-block">Remove</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaytkramov.php" class="btn btn-primary btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
    <?php
    }
    ?>

    <?php

    if (isset($_GET['deletekra'])) {
        $kra_id = $_GET['deletekra'];

        $query = mysqli_query($conn, "SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
        $record = mysqli_fetch_array($query);
        $kra_name = $record['kra_name'];


        ?>

        <div class="container">
            <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="h4 breadcrumb alert alert-danger text-center">Delete KRA Confirmation</div>
                        <input type="hidden" name="tobj_id" value="<?php echo $kra_id; ?>" />
                        <p class="h5">Do you want to remove <b><u><?php echo $kra_name; ?></u></b> KRA from the selection?</p>
                        <div class="row my-4">
                            <div class="col-md-6">
                                <a href="../includes/processtkramov.php?deletekra=<?php echo $kra_id; ?>" class="btn btn-danger btn-block">Remove</a>
                            </div>
                            <div class="col-md-6">
                                <a href="../displaytkramov.php" class="btn btn-primary btn-block">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php

    }
    ?>
    </main>

    <br>

    <?php

    include '../includes/footer.php';
    ?>