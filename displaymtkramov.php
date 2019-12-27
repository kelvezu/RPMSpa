<?php

include 'sampleheader.php';

$kra_num = 0;
$mtobj_num = 1;
//QUERY FOR KRA TABLE  
$result = $conn->query('SELECT * FROM kra_tbl ')  or die($conn->error);

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

<!-- Add Objective  modal -->
<div class="modal fade" id="kra-modal" tabindex="-1" role="dialog" aria-labelledby="addKRAModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add KRA</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processmtkramov.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="" class="col-form-label">Enter the KRA</label>
                            <input type="text" name="addkra_name" id="mtkra" class="form-control" required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include special characters">
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="kraadd">Add KRA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
        $('#mtkra').on('change', function() {
            var mtkra = $(this).val(); 
            if (mtkra) {
                $.ajax({
                    type: 'POST',
                    url: 'validatekramov.php',
                    data: 'mtkra=' + mtkra,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });
</script>


<div class="modal fade" id="objective-modal" tabindex="-1" role="dialog" aria-labelledby="addObjectModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Objective</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processmtkramov.php" method="POST">
                    <div class="form-group row">
                        <div class="col-md  ">
                            <label for="add-cbc" class=" col-form-label">Select Key Result Areas</label>

                            <select name="select_kra" id="" class="form-control" required>
                                <option value="" disabled selected>Select</option>
                                <?php
                                $addresult = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error);
                                while ($addrow = $addresult->fetch_assoc()) :
                                    $addkraid = $addrow['kra_id'];
                                    $addkraname = $addrow['kra_name'];

                                    ?>
                                    <option value="<?php echo $addkraid ?>"><?php echo $addkraname ?>

                                    </option>
                                <?php endwhile ?>
                            </select>


                        </div>
                    </div>
                    <div class="col-lg">
                        <label for="" class="col-form-label">Enter the Objective</label>
                        <input type="text" name="addobjname" id="mtobj_name" class="form-control" required pattern="[A-Za-z ]{3,}" title="Input three or more characters and input should not include special characters">
                        <div id="errorNo1"></div>
                    </div>

                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="addobj">Add Objective</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#mtobj_name').on('change', function() {
            var mtobj_name = $(this).val(); 
            if (mtobj_name) {
                $.ajax({
                    type: 'POST',
                    url: 'validatekramov.php',
                    data: 'mtobj_name=' + mtobj_name,
                    success: function(html) {
                         $('#errorNo1').html(html);
                    }
                });
            } else {
              
            }
        });
     });
</script>
<!-- End of OBJECTIVE Add Modal -->

<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
<?php endif ?>

<div class="container">
<div class="h4 breadcrumb bg-dark text-white "><strong>Master Teacher Key Result Areas and Objectives </strong></div>
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#kra-modal">Add KRA </button>
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#objective-modal">Add Objective for Key Result Areas </button>
        </div>

               


                <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  KRA -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB  
                    while ($row = $result->fetch_assoc()) :
                        $kra_id = $row['kra_id'];
                        $kra_name = $row['kra_name'];
                        $kra_num++;

                        ?>
                        <thead class="thead-dark">
                            <tr>
                                <!-- ASSIGN THE VALUE FROM THE DB  -->
                                <th colspan='3' class="alert alert-success">
                                <div class="d-flex px-5">
                                    <div class="p-2 w-100">
                                        <a><?php echo "KRA " . $kra_num . ": " . $row['kra_name'] ?></a>
                                    </div>
                                    <div class="p-2 flex-shrink-1">
                                        <a href="update/updatemtkramov.php?editkra=<?php echo $row['kra_id']; ?>" class="btn btn-sm btn-outline-primary text-decoration-none">Update</a>
                                    </div>
                                    <div class="p-2">
                                        <a href="delete/deletemtkramov.php?deletekra=<?php echo $row['kra_id']; ?>" class="btn btn-sm btn-outline-danger text-decoration-none">Delete</a>
                                    </div>
                                </div>
                    </th>
                            </tr>
                        </thead>


                        <tbody class="text-dark">
                            <tr>
                                <!-- START OF LOOP FROM OBJECTIVE -->
                                <?php
                                    //QUERY FOR INDICATORS TABLE 
                                    $indresult = $conn->query("SELECT * FROM mtobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
                                    //FETCH THE DATA FROM INDICATOR TABLE

                                    while ($rows = $indresult->fetch_assoc()) :

                                        ?>
                                    <td>

                                        <?php
                                                //ASSIGN THE VALUE FROM THE DB

                                                echo '<strong>' . $mtobj_num++ . ".</strong> " . $mtobj_name = $rows['mtobj_name'];

                                                ?>
                                    </td>
                                    <td><a href="update/updatemtkramov.php?edit=<?php echo $rows['mtobj_id']; ?>" class="btn-sm btn btn-outline-primary text-decoration-none">Update</a></td>

                                    <td><a href="delete/deletemtkramov.php?delete=<?php echo $rows['mtobj_id']; ?>" class="btn-sm btn btn-outline-danger text-decoration-none">Delete</a></td>
                            </tr>
                            <!-- END LOOP FOR THE CBC INDICATORS -->
                        <?php

                            endwhile
                            ?>



                        </tbody>
                        <!-- END LOOP FOR THE KRA -->
                    <?php
                        $mtobj_num = 1;
                    endwhile
                    ?>

                </table>

            </div>
        </div>
    </div>
</div>
</div><!-- End tag of container -->


<br>

<?php

include 'samplefooter.php';
?>