   
    <?php
    
    
include '../includes/conn.inc.php';
include '../includes/header.php';


    if(isset($_GET['edit'])){
        $age_id = $_GET['edit'];
        
        $query = mysqli_query($conn,"SELECT * FROM age_tbl WHERE age_id=$age_id");
        $record = mysqli_fetch_array($query);
        $age_name = $record['age_name'];  
    }
    ?>   
   <div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
    <div class="h4 breadcrumb bg-dark text-white ">Update Age Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="age_id" value="<?php echo $age_id; ?>"/>
        
            <div class="form-group ">
                <label for="username">Age Option</label>
                <input type="text" class="form-control" id="contact" name="age_name" value="<?php echo $age_name;  ?>" />
            </div>
        
            <div class="form-row">
            <button type="submit" name="updateage" class="btn btn-primary btn-block">Update</button>
            <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
        </div>
        </div>
        </div>

        <br>
        </form>

        <?php
   
    include '../includes/footer.php';
?>
