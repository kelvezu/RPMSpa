
<?php
 include_once 'includes/conn.inc.php';
 include_once 'includes/header.php';
 
?>
<main>
<div class="container">
<div class="breadcome-list shadow-reset">
       
    <?php
     if(isset($_SESSION['username'])):
        echo $_SESSION['username'];
        endif
         ?>
        <form action="includes/signup.inc.php" method="post">
        <fieldset class="form-group">
            <legend class="form-legend">Add Account</legend>
            <?php
            if(isset($_GET['error'])){
                //ERROR FOR EMPTY FIELDS 
                if($_GET['error'] == "emptyfields"){
                    echo '<p class="text-danger" align="center"><b> Fill up all empty fields!</b></p>';
                }
                //ERROR FOR SPECIAL CHARACTERS FOR NAMES
                elseif($_GET['error'] == "nospeccharnames"){
                    echo '<p class="text-danger" align="center"><b>Invalid format name! Use Alphabet letters only!</b></p>';
                }
                //ERROR FOR SURNAME AND FIRSTNAME SPECIAL CHARS
                elseif($_GET['error'] == "nospeccharsnamefname"){
                    echo '<p class="text-danger" align="center"><b>Invalid Surname and Firstname!  Use Alphabet letters only! </b></p>';
                }
                //ERROR FOR FIRSTNAME AND MIDDLENAME SPECIAL CHARS
                elseif($_GET['error'] == "nospeccharfnamemname"){
                    echo '<p class="text-danger" align="center"><b>Invalid Firstname and Middlename! Use Alphabet letters only! </b></p>';
                }
                //ERROR FOR SURNAME AND MIDLENAME
                elseif($_GET['error'] == "nospeccharsnamemname"){
                    echo '<p class="text-danger" align="center"><b>Invalid Surname and Middlename! Use Alphabet letters only! </b></p>';
                }
                //ERROR FOR INVALID EMAIL
                elseif($_GET['error'] == "invalidmailuser"){
                    echo '<p class="text-danger" align="center"><b>Invalid Email and Username</b></p>';
                }
                //ERROR FOR SURNAME WITH SPECIAL CHARS
                elseif($_GET['error'] == "invalidsurname"){
                    echo '<p class="text-danger" align="center"><b>Surname invalid!  Use Alphabet letters only!</b></p>';
                }
                //ERROR FOR FIRSTNAME WITH SPECIAL CHARS
                elseif($_GET['error'] == "invalidfirstname"){
                    echo '<p class="text-danger" align="center"><b>Firstname invalid! Use Alphabet letters only!</b></p>';
                }
                //ERROR FOR MIDDLENAME WITH SPECIAL CHARS
                elseif($_GET['error'] == "invalidmiddlename"){
                    echo '<p class="text-danger" align="center"><b>Middlename invalid! Insert a letter only</b></p>';
                }
                //ERROR FOR SURNAME LENGTH IS LESS THAN 1
                elseif($_GET['error'] == "shortsurname"){
                    echo '<p class="text-danger" align="center"><b>Surname must have 2 or more  letters</b></p>';
                }
                //ERROR FOR FIRSTNAME LENGTH IS LESS THAN 1
                elseif($_GET['error'] == "shortfirstname"){
                    echo '<p class="text-danger" align="center"><b>Firstname must have 2 or more  letters</b></p>';
                }
                //ERROR FOR MIDDLENAME LENGTH IS LESS THAN 1
                elseif($_GET['error'] == "shortmiddlename"){
                    echo '<p class="text-danger" align="center"><b>Middlename must have 2 or more  letters</b></p>';
                }
                //ERROR FOR CONTACT IF NOT NUMERIC AND NOT EQUAL TO 11
                elseif($_GET['error'] == "invalidcontact"){
                    echo '<p class="text-danger" align="center"><b>Contact must be numeric and must be 11 digits</b></p>';
                }
                //ERROR FOR CONTACT IF NOT NUMERIC
                elseif($_GET['error'] == "contactnotnumeirc"){
                    echo '<p class="text-danger" align="center"><b>Contact must be numeric</b></p>';
                }
                //ERROR FOR CONTACT LENGTH IS EQUAL TO 11 
                elseif($_GET['error'] == "contactshort"){
                    echo '<p class="text-danger" align="center"><b>Contact must consist 11-digits</b></p>';
                }//ERROR FOR DIDNT MATCH PASSWORD 
                elseif($_GET['error'] == "pwCheck"){
                    echo '<p class="text-danger" align="center"><b>Password didnt match!</b></p>';
                }
                elseif($_GET['error'] == "emailtaken"){
                    echo '<p class="text-danger" align="center"><b>Email is already taken!</b></p>';
                }
                elseif($_GET['error'] == "shortusername"){
                    echo '<p class="text-danger" align="center"><b>Username must have atleast 4 characters!</b></p>';
                }
                elseif($_GET['error'] == "shortpwd"){
                    echo '<p class="text-danger" align="center"><b>Password must have atleast 8 characters!</b></p>';
                }          
            }
            elseif(isset($_GET['signup'])){
                if($_GET['signup'] == 'success'){
                    
                echo '<p class="text-success" align="center"><b>Sign up Success!</b></br> The username is <u><b>'.$_GET['uname'].'</b></u>! </p>';
                }
            }         
             ?>

             <?php
             
            if (!isset($_GET['surname'])){
                echo '<input type="text" class="form-control my-1" name="surname"  placeholder="Enter your Surname...">';
               
            }else{
              $surname = $_GET['surname'];
              echo '<input type="text" class="form-control my-1" name="surname"  placeholder="Enter your Surname..." value="'.$surname.'">';
            }   
             
             if (!isset($_GET['firstname'])){
                 echo '<input type="text" class="form-control my-1" name="firstname"  placeholder="Enter your Firstname...">'; 
                
             }else{
               $firstname = $_GET['firstname'];
                echo '<input type="text" class="form-control my-1" name="firstname"  placeholder="Enter your Firstname..." value="'.$firstname.'">';
             }   
             
             if (!isset($_GET['middlename'])){
                  
                 echo '<input type="text" class="form-control my-1" name="middlename"  placeholder="Enter your Middlename...">';
              }else{
                $middlename = $_GET['middlename'];
               echo '<input type="text" class="form-control my-1" name="middlename"  placeholder="Enter your Middlename..." value="'.$middlename.'">';
              }

            //   if (!isset($_GET['position'])){
            //     echo '<input type="text" class="form-control my-1" name="position"  placeholder="Enter the Position...">';    
            //   }else{
            //     $position = $_GET['position'];
            //     echo '<input type="text" class="form-control my-1" name="position"  placeholder="Enter the Position..." value="'.$position.'">';  
            //   } 
            ?>

            <select name="position" id="" class="form-control">
                  <option>--Select Position--</option>
                <?php  
                     $posiresult = $conn->query('SELECT * FROM position_tbl')  or die($conn->error);
                      while($posirow = $posiresult->fetch_assoc()):
                           $posi_id= $posirow['position_id'];
                            $posi_name = $posirow['position_name'];
                  ?>
                            <option value="<?php echo $posi_name ?>"><?php echo $posi_name; ?>
                            <?php endwhile ?> 
                          </option>
            </select>
            <?php
             if (!isset($_GET['email'])){
                echo '<input type="email" class="form-control my-1" name="email"  placeholder="Enter your Email Address...">';    
              }else{
                $email = $_GET['email'];
                echo '<input type="email" class="form-control my-1" name="email"  placeholder="Enter your Email Address..." value="'.$email.'">';  
              }
             
            if (!isset($_GET['contact'])){     
                echo '<input type="text" class="form-control my-1" name="contact" placeholder="Enter your Contact number..." maxlength="11" >';
              }else{
                $contact = $_GET['contact'];
                echo '<input type="text" class="form-control my-1" name="contact"  placeholder="Enter your Contact number..." value="'.$contact.'" maxlength="11">';
              }

              if (!isset($_GET['gender'])){     
                echo '<input type="text" class="form-control my-1" name="gender" placeholder="Enter Gender..."  >';
              }else{
                $gender = $_GET['gender'];
                echo '<input type="text" class="form-control my-1" name="gender"  placeholder="Enter gender..." value="'.$gender.'" >';
              }

              if (!isset($_GET['birthdate'])){     
                echo '<div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Birth date:</div>
                </div>
                    <input type="date"  class="form-control my-1" name="birthdate"  placeholder="Enter birthdate..."  >
                </div>';
              }else{
                $birthdate = $_GET['birthdate'];
                echo '
                <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                <div class="input-group-text">Birth date:</div>
                </div>
                
                    <input type="date" class="form-control my-1" name="birthdate"  placeholder="Enter birthdate..." value="'.$birthdate.'">
                </div>';
              }
              ?>
            <select name="school" id="" class="form-control">
                  <option>--Select school--</option>
                <?php  
                     $schresult = $conn->query('SELECT * FROM school_tbl')  or die($conn->error);
                      while($schrow = $schresult->fetch_assoc()):
                           $sch_id= $schrow['school_id'];
                            $sch_name = $schrow['school_name'];
                  ?>
                            <option value="<?php echo $sch_id ?>"><?php echo $sch_name; ?>
                            <?php endwhile ?> 
                          </option>
                </select>

             
             <input type="password" class="form-control my-1" name="pwd" placeholder="Enter your Password...">
              <input type="password" class="form-control my-1" name="pwd-repeat" placeholder="Re-type Password">
              <button type="submit" class="btn btn-primary btn-block" name="signup-submit"> Submit</button>
              <a href="usercsv.php" role="button" class="btn btn-success btn-block" name="signup-submit"> Mass Upload</a>
            
            
            
        </fieldset>
        </form>
    </div>
    </div>
    <br>
    <?php

    include 'includes/footer.php';
?>


    
