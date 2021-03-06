<?php
include_once 'sampleheader.php';
RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']) ;
FilterUser\FilterUser::filterEsatT($conn, $_SESSION['position']);


$kra_num = 0;
$tobj_num = 1;
// $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
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

        <!-- Start loop for  KRA -->
        <?php
        //FETCH THE FIELDS FROM THE DB  
        while ($row = $result->fetch_assoc()) :
          $kra_id = $row['kra_id'];
          $kra_name = $row['kra_name'];
          $kra_num++;
          ?>
          <thead class="thead-dark text-nowrap">
            <!-- ASSIGN THE VALUE FROM THE DB  -->
            <th class="bg-dark"><?php echo "KRA " . $kra_num . ": " . $row['kra_name'] ?></th>
            <th class="bg-dark">Level of Capability</th>
            <th class="bg-dark">Priority for Development</th>
            </tr>
          </thead>
          <tbody class="text-dark">
            <tr>
              <!-- START OF LOOP FROM OBJECTIVE -->
              <?php
                //QUERY FOR INDICATORS TABLE 
                $indresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
                //FETCH THE DATA FROM INDICATOR TABLE

                while ($rows = $indresult->fetch_assoc()) :
                  ?>
                <td>
                  <?php
                      //ASSIGN THE VALUE FROM THE DB
                      echo '<strong>' . $tobj_num++ . ".</strong> " . $tobj_name = $rows['tobj_name'];
                      ?>
                  <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id']; ?>">
                  <input type="hidden" name="kra_id[]" value="<?php echo $row['kra_id'] ?>">
                  <input type="hidden" name="tobj_id[]" value="<?php echo $rows['tobj_id'] ?>">

                </td>
                <td>

                  <select name="lvlcap[]" id="lvlcapp" onChange="change_cap()" class="form-control font-weight-bold" required>
                    <option value="">--Select--</option>
                    <option value=4>Very High</option>
                    <option value=3>High</option>
                    <option value=2>Moderate</option>
                    <option value=1>Low</option>
                  </select>
                </td> 
                <td>
                  <div id="priodev">
                    <select name="priodev[]" class="form-control font-weight-bold" required>
                      <option value="">--Select--</option>
                      <option value=4>Very High</option>
                      <option value=3>High</option>
                      <option value=2>Moderate</option>
                      <option value=1>Low</option>
                    </select>
                  </div>

                </td>
            </tr>

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

      <script type="text/javascript">
        // function change_cap() {
        //   var xmlhttp = new XMLHttpRequest();
        //   xmlhttp.open("GET", "ajaxesat2T.php?cap=" + document.getElementById("lvlcapp").value, false);
        //   document.getElementById("priodev").innerHTML = xmlhttp.responseText;
        //   xmlhttp.send();


        //  }
      </script>
      <div class="card-footer text-muted ">
         <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
        <button type="submit" class="btn btn-success" name="submitESAT2t">Submit</button>
        <a href="includes/processESATsurvey.php?cancel" class="btn btn-danger">Cancel</a>
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