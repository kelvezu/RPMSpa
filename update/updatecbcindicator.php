<?php
include '../includes/conn.inc.php';
include '../includes/header.php';


    //DATABASE
     $conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));

     //GETTING THE DATA FROM THE LAST PAGE 
    if(isset($_GET['edit'])){
        $cbc_ind_id = $_GET['edit'];
        
        $result = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_ind_id=$cbc_ind_id");
        $row = $result->fetch_assoc();
        $cbc_ind_id = $row['cbc_ind_id'];
        $cbc_id = $row['cbc_id'];
        $indicator = $row['indicator'];    
    };

    
?> 



<main>
<div class="container">
    <div class="breadcome-list map-mg-t-40-gl shadow-reset">
        <form action="../includes/processcbc.php" class="form-group sm" method="POST">
        <input type="hidden" name="cbc_ind_id" value="<?php echo $cbc_ind_id; ?>"/>
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update Core Behavioral Indicator</strong></legend>
                    <div>
                       
                        <div class="form-group-sm">
                        <input type="hidden" name="cbc_ind_id" id="new-id" value="<?php echo $cbc_ind_id  ?>">
                        
                          <label for="cbc">Core Behavioral Competencies</label>
                          <?php
                          //QUERY FOR RETAINING THE LAST ID 
                           $cbcresult = $conn->query("SELECT * FROM core_behavioral_tbl WHERE cbc_id=$cbc_id"); 
                           while($rows = $cbcresult->fetch_assoc()):
                            $cbc_name=$rows['cbc_name'];
                           ?>
                          <select class="form-control" name="cbc_id" id="new-cbc_id">
                            <option value="<?php echo $cbc_id;?>" selected><?php echo $cbc_name; ?></option>
                            <?php 
                            //SET THE QUERY TO DISPLAY ALL POSSIBLE OPTIONS FOR CORE BEHAVIORAL COMPETENCIES 
                            $cbc = $conn->query("SELECT * FROM core_behavioral_tbl"); 
                            while($rowcbc = $cbc->fetch_assoc()):
                                $id = $rowcbc['cbc_id'];
                                $name = $rowcbc['cbc_name'];
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            
                            <?php 
                                //END OF QUERY FOR DISPLAY ALL OPTIONS 
                                endwhile
                             ?>
                            
                            <?php
                                //END OF QUERY RETAINING 
                                endwhile 
                            ?>
                            
                          </select>
                        </div>
                    </div>
                    <div>
                        <label for="indicator" class="control-label "><strong>Indicator</strong></label>
                        <textarea name="indicator" id="new-indicator" cols="30" rows="5" class="form-control"><?php echo $indicator; ?></textarea>
                    </div>
                    <div class="row m-1">
                        <button type="submit" class="btn btn-secondary  my-4" name="updateIND">Update</button>&nbsp
                        <a  class="btn btn-danger my-4" href="../displaycbc.php" role="button">Cancel</a>
                    </div>   

        </form>
        </div>

     </div>
     </div>
        <br>

 
</main>

<?php
   
        include '../includes/footer.php';
    ?>
