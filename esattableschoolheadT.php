<?php

include 'sampleheader.php';
 
?>


<div class="container col-md-9">
   
    <div class="bg-dark h4 text-white breadcrumb">General ESAT Teacher Result</div>
    <div class="px-3">
       
    
        <form action="esatchartPrincipalT.php" method="POST" class="form-inline">

            <input type="hidden" id="position" name="position" value="<?php echo $_SESSION['position']; ?>"> 
            <input type="hidden" id="active_sy" name="active_sy" value="<?php echo $_SESSION['active_sy_id']; ?>"> 
            <input type="hidden" id="school_id" name="school_id" value="<?php echo $_SESSION['school_id'] ?>"> 

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
                    <!-- Teacher Dropdown -->
                    <label for="sy"><strong>Teacher:</strong></label>&nbsp;&nbsp;
                    <?php $teacherqry = $conn->query('SELECT * FROM account_tbl WHERE position IN ("Teacher III","Teacher II","Teacher I") AND `status` = "Active" AND rater = "'.$_SESSION['user_id'].'"')or die ($conn->error);?>
                    <select id="teacher_id" name="teacher_id" class="form-control">
                    <option value="" disabled selected>--Select Teacher--</option>
                        <?php while($teacherrow = $teacherqry->fetch_assoc()):?>
                        <option value="<?php echo $teacherrow['user_id'];?>"><?php echo $teacherrow['firstname'].' '. substr($teacherrow['middlename'], 0, 1).'. '. $teacherrow['surname'];?></option>
                        <?php endwhile; ?>
                    </select>&nbsp;&nbsp;       
                <!-- End of Teacher Dropdown -->
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


</div>
      
<!-- End tag of container -->
  </div>
  </div>
<script>
   
   showchart()
  
    function showchart() {
        let sy_id = document.getElementById('sy_id').value;
        let teacher_id = document.getElementById('teacher_id').value;
        let school_id = document.getElementById('school_id').value; 
        let active_sy_id = document.getElementById('active_sy').value;
        
        if ((sy_id == "" && teacher_id  == "")) {
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "esatajaxtablePrincipalGeneralT.php?sy=" + active_sy_id + "&sch=" + school_id , true);
            xmlhttp.send();
        } else {            
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("show").innerHTML = xmlhttp.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "esatajaxtablePrincipalT.php?sy=" + sy_id + "&user=" + teacher_id + "&sch=" + school_id, true);
            xmlhttp.send();
            return;
        }
    }


  

</script>


<?php

include 'samplefooter.php';

?>
