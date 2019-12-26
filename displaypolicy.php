<?php
include 'sampleheader.php';


if(isset($_GET['notif'])):
    if(($_GET['notif']) == 'taken'):
        echo "<div class='red-notif-border'>Duplicate entry found. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'whitespace'):
        echo "<div class='red-notif-border'>Too much space. Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'success'):
        echo "<div class='green-notif-border'>School has been added!</div>";
    elseif (($_GET['notif']) == 'error'):
        echo "<div class='red-notif-border'>Unable to proceed!</div>";
    elseif (($_GET['notif']) == 'charNumber'):
        echo "<div class='red-notif-border'>Lack of Characters!</div>";
    endif;
endif;
?>

<div class="modal fade" id="policy-modal" tabindex="-1" role="dialog" aria-labelledby="policyModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Policy</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processpolicy.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="policy-title" class="control-label"><strong>Policy Title</strong></label>
                            <input type="text" name="policytitle" id="policy_title" class="form-control" width="500" placeholder="Enter the Policy Title..." required pattern="{3,}" title="Input three or more characters" />
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div>
                        <label for="content" class="control-label w-25 "><strong>Policy Content</strong></label>
                        <textarea name="policycontent" id="policy_content" cols="5" rows="5" class="form-control" value="" placeholder="Enter the Policy Content..." required></textarea>
                        <div id="errorNo2"></div>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Add Policy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
        $('#policy_title').on('change', function() {
            var policy_title = $(this).val(); 
            if (policy_title) {
                $.ajax({
                    type: 'POST',
                    url: 'validatepolicy.php',
                    data: 'policy_title=' + policy_title,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });


$(document).ready(function() {
        $('#policy_content').on('change', function() {
            var policy_content = $(this).val(); 
            if (policy_content) {
                $.ajax({
                    type: 'POST',
                    url: 'validatepolicy.php',
                    data: 'policy_content=' + policy_content,
                    success: function(html) {
                         $('#errorNo2').html(html);
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
    </div>
<?php endif ?>

<div class="container">
    <div class="breadcome-list  shadow-reset">
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#policy-modal">Add Policy </button>
            <div class="h4 breadcrumb bg-dark text-white">Policy </div>

            <main>

                <div class="container">
                    <div class="col-sm-10">
                        <div class="h4 text-center text-white bg-Success text-center">Policies</div>
                        <div class=" form-group">
                            <?php
                           
                            $result = $conn->query('SELECT * FROM policy_tbl') or die($conn->error);
                            
                            ?>
                            <table class="table table-borderless table-sm">
                                <?php while ($row = $result->fetch_assoc()) : ?>

                                    <tr>
                                        <th colspan="1"><?php echo $row['policy_title'] ?>
                                        </th>
                                    </tr>


                                    <tbody>
                                        <tr>
                                            <td><textarea class="form-control" name="policy_content" id="policy-content" cols="80" rows="10" disabled><?php echo $row['policy_content'] ?></textarea>
                                                <p><b>Date Created:</b> <?php echo $row['date_created'] ?>&nbsp &nbsp<b>Last updated: </b><?php echo $row['date_modified'] ?></p>
                                            </td>
                                            <td>
                                                <a href="update/updatepolicy.php?edit=<?php echo $row['policy_id']; ?>" class="btn btn-outline-primary btn-block">Update</a>
                                                <br>

                                                <a href="delete/deletepolicy.php?delete=<?php echo $row['policy_id']; ?>" class="btn btn-outline-danger btn-block">Delete</a></th>
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
</div>
<br>
</main>

<footer>
    <?php

    include 'samplefooter.php';
    ?>
</footer>