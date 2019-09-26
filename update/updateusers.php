
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';

    if(isset($_GET['edit'])){
        $user_id = $_GET['edit'];
        
        $query = mysqli_query($conn,"SELECT * FROM account_tbl WHERE user_id=$user_id");
        $record = mysqli_fetch_array($query);
        $surname = $record['surname'];
        $firstname = $record['firstname'];
        $middlename = $record['middlename'];
        $position = $record['position'];
        $email = $record['email'];
        $contact = $record['contact'];
        $username = $record['username'];
        
    }
?>

<main>
<div class="breadcome-list shadow-reset">
    <div class="container">
        <div>
       
        <div class="h4 breadcrumb bg-dark text-white ">Update Account Information</div>
            <form method="post" action="../includes/processusers.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
            
            <div class="form-row">
                    <div class="form-group col-md-4 ">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $surname; ?>">
                    </div>
                    <div class="form-group col-md-4 form-control-sm">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>" >
                    </div>
                    <div class="form-group col-md-4 form-control-sm">
                        <label for="middlename">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $middlename; ?>" >

                    </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
                </div>
                <div class="form-group col-md-4">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" />
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">  
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="contact" name="username"value="<?php echo $username; ?>" />
                    </div>
                <div class="form-group col-md-4">
                    
                     <label for="position">Position</label>
                    <select name="position" class="form-control" contenteditable>
                        <option value="<?php echo $position; ?>"><?php  echo $position; ?></option>
                        <?php  
                        $result = $conn->query('SELECT * FROM position_tbl')  or die($conn->error);
                        while($row = $result->fetch_assoc()):
                           echo  $position = $row['position_name'];
                         ?>
                         <option value="<?php echo $position ?>"><?php echo $position ?></option>
                            <?php endwhile ?>
                        
                       
                    </select>
                </div> 
               


            
            <div class="form-row">
            <div class="form-group col-md-6"><button type="submit" name="update" class="btn btn-primary btn-block">Update</button></div>
            <div class="form-group col-md-6"><a href="../displayusers.php" class="btn btn-danger btn-block">Cancel</a></div>
            </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    </div>
   

<br>
<?php
      
        include '../includes/footer.php';
    ?>

