<?php

include 'sampleheader.php';
 
?>

<div class="container">
   
    <div class="d-flex">
        <div class="p-2 w-100">
            <!-- School Year Dropdown -->
            <label for="sy"><strong>School Year:</strong></label>
            <?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die ($conn->error); ?>
            <select id="sy_id" class="form-control" >
            <option value="" disabled selected>--Select School Year--</option>
                <?php while($syrow = $schoolyr->fetch_assoc()): ?>
                <option value="<?php echo $syrow['sy_id'];?>"><?php echo $syrow['sy_desc'];?></option>
                <?php endwhile; ?>
            </select>
        </div>
            <!-- End of School Year Dropdown -->
        <div class="p-2 w-100">
            <!-- School Dropdown -->
            <label for="sy"><strong>School:</strong></label>
            <?php $schoolqry = $conn->query("SELECT * FROM school_tbl")or die ($conn->error);?>
            <select id="sch_id" class="form-control">
            <option value="" disabled selected>--Select School--</option>
                <?php while($schoolrow = $schoolqry->fetch_assoc()):?>
                <option value="<?php echo $schoolrow['school_id'];?>"><?php echo $schoolrow['school_name'];?></option>
                <?php endwhile; ?>
            </select>       
           <!-- End of School Dropdown -->
          
        </div>
        <div class="p-2 flex-shrink-0">
        <label for="submit"><strong>Submit</strong></label>
            <button name="showchart" onclick="showchart()" class="btn btn-success">View</button>
        </div>
      
       
    </div>
  
<br>
                <div id="show">

                </div>
      
<!-- End tag of container -->
  </div>

<script>
  
  
    function showchart() {
        let sy_id = document.getElementById('sy_id').value;
        let sch_id = document.getElementById('sch_id').value;
        
        if ((sy_id == "") && (sch_id  == "")) {
            document.getElementById("show").innerHTML = "";
            return;
        } else {            
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            // getuser.php is seprate php file. q is parameter 
            xmlhttp.open("GET", "ajaxesatchartT.php?sy=" + sy_id + "&sch=" + sch_id, true);
            xmlhttp.send();
        }
    }
</script>















<?php

include 'samplefooter.php';

?>