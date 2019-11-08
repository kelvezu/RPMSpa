<?php
include_once 'includes.php';


//DATABASE
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $mtobj_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM mtobj_tbl WHERE mtobj_id=$mtobj_id");
    $record = mysqli_fetch_array($query);
    $mtobj_id = $record['mtobj_id'];
    $kra_id = $record['kra_id'];
    $mtobj_name = $record['mtobj_name'];


    ?>

    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processmtkramov.php" class="form-group sm" method="POST">
                <input type="hidden" name="mtobj_id" value="<?php echo $mtobj_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Objective</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <input type="hidden" name="mtobj_id" id="mtobj_id" value="<?php echo $mtobj_id  ?>">

                        <label for="kra">Key Result Areas</label>
                        <?php
                            //QUERY FOR RETAINING THE LAST ID 
                            $kraresult = $conn->query("SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
                            while ($rows = $kraresult->fetch_assoc()) :
                                $kra_name = $rows['kra_name'];
                                ?>
                            <select class="form-control" name="kraid" id="kraid">
                                <option value="<?php echo $kra_id; ?>"><?php echo $kra_name; ?></option>
                                <?php
                                        //SET THE QUERY TO DISPLAY ALL POSSIBLE OPTIONS 
                                        $kra = $conn->query("SELECT * FROM kra_tbl");
                                        while ($rowkra = $kra->fetch_assoc()) :
                                            $id = $rowkra['kra_id'];
                                            $name = $rowkra['kra_name'];
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
                <div>
                    <label for="mtobj_name" class="control-label "><strong>Objective</strong></label>
                    <textarea name="newtobj_name" id="tobj_name" cols="30" rows="5" class="form-control"><?php echo $mtobj_name; ?></textarea>
                </div>
                <div class="row m-1">
                    <button type="submit" class="btn btn-secondary  my-4" name="updatetOBJ">Update</button>&nbsp
                    <a class="btn btn-danger my-4" href="../displaymtkramov.php" role="button">Cancel</a>
                </div>

            </form>
        </div>

    </div>
<?php
};
?>

<?php
if (isset($_GET['editkra'])) {
    $kra_id = $_GET['editkra'];

    $result = $conn->query("SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
    $row = $result->fetch_assoc();
    $kra_id = $row['kra_id'];
    $kra_name = $row['kra_name'];
    ?>

    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processmtkramov.php" class="form-group sm" method="POST">
                <input type="hidden" name="kra_id" value="<?php echo $kra_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update KRA</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <input type="hidden" name="kra_id" id="kra_id" value="<?php echo $kra_id  ?>">
                    </div>
                </div>
                <div>
                    <label for="kra_name" class="control-label "><strong>KRA Name</strong></label>
                    <textarea name="newkra_name" id="kra_name" cols="30" rows="5" class="form-control"><?php echo $kra_name; ?></textarea>
                </div>
                <div class="row m-1">
                    <button type="submit" class="btn btn-secondary  my-4" name="updatetKRA">Update</button>&nbsp
                    <a class="btn btn-danger my-4" href="../displaymtkramov.php" role="button">Cancel</a>
                </div>

            </form>
        </div>

    </div>

<?php
};
?>
<br>
</main>

<?php

include '../includes/footer.php';
?>