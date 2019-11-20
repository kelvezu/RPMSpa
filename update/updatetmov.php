<?php
include_once 'includes.php';


//DATABASE 


//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $tmov_id = $_GET['edit'];

    $query = mysqli_query($conn, "SELECT * FROM tmov_tbl WHERE tmov_id=$tmov_id");
    $record = mysqli_fetch_array($query);
    $kra_id = $record['kra_id'];
    $tobj_id = $record['tobj_id'];
    $main_mov = $record['main_mov'];
    $supp_mov = $record['supp_mov'];
}
?>
<main>
    <div class="container ">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processtmov.php" class="form-group sm" method="POST">
                <input type="hidden" name="tmov_id" value="<?php echo $tmov_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update MOV</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <input type="hidden" name="tmov_id" id="tmov_id" value="<?php echo $tmov_id  ?>">

                        <label for="kra">Select KRA</label>
                        <?php
                        //QUERY FOR RETAINING THE LAST ID 
                        $kraresult = $conn->query("SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
                        while ($rows = $kraresult->fetch_assoc()) :
                            $kra_name = $rows['kra_name'];
                            ?>
                            <select name="kraid" id="kradd" onChange="change_kra()" class="form-control">
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
                            $objresult = $conn->query("SELECT * FROM tobj_tbl WHERE tobj_id=$tobj_id");
                            while ($rows = $objresult->fetch_assoc()) :
                                $tobj_name = $rows['tobj_name'];
                                ?>
                                <div id="objective">
                                    <select class="form-control" name="tobj_name">

                                        <option value="<?php echo $tobj_id; ?>"><?php echo $tobj_name; ?></option>
                                    </select>
                                </div>
                            <?php
                            endwhile
                            ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label for="main-mov" class="col-form-label"><strong>Main MOV</strong></label>
                        <input type="text" name="main_mov" id="main-mov" class="form-control" placeholder="Enter the main mov..." value="<?php echo $main_mov; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <label for="supp-mov" class="col-form-label"><strong>Supporting MOV</strong></label>
                        <input type="text" name="supp_mov" id="supp-mov" class="form-control" placeholder="Enter the supporting mov..." value="<?php echo $supp_mov; ?>" required >
                    </div>
                </div>
                <div class="m-2">
                    <button type="submit" class="btn btn-secondary  my-4" name="update">Update</button>&nbsp
                    <a class="btn btn-danger my-4" href="../displaytmov.php" role="button">Cancel</a>
                </div>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>


    <script type="text/javascript">
        function change_kra() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "../ajaxmov.php?kra=" + document.getElementById("kradd").value, false);
            xmlhttp.send(null);
            document.getElementById("objective").innerHTML = xmlhttp.responseText;

        }
    </script>

</main>
<br>
<?php

include '../includes/footer.php';
?>