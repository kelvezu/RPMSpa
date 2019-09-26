
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';


    if(isset($_GET['delete'])){
        $school_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM school_tbl WHERE school_id=$school_id");
        $record = mysqli_fetch_array($query);
        $school_name = $record['school_name'];
        
    }  
?>

<main>
<div class="container text-center">
<div class="breadcome-list map-mg-t-40-gl shadow-reset">
   
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete School Confirmation</div>
        <input type="hidden" name="school_id" value="<?php echo $school_id; ?>"/>
        <p class="h5">Do you want to delete <b><?php echo $school_name; ?></b> from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processschool.php?delete=<?php echo $school_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../school.php" class="btn btn-primary btn-block">Cancel</a>
            </div>
        </div>
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
