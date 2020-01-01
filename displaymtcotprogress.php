<?php

use RPMSdb\RPMSdb;

include 'classes/rpmsdb/rpmsdb.class.php';
include 'sampleheader.php';



$teacher_id = $_GET['user_id'];
$school_id = $_SESSION['school_id'];
$sy_id = $_SESSION['active_sy_id'];
$obs = $_GET['obs'];

$positionQry = $conn->query("SELECT * FROM account_tbl WHERE `user_id` = '$teacher_id' ");
while ($result = $positionQry->fetch_assoc()) :
    $position = $result['position'];

$indicator_arr = RPMSdb::fetchSpecificMTindicatorPeriod($conn, $sy_id, $school_id,  $teacher_id,$obs);

if(isset($_GET['notif'])):
    if($_GET['notif'] == 'pwerror'):
        echo '<div class="red-notif-border">Principal Password Entered Invalid!</div>';
    endif;
endif;

    ?>

<style>
#form {

display:none;

}
</style>

<script>

$(document).ready(function() {
  $("#editbtncot").click(function() {
    $("#form").toggle();
  });
});
</script>

    <div class="container">

    <button type="button" class="btn btn-outline-info" id="editbtncot">Edit</button>
        <form action="coteditMT.php" id="form" method="POST">
            <label><strong>Enter Principal Password:</strong></label>
            <input type="hidden" name="user_id" value="<?php echo $teacher_id; ?>">
            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
            <input type="hidden" name="sy_id" value="<?php echo $sy_id; ?>">
            <input type="hidden" name="obs" value="<?php echo $obs; ?>">
            <input type="password" name="pass">
            <input type="submit" value="Go" class="btn btn-info" name="password_sub">
        </form>

        <div class="d-flex justify-content-center">
            <img src="img\deped.png" width="100" height="100" class="rounded-circle">
        </div>

        <div class="d-flex justify-content-center my-2">
            <h5><strong>COT-RPMS for Master Teacher I-IV</strong></h5>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <div class="row">
                    <div class="col">
                        <p>
                            <b>Teacher Observed:</b> <?php displayname($conn, $teacher_id) ?? "<p class='font-weight-bold text-danger'>N/A</p>" ?><br />
                            <b>School :</b> <?= displaySchool($conn, $school_id) ?><br />
                            <b>Observation Period :</b> <?= $obs; ?>
                        </p>
                    </div>
                    <div class="col">
                        <p>
                            <?php $qry = $conn->query("SELECT rater FROM account_tbl WHERE `user_id` = $teacher_id");
                                while ($row = $qry->fetch_assoc()) :
                                    $rater = $row['rater'];
                                    ?>
                                <b> Rater:</b> <?= displayName($conn, $rater)  ?><br />
                                <b> School Year:</b> <?= displaySY($conn, $sy_id) ?><br />
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="card-body">
            <table class="table table-bordered table-responsive-sm table-sm">
                <thead class="alert alert-info">
                    <tr>
                        <th>Indicator No</th>
                        <th>Indicator Name</th>
                        <th>COT Rating</th>
                    </tr>
                </thead>
                <?php
                    $num = 1;
                    foreach ($indicator_arr as $ind) :
                        ?>
                    <tbody>
                        <tr>
                            <td class="font-weight-bold"><?= $num++ . '.'; ?></td>
                            <td class="font-italic"><?= displayMTindicator($conn, $ind['indicator_id']); ?></td>
                            <td class="text-center text-success">
                                <?php
                                        if (empty(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id))) :
                                            echo "<p class='font-weight-bold text-danger'>N/A</p>";
                                        else :
                                            echo rawRate(fetchCOTratingMT($conn, $teacher_id, $obs, $ind['indicator_id'], $sy_id, $school_id), $position);
                                        endif;
                                        ?>
                            </td>
                        </tr>
                    </tbody>
            <?php endforeach;
            endwhile ?>
            </table>
             <?php
                $commentQry = $conn->query("SELECT * FROM cot_mt_rating_b_tbl WHERE `user_id` = '$teacher_id' AND sy = '$sy_id' AND obs_period = '$obs' AND school_id = '$school_id'");
                while ($comment = $commentQry->fetch_assoc()):
                    $commentresult = $comment['comment'];
            ?>

            <textarea name="comment" cols="10" rows="5" readonly class="form-control"><?php echo $commentresult; ?></textarea>

                <?php endwhile; ?>
        </div>
        </div>


    </div>

    <?php
    include 'samplefooter.php';

    ?>