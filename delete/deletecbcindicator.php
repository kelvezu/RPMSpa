
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';
  
   
    if(isset($_GET['delete'])){
        $cbc_ind_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM cbc_indicators_tbl WHERE cbc_ind_id=$cbc_ind_id");
        $record = mysqli_fetch_array($query);
        
       
    }

    

  
?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Indicator Confirmation</div>
        <input type="hidden" name="cbc_ind_id" value="<?php echo $cbc_ind_id; ?>"/>
        <p class="h5">Do you want to delete this indicator from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processcbc.php?delete=<?php echo $cbc_ind_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../displaycbc.php" class="btn btn-primary btn-block">Cancel</a>
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


