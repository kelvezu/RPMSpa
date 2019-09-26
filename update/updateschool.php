<?php 
 include '../includes/header.php';
include '../includes/conn.inc.php';
  
 
    //DATABASE 
     $conn = new mysqli('localhost','root','','rpms') or die(mysqli_error($conn));

     //GETTING THE DATA FROM THE LAST PAGE 
        if(isset($_GET['edit'])){
            $school_id = $_GET['edit'];
            
            $query = mysqli_query($conn,"SELECT region_tbl.region_name,division_tbl.divi_name,municipality_tbl.muni_name,school_tbl.* FROM (((school_tbl INNER JOIN region_tbl ON school_tbl.reg_id = region_tbl.reg_id) INNER JOIN division_tbl ON school_tbl.div_id = division_tbl.div_id) INNER JOIN municipality_tbl ON school_tbl.muni_id = municipality_tbl.muni_id)");
            $record = mysqli_fetch_array($query);
            $school_id = $record['school_id'];
            $school_no = $record['school_no'];
            $school_name = $record['school_name'];
            $tel_no = $record['tel_no'];
            $reg_id = $record['region_name'];
            $div_id = $record['divi_name'];
            $muni_id = $record['muni_name'];
            $region_name = $record['region_name'];
            $divi_name = $record['divi_name'];
            $muni_name = $record['muni_name'];
        }
        
?>




<div class="container">
<div class="breadcome-list shadow-reset">

        <form action="../includes/processschool.php" class="form-group sm" method="POST">
        <input type="hidden" name="school_id" value="<?php echo $school_id; ?>"/>
                <legend class="legend-control breadcrumb bg-dark text-white "><strong>Update School</strong></legend>
                    <div>
                        <div class="form-group-sm">
                            <input type="hidden" name="school_id" id="school_id" value="<?php echo $school_id  ?>">

                            <div class="form-group row">   
                            <div class="col-lg">
                                <label for="school-no" class="col-form-label"><strong>School Number</strong></label>
                                <input type="number" name ="school_no" id ="school-no" class="form-control" value = "<?php echo $school_no; ?>" placeholder="Enter the School No...">
                            </div>
                            </div>
                            <div class="form-group row">   
                            <div class="col-lg">
                                <label for="school-name" class="col-form-label"><strong>School Name</strong></label>
                                <input type="text" name ="school_name" id="school-name" class="form-control" value = "<?php echo $school_name; ?>" placeholder="Enter the School Name...">
                            </div>
                            </div>
                            <div class="form-group row">   
                            <div class="col-lg">
                                <label for="tel-no" class="col-form-label"><strong>Telephone Number</strong></label>
                                <input type="number" name ="tel_no" id ="tel-no" class="form-control" value = "<?php echo $tel_no; ?>" placeholder="Enter the Telephone Number...">
                            </div>
                            </div>

                            <label for="reg">Select Region</label>
                            <?php
                                
                                $query = $conn->query("SELECT * FROM region_tbl");
                                $rowCount = $query->num_rows;
                                ?>
                                <select name="region" id="region" class ="form-control">
                                    <option value="<?php echo $reg_id; ?>"><?php echo $region_name; ?></option>
                                    <?php
                                    if($rowCount > 0){
                                        while($row = $query->fetch_assoc()){ 
                                            echo '<option value="'.$row['reg_id'].'">'.$row['region_name'].'</option>';
                                        }
                                    }else{
                                        echo '<option value="">Region not available</option>';
                                    }
                                    ?>

                                </select>
                                <label for="sel-reg" class=" col-form-label"><strong>Select Division</strong></label>
                                <select name="division" id="division" class ="form-control">
                                    <option value="<?php echo $div_id; ?>"><?php echo $divi_name; ?></option>
                                </select>

                                <label for="sel-reg" class=" col-form-label"><strong>Select Municipality</strong></label>
                                <select name="municipality" id="municipality" class ="form-control">
                                    <option value="<?php echo $muni_id; ?>"><?php echo $muni_name; ?></option>
                                </select>

                 
                            <div class="m-2">
                                <button type="submit" class="btn btn-secondary  my-4" name="update">Update</button>&nbsp
                                <a  class="btn btn-danger my-4" href="../school.php" role="button">Cancel</a>
                            </div>
                        </div>
                 </form>     
            </div>
        </div>
    </div>
<br>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
    <script src="jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $('#region').on('change',function(){
        var regionID = $(this).val();
        if(regionID){
            $.ajax({
                type:'POST',
                url:'ajaxschool.php',
                data:'reg_id='+regionID,
                success:function(html){
                    $('#division').html(html);
                    $('#municipality').html('<option value="">Select Division first</option>'); 
                }
            }); 
        }else{
            $('#division').html('<option value="">Select region first</option>');
            $('#municipality').html('<option value="">Select division first</option>'); 
        }
    });
    
    $('#division').on('change',function(){
        var divisionID = $(this).val();
        if(divisionID){
            $.ajax({
                type:'POST',
                url:'ajaxschool.php',
                data:'div_id='+divisionID,
                success:function(html){
                    $('#municipality').html(html);
                }
            }); 
        }else{
            $('#municipality').html('<option value="">Select division first</option>'); 
        }
    });
});
</script>

<footer>
<?php
    include '../includes/footer.php';
?>
</footer>