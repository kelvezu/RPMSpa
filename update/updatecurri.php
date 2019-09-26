<?php
      include '../includes/conn.inc.php';
      include '../includes/header.php';

   
    if(isset($_GET['edit'])){
        $curriclass_id = $_GET['edit'];
        
        $query = mysqli_query($conn,"SELECT * FROM curriclass_tbl WHERE curriclass_id=$curriclass_id");
        $record = mysqli_fetch_array($query);
        $curriclass_name = $record['curriclass_name'];  
    }
    ?>   
    <div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
   
    <div class="h4 breadcrumb bg-dark text-white ">Update Curricular Classification Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="curriclass_id" value="<?php echo $curriclass_id; ?>"/>
        
            <div class="form-group ">
                <label for="curriclass">Curricular Classification Option</label>
                <input type="text" class="form-control" id="curriclass_id" name="curriclass_name" value="<?php echo $curriclass_name;  ?>" />
            </div>
        
        <div class="form-row">
            <button type="submit" name="updateCC" class="btn btn-primary btn-block">Update</button>
            <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
        </div>
        </div>
        </div>
        <br>
        </form>


        <?php

    include '../includes/footer.php';
?>



      