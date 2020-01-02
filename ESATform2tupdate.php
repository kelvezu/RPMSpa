<?php
include_once 'sampleheader.php';


$user_id = $_SESSION['user_id'];
$school = $_SESSION['school_id'];
$sy_id = $_SESSION['active_sy_id'];

$kra_num = 0;
$tobj_num = 1;
$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
//QUERY FOR KRA TABLE  
$result = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error);


?>

<div class="container">

  <div class="card">
    <div class="card-header h4 bg-dark text-white text-center">
      Self Assessment Tool Form / Part II / Teacher / Objectives
      
    </div>
    <h8><font color="red"><strong>Legend:</strong></font>
    <strong><font color="green">Very High</strong> - 4
    <strong><font color="green">High</strong> - 3
    <strong><font color="green">Moderate</strong> - 2
    <strong><font color="green">Low</strong> - 1
    </h8>
    <div class="card-body">


      <form action=" includes/processESATsurvey.php" method="POST">
        <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>">
        <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>">
        <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />
        <input type="hidden" name="status" value="Active">

    
        <?php
            $obj_Qry = $conn->query("SELECT * FROM esat2_objectivest_tbl WHERE sy = '$sy_id' AND `user_id` = '$user_id' AND school = '$school' ");
            foreach ($obj_Qry as $esat):
        ?>
      <table>
            <thead class="thead-dark text-nowrap">
                <tr>
                    <th><?php echo $esat['kra_id']; ?></th>
                    <th>Level of Capability</th>
                    <th>Priority for Development</th>
                </tr>
            </thead>
       

        </table>
   

        <?php endforeach;?>

      <div class="card-footer text-muted ">
         <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-success" name="submitESAT2t">Submit</button>
        <a href="" role="button" class="btn btn-danger">Cancel</a>
      </div>
    </div>
  </div>
  </form>

</div>


<br>
<?php

include_once 'includes/scripts.php';
include_once 'samplefooter.php';
?>