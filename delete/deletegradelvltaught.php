
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';

    if(isset($_GET['delete'])){
        $gradelvltaught_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM gradelvltaught_tbl WHERE gradelvltaught_id=$gradelvltaught_id");
        $record = mysqli_fetch_array($query);
        $gradelvltaught_name = $record['gradelvltaught_name'];
        
    }

    

  
?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Grade Level Taught Confirmation</div>
        <input type="hidden" name="gradelvltaught_id" value="<?php echo $gradelvltaught_id; ?>"/>
        <p class="h5">Do you want to delete <b><?php echo $gradelvltaught_name; ?></b> from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processESAT.php?deleteGLT=<?php echo $gradelvltaught_id;?>" class="btn btn-danger btn-block">Delete</a>
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

