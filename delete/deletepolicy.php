
<?php
      include '../includes/conn.inc.php';
      include '../includes/header.php';


    if(isset($_GET['delete'])){
        $policy_id = $_GET['delete'];
        
        $query = mysqli_query($conn,"SELECT * FROM policy_tbl WHERE policy_id=$policy_id");
        $record = mysqli_fetch_array($query);
        $policy_title = $record['policy_title'];
        $policy_content= $record['policy_content'];
?>

<main>
    <div class="container text-center">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
    <div class="card">
     <div class="card-body">
    <div class="h4 breadcrumb alert alert-danger text-center">Delete Policy Confirmation</div>
        <input type="hidden" name="policy_id" value="<?php echo $policy_id; ?>"/>
        <p class="h5">Do you want to delete <b><u><?php echo $policy_title; ?></u></b> policy from the database?</p>
        <div class="row my-4">
            <div class="col-md-6">
            <a href="../includes/processpolicy.php?delete=<?php echo $policy_id;?>" class="btn btn-danger btn-block">Delete</a>
            </div>
            <div class="col-md-6">
            <a href="../displaypolicy.php" class="btn btn-primary btn-block">Cancel</a>
            </div>
        </div>
    </div>
        </div>

    </div>
    </div>
<br>
<?php 
}
include '../includes/footer.php';
?>
