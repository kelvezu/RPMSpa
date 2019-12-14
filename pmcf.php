<?php

include 'sampleheader.php';

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
//QUERY FOR CORE BEHAVIORAL COMPETENCIES 
$result = $conn->query('SELECT * FROM pmcf_tbl')  or die($conn->error);
?>


<!-- Add CBC indicator  modal -->
<div class="modal fade" id="indicator-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add PMCF</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processpmcf.php" method="POST">
                    <div class="form-group-row">
                        <div class="col-lg ">
                            <label for="" class="col-form-label">Date</label>
                            <input type="date" name="tdate" class="form-control" />
                        </div>

                        <div class="col-lg">
                            <label for="" class="col-form-label">Critical Incidence Description</label>
                            <textarea name="cid" rows="2" cols="5" class="form-control"></textarea>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Output</label>
                            <textarea name="toutput" rows="2" cols="5" class="form-control"></textarea>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Action Plan</label>
                            <textarea name="actionplan" rows="2" cols="5" class="form-control"></textarea>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Rater</label>
                            <textarea name="rater" rows="2" cols="5" class="form-control"></textarea>
                        </div>
                        <div class="col-lg">
                            <label for="" class="col-form-label">Ratee</label>
                            <textarea name="ratee" rows="2" cols="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addpmcf">Add PMCF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of  Add Modal -->
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
<?php endif ?>
<div class="container text-center">
    <div class="breadcome-list shadow-reset">
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#indicator-modal">Add PMCF</button>
        </div>

        <div class="h4 breadcrumb bg-dark text-white ">Performance Monitoring and Coaching </div>


        <table class="table table-responsive-sm">
            <thead class="bg-success text-white">
                <tr>
                    <th>Date</th>
                    <th>Critical Incidence Description</th>
                    <th>Output</th>
                    <th>Impact on Job/Action Plan</th>
                    <th>Rater</th>
                    <th>Ratee</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>

            <!-- Start loop for  PMCF -->
            <?php
            //FETCH THE FIELDS FROM THE DB  

            while ($row = $result->fetch_assoc()) :
                $pmcf_id = $row['pmcf_id'];
                $tdate = $row['tdate'];
                $cid = $row['cid'];
                $toutput = $row['toutput'];
                $actionplan = $row['actionplan'];
                $rater = $row['rater'];
                $ratee = $row['ratee'];
                ?>
                <tbody class="text-justify">

                    <tr>
                        <td><?php echo $row['tdate'] ?></td>
                        <td><?php echo $row['cid'] ?></td>
                        <td><?php echo $row['toutput'] ?></td>
                        <td><?php echo $row['actionplan'] ?></td>
                        <td><?php echo $row['rater'] ?></td>
                        <td><?php echo $row['ratee'] ?></td>
                        <td><a href="update/updatepmcf.php?edit=<?php echo $row['pmcf_id']; ?>" class="btn-sm btn-outline-primary text-decoration-none">Update</a></td>
                        <td><a href="delete/deletepmcf.php?delete=<?php echo $row['pmcf_id']; ?>" class="btn-sm btn-outline-danger text-decoration-none">Delete</a></td>
                    </tr>
                </tbody>
                <!-- END LOOP FOR PMCF -->
            <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<?php

include 'samplefooter.php';
?>