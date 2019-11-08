<?php
include_once 'includes.php';

if (isset($_GET['edit'])) {
    $perfmtindicator_id = $_GET['edit'];
    $query = mysqli_query($conn, "SELECT * FROM perfmtindicator_tbl WHERE perfmtindicator_id=$perfmtindicator_id");
    $record = mysqli_fetch_array($query);
    $kra_id = $record['kra_id'];
    $mtobj_id = $record['mtobj_id'];
    $qet = $record['qet'];
    $level_no  = $record['level_no'];
    $indicator_name  = $record['indicator_name'];
    $desc_name = $record['desc_name'];
}

?>



<div class="container ">
    <div class="breadcome-list shadow-reset">
        <form action="../includes/processperfmtindicator.php" class="form-group sm" method="POST">
            <input type="hidden" name="perfmtindicator_id" value="<?php echo $perfmtindicator_id; ?>" />
            <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Indicator</strong></legend>

            <div class="row">
                <div class="col-lg">
                    <label for="kra">Select KRA</label>
                    <?php
                    //QUERY FOR RETAINING THE LAST ID 
                    $kraresult = $conn->query("SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
                    while ($rows = $kraresult->fetch_assoc()) :
                        $kra_name = $rows['kra_name'];
                        ?>
                        <select name="kra_name" id="kradd" onChange="change_kra()" class="form-control">
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

                        <label for="obj">Select Objective</label>
                        <?php
                        //QUERY FOR RETAINING THE LAST ID 
                        $objresult = $conn->query("SELECT * FROM mtobj_tbl WHERE mtobj_id=$mtobj_id");
                        while ($rows = $objresult->fetch_assoc()) :
                            $mtobj_name = $rows['mtobj_name'];
                            ?>
                            <div id="objective">
                                <select class="form-control" name="mtobj_name">

                                    <option value="<?php echo $mtobj_id; ?>"><?php echo $mtobj_name; ?></option>
                                </select>
                            </div>
                        <?php
                        endwhile
                        ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg">
                    <label for="indicator-no" class="control-label"><strong>QET</strong></label>
                    <select name="qet" class="form-control">
                        <option value="<?php echo $qet; ?>"><?php echo $qet; ?></option>
                        <option value="Quality">Quality</option>
                        <option value="Efficiency">Efficiency</option>
                        <option value="Timeliness">Timeliness</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <label for="lvl-no" class="control-label w-25 "><strong>Level No</strong></label>
                    <input type="number" name="level_no" class="form-control" value="<?php echo $level_no; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <label for="indicator-name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                    <textarea name="indicator_name" id="indicator-name" cols="5" rows="5" class="form-control" placeholder="Enter the indicator name..."><?php echo $indicator_name; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <label for="desc" class="control-label w-25 "><strong>Indicator Description</strong></label>
                    <textarea name="desc_name" id="desc" cols="5" rows="5" class="form-control" placeholder="Enter the indicator description..."><?php echo $desc_name; ?></textarea>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-primary my-4" name="update">Update</button>&nbsp
                <a class="btn btn-danger my-4" href="../displayperfmtindicator.php" role="button">Cancel</a>
            </div>


    </div>

</div>
</form>

<script type="text/javascript">
    function change_kra() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajaxmtmov.php?kra=" + document.getElementById("kradd").value, false);
        xmlhttp.send(null);
        document.getElementById("objective").innerHTML = xmlhttp.responseText;

    }
</script>

<br>
<?php

include '../includes/footer.php';
?>