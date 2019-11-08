<?php
include_once 'includes.php';

//DATABASE
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

//GETTING THE DATA FROM THE LAST PAGE 
if (isset($_GET['edit'])) {
    $pmcf_id = $_GET['edit'];

    $result = $conn->query("SELECT * FROM pmcf_tbl WHERE pmcf_id=$pmcf_id");
    $row = $result->fetch_assoc();
    $pmcf_id = $row['pmcf_id'];
    $tdate = $row['tdate'];
    $cid = $row['cid'];
    $toutput = $row['toutput'];
    $actionplan = $row['actionplan'];
    $rater = $row['rater'];
    $ratee = $row['ratee'];
};


?>



<main>
    <div class="container">
        <div class="breadcome-list shadow-reset">
            <form action="../includes/processpmcf.php" class="form-group sm" method="POST">
                <input type="hidden" name="pmcf_id" value="<?php echo $pmcf_id; ?>" />
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update PMCF</strong></legend>
                <div>

                    <div class="form-group-sm">
                        <input type="hidden" name="pmcf_id" id="new-id" value="<?php echo $pmcf_id  ?>">

                        <label for="pmcf">Performance Monitoring and Coaching</label>

                        <div class="form-group row">
                            <div class="col-lg">
                                <label for="" class="col-form-label">Date</label>
                                <input type="date" name="tdate" value="<?php echo $tdate; ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Critical Incidence Description</label>
                            <textarea name="cid" rows="2" cols="5" class="form-control"><?php echo $cid; ?></textarea>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Output</label>
                            <textarea name="toutput" rows="2" cols="5" class="form-control"><?php echo $toutput; ?></textarea>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Action Plan</label>
                            <textarea name="actionplan" rows="2" cols="5" class="form-control"><?php echo $actionplan; ?></textarea>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Rater</label>
                            <textarea name="rater" rows="2" cols="5" class="form-control"><?php echo $rater; ?></textarea>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Ratee</label>
                            <textarea name="ratee" rows="2" cols="5" class="form-control"><?php echo $ratee; ?></textarea>
                            </select>
                        </div>
                        <div class="row m-1">
                            <button type="submit" class="btn btn-secondary  my-4" name="update">Update</button>&nbsp
                            <a class="btn btn-danger my-4" href="../pmcf.php" role="button">Cancel</a>
                        </div>

            </form>
        </div>

    </div>
    </div>
    <br>

</main>

<?php

include '../includes/footer.php';
?>