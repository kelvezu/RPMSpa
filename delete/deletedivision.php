
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';
  
    if(isset($_GET['delete'])){
        $div_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM division_tbl WHERE div_id=$div_id");
        $record = mysqli_fetch_array($query);
        $divi_name = $record['divi_name'];
        
    }

    

  
?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Division Confirmation</div>
        <input type="hidden" name="div_id" value="<?php echo $div_id; ?>"/>
        <p class="h5">Do you want to delete <b><?php echo $divi_name; ?></b> from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processESAT.php?deleteDIV=<?php echo $div_id;?>" class="btn btn-danger btn-block">Delete</a>
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



