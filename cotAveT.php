<?php

include 'sampleheader.php';
 
?>

<div class="container">
   
    <div class="bg-dark h4 text-white breadcrumb"> Teacher COT Rating</div>
    <div class="px-3">
       
    
        <form action="" method="POST" class="form-inline">

            <input type="hidden" id="position" name="position" value="<?php echo $_SESSION['position']; ?>"> 
            <input type="hidden" id="school_id" name="school_id" value="<?php echo $_SESSION['school_id'] ?>">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
            <input type="hidden" id="rater_id" name="rater_id" value="<?php echo $_SESSION['rater'] ?>">

            <div class="form-row">
                <div class="form-group mb-2">
                    <!-- School Year Dropdown -->            
                    <label for="sy"><strong>School Year:</strong></label>&nbsp;&nbsp;
                    <?php $schoolyr = $conn->query("SELECT * FROM sy_tbl") or die ($conn->error); ?>
                    <select id="sy_id" name="sy_id"  class="form-control" required>
                    <option value="" disabled selected>--Select School Year--</option>
                        <?php while($syrow = $schoolyr->fetch_assoc()): ?>
                        <option value="<?php echo $syrow['sy_id'];?>"><?php echo $syrow['sy_desc'];?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;
                </div>
                
                    <a onClick="showAve()" class="btn btn-success text-white">View</a>&nbsp;&nbsp;
                
               
            </div>
        </form>
<br>
                <div id="show">

                </div>


</div>
      
<!-- End tag of container -->
  </div>
  </div>
<script>
   
    function showAve() {
        let sy_id = document.getElementById('sy_id').value;
        let school_id = document.getElementById('school_id').value;
        let teacher_id = document.getElementById('user_id').value;
        let rater = document.getElementById('rater_id').value;
        

        
        if ((sy_id == "")) {
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
            xmlhttp.open("GET", "cotAveTajax.php?sy=" + sy_id + "&user=" + teacher_id + "&sch=" + school_id + "&rater=" + rater, true);
            xmlhttp.send();
        }
    }
  

</script>


<?php

include 'samplefooter.php';

?>
