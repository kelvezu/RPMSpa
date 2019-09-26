
<?php
  include '../includes/conn.inc.php';
  include '../includes/header.php';
 
    if(isset($_GET['delete'])){
        $perftindicator_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM perftindicator_tbl WHERE perftindicator_id=$perftindicator_id");
        $record = mysqli_fetch_array($query);
        $indicator_name = $record['indicator_name'];
        $qet = $record['qet'];

?>

<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset text-center">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Indicator Confirmation</div>
        <input type="hidden" name="perftindicator_id" value="<?php echo $perftindicator_id; ?>"/>
        <p class="h5">Do you want to delete <b><u><?php echo $indicator_name; ?></u></b> under <b><u><?php echo $qet; ?></u></b> indicator from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processperftindicator.php?delete=<?php echo $perftindicator_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../displayperftindicator.php" class="btn btn-primary btn-block">Cancel</a>
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

