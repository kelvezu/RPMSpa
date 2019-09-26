
<?php

include '../includes/conn.inc.php';
   include '../includes/header.php';

    if(isset($_GET['delete'])){
        $subject_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM subject_tbl WHERE subject_id=$subject_id");
        $record = mysqli_fetch_array($query);
        $subject_name = $record['subject_name'];
        
    }

     

  
?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Subject Confirmation</div>
        <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>"/>
        <p class="h5">Do you want to delete <b><?php echo $subject_name; ?></b> from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processESAT.php?deleteSJ=<?php echo $subject_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../ESAT.php" class="btn btn-primary btn-block">Cancel</a>
            </div>
        </div>
    </div>
        </div>

    </div>
    </div>

    <br>
 
</main>

<?php

    include '../includes/footer.php';
?>

