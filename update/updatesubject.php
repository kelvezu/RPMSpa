    <?php
    include '../includes/conn.inc.php';
    include '../includes/header.php';
  

    if(isset($_GET['edit'])){
        $subject_id = $_GET['edit'];
        
        $query = mysqli_query($conn,"SELECT * FROM subject_tbl WHERE subject_id=$subject_id");
        $record = mysqli_fetch_array($query);
        $subject_name = $record['subject_name'];  
    }
    ?>  
   <div class="container ">
    <div class="breadcome-list  shadow-reset">

    <div class="h4 breadcrumb bg-dark text-white ">Update Subject Option</div>
        <form method="post" action="../includes/processESAT.php">
            <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>"/>
        
            <div class="form-group ">
                <label for="username">Subject Option</label>
                <input type="text" class="form-control" id="contact" name="subject_name" value="<?php echo $subject_name;  ?>" />
            </div>
         
            <div class="form-row">
                <button type="submit" name="updateSUB" class="btn btn-primary btn-block">Update</button>
                <a href="../ESAT.php" class="btn btn-danger btn-block">Cancel</a>
            </div>

        </div>
        </div>

        <br>
        </form>

        <?php

    include '../includes/footer.php';
?>