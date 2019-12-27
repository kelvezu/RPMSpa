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




<div class="modal fade" id="mtindicator-modal" tabindex="-1" role="dialog" aria-labelledby="mtindicatorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Indicator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processmtindicator.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="mtindicator-no" class="control-label"><strong>Indicator Number</strong></label>
                            <input type="number" name="mtindicator_no" id="mtindicator_no" class="form-control" width="500" placeholder="Enter the Indicator Number..." required pattern="[0-9]" title="Input number only">
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="mtindicator_name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                            <textarea name="mtindicator_name" id="mtindicator_name" class="form-control" placeholder="Enter the indicator name..." required></textarea>
                            <div id="errorNo1"></div>
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

<script>

$(document).ready(function() {
        $('#mtindicator_no').on('change', function() {
            var mtindicator_no = $(this).val(); 
            if (mtindicator_no) {
                $.ajax({
                    type: 'POST',
                    url: 'validateindicator.php',
                    data: 'mtindicator_no=' + mtindicator_no,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });

$(document).ready(function() {
        $('#mtindicator_name').on('change', function() {
            var mtindicator_name = $(this).val(); 
            if (mtindicator_name) {
                $.ajax({
                    type: 'POST',
                    url: 'validateindicator.php',
                    data: 'mtindicator_name=' + mtindicator_name,
                    success: function(html) {
                         $('#errorNo1').html(html);
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
            <button class="btn btn-sm btn-primary m-1 " data-toggle="modal" data-target="#mtindicator-modal">Add Indicator </button>
            <button class="btn btn-sm btn-primary m-1 " data-toggle="modal" data-target="#mtioaf-modal">View COT Form </button>
            <div class="h4 breadcrumb bg-dark text-white ">Master Teacher Indicator </div>


            
                        <?php
                        
                        $result = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);
                        ?>

                        <table class="table table-responsive-sm table-sm">
                            <caption>Master Teacher Indicator</caption>
                            <thead class="bg-primary text-white ">
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
                                        <td><?php echo $row['mtindicator_no']; ?></td>
                                        <td><?php echo $row['mtindicator_name']; ?></td>
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
                                        <td><a href="update/updatemtindicator.php?edit=<?php echo $row['mtindicator_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                        <td><a href="delete/deletemtindicator.php?delete=<?php echo $row['mtindicator_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                        </table>
                    </div>
                </div>


<div class="modal fade" id="mtioaf-modal" tabindex="-1" role="dialog" aria-labelledby="mtioafModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Master Teacher COT Rating Sheet</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php
                
                $resultquery = $conn->query('SELECT * FROM mtindicator_tbl')  or die($conn->error);
                ?>

                <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
                <h5>COT-RPMS</h5>

                <div class="h3 bg-primary text-white">Master Teacher I-IV
                </div>

                <h4> COT Rating Sheet</h4>


                <h5 class="text-left">OBSERVER 1<br>
                    OBSERVER 2<br>
                    OBSERVER 3<br>DATE<br>
                    TEACHER OBSERVED<br>
                    SUBJECT<br>
                    GRADE LEVEL TAUGHT <br>OBSERVATION PERIOD
                    1<input type="checkbox" value="1">
                    2<input type="checkbox" value="2">
                    3<input type="checkbox" value="3">
                    4<input type="checkbox" value="4">
                </h5>
            </div>
            <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                <thead class="legend-control bg-primary text-white ">
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
                                <th><?php echo $row['mtindicator_no']; ?></th>
                                <th><?php echo $row['mtindicator_name']; ?></th>
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
            <textarea class="form-control" name="comment" rows="5" placeholder="OTHER COMMENTS" required></textarea>
        </div>
    </div>
</div>
</div>
</div>
</main>
<br>
<?php

include 'samplefooter.php';
?>