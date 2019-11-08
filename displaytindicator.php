<?php
include 'includes/conn.inc.php';
include 'includes/header.php';

?>



<div class="modal fade" id="tindicator-modal" tabindex="-1" role="dialog" aria-labelledby="tindicatorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Indicator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processtindicator.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="indicator-no" class="control-label"><strong>Indicator Number</strong></label>
                            <input type="number" name="indicator_no" id="indicator_no" class="form-control" width="500" placeholder="Enter the Indicator Number..." required pattern="[0-9]" title="Input number only">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="description" class="control-label w-25 "><strong>Indicator Name</strong></label>
                            <textarea name="indicator_name" id="indicator-name" class="form-control" placeholder="Enter the indicator name..." required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="obs" class="control-label w-25 "><strong>Observation Period</strong></label>
                            <input type="checkbox" name="obs1" id="" class="form-control-sm" value="1">1st
                            <input type="checkbox" name="obs2" id="" class="form-control-sm" value="1">2nd
                            <input type="checkbox" name="obs3" id="" class="form-control-sm" value="1">3rd
                            <input type="checkbox" name="obs4" id="" class="form-control-sm" value="1">4th
                        </div>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Add Indicator</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
<?php endif ?>

<div class="container">
    <div class="breadcome-list shadow-reset">
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#tindicator-modal">Add Indicator </button>
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#cot-modal">View COT Form </button>
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#ioaf-modal">View IOAF Form </button>
            <div class="h4 breadcrumb bg-dark text-white ">Teacher Indicator </div>


            <main>
                <div class="container">
                    <div class="col-sm-10">
                        <?php
                        $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                        $result = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
                        ?>

                        <table class="table table-responsive-sm">
                            <caption>Teacher Indicator</caption>
                            <thead class="bg-success text-white ">
                                <tr>
                                    <th>Indicator No</th>
                                    <th>Indicator Name</th>
                                    <th colspan="4">Observation Period</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <?php
                            while ($row = $result->fetch_assoc()) :
                                ?>
                                <tbody class="text-justify">
                                    <tr>
                                        <td><?php echo $row['indicator_no']; ?></td>
                                        <td><?php echo $row['indicator_name']; ?></td>


                                        <td><?php if ($row['period1'] == 0) {
                                                    echo "-";
                                                } else {
                                                    echo "1st";
                                                } ?></td>
                                        <td><?php if ($row['period2'] == 0) {
                                                    echo "-";
                                                } else {
                                                    echo "2nd";
                                                } ?></td>
                                        <td><?php if ($row['period3'] == 0) {
                                                    echo "-";
                                                } else {
                                                    echo "3rd";
                                                } ?></td>
                                        <td><?php if ($row['period4'] == 0) {
                                                    echo "-";
                                                } else {
                                                    echo "4th";
                                                } ?></td>

                                        <td><a href="update/updatetindicator.php?edit=<?php echo $row['indicator_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                        <td><a href="delete/deletetindicator.php?delete=<?php echo $row['indicator_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                        </td>
                                    </tr>

                                <?php endwhile; ?>
                                </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="cot-modal" tabindex="-1" role="dialog" aria-labelledby="cotModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title " id="exampleModalLabel">COT Teacher Rating Sheet</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <?php
                                $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                                $resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
                                ?>

                                <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br><br>
                                <h5><strong>COT-RPMS</strong></h5>


                                <div class="h3 bg-success">Teacher I-III
                                </div>

                                <h4>Rating Sheet</h4>




                                <h5 class="text-left">OBSERVER<br>DATE<br>
                                    TEACHER OBSERVED<br>
                                    SUBJECT<br>
                                    GRADE LEVEL TAUGHT<br>OBSERVATION PERIOD
                                    1<input type="checkbox" value="1">
                                    2<input type="checkbox" value="2">
                                    3<input type="checkbox" value="31">
                                    4<input type="checkbox" value="4">
                                    </h6>
                            </div>
                            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                                <thead class="legend-control bg-success text-white ">
                                    <tr>
                                        <th>Indicator No</th>
                                        <th>Indicator Name</th>
                                        <th>COT Rating</th>
                                    </tr>
                                </thead>
                                <?php
                                if ($resultquery) {
                                    while ($row = mysqli_fetch_array($resultquery)) {
                                        ?>
                                        <tbody>
                                            <tr>
                                                <th><?php echo $row['indicator_no']; ?></th>
                                                <th><?php echo $row['indicator_name']; ?></th>
                                                <th>
                                                    <select name="rating">
                                                        <option value="">--select--</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="3">NO*</option>
                                                    </select>

                                                </th>
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>

                            </table>
                            <textarea class="form-control" name="cot_comment" rows="5" placeholder="OTHER COMMENTS" required></textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="ioaf-modal" tabindex="-1" role="dialog" aria-labelledby="ioafModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Teacher IOAF Rating Sheet</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php
                $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                $resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
                ?>

                <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
                <h5>COT-RPMS</h5>

                <div class="h3 bg-success text-white">Teacher I-III
                </div>

                <h4> Inter-Observer Agreement Form</h4>



                <h5 class="text-left">OBSERVER 1<br>
                    OBSERVER 2<br>
                    OBSERVER 3 <br>
                    DATE<br>
                    TEACHER OBSERVED<br>
                    SUBJECT<br>
                    GRADE LEVEL TAUGHT<br> OBSERVATION PERIOD<br>
                    1<input type="checkbox" value="1">
                    2<input type="checkbox" value="2">
                    3<input type="checkbox" value="31">
                    4<input type="checkbox" value="4">
                </h5>
            </div>
            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                <thead class="legend-control bg-success text-white ">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>Final Rating</th>
                    </tr>
                </thead>
                <?php
                if ($resultquery) {
                    while ($row = mysqli_fetch_array($resultquery)) {
                        ?>
                        <tbody>
                            <tr>
                                <th><?php echo $row['indicator_no']; ?></th>
                                <th><?php echo $row['indicator_name']; ?></th>
                                <th>
                                    <select name="rating">
                                        <option value="">--select--</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="3">NO*</option>
                                    </select>

                                </th>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>
            </table>
            <textarea class="form-control" name="ioaf_comment" rows="5" placeholder="OTHER COMMENTS" required></textarea>
        </div>
    </div>
</div>
</div>
</div>
</main>
<br>
<?php

include 'includes/footer.php';
?>