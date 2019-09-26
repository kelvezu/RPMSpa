
<?php
include '../includes/conn.inc.php';
  include '../includes/header.php'; 


  

    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM account_tbl WHERE user_id=$user_id");
        $record = mysqli_fetch_array($query);
        $surname = $record['surname'];
        $firstname = $record['firstname'];
        $middlename = $record['middlename'];
        $email = $record['email'];
        $contact = $record['contact'];
        $username = $record['username'];
         $fullname = $firstname.' '.substr($middlename,0,1).'. '.$surname;
    }

    

  
?>
<main>

<div class="breadcome-list shadow-reset">
    <div class="container ">
   
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Account Confirmation</div>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
            <p class="h5 text-center">Do you want to delete <b><?php echo $fullname; ?></b> from the database?</p>
                <div class="row my-4">
                 <div class="col-md-6">
                     <a href="../includes/processusers.php?delete=<?php echo $user_id;?>" class="btn btn-danger btn-block">Delete</a>
                 </div>
                    <div class="col-md-6">
                        <a href="../displayusers.php" class="btn btn-primary btn-block">Cancel</a>
                    </div>
                  </div>
        </div>
    </div>
    </div>
    
</main>

    
 
<br>
<?php

    include '../includes/footer.php';
    ?>
<script src="includes/scripts.js"></script>


