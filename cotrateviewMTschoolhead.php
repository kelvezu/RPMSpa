<?php

include 'sampleheader.php';
 
?>


<div class="container">
   
    <div class="bg-dark h4 text-white breadcrumb">Master Teacher COT Rating</div>
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
                    <!-- End of School Year Dropdown -->
                <div class="form-group mb-2">
                    <!--Obs Period Dropdown -->            
                    <label for="obs"><strong>Observation Period:</strong></label>&nbsp;&nbsp;
                    <select id="obs_period" name="obs_period" class="form-control" required >
                    <option value="" disabled selected>--Select Obs Period--</option>
                        <option value="1">1st Period</option>
                        <option value="2">2nd Period</option>
                        <option value="3">3rd Period</option>
                        <option value="4">4th Period</option>
                    </select>&nbsp;&nbsp;
                </div>
                    <!-- Obs Period Dropdown -->
                <div class="form-group mb-2">
                <label for="sy"><strong>Master Teacher:</strong></label>&nbsp;&nbsp;
                 
                    <select id="teacher_id" name="teacher_id" class="form-control" required>
                    <option value="" disabled selected>Select Master Teacher</option>
                    <?php
                        $qry = $conn->query('SELECT * FROM account_tbl WHERE position IN ("Master Teacher IV","Master Teacher III","Master Teacher II","Master Teacher I") AND school_id = "'.$_SESSION['school_id'].'" AND rater = "'.$_SESSION['user_id'].'"');
                        while ($row = $qry->fetch_assoc()):
                    ?>
                            
                        <option value="<?= $row['user_id'] ?>"><?= displayName($conn,$row['user_id']) ?></option>

                       <?php endwhile; ?>
                       
                    </select>&nbsp;&nbsp;   
                    <a onclick="showRating()" class="btn btn-info text-white">View</a>&nbsp;&nbsp;
                
                </div>
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
   

  
    function showRating() {
        let sy_id = document.getElementById('sy_id').value;
        let user_id = document.getElementById('user_id').value;
        let school_id = document.getElementById('school_id').value;
        let obs_period = document.getElementById('obs_period').value;
        let teacher_id = document.getElementById('teacher_id').value;
        

        
        if ((sy_id == "" || teacher_id == "" || obs_period == "" )) {
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
            xmlhttp.open("GET", "cotrateviewMTprincipalajax.php?sy=" + sy_id + "&user=" + user_id + "&sch=" + school_id + "&obs=" + obs_period + "&teacher=" + teacher_id, true);
            xmlhttp.send();
        }
    }
  

</script>


<?php

include 'samplefooter.php';

?>
