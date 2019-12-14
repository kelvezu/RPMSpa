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
                <div class="p-2"><a href="signup2.php" class="btn btn-primary">Add User</a></div>
               
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
<?php

include 'samplefooter.php';
?>
