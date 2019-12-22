
<?php

include 'sampleheader.php';

if(isset($_POST['password_sub'])):
    $pass = $_POST['pass'];
    $school_id = $_POST['school_id'];
    $teacher_id = $_POST['user_id'];
    $obs = $_POST['obs'];

    $password = $conn->query("SELECT * FROM account_tbl WHERE position='Principal' AND school_id = $school_id") or die ($conn->error);
        while($row = $password->fetch_assoc()):
            $principalpass = $row['userpassword'];
  
    $pwdCheck = password_verify($pass, $principalpass);

    if($pwdCheck == false):
        header('displaytcotprogress.php?user_id='.$teacher_id.'&obs='.$obs);
    else: "No error";
    endif;

endwhile;
endif;



?>



<div class="modal fade" id="editcot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Classroom Observation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <center>
            <img src="img\deped.png" width="100" height="100" class="rounded-circle">
             <h5><strong>COT-RPMS for Teacher I-III</strong></h5>       
             <br>
            </center>
            <div>
            <table>
                <tr>
                    <th>Teacher Observed:</th>
                    <td><?php echo displayName($conn,$teacher_id); ?></td>
                </tr>
                <tr>
                    <th>School:</th>
                    <td><?php echo displaySchool($conn,$school_id); ?></td>
                </tr>
                <tr>
                    <th>Observation Period:</th>
                    <td><?php echo $obs; ?></td>
                </tr>
            </table>
            </div>
            <br>
              <div class="container">
            <table class=" text-center  table table-bordered">
                <thead class="bg-success text-white">
                   
                    <tr>
                        <th>Indicator ID</th>
                        <th>Indicator Name</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cotQry = $conn->query("SELECT * FROM cot_t_rating_a_tbl WHERE `user_id` = '$teacher_id' AND sy = '$sy_id' AND obs_period = '$obs' AND school_id = '$school_id'");
                    $num = 1;
                    while($cotresult = $cotQry->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $num++ . '.'; ?></td>
                            <td><?php echo displayTindicator($conn, $cotresult['indicator_id']); ?></td>
                            <td>
                                <select name="rating[]">
                                    <option value="<?php echo $cotresult['rating'];?>"><?php echo rawRate($cotresult['rating'],$position);?></option>
                                    <option value="1">3</option>
                                    <option value="2">4</option>
                                    <option value="3">5</option>
                                    <option value="4">6</option>
                                    <option value="5">7</option>
                                    <option value="1">NO*</option>
                                </select>
                            </td>
                        </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <?php
                $commentQry = $conn->query("SELECT * FROM cot_t_rating_b_tbl WHERE `user_id` = '$teacher_id' AND sy = '$sy_id' AND obs_period = '$obs' AND school_id = '$school_id'");
                while ($comment = $commentQry->fetch_assoc()):
            ?>
        
            <textarea name="comment" cols="15" rows="5" class="form-control"><?php echo $comment['comment'];?></textarea>
                <?php endwhile; ?>
        </div>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php

include 'samplefooter.php';

?>