
<?php 
include '../includes/conn.inc.php';
include '../includes/header.php';

    if(isset($_GET['edit'])){
        $indicator_id = $_GET['edit'];
        $query = mysqli_query($conn,"SELECT * FROM tindicator_tbl WHERE indicator_id=$indicator_id");
        $record = mysqli_fetch_array($query);
        $indicator_no = $record['indicator_no'];
        $indicator_name = $record['indicator_name'];
        
    }
    
?>


<main>
 
<div class="container ">
<div class="breadcome-list shadow-reset">
        <form action="../includes/processtindicator.php" class="form-group sm" method="POST">
        <input type="hidden" name="indicator_id" value="<?php echo $indicator_id; ?>"/>
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Indicator</strong></legend>
                    <div>

                        <div class="form-group-sm">
                        <label for="indicator-no" class="control-label"><strong>Indicator Number</strong></label>
                        <input type="number" name="newindicator_no" id="indicator-no" class="form-control" value = "<?php echo $indicator_no; ?>" width="500">
                        </div>
                    </div>
                    <div>
                        <label for="indicator-name" class="control-label w-25 "><strong>Indicator Name</strong></label>
                        <textarea name="newindicator_name" value="" id="indicator-name" cols="5" rows="5" class="form-control"><?php echo $indicator_name; ?></textarea>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary my-4" name="update">Update</button>&nbsp
                        <a  class="btn btn-danger my-4" href="../displaytindicator.php" role="button">Cancel</a>
                    </div>   

    
        </div>

     </div>
     </form>

</main>
<br>
<?php

    include '../includes/footer.php';
?>