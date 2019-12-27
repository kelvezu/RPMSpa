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

<div class="modal fade" id="perftindicator-modal" tabindex="-1" role="dialog" aria-labelledby="perftindicatorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add Indicator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/processperftindicator.php" method="POST">
                    <div class="row">
                        <div class="col-lg">
                            <label for="sel-kra" class="col-form-label"><strong>Select Key Result Areas</strong></label>
                            <select name="kra_name" id="kradd" onChange="change_kra()" class="form-control" required>
                                <option>Select KRA</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * from kra_tbl");
                                while ($row = mysqli_fetch_array($query)) {
                                    $kra_id = $row['kra_id'];
                                    $kra_name = $row['kra_name'];
                                    ?>
                                    <option value="<?php echo $kra_id ?>"><?php echo $kra_name; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="sel-mov" class=" col-form-label"><strong>Select Objective</strong></label>
                            <div id="objective">
                                <select class="form-control" required>
                                    <option>Select Objective</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="indicator-no" class="control-label"><strong>QET</strong></label>
                            <select name="qet" class="form-control" required>
                                <option value="" disabled selected>--Select--</option>
                                <option value="Quality">Quality</option>
                                <option value="Efficiency">Efficiency</option>
                                <option value="Timeliness">Timeliness</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="lvl-no" class="control-label w-25 "><strong>Level No</strong></label>
                            <input type="number" name="level_no" id="level_no" class="form-control" required pattern="[0-9]" title="Input number only">
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="indicator-name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                            <textarea name="indicator_name" id="indicator_name" cols="5" rows="5" class="form-control" placeholder="Enter the indicator name..." required></textarea>
                            <div id="errorNo1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="desc" class="control-label w-25 "><strong>Indicator Description</strong></label>
                            <textarea name="desc_name" id="desc" cols="5" rows="5" class="form-control" placeholder="Enter the indicator description..." required></textarea>
                            <div id="errorNo2"></div>
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
        $('#indicator_name').on('change', function() {
            var indicator_name = $(this).val(); 
            if (indicator_name) {
                $.ajax({
                    type: 'POST',
                    url: 'validateperfindicator.php',
                    data: 'indicator_name=' + indicator_name,
                    success: function(html) {
                         $('#errorNo1').html(html);
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
                    url: 'validateperfindicator.php',
                    data: 'desc=' + desc,
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
<?php endif ?>

<div class="container">
  
        <div class="right">
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#perftindicator-modal">Add Indicator </button>

            <div class="h4 breadcrumb bg-dark text-white ">Teacher Performance Indicator </div>

            <script type="text/javascript">
                function change_kra() {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "ajaxmov.php?kra=" + document.getElementById("kradd").value, false);
                    xmlhttp.send(null);
                    document.getElementById("objective").innerHTML = xmlhttp.responseText;

                }
            </script>


         
                        <?php
                        
                        $result = $conn->query('SELECT kra_tbl.kra_name,tobj_tbl.tobj_name,perftindicator_tbl.* FROM (perftindicator_tbl INNER JOIN kra_tbl ON perftindicator_tbl.kra_id = kra_tbl.kra_id) 
                    INNER JOIN tobj_tbl ON perftindicator_tbl.tobj_id = tobj_tbl.tobj_id')  or die($conn->error);
                        ?>

                        <table class="table table-sm">
                            <caption>Teacher Performance Indicator</caption>
                            <thead class="bg-success text-nowrap text-white ">
                                <tr>
                                    <th class="text-center">KRA</th>
                                    <th class="text-center">Objective</th>
                                    <th class="text-center">QET</th>
                                    <th class="text-center">Level No</th>
                                    <th class="text-center">Indicator Name</th>
                                    <th class="text-center">Description</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php
                            while ($row = $result->fetch_assoc()) :
                                ?>
                                <tbody class="text-justify">
                                    <tr>
                                        <td><?php echo $row['kra_name']; ?></td>
                                        <td><?php echo $row['tobj_name']; ?></td>
                                        <td><?php echo $row['qet']; ?></td>
                                        <td><?php echo $row['level_no']; ?></td>
                                        <td><?php echo $row['indicator_name']; ?></td>
                                        <td><?php echo $row['desc_name']; ?></td>
                                        <td><a href="update/updateperftindicator.php?edit=<?php echo $row['perftindicator_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                        <td><a href="delete/deleteperftindicator.php?delete=<?php echo $row['perftindicator_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                        </table>
                    </div>
                </div>

<br>
<?php

include 'samplefooter.php';
?>