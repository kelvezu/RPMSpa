<?php
include_once 'sampleheader.php';


if (isset($_GET['successset'])) :
    echo '<div class="green-notif-border">You have successfully set school year! Please log in again to continue.</div>';
elseif (isset($_GET['successadd'])) :
    echo '<div class="green-notif-border">You have successfully added school year!</div>';
elseif (isset($_GET['errorset'])) :
    echo '<div class="red-notif-border">There was a problem setting the school year!</div>';
elseif (isset($_GET['erroradd'])) :
    echo '<div class="red-notif-border">There was a problem adding the school year!</div>';
endif;

?>

<!-- add a active status on the database! -->

<!-- Modal of Add School Year -->

<div class="modal fade" id="schoolyr-modal" tabindex="-1" role="dialog" aria-labelledby="schoolModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add School Year</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <form action="includes/addsy.php" method="post">
                        <div class="row mb-4">


                            <label for="start-month"><strong>Enter the start date: </strong></label>
                            <select name="start-month" class="form-control">
                                <option value="">--Choose Month--</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>



                            <select name="start-day[]" id="" class="form-control">
                                <?php for ($i = 1; $i < 32; $i++) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                endfor ?>
                            </select>



                            <input type="text" name="start-year" id="start-year" class=" form-control" value="
           <?php
            $currYear = date('Y');
            echo trim($currYear);
            ?>" class="form-control-sm mx-2" maxlength="4" disabled />

                        </div>
                        <!-- End of start year -->
                        <div class="row">

                            <label for="end-month" class="form-control-label   "><strong>Enter the end date: </strong></label>
                            <select name="end-month" class="form-control">
                                <option value="">--Choose Month--</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>

                            <select name="end-day[]" id="" class="form-control">
                                <?php
                                for ($i = 1; $i < 32; $i++) :
                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                endfor ?>
                            </select>



                            <input type="text" name="end-year" id="start-year" value="
           <?php
            $currentYear =  date('Y');
            $nextYear = strtotime('next Year');
            $nextYearDate = date('Y', $nextYear);
            echo $nextYearDate;
            ?>" class="form-control" maxlength="4" disabled />



                        </div>
                        <br>
                        <div class="row">

                            <button type="submit" class="btn btn-success" name="add">Add </button>

                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- End Modal of Add School Year -->




<div class="container">
    <div class="h4 breadcrumb bg-dark text-white ">School Year</div>

    <?php if (empty($_SESSION['active_sy_id'])) : ?>
        <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#schoolyr-modal">Add School Year</button>
    <?php endif ?>



    <!-- Display list of School Year -->


    <br>


    <table class="table table-bordered hover text-center table-sm   ">
        <thead class="bg-dark text-white">
            <tr>
                <td>Start Date</td>
                <td>End Date</td>
                <td>School Year</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php

            $syQry = $conn->query("SELECT * FROM sy_tbl") or die($conn->error);
            while ($row = $syQry->fetch_assoc()) :
                $sy_id = $row['sy_id'];
                $start = $row['startDate'];
                $end = $row['end_date'];
                $sy = $row['sy_desc'];
                $status = $row['status'];
            ?>

                <form method="post" action="includes/importsy.inc.php">
                    <tr>
                        <input type="hidden" name="sy_id" value="<?= $sy_id; ?>">
                        <td><?php echo displayDate($start); ?></td>
                        <td><?php echo displayDate($end); ?></td>
                        <td><?php echo $sy; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><a href="<?= $sy_id; ?>" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter<?= $sy_id; ?>">Set<?= $sy_id; ?></a></td>

                    </tr>

                    <!-- Modal -->

                    <div class="modal fade" id="exampleModalCenter<?= $sy_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to set the school year? Please note that you will be forced log out by the system if you proceed.
                                    <?= $sy_id; ?>
                                </div>
                                <div class="modal-footer">
                                    <form action="" method="post">
                                        <input type="hidden" name="sy_id" value="<?= $sy_id; ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="sy_set" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endwhile; ?>

        </tbody>
    </table>


</div>



<?php

include 'samplefooter.php';
?>