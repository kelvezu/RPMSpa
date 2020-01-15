<?php
include_once 'includes.php';
include '../includes/conn.inc.php';


//DATABASE
// $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $mtobj_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM mtobj_tbl WHERE mtobj_id=$mtobj_id");
    $record = mysqli_fetch_array($query);
    $mtobj_id = $record['mtobj_id'];
    $kra_id = $record['kra_id'];
    $mtobj_name = $record['mtobj_name'];
    $class_observable = $record['classroom_observable'];
    $indicator_id = $record['indicator_id'];
?>

    <div class="container my-3">
        <!-- <div class="breadcome-list shadow-reset"> -->
        <form action="../includes/processmtkramov.php" method="POST">
            <input type="hidden" name="mtobj_id" value="<?php echo $mtobj_id; ?>" />
            <legend class=" breadcrumb bg-dark text-white "><strong>Update Objective</strong></legend>
            <div>

                <div>
                    <input type="hidden" name="mtobj_id" id="mtobj_id" value="<?php echo $mtobj_id  ?>">
                    <label class="font-weight-bold" for="kraid">Key Result Area</label>
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
                <input type="text" name="newtobj_name" id="tobj_name" class="form-control" value="<?php echo $mtobj_name; ?>" required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include special characters">
            </div>

            <div>
                <label for="classroom_observable"><strong>Classroom Observable</strong></label>
                <select class="form-control " name="classroom_observable" id="classroom_observable">
                    <option value="<?= $class_observable; ?>">
                        <?= $class_observable; ?>
                    </option>
                    <option value="No">
                        No
                    </option>
                    <option value="Yes">
                        Yes
                    </option>
                </select>
            </div>

            <div id="map_indicator_group">
                <label class="font-weight-bold" for="map_indicator">Select an Indicator to mapped this Objective</label>
                <select name="map_indicator" id="map_indicator" class="form-control">
                    <option value="<?= $indicator_id ?>" selected><?php echo ($indicator_id) == 0 ? "---Select Indicator---" : displayMTindicator($conn, $indicator_id)  ?></option>
                    <?php foreach (fetchMTindicator($conn) as $indicator) : ?>
                        <option class="text-wrap" value="<?= $indicator['mtindicator_id'] ?>">
                            <?= $indicator['mtindicator_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row m-1">
                <button type="submit" class="btn btn-secondary  my-4" name="updatetOBJ">Update</button>&nbsp
                <a class="btn btn-danger my-4" href="../displaymtkramov.php" role="button">Cancel</a>
            </div>

        </form>
        <!-- </div> -->

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
                    <input type="text" name="newkra_name" id="kra_name" class="form-control" value="<?php echo $kra_name; ?>" required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include special characters">
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
<script>
    const classroom_observable = document.getElementById("classroom_observable");
    const map_indicator_group = document.getElementById("map_indicator_group");
    const map_indicator = document.getElementById("map_indicator");
    map_indicator_group.style.display = "none"
    popMap();

    classroom_observable.addEventListener("click", popMap);

    function popMap() {
        // console.log(class_obs.value);
        if (classroom_observable.value == "Yes") {
            map_indicator_group.style.display = "block";
        } else {
            map_indicator_group.style.display = "none";
            map_indicator.value = "<?php echo $indicator_id ?>"
        }
    }
</script>

<?php

include '../includes/footer.php';
?>