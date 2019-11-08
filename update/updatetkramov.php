<?php
include_once 'includes.php';

//DATABASE
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $tobj_id = $_GET['edit'];

    $result = $conn->query("SELECT * FROM tobj_tbl WHERE tobj_id=$tobj_id");
    $row = $result->fetch_assoc();
    $tobj_id = $row['tobj_id'];
    $kra_id = $row['kra_id'];
    $tobj_name = $row['tobj_name'];


    ?>

    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processtkramov.php" class="form-group sm" method="POST">
                <input type="hidden" name="tobj_id" value="<?php echo $tobj_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Objective</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <input type="hidden" name="tobj_id" id="tobj_id" value="<?php echo $tobj_id  ?>">

                        <label for="cbc">Key Result Areas</label>
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
                    <label for="tobj_name" class="control-label "><strong>Objective</strong></label>
                    <textarea name="newtobj_name" id="tobj_name" cols="30" rows="5" class="form-control"><?php echo $tobj_name; ?></textarea>
                </div>
                <div class="row m-1">
                    <button type="submit" class="btn btn-secondary  my-4" name="updatetOBJ">Update</button>&nbsp
                    <a class="btn btn-danger my-4" href="../displaytkramov.php" role="button">Cancel</a>
                </div>

            </form>
        </div>
    </div>
    </div>
<?php
};
?>
<br>
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
            <form action="../includes/processtkramov.php" class="form-group sm" method="POST">
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
                    <a class="btn btn-danger my-4" href="../displaytkramov.php" role="button">Cancel</a>
                </div>

            </form>
        </div>

    </div>

<?php
};
?>

</main>
<br>
<?php

include '../includes/footer.php';
?>