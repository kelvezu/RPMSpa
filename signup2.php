         <?php

            include 'sampleheader.php';

            $user = $_SESSION['user_id'];
            $sy = $_SESSION['active_sy_id'];
            $school_id = $_SESSION['school_id'];

            $rater = $_SESSION['rater'];
            $approving_authority = $_SESSION['approving_authority'];

            if (isset($_GET['notif'])) :
                if ($_GET['notif'] == 'success') :
                    echo '<div class="green-notif-border">User has been added!</div>';
                else :
                    echo '<div class="red-notif-border">User is not added!</div>';
                endif;

            endif;

            ?>

         <?php if (isset($_POST['signup'])) : ?>

             <?php showModal('myModal') ?>

             <div id="myModal" class="modal container-fluid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-lg">
                     <div class="modal-content">

                         <?php
                            $error_array = [];
                            $prc_id =  $_POST['prc_id'];
                            $email = $_POST['email'];
                            $surname = $_POST['surname'];
                            $firstname = $_POST['firstname'];
                            $middlename = $_POST['middlename'];
                            $position = $_POST['position'] ?? "";
                            $contact = $_POST['contact'];
                            $gender = $_POST['gender'] ?? "";
                            $birthdate = $_POST['birthdate'];
                            $from = new DateTime($birthdate);
                            $to   = new DateTime('today');
                            $age = $from->diff($to)->y;
                            $school = $_POST['school'] ?? "";

                            $prc_Qry = $conn->query("SELECT * FROM account_tbl WHERE prc_id = '$prc_id'");
                            $prc_count = $prc_Qry->num_rows;

                            if ($prc_count > 0) :
                                $error_array[] = "PRC ID is taken";
                            endif;

                            if (strlen($prc_id) < 6) :
                                $error_array[] = "PRC ID should contain 6 digits above.";
                            endif;

                            $email_Qry = $conn->query("SELECT * FROM account_tbl WHERE email = '$email'");
                            $email_count = $email_Qry->num_rows;

                            if ($email_count > 0) :
                                $error_array[] = "Email is taken";
                            endif;

                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
                                $error_array[] = "Invalid Email Format! ";
                            endif;

                            if (ctype_space($surname)) :
                                $error_array[] = "Surname has too many spaces! ";
                            endif;

                            if ((strlen($surname)) < 2) :
                                $error_array[] = "Surname should consist at least 2 characters above.! ";
                            endif;

                            if (ctype_space($middlename)) :
                                $error_array[] = "Middlename has too many spaces! ";
                            endif;

                            if ((strlen($middlename)) < 2) :
                                $error_array[] = "Middlename should consist at least 2 characters above.! ";
                            endif;

                            if (ctype_space($firstname)) :
                                $error_array[] = "Firstname has too many spaces! ";
                            endif;

                            if ((strlen($firstname)) < 2) :
                                $error_array[] = "Firstname should consist at least 2 characters above.! ";
                            endif;

                            $contact_Qry = $conn->query("SELECT * FROM account_tbl WHERE contact = '$contact'");
                            $contact_count = $contact_Qry->num_rows;

                            if ($contact_count > 0) :
                                $error_array[] = "Contact Number is taken";
                            endif;

                            if ((strlen($contact)) < 11) :
                                $error_array[] = "Contact should consist of 11 digits.";
                            endif;

                            if ($age < 18) :
                                $error_array[] = "Birthdate not valid.";
                            endif;

                            if ($age > 65) :
                                $error_array[] = "Birthdate not valid.";
                            endif;

                            if ($position == 'Principal') :
                                $schoolpos_Qry = $conn->query("SELECT * FROM account_tbl WHERE school_id = '$school'");
                                $schoolpos_count = $schoolpos_Qry->num_rows;

                                if ($schoolpos_count > 0) :
                                    $error_array[] = "Only one principal is allowed per school.";
                                endif;
                            endif;

                            $user_Exist = mysqli_query($conn, "SELECT * FROM account_tbl WHERE surname = '$surname' AND firstname = '$firstname' AND middlename = '$middlename' AND birthdate = '$birthdate'") or console_log($conn->error . $user_Exist);
                            $user_count = mysqli_num_rows($user_Exist);

                            if ($user_count > 0) :
                                $error_array[] = "User already exist!";
                            endif;

                            if (!empty($error_array)) :
                                echo '<ul class="red-notif-border text-justify">';
                                foreach ($error_array as $errors) :
                                    echo '<li>' . $errors . '</li>';
                                endforeach;
                                echo '</ul>';
                            endif;
                            ?>
                         <form action="includes/processsignup.php" method="post">
                             <input type="hidden" name="added_by" value="<?php echo $user;  ?>">
                             <input type="hidden" name="school" value="<?php echo $school_id; ?>">
                             <input type="hidden" name="sy" value="<?php echo $sy; ?>">


                             <div class="tomato-color h4 font-italic">Are you sure you want to add user below?</div>
                             <div class="m-3">
                                 <table class="table table-sm table-bordered text-justify">

                                     <tr>
                                         <th>PRC ID:</th>
                                         <td><input type="hidden" name="prc_id" value="<?php echo $prc_id; ?>" readonly class="form-control">
                                             <?php echo $prc_id; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Email:</th>
                                         <td><input type="hidden" name="email" value="<?php echo $email; ?>" readonly class="form-control">
                                             <?php echo $email; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Surname:</th>
                                         <td><input type="hidden" name="surname" value="<?php echo $surname; ?>" readonly class="form-control">
                                             <?php echo $surname; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Firstname:</th>
                                         <td><input type="hidden" name="firstname" value="<?php echo $firstname; ?>" readonly class="form-control">
                                             <?php echo $firstname; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Middlename:</th>
                                         <td><input type="hidden" name="middlename" value="<?php echo $middlename; ?>" readonly class="form-control">
                                             <?php echo $middlename; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Position:</th>
                                         <td><input type="hidden" name="position" value="<?php echo $position; ?>" readonly class="form-control">
                                             <?php echo $position; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Contact Number:</th>
                                         <td><input type="hidden" name="contact" value="<?php echo $contact; ?>" readonly class="form-control">
                                             <?php echo $contact; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Sex</th>
                                         <td><input type="hidden" name="gender" value="<?php echo $gender; ?>" readonly class="form-control">
                                             <?php echo $gender; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>Birthdate:</th>
                                         <td><input type="hidden" name="birthdate" value="<?php echo $birthdate; ?>" readonly class="form-control">
                                             <?php echo $birthdate; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <th>School:</th>
                                         <td><input type="hidden" name="school" value="<?php echo $school; ?>" readonly class="form-control">
                                             <?php echo displaySchool($conn, $school); ?>
                                         </td>
                                     </tr>

                                     <tfoot>
                                         <td colspan="10">
                                             <div class="d-flex justify-content-center">
                                                 <?php if (empty($error_array)) : ?>
                                                     <div class="p-2"><button name="submit" class="btn btn-success">Submit</button></div>
                                                 <?php endif; ?>
                                                 <div class="p-2"><button class="btn btn-danger" data-dismiss="modal">Cancel</button></div>
                                             </div>
                                         </td>
                                     </tfoot>
                                 </table>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>

         <?php endif; ?>

         <div class="container col-sm-6 ">
             <div class="card">
                 <div class="card-header bg-dark text-white h5">
                     Add User
                 </div>
                 <div class="card-body">
                     <form method="post">

                         <label for="prcid"><strong>PRC ID:</strong></label>
                         <input type="number" name="prc_id" placeholder="Enter PRC ID.." class="form-control" id="prc_id" required value="<?php echo $prc_id ?? ""; ?>">
                         <div id="errorNo"></div>

                         <label for="Email"><strong>Email:</strong></label>
                         <input type="text" name="email" placeholder="Enter Email.." class="form-control" id="email" required value="<?php echo $email ?? ""; ?>">
                         <div id="errorNo1"></div>

                         <label for="surname"><strong>Surname:</strong></label>
                         <input type="text" name="surname" placeholder="Enter Surname.." class="form-control" id="surname" required value="<?php echo $surname ?? ""; ?>">
                         <div id="errorNo2"></div>

                         <label for="firstname"><strong>Firstname:</strong></label>
                         <input type="text" name="firstname" placeholder="Enter Firstname.." class="form-control" id="firstname" required value="<?php echo $firstname ?? ""; ?>">
                         <div id="errorNo3"></div>

                         <label for="middlename"><strong>Middlename:</strong></label>
                         <input type="text" name="middlename" placeholder="Enter Middlename.." class="form-control" id="middlename" required value="<?php echo $middlename ?? ""; ?>">
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
                         <input name="contact" placeholder="Enter Contact Number.." class="form-control" id="contact" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" required value="<?php echo $contact ?? ""; ?>">
                         <div id="errorNo6"></div>

                         <label for="sex"><strong>Sex:</strong></label>
                         <select name="gender" id="gender" class="form-control" required>
                             <option value="" disabled selected>Select Gender</option>
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
                         <input type="date" name="birthdate" class="form-control" id="birthdate" required value="<?php echo $birthdate ?? ""; ?>">
                         <div id="errorNo8"></div>

                         <label for="school"><strong>School:</strong></label>
                         <select name="school" id="school" class="form-control" required>
                             <option value="" disabled selected>Select School</option>

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
                         <div id="errorNo9"></div> <br>


                         <a href="javascript:history.back(1)" class="btn btn-danger">Back</a>
                         <button type="submit" name="signup" class="btn btn-info">Submit</button>
                     </form>
                 </div>
             </div>
         </div>



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