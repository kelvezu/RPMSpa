

<?php
include_once 'sampleheader.php';

$user_id = $_SESSION['user_id'];
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

        <strong>
          <h3></h3>
        </strong>
    </div>

    <div class="table">
      <table class="table table-borderless table-hover table-responsive-sm table-sm ">

       
        <?php
      
        while ($row = $result->fetch_assoc()) :
          $kra_id = $row['kra_id'];
          $kra_name = $row['kra_name'];
          $kra_num++;
          ?>
          <thead class="thead-dark text-nowrap">
        
            <th class="bg-dark"><?php echo "KRA " . $kra_num . ": " . $row['kra_name'] ?></th>
            <th class="bg-dark">Level of Capability</th>
            <th class="bg-dark">Priority for Development</th>
            </tr>
          </thead>
          <tbody class="text-dark">
            <tr>

              <?php
                
                $indresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
         

                while ($rows = $indresult->fetch_assoc()) :
                    $tobj_id = $rows['tobj_id'];
                  ?>
                <td>
                  <?php
                     
                      echo '<strong>' . $tobj_num++ . ".</strong> " . $tobj_name = $rows['tobj_name'];
                      ?>
                  <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id']; ?>">
                  <input type="hidden" name="kra_id[]" value="<?php echo $row['kra_id'] ?>">
                  <input type="hidden" name="tobj_id[]" value="<?php echo $rows['tobj_id'] ?>">

                </td>
                <?php
                $objective_Query = $conn->query("SELECT * FROM esat2_objectivest_tbl WHERE kra_id = '$kra_id' AND tobj_id = '$tobj_id' AND `user_id` = '$user_id' ");
                        while($res = $objective_Query->fetch_assoc()):
                            $lvlcap = $res['lvlcap'];
                            $priodev = $res['priodev'];
                            $esat2_id = $res['esat2_id'];
                    
                    if($lvlcap == 4):
                        $lvlcap_desc = "Very High";
                    elseif($lvlcap == 3):
                        $lvlcap_desc = "High";
                    elseif($lvlcap == 2):
                        $lvlcap_desc = "Moderate";
                    elseif($lvlcap == 1):
                        $lvlcap_desc = "Low";
                    endif;

                    if($priodev == 4):
                        $priodev_desc = "Very High";
                    elseif($priodev == 3):
                        $priodev_desc = "High";
                    elseif($priodev == 2):
                        $priodev_desc = "Moderate";
                    elseif($priodev == 1):
                        $priodev_desc = "Low";
                    endif;

                ?>

                <input type="hidden" name="esat2_id[]" value="<?php echo $esat2_id;?>">
                <td>
                  <select name="lvlcap[]" id="lvlcapp" onChange="change_cap()" class="form-control font-weight-bold" required>
                    <option value="<?php echo $lvlcap ?>"><?php echo $lvlcap_desc ?></option>
                    <option value=4>Very High</option>
                    <option value=3>High</option>
                    <option value=2>Moderate</option>
                    <option value=1>Low</option>
                  </select>
                </td>
                <td>
                  <div id="priodev">
                    <select name="priodev[]" class="form-control font-weight-bold" required>
                      <option value="<?php echo $priodev ?>"><?php echo $priodev_desc ?></option>
                      <option value=4>Very High</option>
                      <option value=3>High</option>
                      <option value=2>Moderate</option>
                      <option value=1>Low</option>
                    </select>
                  </div>

                </td>
            </tr>

            <?php
            endwhile
            ?>
            <!-- END LOOP FOR THE CBC INDICATORS -->
          <?php
            endwhile
            ?>
          </tbody>
          <!-- END LOOP FOR THE KRA -->
        <?php
          $tobj_num = 1;
        endwhile
        ?>

      </table>

      <div class="card-footer text-muted ">
         <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-success" name="updateESAT2t">Update</button>
      <a href="includes/processESATsurvey.php?cancel" class="btn btn-danger">Cancel All ESAT</a>
      </div>
    </div>
  </div>
  </form>

</div>


<?php if(isset($_GET['cancelAll'])):
    showModal('cancelEsat');
?>
<div id="cancelEsat" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="includes/processESATsurvey.php" method="post">
                <div class="tomato-color font-italic text-center"><h5>Are you sure you want to cancel? Please be advised that all data you already answered wil be deleted.</h5></div>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                    <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id'];?>">
                    <input type="hidden" name="school" value="<?php echo $_SESSION['school_id'];?>">
                    <input type="hidden" name="position" value="<?php echo $_SESSION['position'];?>">

                  <div class="modal-footer justify-content-center">
                        <div class="p-2"><button type="submit" name="deleteEsat" class="btn btn-success">Submit</button></div>
                        <div class="p-2"><a href="esatform3.php" class="btn btn-danger">Cancel</a></div>
                  </div>
                    </form>
                </div>  
            </div>
        </div>

<br>
<?php
endif;
include_once 'includes/scripts.php';
include_once 'samplefooter.php';
?>





