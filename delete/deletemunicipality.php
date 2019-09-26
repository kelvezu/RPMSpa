
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';
 
    if(isset($_GET['delete'])){
        $muni_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM municipality_tbl WHERE muni_id=$muni_id");
        $record = mysqli_fetch_array($query);
        $muni_name = $record['muni_name'];
        
    }

    

  
?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Municipality Confirmation</div>
        <input type="hidden" name="muni_id" value="<?php echo $muni_id; ?>"/>
        <p class="h5">Do you want to delete <b><?php echo $muni_name; ?></b> from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processESAT.php?deleteMUNI=<?php echo $muni_id;?>" class="btn btn-danger btn-block">Delete</a>
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


