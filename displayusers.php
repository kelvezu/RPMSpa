<?php
include 'sampleheader.php';


if (isset($_GET['usertype'])) :
    $usertype = $_GET['usertype'];
    if ($usertype == 'sh') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Principal" OR position = "School Heads"';
    elseif ($usertype == 'as') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Asst. Superintendent" OR position = "Superintendent"';
    elseif ($usertype == 'mt') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Master Teacher IV" OR position = "Master Teacher III" OR position = "Master Teacher II" OR position = "Master Teacher I"';
    elseif ($usertype == 't') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = "Teacher III" OR position = "Teacher II" OR position = "Teacher I"';
    elseif ($usertype == 'n') :
        $userqry = 'SELECT * FROM account_tbl WHERE position = 10';
    elseif ($usertype == 'a') :
        $userqry = 'SELECT * from account_tbl';
    endif;
else :
    $userqry = 'SELECT * FROM account_tbl';
endif;
?>
<script src="includes/scripts.js"></script>

<main>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> breadcrumb">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
    <?php endif ?>


    <!--View User Records modal -->




    
        <div class="container">
            <div class="d-flex justify-content-center">
                
                <div class="d-inline-flex p-2 bd-highlight">
                    <a href="?usertype=a" class="btn btn-sm btn-success">View All Users</a>&nbsp
                    <a href="?usertype=as" class=" btn btn-sm btn-success">View All Asst. Superintendent</a>&nbsp
                    <a href="?usertype=sh" class=" btn btn-sm btn-success">View All School Heads</a>&nbsp
                    <a href="?usertype=mt" class=" btn btn-sm btn-success">View All Master Teacher</a>&nbsp
                    <a href="?usertype=t" class="btn btn-sm btn-success">View All Teacher</a>&nbsp
                    <a href="?usertype=n" class="btn btn-sm btn-success">View Users with No position</a>

                </div>
            </div>
            <div class="d-flex justify-content-between bg-dark">
                <div class="p-2"></div>
                <div class="p-2 h4 text-white"> Account Informations</div>
                <div class="p-2"> <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#adduser">Add User</button></div>
               
            </div>
            
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="schoolModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title " id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="includes/signup.inc.php" method="post">
                    <input type="hidden" name="added_by" value="<?php echo $_SESSION['user_id'];  ?>">

                    <label for="prcid"><strong>PRC ID:</strong></label>
                    <input type="number" name="prc_id" placeholder="Enter PRC ID.." class="form-control" id="prc_id" required>
                    <div id="errorNo"></div>

                    <label for="Email"><strong>Email:</strong></label>
                    <input type="email" name="email" placeholder="Enter Email.." class="form-control" id="email" required>
                    <div id="errorNo1"></div>

                    <label for="surname"><strong>Surname:</strong></label>
                    <input type="text" name="surname" placeholder="Enter Surname.." class="form-control" id="surname" required>
                    <div id="errorNo2"></div>

                    <label for="firstname"><strong>Firstname:</strong></label>
                    <input type="text" name="firstname" placeholder="Enter Firstname.." class="form-control" id="firstname" required>
                    <div id="errorNo3"></div>

                    <label for="middlename"><strong>Middlename:</strong></label>
                    <input type="text" name="middlename" placeholder="Enter Middlename.." class="form-control" id="middlename" required>
                    <div id="errorNo4"></div>

                    <label for="position"><strong>Position:</strong></label>
                    <select name="position" class="form-control" required id="position">
                        <option value="" disabled selected>Select Position</option>
                        <?php
                            $posiresult = $conn->query('SELECT * FROM position_tbl')  or die($conn->error);
                            while ($posirow = $posiresult->fetch_assoc()) :
                                $posi_id = $posirow['position_id'];
                                $posi_name = $posirow['position_name'];
                        ?>
                                <option value="<?php echo $posi_name ?>"><?php echo $posi_name; ?>
                        <?php endwhile; ?>
                        </option>
                    </select>
                    <div id="errorNo5"></div>

                    <label for="contact"><strong>Contact Number:</strong></label>
                    <input name="contact" placeholder="Enter Contact Number.." class="form-control"  id="contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "11" required>
                    <div id="errorNo6"></div>

                    <label for="sex"><strong>Sex:</strong></label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option>--Select Gender--</option>
                        <?php
                        $genderresult = $conn->query('SELECT * FROM gender_tbl')  or die($conn->error);
                        while ($genrow = $genderresult->fetch_assoc()) :
                            $gender_name = $genrow['gender_name'];
                            ?>
                            <option value="<?php echo $gender_name ?>"><?php echo $gender_name; ?>
                            <?php endwhile ?>
                            </option>
                    </select>
                    <div id="errorNo7"></div>

                    <label for="birthdate"><strong>Birthdate:</strong></label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate" required>
                    <div id="errorNo8"></div>

                    <label for="school"><strong>School:</strong></label>
                    <select name="school" id="school" class="form-control" required>
                                    <option>--Select school--</option>
                                    <?php
                                    $schresult = $conn->query('SELECT * FROM school_tbl')  or die($conn->error);
                                    while ($schrow = $schresult->fetch_assoc()) :
                                        $sch_id = $schrow['school_id'];
                                        $sch_name = $schrow['school_name'];
                                        ?>
                                        <option value="<?php echo $sch_id ?>"><?php echo $sch_name; ?>
                                        <?php endwhile ?>
                                        </option>
                    </select>
                    <div id="errorNo9"></div>

        <br>
    
                    <a href="dbAdmin.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="signup" id="signup" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <small>
            <table class="table table-bordered hover table-sm">

                <thead class="thead-dark text-center">
                    <tr>
                        <th>Fullname</th>
                        <th>Position</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>School</th>
                        <th>Username</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <?php 
                $result = mysqli_query($conn,$userqry);
                while ($row = $result->fetch_assoc()) :
                    $surname = $row['surname'];
                    $firstname = $row['firstname'];
                    $middlename = $row['middlename'];
                    $position = $row['position'];
                    $fullname = $firstname . ' ' . substr($middlename, 0, 1) . '. ' . $surname;
                    ?>
                    <tbody>
                        <tr>

                            <td><?php echo $fullname; ?></td>
                            <td><?php echo $row['position'] ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo displaySchool($conn,$row['school_id']); ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><a href="update/updateusers.php?edit=<?php echo $row['user_id']; ?>" class="btn-sm btn-outline-primary btn-block text-center text-decoration-none">Update</a></td>
                            <td><a href="delete/deleteusers.php?delete=<?php echo $row['user_id']; ?>" class="btn-sm btn-outline-danger btn-block text-center text-decoration-none">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                
        </div>
        </tbody>

        </table>

</small>


<br>

<script>

$(document).ready(function() {
        $('#prc_id').on('change', function() {
            var prc_id = $(this).val(); 
            if (prc_id) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'prc_id=' + prc_id,
                    success: function(html) {
                         $('#errorNo').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#email').on('change', function() {
            var email = $(this).val(); 
            if (email) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'email=' + email,
                    success: function(html) {
                         $('#errorNo1').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#surname').on('change', function() {
            var surname = $(this).val(); 
            if (surname) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'surname=' + surname,
                    success: function(html) {
                         $('#errorNo2').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#firstname').on('change', function() {
            var firstname = $(this).val(); 
            if (firstname) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'firstname=' + firstname,
                    success: function(html) {
                         $('#errorNo3').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#middlename').on('change', function() {
            var middlename = $(this).val(); 
            if (middlename) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'middlename=' + middlename,
                    success: function(html) {
                         $('#errorNo4').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#contact').on('change', function() {
            var contact = $(this).val(); 
            if (contact) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'contact=' + contact,
                    success: function(html) {
                         $('#errorNo6').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#birthdate').on('change', function() {
            var birthdate = $(this).val(); 
            if (birthdate) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'birthdate=' + birthdate,
                    success: function(html) {
                         $('#errorNo8').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });

    $(document).ready(function() {
        $('#school').on('change', function() {
            var school = $(this).val(); 
            var position = $('#position').val();
            if (school) {
                $.ajax({
                    type: 'POST',
                    url: 'validateuser.php',
                    data: 'school=' + school + '&position=' + position,
                    success: function(html) {
                         $('#errorNo9').html(html);
                    }
                });
            } else {
                return "Please enter school number";
            }
        });
    });
</script>




<?php

include 'samplefooter.php';
?>
