<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';

?>


<div class="container col-md-9">

    <div class="bg-dark h4 text-white breadcrumb">Teacher COT Average</div>
    <div class="px-3">


        <form action="cotchartTadmin.php" method="POST" class="form-inline">


            <input type="hidden" id="active_sy" name="active_sy" value="<?php echo $_SESSION['active_sy_id']; ?>">


            <div class="form-row">
                <div class="form-group mb-2">
                    <!-- School Year Dropdown -->
                    <label for="sy"><strong>School Year:</strong></label>&nbsp;&nbsp;
                    <?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die($conn->error); ?>
                    <select id="sy_id" name="sy_id" class="form-control">
                        <option value="" disabled selected>--Select School Year--</option>
                        <?php while ($syrow = $schoolyr->fetch_assoc()) : ?>
                            <option value="<?php echo $syrow['sy_id']; ?>"><?php echo $syrow['sy_desc']; ?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;
                </div>
                <!-- End of School Year Dropdown -->
                <div class="form-group mb-2">
                    <!-- Teacher Dropdown -->
                    <label for="sy"><strong>School:</strong></label>&nbsp;&nbsp;
                    <?php $schoolQry = $conn->query('SELECT * FROM school_tbl WHERE `status` = "Active"') or die($conn->error); ?>
                    <select id="school_id" name="school_id" class="form-control">
                        <option value="" disabled selected>--Select School--</option>
                        <?php while ($school = $schoolQry->fetch_assoc()) : ?>
                            <option value="<?php echo $school['school_id']; ?>"><?php echo $school['school_name']; ?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;
                    <!-- End of Teacher Dropdown -->
                </div>
                <div class="form-group mb-2">
                    <a onclick="showAve()" class="btn btn-success text-white">View</a>&nbsp;&nbsp;
                    <button type="submit" name="view" class="btn btn-success">View Data in Charts</button>
                </div>
            </div>
        </form>
        <br>
        <div id="show">

        </div>


    </div>

    <!-- End tag of container -->
</div>
</div>
<script>
    showAve()

    function showAve() {
        let sy_id = document.getElementById('sy_id').value;
        let school_id = document.getElementById('school_id').value;
        let active_sy_id = document.getElementById('active_sy').value;

        if ((sy_id == "" || school_id == "")) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "cotAveTadmintableGeneral.php?sy=" + active_sy_id, true);
            xmlhttp.send();
            return;
        } else {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "cotAveTadmintable.php?sy=" + sy_id + "&sch=" + school_id, true);
            xmlhttp.send();
            return;
        }
    }
</script>


<?php

include 'samplefooter.php';

?>