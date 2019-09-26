<?php
    include '../includes/conn.inc.php';
    include '../includes/header.php';
  
    if(isset($_GET['edit'])){
        $gradelvltaught_id = $_GET['edit'];
        
        $query = mysqli_query($conn,"SELECT * FROM gradelvltaught_tbl WHERE gradelvltaught_id=$gradelvltaught_id");
        $record = mysqli_fetch_array($query);
        $gradelvltaught_name = $record['gradelvltaught_name'];  
    } 
    ?>  
     <div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
   
    <div class="h4 breadcrumb bg-dark text-white ">Update Grade Level Taught Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="gradelvltaught_id" value="<?php echo $gradelvltaught_id; ?>"/>
        
            <div class="form-group ">
                <label for="gradelvltaught">Grade Level Option</label>
                <input type="text" class="form-control" id="gradelvltaught" name="gradelvltaught_name" value="<?php echo $gradelvltaught_name;  ?>" />
            </div>
        
        <div class="form-row">
           <button type="submit" name="updateGLT" class="btn btn-primary btn-block">Update</button>
           <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
        </div>
        </div>
        </div>
        <br>
        </form>
        <?php
    include '../includes/scripts.php';
    include '../includes/footer.php';
?>
