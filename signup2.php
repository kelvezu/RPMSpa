<?php


include 'processsignup.php';

?>
<script src="js/jquery.min.js"></script>
<script src="js/singup.js"></script>
<html>



    <link rel="stylesheet" href="bootstrap4/b4css/main.css">
    <link rel="stylesheet" href="bootstrap4/b4css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="bootstrap4/font_awesome/css/all.css">
 <link rel="stylesheet" href="signup.css">
<div class="container col-md-6">

<div class="card ">
    <div class="card-header text-center bg-info h4">
        Add Account
    </div>
    <div class="card-body">
      
    <form method="POST">
  <div id="error_msg"></div>

        <!-- <input type="hidden" name="added_by" value="<?php //echo $_SESSION['user_id'];  ?>"> -->
    <div>
        <label for="prcid"><strong>PRC ID:</strong></label>
        <input type="number" name="prc_id" placeholder="Enter PRC ID.." class="form-control" id="prc_id">
        <span></span>
</div>
<div>
        <label for="Email"><strong>Email:</strong></label>
        <input type="email" name="email" placeholder="Enter Email.." class="form-control" id="email">
        <span></span>
</div>
<div>
        <label for="surname"><strong>Surname:</strong></label>
        <input type="text" name="surname" placeholder="Enter Surname.." class="form-control" id="surname">
</div>
<div>
        <label for="firstname"><strong>Firstname:</strong></label>
        <input type="text" name="firstname" placeholder="Enter Firstname.." class="form-control" id="firstname">
</div>
<div>
        <label for="middlename"><strong>Middlename:</strong></label>
        <input type="text" name="middlename" placeholder="Enter Middlename.." class="form-control" id="middlename">
</div>
<div>
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
</div>

<div>
        <label for="contact"><strong>Contact Number:</strong></label>
        <input name="contact" placeholder="Enter Contact Number.." class="form-control"  id="contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "11" >
        <span></span>
</div>
<div>
        <label for="sex"><strong>Sex:</strong></label>
        <select name="gender" id="gender" class="form-control">
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
        <span></span>
</div>
<div>
        <label for="birthdate"><strong>Birthdate:</strong></label>
        <input type="date" name="birthdate" class="form-control" id="birthdate">
        <span></span>
</div>
<div>
        <label for="school"><strong>School:</strong></label>
         <select name="school" id="school" class="form-control">
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
        <span></span>
</div>
        <br>
    
        <a href="dbAdmin.php" class="btn btn-danger">Cancel</a>
        <button type="button" name="signup" id="signup" class="btn btn-info">Submit</button>
    </form> 
    </div>

</div>
</div>
</html>



