<?php
  include 'includes/conn.inc.php';
  include 'includes/header.php';
 

  $kra_num = 0;   
    $tobj_num = 1;
    $conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));
    //QUERY FOR KRA TABLE  
    $result = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error); 
?>

<div class="container">
    <div class="breadcome-list shadow-reset">
<form action="includes/processESATsurvey.php" method="POST">
<input type="hidden" name="sy" value=<?php echo $_SESSION['sy_id'];?>>
<input type="hidden" name="school_id" value=<?php echo $_SESSION['school_id'];?>>
<strong> <h3> Self Assessment Tool Form / Part II / Master Teacher / Objectives </h3> </strong>
  

 



  <div class="table">
  <table class="table table-borderless table-hover table-responsive-sm table-sm ">
    
   <!-- Start loop for  KRA -->
    <?php
        //FETCH THE FIELDS FROM THE DB  
        while($row = $result->fetch_assoc()):
            $kra_id = $row['kra_id'];
            $kra_name = $row['kra_name'];
            $kra_num++;
           
            ?>
          <thead class="thead-dark text-nowrap">
            <!-- ASSIGN THE VALUE FROM THE DB  -->
            <th class="bg-info"><?php echo "KRA ".$kra_num.": ". $row['kra_name'] ?></th>
            <th class="bg-info">Level of Capability</th>
            <th class="bg-info">Priority for Development</th>
            </tr>   
        </thead>
        
        
            <tbody class="text-dark">
            <tr>
            <!-- START OF LOOP FROM OBJECTIVE -->
            <?php
                //QUERY FOR INDICATORS TABLE 
                    $indresult = $conn->query("SELECT * FROM mtobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
                //FETCH THE DATA FROM INDICATOR TABLE
                
                    while($rows = $indresult->fetch_assoc()):            
            ?>
                <td>
                        
                <?php
                //ASSIGN THE VALUE FROM THE DB
                  
                    echo '<strong>'.$tobj_num++.".</strong> ".$tobj_name = $rows['mtobj_name'];
                    
                ?>
                <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id'];?>">
                <input type="hidden" name="kra_id[]" value="<?php echo $row['kra_id']?>">
                <input type="hidden" name="mtobj_id[]" value="<?php echo $rows['mtobj_id']?>">
                </td>
                <td>
                  <select name="lvlcap[]" id="" class="form-control bg-primary text-white font-weight-bold">
                    <option value="">--Select--</option>
                    <option value="4">Very High</option>
                    <option value="3">High</option>
                    <option value="2">Moderate</option>
                    <option value="1">Low</option>
                  </select>
                </td>
                
                <td>
                  <select name="priodev[]" id="" class="form-control bg-danger text-white font-weight-bold">
                    <option value="">--Select--</option>
                    <option value="4">Very High</option>
                    <option value="3">High</option>
                    <option value="2">Moderate</option>
                    <option value="1">Low</option>
                  </select>
                </td>
            </tr>
            <!-- END LOOP FOR THE CBC INDICATORS -->
            <?php      
            endwhile
             ?>
            </tbody>
        <!-- END LOOP FOR THE KRA -->
        <?php 
        $tobj_num=1;
        endwhile
           ?>
        
    </table>
    <div class="card-footer text-muted ">
   <button  type="submit" class="btn btn-success btn-block my-2" name="submitESAT2mt">Submit</button>
    <button type="submit" class="btn btn-danger btn-block my-2" name="cancel">Cancel</button>
  </div>

  </div>
  </form>
  </div>
</div>
  </div>
<br>
<?php
   
    include 'includes/footer.php';
?>
