
<?php
   include '../includes/conn.inc.php';
   include '../includes/header.php';

    if(isset($_GET['delete'])){
        $mtobj_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM mtobj_tbl WHERE mtobj_id=$mtobj_id");
        $record = mysqli_fetch_array($query);
        $mtobj_name = $record['mtobj_name'];
  
?>


<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Objective Confirmation</div>
        <input type="hidden" name="mtobj_id" value="<?php echo $mtobj_id; ?>"/>
        <p class="h5">Do you want to delete <b><u><?php echo $mtobj_name; ?></u></b> objective from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processmtkramov.php?delete=<?php echo $mtobj_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../displaymtkramov.php" class="btn btn-primary btn-block">Cancel</a>
            </div>
        </div>
    </div>
        </div>

    </div>
    </div>
    <br>
<?php 
}
?>

<?php

    if(isset($_GET['deletekra'])){
        $kra_id = $_GET['deletekra'];
        
        $query = mysqli_query($conn,"SELECT * FROM kra_tbl WHERE kra_id=$kra_id");
        $record = mysqli_fetch_array($query);
        $kra_name = $record['kra_name'];
        
       
        ?>

<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete KRA Confirmation</div>
        <input type="hidden" name="tobj_id" value="<?php echo $kra_id; ?>"/>
        <p class="h5">Do you want to delete <b><u><?php echo $kra_name; ?></u></b> KRA from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processmtkramov.php?deletekra=<?php echo $kra_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../displaymtkramov.php" class="btn btn-primary btn-block">Cancel</a>
            </div>
        </div>
    </div>
        </div>
        </div>
    </div>
    <br>
    <?php
 
}
?>





<?php
  
    include '../includes/footer.php';
?>
