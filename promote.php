<?php

include 'sampleheader.php';


$userqry = $conn->query('SELECT * from account_tbl WHERE position IN("School Head","Master Teacher IV","Master Teacher III","Master Teacher II","Master Teacher I","Teacher III","Teacher II","Teacher I") ');
?>
<div class="container">
<div class="card">
    <div class="card-header text-center">
    <h2 class="text-center">Promote User</h2>
    </div>
        <div class="card-body text-center">
            <table class="table table-sm table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Fullname</th>
                        <th>Position</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>School</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = $userqry->fetch_assoc()):
                        $user_id = $row['user_id'];
                        $surname = $row['surname'];
                        $firstname = $row['firstname'];
                        $middlename = $row['middlename'];
                        $position = $row['position'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        $school = displaySchool($conn,$row['school_id']);
                        $fullname = $firstname . ' ' . substr($middlename, 0, 1) . '. ' . $surname;
                    ?>
                <tr>
                    <td><?php echo $fullname; ?></td>
                    <td><?php echo $position; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $contact; ?></td>
                    <td><?php echo $school; ?></td>
                    <td><button class="btn btn-sm btn-outline-info" name="promote" data-toggle="modal" data-target="#userModal<?= $user_id ?>">Promote</button></td>
                </tr>
                    
                    
                    
                </tbody>
                <!-- User Modal -->
                <div class="modal fade" id="userModal<?= $user_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Promote User    <?= displayName($conn,$user_id) ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="includes/processpromote.php">
                        <input type = "hidden" name="user_id" value="<?= $user_id;?>">
                        <strong>Previous position: </strong><b class="text-danger"><?php echo $position; ?></b> <br>
                        <strong>New Position: </strong>
                        <select name="new_pos" class="form-control-sm">
                            <?php
                                $positionQry = $conn->query('SELECT * FROM position_tbl WHERE position_name IN ("School Head","Master Teacher IV","Master Teacher III","Master Teacher II","Master Teacher I","Teacher III","Teacher II","Teacher I")');
                                while ($rows = $positionQry->fetch_assoc()):
                                    $position_name = $rows['position_name'];
                            ?>
                       
                            <option value="<?php echo $position_name?>"><?php echo $position_name?></option>
                       

                                <?php endwhile; ?>
                                </select>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Enf of user modal -->
                     


                    <?php endwhile; ?>
            </table>


        </div>

</div>
</div>


<?php


include 'samplefooter.php';
?>