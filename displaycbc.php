<?php

include 'sampleheader.php';



//QUERY FOR CORE BEHAVIORAL COMPETENCIES 
$result = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
$numcbc = 1;
$numind = 1;

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

<!-- Add CBC indicator  modal -->
<div class="modal fade" id="indicator-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Indicator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processcbc.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md  ">
                            <label for="add-cbc" class=" col-form-label">Select Core Behavioral Competencies</label>

                            <select name="add_cbc" id="" class="form-control" required>
                                <option value="" disabled selected>--Select--</option>
                                <?php
                                $addresult = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
                                while ($addrow = $addresult->fetch_assoc()) :
                                    $addcbcid = $addrow['cbc_id'];
                                    $addcbcname = $addrow['cbc_name'];

                                    ?>
                                    <option value="<?php echo $addcbcid ?>"><?php echo $addcbcname ?>

                                    </option>
                                <?php endwhile ?>
                            </select>


                        </div>
                    </div>
                    <div class="col-lg">
                        <label for="" class="col-form-label">Enter the indicator</label>
                        <input type="text" name="addindicator" id="indicator" class="form-control" required pattern="[0-9A-Za-z -.]{3,}" title="Input three or more characters and input should not include special characters">
                        <div id="errorNo"></div>
                    </div>

                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addcbc">Add Indicator</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
        $('#indicator').on('change', function() {
            var indicator = $(this).val(); 
            if (indicator) {
                $.ajax({
                    type: 'POST',
                    url: 'validatecbc.php',
                    data: 'indicator=' + indicator,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });
</script>

<!-- End of  Add Modal -->



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
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#indicator-modal">Add Indicator for Core Behavioral Competencies </button>
        </div>
        <div class="h4 breadcrumb bg-dark text-white ">Core Behavioral Competencies </div>
        <table class="table table-hover table-responsive-sm table-sm ">
            <!-- Start loop for  Core Behavioral Competencies -->
            <?php
            //FETCH THE FIELDS FROM THE DB  
            while ($row = $result->fetch_assoc()) :
                $cbc_id = $row['cbc_id'];
                $cbc_name = $row['cbc_name'];

                ?>
                <thead class="bg-info">
                    <tr>
                        <!-- ASSIGN THE VALUE FROM THE DB  -->
                        <th colspan='3'><?php echo $numcbc++ . '. ' . $row['cbc_name'] ?></th>
                    </tr>
                </thead>


                <tbody class="text-dark">
                    <tr>
                        <!-- START OF LOOP FROM CBC INDICATOR -->
                        <?php
                            //QUERY FOR INDICATORS TABLE 
                            $indresult = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_id = '$cbc_id'")  or die($conn->error);
                            //FETCH THE DATA FROM INDICATOR TABLE
                            while ($rows = $indresult->fetch_assoc()) :
                                ?>
                            <td>

                                <?php
                                        //ASSIGN THE VALUE FROM THE DB  
                                        echo '<strong>' . $numind++ . '.</strong> ' . $indicator = $rows['indicator'];

                                        ?>
                            </td>
                            <td><a href="update/updatecbcindicator.php?edit=<?php echo $rows['cbc_ind_id']; ?>" class="btn-sm btn-outline-primary text-decoration-none">Update</a></td>

                            <td><a href="delete/deletecbcindicator.php?delete=<?php echo $rows['cbc_ind_id']; ?>" class="btn-sm btn-outline-danger text-decoration-none">Delete</a></td>
                    </tr>
                    <!-- END LOOP FOR THE CBC INDICATORS -->
                <?php endwhile ?>




                </tbody>
                <!-- END LOOP FOR THE CORE BEHAVIORAL COMPETENCIES -->
            <?php
                $numind = 1;
            endwhile


            ?>

        </table>


    </div>
</div><!-- end tag of container -->

<br>


<?php


include 'samplefooter.php';
?>