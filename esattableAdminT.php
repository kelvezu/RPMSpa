<?php

include 'sampleheader.php';
 
?>



<!-- Admin View -->

<div class="container col-md-9">
   
    <div class="bg-dark h4 text-white breadcrumb">General ESAT Teacher Result</div>
    <div class="px-3">
       
    
        <form action="esatchartAdminT.php" method="POST" class="form-inline"> 

        <input type="hidden" id="active_sy" name="active_sy" value="<?php echo $_SESSION['active_sy_id']; ?>"> 

            <div class="form-row">
                <div class="form-group mb-2">
                    <!-- School Year Dropdown -->            
                    <label for="sy"><strong>School Year:</strong></label>&nbsp;&nbsp;
                    <?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die ($conn->error); ?>
                    <select id="sy_id" name="sy_id" class="form-control" >
                    <option value="" disabled selected>--Select School Year--</option>
                        <?php while($syrow = $schoolyr->fetch_assoc()): ?>
                        <option value="<?php echo $syrow['sy_id'];?>"><?php echo $syrow['sy_desc'];?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;
                </div>
                    <!-- End of School Year Dropdown -->
                <div class="form-group mb-2">
                    <!-- School Dropdown -->
                    <label for="sy"><strong>School:</strong></label>&nbsp;&nbsp;
                    <?php $schoolqry = $conn->query("SELECT * FROM school_tbl")or die ($conn->error);?>
                    <select id="sch_id" name="sch_id" class="form-control">
                    <option value="" disabled selected>--Select School--</option>
                        <?php while($schoolrow = $schoolqry->fetch_assoc()):?>
                        <option value="<?php echo $schoolrow['school_id'];?>"><?php echo $schoolrow['school_name'];?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;       
                <!-- End of School Dropdown -->
                </div>
                <div class="form-group mb-2">
                    <a onclick="showchart()" class="btn btn-success text-white">View</a>&nbsp;&nbsp;
                    <button type="submit" name="view" class="btn btn-success">View Data in Charts</button>
                </div>
            </div>
        </form>
<br>
                <div id="show">

                </div>
      
<!-- End tag of container -->
  </div>
  </div>
<script>
  showchart()
  
    function showchart() {
        let sy_id = document.getElementById('sy_id').value;
        let sch_id = document.getElementById('sch_id').value;
        let active_sy_id = document.getElementById('active_sy').value;
        
        if ((sy_id == "") && (sch_id  == "")) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "esatajaxtableAdminGeneralT.php?activesy=" + active_sy_id  , true);
            xmlhttp.send();


        } else {            
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            // getuser.php is seprate php file. q is parameter 
            xmlhttp.open("GET", "esatajaxtableAdminT.php?sy=" + sy_id + "&sch=" + sch_id, true);
            xmlhttp.send();
        }
    }
</script>


<!-- End of Admin View -->






<?php

include 'samplefooter.php';

?>
