<?php
include_once 'includes.php';


if (isset($_GET['edit'])) {
    $div_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM division_tbl WHERE div_id=$div_id");
    $record = mysqli_fetch_array($query);
    $reg_id = $record['reg_id'];
    $divi_name = $record['divi_name'];
}
?>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
        <div class="h4 breadcrumb bg-dark text-white ">Update Division Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="div_id" value="<?php echo $div_id; ?>" />
            <div class="form-group row">
                <div class="col-md">
                    <label for="divi">Select Region</label>
                    <?php

                    $regresult = $conn->query("SELECT * FROM region_tbl WHERE reg_id=$reg_id");
                    while ($rows = $regresult->fetch_assoc()) :
                        $region_name = $rows['region_name'];
                        ?>
                        <select name="reg_name" class="form-control">
                            <option value="<?php echo $reg_id; ?>"><?php echo $region_name; ?></option>
                            <?php

                                //SET THE QUERY TO DISPLAY ALL POSSIBLE OPTIONS 
                                $reg = $conn->query("SELECT * FROM region_tbl");
                                while ($rowreg = $reg->fetch_assoc()) :
                                    $id = $rowreg['reg_id'];
                                    $name = $rowreg['region_name'];
                                    ?>
                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                            <?php
                                //END OF QUERY FOR DISPLAY ALL OPTIONS 
                                endwhile
                                ?>

                        <?php
                        //END OF QUERY RETAINING 
                        endwhile
                        ?>

                        </select>

                </div>
            </div>

            <div class="form-group ">
                <label for="division">Division Option</label>
                <input type="text" class="form-control" id="division" name="divi_name" value="<?php echo $divi_name;  ?>" />
            </div>

            <div class="form-row">
                <button type="submit" name="updateDIV" class="btn btn-primary btn-block">Update</button>
                <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
    </div>
</div>
<br>
</form>
<?php

include '../includes/footer.php';
?>