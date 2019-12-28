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

<div class="modal fade" id="seminar-modal" tabindex="-1" role="dialog" aria-labelledby="seminarModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Add MOV</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="includes/processseminar.php" method="POST">
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="start-date" class="col-form-label"><strong>Select Start Date</strong></label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg">
                            <label for="end-date" class="col-form-label"><strong>Select End Date</strong></label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <label for="sem-name" class="col-form-label"><strong>Seminar Name</strong></label>
                            <textarea name="seminar_name" id="semname" cols="5" rows="5" class="form-control" placeholder="Enter the seminar name..." required></textarea>
                            <div id="errorNo"></div>
                        </div>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save">Add Seminar</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
</div>

<script>
         $(document).ready(function() {
        $('#semname').on('change', function() {
            var semname = $(this).val(); 
            if (semname) {
                $.ajax({
                    type: 'POST',
                    url: 'validateseminar.php',
                    data: 'semname=' + semname,
                    success: function(html) {
                         $('#errorNo').html(html);
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
            <button class="btn btn-sm btn-success m-1 " data-toggle="modal" data-target="#seminar-modal">Add Seminar<i class="fas fa-truck-moving    "></i> </button>


            <div class="h4 breadcrumb bg-dark text-white ">List of Seminars </div>


           
                        <?php

                        $query2 = mysqli_query($conn, "SELECT * FROM seminar_tbl") or die($conn->error);

                        ?>

                        <table class="table table-sm">
                            <caption>Seminar</caption>
                            <thead class="bg-success text-white ">
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Seminar Name</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <?php
                            while ($rows = mysqli_fetch_array($query2)) {
                                ?>
                                <tbody class="text-justify">
                                    <tr>
                                        <td><?php echo $rows['semstart_date']; ?></td>
                                        <td><?php echo $rows['semend_date']; ?></td>
                                        <td><?php echo $rows['seminar_name']; ?></td>
                                        <td><a href="update/updateseminar.php?edit=<?php echo $rows['seminar_id']; ?>" class="btn btn-outline-primary">Update</a></td>
                                        <td><a href="delete/deleteseminar.php?delete=<?php echo $rows['seminar_id']; ?>" class="btn btn-outline-danger">Delete</a>

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