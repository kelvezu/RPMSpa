      
<?php 


include 'sampleheader.php';

if(isset($_GET['user_id'])):
    $teacher_id = $_GET['user_id'];
    $school_id = $_GET['school_id'];
    $obs = $_GET['obs'];
    $sy_id = $_SESSION['active_sy_id'];
    $position = 'Teacher I';
endif;


$cotobs = getCOTobserver($conn,$teacher_id,$sy_id,$school_id,$obs);
$cotobsB = getCOTobserverB($conn,$teacher_id,$sy_id,$school_id,$obs);

?>

<div class="container">

<div class="card">

<div class="card-header bg-dark text-white h5">
    Edit Classroom Observation Rating
</div>

<div class="card-body">

    <form action="includes/processcotformT.php" method="POST">
          <center>
            <img src="img\deped.png" width="100" height="100" class="rounded-circle">
             <h5><strong>COT-RPMS for Teacher I-III</strong></h5>       
             <br>
            </center>
            <table>
                <?php foreach ($cotobs as $cobs):?>
                    <input type="hidden" name="rater_id1" value="<?php echo $cobs['rater_id1'] ?>">
                    <input type="hidden" name="rater_id2" value="<?php echo $cobs['rater_id2'] ?>">
                    <input type="hidden" name="rater_id3" value="<?php echo $cobs['rater_id3'] ?>">
                    <input type="hidden" name="user_id" value="<?php echo $teacher_id ?>">
                    <input type="hidden" name="obs" value="<?php echo $obs ?>">
                    <input type="hidden" name="indicator_id[]" value="<?php echo $cobs['indicator_id'] ?>">
                    <input type="hidden" name="sy_id" value="<?php echo $sy_id ?>">
                    <input type="hidden" name="school_id" value="<?php echo $school_id ?>">

                <?php endforeach ?>
                     

                <?php foreach($cotobsB as $cobsB): ?>
                    <input type="hidden" name="subject" value="<?php echo $cobsB['subject_id'] ?>">
                    <input type="hidden" name="gradelvltaught" value="<?php echo $cobsB['gradelvltaught_id'] ?>">

                <?php endforeach ?>
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
     
            <br>
              
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
                    $commentresult = $comment['comment'];
            ?>
        
            <textarea name="comment" cols="15" rows="5" class="form-control"><?php echo $commentresult;?></textarea>
                <?php endwhile; ?>
        
      
    <br>
        <a href="displaytcotprogress.php?user_id=<?= $teacher_id?>&obs=<?=$obs?>" class="btn btn-outline-danger">Close</a>
       <input type="submit" name="edit" value="Edit" class="btn btn-outline-secondary">
</form>
</div>
</div>



</div>
     



<?php 

include 'samplefooter.php';


?>