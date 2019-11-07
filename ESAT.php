<?php
include 'includes/conn.inc.php';
include 'includes/header.php';
?>
<b />

<!-- Subject modal -->
<div class="modal fade" id="subject-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Subject Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Science and Technolgy">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="subjectsave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of  Subject Modal -->

<!-- Age modal -->
<div class="modal fade" id="age-modal" tabindex="-1" role="dialog" aria-labelledby="addAgeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Age Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="age" id="age" placeholder="Ex. 15-30 years">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="agesave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Age Modal -->
<!-- Gender modal -->
<div class="modal fade" id="gender-modal" tabindex="-1" role="dialog" aria-labelledby="addGenderModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Gender Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="gender" id="gender" placeholder="Female">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="gendersave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Gender Modal -->
<!-- Position modal -->
<div class="modal fade" id="position-modal" tabindex="-1" role="dialog" aria-labelledby="addAgeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Position Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">

                        <div class="col-sm">
                            <input type="text" class="form-control" name="position" id="age" placeholder="Ex.Master Teacher I">
                        </div>
                    </div>

                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="positionsave">Add Option</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- End of Position Modal-->
<!-- Total Number of Years modal -->
<div class="modal fade" id="totalyears-modal" tabindex="-1" role="dialog" aria-labelledby="totalyearsmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Total Number of Years in Teaching Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">

                        <div class="col-sm">
                            <input type="text" class="form-control" name="totalyears" id="age" placeholder="Ex.0-3 Years">
                        </div>
                    </div>

                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="totalyearsave">Add Option</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- End of Total Number of Years Modal-->

<!-- Grade Level Taught modal -->
<div class="modal fade" id="glt-modal" tabindex="-1" role="dialog" aria-labelledby="addGltModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Grade Level Taught Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="glt" id="glt" placeholder="Ex. Kindergarten">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="gltsave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of GradeLevelTaught Modal -->
<!-- Curricular class modal -->
<div class="modal fade" id="curriclass-modal" tabindex="-1" role="dialog" aria-labelledby="addCurriClassModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Curricular Class Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="curri" id="curri" placeholder="ex. Kinder and Grade 1-6">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="currisave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Curricular Modal -->
<!-- Region class modal -->
<div class="modal fade" id="region-modal" tabindex="-1" role="dialog" aria-labelledby="addRegionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Region Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="region" id="region" placeholder="ex. Manila">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="regionsave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Region Modal -->
<!-- Division class modal -->
<div class="modal fade" id="division-modal" tabindex="-1" role="dialog" aria-labelledby="addDivisionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Division Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <label for="sel-reg" class=" col-form-label"><strong>Select Region</strong></label>
                            <select name="regionname" class="form-control">
                                <option>Select Region</option>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "");
                                mysqli_select_db($connection, "rpms");
                                $query = mysqli_query($connection, "SELECT * from region_tbl");
                                while ($row = mysqli_fetch_array($query)) {
                                    $reg_id = $row['reg_id'];
                                    $region_name = $row['region_name'];
                                    ?>
                                    <option value="<?php echo $reg_id ?>"><?php echo $region_name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="division" id="division" placeholder="ex. Makati">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="divisionsave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Division Modal -->
<!-- Municipality class modal -->
<div class="modal fade" id="muni-modal" tabindex="-1" role="dialog" aria-labelledby="addMunicipalityModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Municipality Option</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processESAT.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md">
                            <label for="sel-reg" class=" col-form-label"><strong>Select Division</strong></label>
                            <select name="divname" class="form-control">
                                <option>Select Division</option>
                                <?php
                                $connection = mysqli_connect("localhost", "root", "");
                                mysqli_select_db($connection, "rpms");
                                $query = mysqli_query($connection, "SELECT * from division_tbl");
                                while ($row = mysqli_fetch_array($query)) {
                                    $div_id = $row['div_id'];
                                    $divi_name = $row['divi_name'];
                                    ?>
                                    <option value="<?php echo $div_id ?>"><?php echo $divi_name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md">
                            <input type="text" class="form-control" name="municipality" id="municipality" placeholder="ex. Makati City">
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="munisave">Add Option</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Municipality Modal -->


<?php if (isset($_SESSION['message'])) : ?>
    <div class="<?= $_SESSION['msg_type'] ?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
<?php endif ?>


<div class="container">
    <div class="breadcome-list shadow-reset">
        <div class="h4 card-header text-center">Self Assessment Tool Components</div>




        <!-- Start of Row 2-->
        <div class="col-sm my-4">
            <h5> Subject Option</h5>
            <?php
            $subjqry = 'SELECT * FROM subject_tbl ORDER BY `status`';
            $qry_run = mysqli_query($conn, $subjqry);
            ?>
            <table class=" table table-sm  table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ((mysqli_num_rows($qry_run)) > 0) {
                    foreach ($qry_run as $row) :
                        ?>
                        <tbody class=" text-dark">
                            <tr> <?php if ($row['status'] == "Active") : ?>
                                    <td><b><?= $row['subject_name'];  ?></b></td>
                                    <td><b class="apple-color"><?= $row['status'] ?></b></td>
                                    <td>
                                        <a href="update/updatesubject.php?edit=<?php echo $row['subject_id'] ?>" class="btn btn-success  text-decoration-none ">Update</a> &nbsp
                                        <a href="delete/deletesubject.php?delete=<?php echo $row['subject_id']; ?>" class="btn  btn-danger text-decoration-none ">Set to Inactive</a>
                                    </td>
                                <?php elseif ($row['status'] == "Inactive") : ?>
                                    <td><b><strike><?= $row['subject_name'] ?></strike></b></td>
                                    <td class="tomato-color"><?= $row['status'] ?></td>
                                    <td>
                                        <a href="update/updatesubject.php?edit=<?php echo $row['subject_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="includes/processESAT.php?unremovesub=<?php echo $row['subject_id']; ?>" class="btn btn-info text-decoration-none ">Set to active</a>
                                    </td>
                                <?php else : echo 'Error' ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                <?php
                    endforeach;
                } else {
                    echo '<td class="tomato-color">No Record Found!</td>';
                }
                ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#subject-modal">Add Subject Option</button>
        </div><!-- End of col-sm my-4-->




        <div class="col-sm my-4">
            <h5> Age Option</h5>
            <?php
            $agejqry = "SELECT * FROM age_tbl ORDER BY `status`";
            $qry_run = mysqli_query($conn, $agejqry);
            ?>
            <table class=" table table-sm  table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if (!empty($qry_run)) {
                    foreach ($qry_run as $row) {
                        ?><?php if ($row['status'] == "Active") : ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['age_name'] ?></td>
                        <td class="apple-color"><b><?= $row['status'] ?></b></td>
                        <td><a href="update/updateage.php?edit=<?php echo $row['age_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                            <a href="delete/deleteage.php?delete=<?php echo $row['age_id']; ?>" class="btn btn-danger text-decoration-none ">Set to Inactive</a></td>

                    <?php elseif ($row['status'] == "Inactive") : ?>

                        <td><strike><?php echo $row['age_name'] ?></strike></td>
                        <td class="tomato-color"><?= $row['status'] ?></td>
                        <td><a href="update/updateage.php?edit=<?php echo $row['age_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                            <a href="includes/processESAT.php?unremoveage=<?php echo $row['age_id']; ?>" class="btn btn-info text-decoration-none ">Set to Active</a>
                        </td>
                    <?php
                            else : echo '<td>Error in age</td>';
                            endif; ?>

                    </tr>
                </tbody>
        <?php
            }
        } else {
            echo "<td class='tomato-color'>No Record Found!</td>";
        }
        ?>

            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#age-modal">Add Age Option</button>
        </div><!-- End of col-md-6 -->

        <div class="col-sm my-4">
            <h5> Gender Option</h5>
            <?php
            $genderjqry = "SELECT * FROM gender_tbl ORDER BY `status`";
            $qry_run = mysqli_query($conn, $genderjqry);
            ?>
            <table class=" table table-sm  table-hover ">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        <tbody><?php if ($row['status'] == "Active") : ?>
                                <tr>
                                    <td><?php echo $row['gender_name'] ?></td>
                                    <td class="apple-color"><b><?= $row['status'] ?></b></td>
                                    <td><a href="update/updategender.php?edit=<?php echo $row['gender_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="delete/deletegender.php?delete=<?php echo $row['gender_id']; ?>" class="btn btn-danger text-decoration-none ">Set to Inactive</a></td>

                                <?php elseif ($row['status'] == "Inactive") : ?>

                                    <td><strike><?php echo $row['gender_name'] ?></strike></td>
                                    <td class="tomato-color"><?= $row['status'] ?></td>
                                    <td><a href="update/updategender.php?edit=<?php echo $row['gender_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="includes/processESAT.php?unremovegen=<?php echo $row['gender_id']; ?>" class="btn btn-info text-decoration-none ">Set to Active</a>


                                    <?php endif; ?>
                                </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "<td><p class='tomato-color'>SQL Error!</p></td>";
                }
                ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#gender-modal">Add Gender Option</button>
        </div><!-- End of col-md-6 -->



        <div class="col-sm my-4">
            <h5> Position Option</h5>
            <?php
            $posiqry = "SELECT * FROM position_tbl WHERE position_id IN (3,4,5,6,7,8,9) AND `status` ='Active' ";
            $qry_run = mysqli_query($conn, $posiqry);
            ?>
            <table class=" table table-sm table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($qry_run) {
                        foreach ($qry_run as $row) {
                            ?>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['position_name'] ?></td>
                        <td><a href="update/updateposition.php?edit=<?php echo $row['position_id'] ?>" class="btn btn-success ">Update</a> &nbsp
                            <a href="delete/deleteposition.php?delete=<?php echo $row['position_id']; ?>" class="btn btn-danger text-decoration-none ">Remove</a></td>
                    </tr>
                </tbody>
        <?php
            }
        } else {
            echo "<td><p class='tomato-color'>SQL Error!</p></td>";
        }
        ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#position-modal">Add Position Option</button>
        </div><!-- End of col-md-6 -->




        <div class="col-sm my-4">
            <h5> Total Number of Years Option</h5>
            <?php
            $totyrqry = "SELECT * FROM totalyear_tbl ORDER BY `status`";
            $qry_run = mysqli_query($conn, $totyrqry);
            ?>
            <table class=" table table-sm table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        </th>
                        <tbody>
                            <tr><?php if ($row['status'] == "Active") : ?>

                                    <td><?php echo $row['totalyear_name'] ?></td>
                                    <td><b class="apple-color"><?= $row['status'] ?></b></td>
                                    <td><a href="update/updatetotalyear.php?edit=<?php echo $row['totalyear_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="delete/deletetotalyear.php?delete=<?php echo $row['totalyear_id']; ?>" class="btn btn-danger text-decoration-none ">Set to Inactive</a></td>

                                <?php elseif ($row['status'] == "Inactive") : ?>
                                    <td><strike><?php echo $row['totalyear_name'] ?></strike></td>
                                    <td class="tomato-color"><?= $row['status'] ?></td>
                                    <td><a href="update/updatetotalyear.php?edit=<?php echo $row['totalyear_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="includes/processESAT.php?unremovetot=<?php echo $row['totalyear_id']; ?>" class="btn btn-info text-decoration-none ">Set to Active</a>
                                    <?php
                                            else : echo 'Error';
                                            endif;
                                            ?>

                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "<td><p class='tomato-color'>SQL Error!</p></td>";
                }
                ?>
            </table>
            <button class=" btn btn-sm btn-success" data-toggle="modal" data-target="#totalyears-modal">Add Years Option</button>
        </div><!-- End of col-md-6 -->


        <div class="col-sm my-4">
            <h5> Grade Level Taught Option</h5>
            <?php
            $gltqry = "SELECT * FROM gradelvltaught_tbl ORDER BY `status`";
            $qry_run = mysqli_query($conn, $gltqry);
            ?>
            <table class=" table table-sm table-hover ">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) :

                        ?>
                        <tbody>
                            <tr><?php if ($row['status'] == "Active") : ?>
                                    <td><?php echo $row['gradelvltaught_name'] ?></td>
                                    <td><b class="apple-color"><?= $row['status'] ?></b></td>
                                    <td><a href="update/updateglt.php?edit=<?php echo $row['gradelvltaught_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="delete/deletegradelvltaught.php?delete=<?php echo $row['gradelvltaught_id']; ?>" class="btn btn-danger text-decoration-none">Set to Inactive</a></td>

                                <?php elseif ($row['status'] == "Inactive") : ?>
                                    <td><strike><?php echo $row['gradelvltaught_name'] ?></strike></td>
                                    <td class="tomato-color"><?= $row['status'] ?></td>
                                    <td><a href="update/updateglt.php?edit=<?php echo $row['gradelvltaught_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="includes/processESAT.php?unremoveglt=<?php echo $row['gradelvltaught_id']; ?>" class="btn btn-info text-decoration-none ">Set to Active</a>
                                    <?php
                                            else : echo '<td><p class="tomato-color">SQL Error!</p></td>';
                                            endif;
                                            ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    <?php


                    } else {
                        echo "<td><p class='tomato-color'>SQL Error!</p></td>";
                    }
                    ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#glt-modal">Add Grade Level Option</button>
        </div><!-- End of col-md-6 -->


        <!-- Start of Row 4-->

        <div class="col-sm my-4">
            <h5>Curricular Classification of the School Option</h5>
            <?php
            $curriqry = "SELECT * FROM curriclass_tbl ORDER BY `status`";
            $qry_run = mysqli_query($conn, $curriqry);
            ?>
            <table class=" table table-sm table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        <tbody>
                            <tr><?php if ($row['status'] == "Active") : ?>
                                    <td><?php echo $row['curriclass_name'] ?></td>
                                    <td><b class="apple-color"><?= $row['status'] ?></b></td>
                                    <td><a href="update/updatecurri.php?edit=<?php echo $row['curriclass_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="delete/deletecurri.php?delete=<?php echo $row['curriclass_id']; ?>" class="btn btn-danger text-decoration-none ">Set to Inactive</a></td>

                                <?php elseif ($row['status'] == "Inactive") : ?>
                                    <td><strike><?php echo $row['curriclass_name'] ?></strike></td>
                                    <td class="tomato-color"><?= $row['status'] ?></td>
                                    <td><a href="update/updatecurri.php?edit=<?php echo $row['curriclass_id'] ?>" class=" btn btn-success text-decoration-none ">Update</a> &nbsp
                                        <a href="includes/processESAT.php?unremovecurr=<?php echo $row['curriclass_id']; ?>" class="btn btn-info text-decoration-none ">Set to Active</a>
                                    <?php
                                            else : echo '<td><p class="tomato-color">SQL Error!</p></td>';
                                            endif; ?>

                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "<td><p class='tomato-color'>SQL Error!</p></td>";
                }
                ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#curriclass-modal">Add Curricular Classification Option</button>
        </div><!-- End of col-md-6 -->




        <!-- Start of Row 5-->

        <div class="col-sm my-4">
            <h5>Region</h5>
            <?php
            $regqry = "SELECT * FROM region_tbl";
            $qry_run = mysqli_query($conn, $regqry);
            ?>
            <table class=" table table-sm table-hover">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['region_name'] ?></td>
                                <td><a href="update/updateregion.php?edit=<?php echo $row['reg_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                    <a href="delete/deleteregion.php?delete=<?php echo $row['reg_id']; ?>" class="btn btn-danger text-decoration-none ">Delete</a></td>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "No Record Found!";
                }
                ?>

            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#region-modal">Add Region Option</button>
        </div><!-- End of col-md-4 -->

        <div class="col-sm my-4">
            <h5> Division </h5>
            <?php
            $divqry = "SELECT * FROM division_tbl";
            $qry_run = mysqli_query($conn, $divqry);
            ?>
            <table class=" table table-sm table-hover ">
                <thead class="bg-info">

                    <tr>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        <tbody>

                            <tr>
                                <td><?php echo $row['divi_name'] ?></td>
                                <td><a href="update/updatedivision.php?edit=<?php echo $row['div_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                    <a href="delete/deletedivision.php?delete=<?php echo $row['div_id']; ?>" class="btn btn-danger text-decoration-none ">Delete</a></td>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "No Record Found!";
                }
                ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#division-modal">Add Division Option</button>
        </div><!-- End of col-md-4 -->

        <div class="col-sm my-4">
            <h5> Municipality </h5>
            <?php
            $muniqry = "SELECT * FROM municipality_tbl";
            $qry_run = mysqli_query($conn, $muniqry);
            ?>
            <table class=" table table-sm table-hover ">
                <thead class="bg-info">
                    <tr>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                if ($qry_run) {
                    foreach ($qry_run as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['muni_name'] ?></td>
                                <td><a href="update/updatemunicipality.php?edit=<?php echo $row['muni_id'] ?>" class="btn btn-success text-decoration-none ">Update</a> &nbsp
                                    <a href="delete/deletemunicipality.php?delete=<?php echo $row['muni_id']; ?>" class="btn btn-danger text-decoration-none ">Delete</a></td>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    echo "No Record Found!";
                }
                ?>
            </table>
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#muni-modal">Add Municipality Option</button>
        </div><!-- End of col-md-4 -->

    </div>
</div>
<br>





<?php

include 'includes/footer.php';
?>