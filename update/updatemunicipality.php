<?php
include_once 'includes.php';

if (isset($_GET['edit'])) {
    $muni_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM municipality_tbl WHERE muni_id=$muni_id");
    $record = mysqli_fetch_array($query);
    $muni_name = $record['muni_name'];
    $div_id = $record['div_id'];
}
?>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">

        <div class="h4 breadcrumb bg-dark text-white ">Update Municipality Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="muni_id" value="<?php echo $muni_id; ?>" />

            <div class="form-group row">
                <div class="col-md">
                    <label for="divi">Select Division</label>
                    <?php

                    $regresult = $conn->query("SELECT * FROM division_tbl WHERE div_id=$div_id");
                    while ($rows = $regresult->fetch_assoc()) :
                        $divi_name = $rows['divi_name'];
                        ?>
                        <select name="diviname" class="form-control">
                            <option value="<?php echo $div_id; ?>"><?php echo $divi_name; ?></option>
                            <?php

                                //SET THE QUERY TO DISPLAY ALL POSSIBLE OPTIONS 
                                $reg = $conn->query("SELECT * FROM division_tbl");
                                while ($rowreg = $reg->fetch_assoc()) :
                                    $id = $rowreg['div_id'];
                                    $name = $rowreg['divi_name'];
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
                <label for="municipality">Municipality</label>
                <input type="text" class="form-control" id="muni_name" name="muni_name" value="<?php echo $muni_name;  ?>" />
            </div>

            <div class="form-row">
                <button type="submit" name="updateMUNI" class="btn btn-primary btn-block">Update</button>
                <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
    </div>
</div>
<br>
</form>

<?php

include '../includes/footer.php';
?>