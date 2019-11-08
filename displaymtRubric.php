<?php
include 'includes/conn.inc.php';
include 'includes/header.php';

?>



<div class="modal fade" id="mtrubric-modal" tabindex="-1" role="dialog" aria-labelledby="mtrubricModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Rubric</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processmtrubric.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="level" class="control-label"><strong>Rubric Level</strong></label>
                            <input type="number" name="rubric_lvl" id="rubric-lvl" class="form-control" width="500" placeholder="Enter the rubric level..." required pattern="[0-9]" title="Input number only">
                        </div>

                        <div class="col-sm-6">
                            <label for="level-name" class="control-label"><strong>Level Name</strong></label>
                            <input type="text" name="level_name" id=level-name" class="form-control" width="500" placeholder="Enter the Level Name..." required pattern="[A-Za-z]{3,}" title="Input three or more characters and input should not include numbers and special characters" />
                        </div>
                    </div>
                    <div>
                        <label for="description" class="control-label w-25 "><strong>Description</strong></label>
                        <textarea name="rubric_description" id="policy-content" cols="5" rows="5" class="form-control" value="" placeholder="Enter the description..." required></textarea>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Add Rubric</button>
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
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#mtrubric-modal">Add Rubric </button>
            <div class="h4 breadcrumb bg-dark text-white ">Master Teacher Rubric Summary </div>



            <div class="container">
                <div class="col-sm-10">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
                    $result = $conn->query('SELECT * FROM mtrubric_tbl')  or die($conn->error);
                    ?>

                    <table class="table table-responsive-sm">
                        <caption>Rubric Level for Master Teacher I-IV</caption>
                        <thead class="bg-primary text-white ">
                            <tr>
                                <th>Level</th>
                                <th>Level Name</th>
                                <th>Level Description</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <?php
                        while ($row = $result->fetch_assoc()) :
                            ?>
                            <tbody class="text-justify">
                                <tr>
                                    <td><?php echo $row['rubric_lvl']; ?></td>
                                    <td><?php echo $row['level_name']; ?></td>
                                    <td><?php echo $row['rubric_description']; ?></td>
                                    <td><a href="update/updatemtRubric.php?edit=<?php echo $row['rubric_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                    <td><a href="delete/deletemtrubric.php?delete=<?php echo $row['rubric_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
</main>

<?php

include 'includes/footer.php';
?>