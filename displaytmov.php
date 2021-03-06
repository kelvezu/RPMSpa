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


    <div class="modal fade" id="mov-modal" tabindex="-1" role="dialog" aria-labelledby="movModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title " id="exampleModalLabel">Add MOV</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="includes/processtmov.php" method="POST">
                     
                            <div class="col">
                                <label for="sel-kra" class="col-form-label"><strong>Select Key Result Areas</strong></label>
                                <select name="kra_name" id="kradd" onChange="change_kra()" class="form-control" required>
                                    <option value="" disabled selected>Select KRA</option>
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

                            <div class="col">
                                <label for="sel-mov" class=" col-form-label"><strong>Select Objective</strong></label>
                                <div id="objective">
                                    <select class="form-control" required>
                                        <option>Select Objective</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="main-mov" class="col-form-label"><strong>Main MOV</strong></label>
                                <input type="text" name="main_mov" id="main_mov" class="form-control" placeholder="Enter the main mov..." required>
                                <div id="errorNo"></div>
                            </div>
                            <div class="col">
                                <label for="supp-mov" class="col-form-label"><strong>Supporting MOV</strong></label>
                                <input type="text" name="supp_mov" id="supp_mov" class="form-control" placeholder="Enter the supporting mov..." required>
                                <div id="errorNo1"></div>
                            </div>
                            <div class="m-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Add MOV</button>
                            </div>
                            </div>
                           
                    </form>
              
            </div>
        </div>

    </div>

    <script>
    $(document).ready(function() {
        $('#main_mov').on('change', function() {
            var main_mov = $(this).val(); 
            if (main_mov) {
                $.ajax({
                    type: 'POST',
                    url: 'validatemov.php',
                    data: 'main_mov=' + main_mov,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
              
            }
        });
     });

         $(document).ready(function() {
        $('#supp_mov').on('change', function() {
            var supp_mov = $(this).val(); 
            if (supp_mov) {
                $.ajax({
                    type: 'POST',
                    url: 'validatemov.php',
                    data: 'supp_mov=' + supp_mov,
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
    <?php endif; ?>

    <div class="container">
            <div class="right">
                <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#mov-modal">Add MOV<i class="fas fa-truck-moving    "></i> </button>

                <script type="text/javascript">
                    function change_kra() {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("GET", "ajaxmov.php?kra=" + document.getElementById("kradd").value, false);
                        xmlhttp.send(null);
                        document.getElementById("objective").innerHTML = xmlhttp.responseText;

                    }
                </script>

                <div class="h4 breadcrumb bg-dark text-white "><strong>Teacher Means of Verification</strong> </div>
                   
                      
                            <?php

                            $query2 = mysqli_query($conn, "SELECT kra_tbl.kra_name,tobj_tbl.tobj_name,tmov_tbl.* FROM (tmov_tbl INNER JOIN kra_tbl ON tmov_tbl.kra_id = kra_tbl.kra_id) 
                    INNER JOIN tobj_tbl ON tmov_tbl.tobj_id = tobj_tbl.tobj_id")
                                or die($conn->error);

                            ?>

                            <table class="table table-sm">   
                                <caption>Teacher Means of Verification</caption>
                                <thead class="bg-success text-white ">
                                    <tr>
                                        <th>KRA Name</th>
                                        <th>Objective Name</th>
                                        <th>Main MOV</th>
                                        <th>Supporting MOV</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                while ($rows = mysqli_fetch_array($query2)) {
                                    ?>
                                    <tbody class="text-justify">
                                        <tr>
                                            <td><?php echo $rows['kra_name']; ?></td>
                                            <td><?php echo $rows['tobj_name']; ?></td>
                                            <td><?php echo $rows['main_mov']; ?></td>
                                            <td><?php echo $rows['supp_mov']; ?></td>
                                            <td><a href="update/updatetmov.php?edit=<?php echo $rows['tmov_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                            <td><a href="delete/deletetmov.php?delete=<?php echo $rows['tmov_id']; ?>" class="btn btn-outline-danger">Delete</a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>

    <br>
    <?php

    include 'samplefooter.php';
    ?>