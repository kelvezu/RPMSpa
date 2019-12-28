<?php

include 'sampleheader.php';

if(isset($_GET['notif'])):
    if(($_GET['notif']) == 'taken'):
        echo "<div class='red-notif-border'>Duplicate entry found. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'whitespace'):
        echo "<div class='red-notif-border'>Too much space. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'success'):
        echo "<div class='green-notif-border'>Data has been added!</div>";
    elseif (($_GET['notif']) == 'error'):
        echo "<div class='red-notif-border'>Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'charNumber'):
        echo "<div class='red-notif-border'>Lack of Characters!</div>";
    elseif (($_GET['notif']) == 'updatewhitespace'):
        echo "<div class='red-notif-border'>Unable to Update. Too much space!</div>";
    elseif (($_GET['notif']) == 'updatecharNumber'):
        echo "<div class='red-notif-border'>Unable to Update. Field should contain at least 2 characters!</div>";
    elseif (($_GET['notif']) == 'updatesuccess'):
        echo "<div class='green-notif-border'>Update Success!</div>";
    endif;
endif;


?>


<div class="modal fade" id="trubric-modal" tabindex="-1" role="dialog" aria-labelledby="rubricModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Rubric</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processtrubric.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="level" class="control-label"><strong>Rubric Level</strong></label>
                            <input type="number" name="rubric_lvl" id="rubriclvl" class="form-control" width="500" placeholder="Enter the rubric level..." required pattern="[0-9]" title="Input number only">
                            <div id="errorNo"></div>
                        </div>

                        <div class="col-sm-6">
                            <label for="level-name" class="control-label"><strong>Level Name</strong></label>
                            <input type="text" name="level_name" id="levelname" class="form-control" width="500" placeholder="Enter the Level Name..." required pattern="[A-Za-z]{3,}" title="Input three or more characters and input should not include numbers and special characters" />
                            <div id="errorNo2"></div>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="control-label w-25 "><strong>Description</strong></label>
                        <textarea name="rubric_description" id="desc" cols="5" rows="5" class="form-control" value="" placeholder="Enter the description..." required></textarea>
                        <div id="errorNo3"></div>
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

<script>

$(document).ready(function() {
        $('#rubriclvl').on('change', function() {
            var rubriclvl = $(this).val(); 
            if (rubriclvl) {
                $.ajax({
                    type: 'POST',
                    url: 'validaterubric.php',
                    data: 'rubriclvl=' + rubriclvl,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });

$(document).ready(function() {
        $('#levelname').on('change', function() {
            var levelname = $(this).val(); 
            if (levelname) {
                $.ajax({
                    type: 'POST',
                    url: 'validaterubric.php',
                    data: 'levelname=' + levelname,
                    success: function(html) {
                         $('#errorNo2').html(html);
                    }
                });
            } else {
              
            }
        });
     });

    $(document).ready(function() {
    $('#desc').on('change', function() {
        var desc = $(this).val(); 
        if (desc) {
            $.ajax({
                type: 'POST',
                url: 'validaterubric.php',
                data: 'desc=' + desc,
                success: function(html) {
                        $('#errorNo3').html(html);
                }
            });
        } else {
            
        }
    });
    });

</script>





<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
<?php endif ?>

<div class="container">
  
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#trubric-modal">Add Rubric </button>
            <div class="h4 breadcrumb bg-dark text-white ">Teacher Rubric Summary </div>



          
                    <?php
                   
                    $result = $conn->query('SELECT * FROM trubric_tbl')  or die($conn->error);
                    ?>

                    <table class="table table-responsive-sm table-sm">
                        <caption>Rubric Level for Teacher I-III</caption>
                        <thead class="bg-success text-white">
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
                                    <td><a href="update/updatetRubric.php?edit=<?php echo $row['rubric_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                    <td><a href="delete/deletetrubric.php?delete=<?php echo $row['rubric_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                    </table>
                </div>
            </div>

<br>

</main>

<?php

include 'samplefooter.php';
?>