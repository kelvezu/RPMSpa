<form action="includes/processschool.php" method="POST">
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Grade Level</strong></label>
                            <select class="form-control" name="sgl" id="">
                                <option value="">--Select--</option>
                                <option value="Elementary School">Elementary School</option>
                                <option value="Secondary School">Secondary School</option>
                                <option value="Division Office">Division Office</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-no" class="col-form-label"><strong>School Number</strong></label>
                            <input type="number" name="school_no" id="school-no" class="form-control" placeholder="Enter the School No..." required pattern="[0-9]{3,}" title="Input three or more numbers and input should not include special characters">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="school-name" class="col-form-label"><strong>School Name</strong></label>
                            <input type="text" name="school_name" id="school-name" class="form-control" placeholder="Enter the School Name..." required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include numbers and special characters">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="tel-no" class="col-form-label"><strong>Telephone Number</strong></label>
                            <input type="number" name="tel_no" id="tel-no" class="form-control" placeholder="Enter the Telephone Number..." required pattern="[0-9-]{8}" title="Input eight digit number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <label for="sel-reg" class=" col-form-label"><strong>Select Region</strong></label>

                            <?php

                            include('includes/conn.inc.php');
                            $query = $conn->query("SELECT * FROM region_tbl");

                            $rowCount = $query->num_rows;
                            ?>
                            <select name="region" id="region" class="form-control" onchange="showDivision()">
                                <option value="">Select Region</option>
                                <?php
                                if ($rowCount > 0) {
                                    while ($row = $query->fetch_assoc()) {
                                        echo '<option value="' . $row['reg_id'] . '">' . $row['region_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Region not available</option>';
                                }
                                ?>
                            </select>
                            
                                <p id="showDiv"></p>
                            </select>
                            <label for="sel-reg" class=" col-form-label"><strong>Select Municipality</strong></label>
                            <select name="municipality" id="municipality" class="form-control">
                                <option value="">Select Division first</option>
                                <div id="showMuni"></div>
                            </select>


                            <div class="m-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Add School</button>
                            </div>
                        </div>
                </form>

<script>

    function showDivision() {
        let region = document.getElementById('region').value;
        let division = document.getElementById('division').value;
        let municipality = document.getElementById('municipality').value;

        if (region == "")  {
            document.getElementById("showDiv").innerHTML = "";
            return;
        } else {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.readyState+' '+ this.status);
                    console.log(this.responseText);
                    document.getElementById("showDiv").innerHTML = this.responseText;
                  
                }
            }
            xmlhttp.open("GET", "ajaxschool.php?reg_id=" + region + "&divi_id=" + division , true);
            xmlhttp.send();
        }
    }
</script>