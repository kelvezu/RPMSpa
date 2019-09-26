
<?php 
include '../includes/conn.inc.php';
include '../includes/header.php';


    if(isset($_GET['edit'])){
        $mtindicator_id = $_GET['edit'];
        $query = mysqli_query($conn,"SELECT * FROM mtindicator_tbl WHERE mtindicator_id=$mtindicator_id");
        $record = mysqli_fetch_array($query);
        $mtindicator_no = $record['mtindicator_no'];
        $mtindicator_name = $record['mtindicator_name'];
        
    }
    
?>


<main>
 
<div class="container ">
<div class="breadcome-list shadow-reset">
        <form action="../includes/processmtindicator.php" class="form-group sm" method="POST">
        <input type="hidden" name="mtindicator_id" value="<?php echo $mtindicator_id; ?>"/>
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Indicator</strong></legend>
                    <div>

                        <div class="form-group-sm">
                        <label for="indicator-no" class="control-label"><strong>Indicator Number</strong></label>
                        <input type="number" name="newmtindicator_no" id="indicator-no" class="form-control" value = "<?php echo $mtindicator_no; ?>" width="500">
                        </div>
                    </div>
                    <div>
                        <label for="indicator-name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                        <textarea name="newmtindicator_name" value="" id="indicator-name" cols="5" rows="5" class="form-control"><?php echo $mtindicator_name; ?></textarea>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary my-4" name="update">Update</button>&nbsp
                        <a  class="btn btn-danger my-4" href="../displaymtindicator.php" role="button">Cancel</a>
                    </div>   

    
        </div>

     </div>
     </form>
<br>
</main>
<?php
   
    include '../includes/footer.php';
?>
