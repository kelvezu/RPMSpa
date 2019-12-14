<?php

use FilterUser\FilterUser;

include 'sampleheader.php';

FilterUser::filterObsPeriod($_SESSION['position']);
echo '</b>';

if (isset($_GET['notif'])) :
    if ($_GET['notif'] == "success") :
        echo '<div class="green-notif-border">You have successfully set the observation period!</div>';
    elseif ($_GET['notif'] == "error") :
        echo '<div class="red-notif-border">There is an error setting the observation period!</div>';
    endif;
endif;

?>

<div class="container">

    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            <form action="includes/processobsperiod.php" method="POST">
                <!-- ID OF WHO CREATED THE OBS PERIOD -->
                <input type="hidden" name="created_by" id="" value="<?= $_SESSION['user_id'] ?>" />
                <input type="hidden" name="current_year" value="<?= date('Y'); ?>">
                <input type="hidden" name="sy" value="<?= $_SESSION['active_sy_id'] ?>">
                <input type="hidden" name="school" value="<?= $_SESSION['school_id'] ?>">

                <fieldset>
                    <legend>Enter the Class Period</legend>
                    <div class="form-group">
                        <div class="form-control">
                            <label class="font-weight-bold" for="first_period">First Period </label>
                            <input class="form-control" type="date" name="first_period" placeholder="Enter the First Period date...">

                            <label class="font-weight-bold" for="second_period">Second Period </label>
                            <input class="form-control" type="date" name="second_period" placeholder="Enter the Second Period date...">
                            <label class="font-weight-bold" for="third_period">Third Period </label>
                            <input class="form-control" type="date" name="third_period" placeholder="Enter the Third Period date...">

                            <label class="font-weight-bold" for="fourth_period">Fourth Period </label>
                            <input class="form-control" type="date" name="fourth_period" placeholder="Enter the Fourth Period date...">

                            <div class="d-flex justify-content-center my-3">
                                <button type="submit" name="submit_obs" class="btn btn-primary">Create Observation Period</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>

    </div>
    <br>

    <div class="card">
        <div class="card-header bg-dark text-white text-center h4">
            Observation Period
        </div>
        <div class="card-body">
            <table class="table table-bordered hover table-sm text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>Start of 1st Period</td>
                        <td>Start of 2nd Period</td>
                        <td>Start of 3rd Period</td>
                        <td>Start of 4th Period</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qry = $conn->query("SELECT * FROM obs_period_tbl WHERE school = '" . $_SESSION['school_id'] . "'");
                    while ($row = $qry->fetch_assoc()) :
                        $first_period = $row['first_period'];
                        $second_period = $row['second_period'];
                        $third_period = $row['third_period'];
                        $fourth_period = $row['fourth_period'];
                        $status = $row['status'];
                        ?>
                        <tr>
                            <td><?php echo $first_period; ?></td>
                            <td><?php echo $second_period; ?></td>
                            <td><?php echo $third_period; ?></td>
                            <td><?php echo $fourth_period; ?></td>
                            <td><?php echo $status; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>


            </table>

        </div>
    </div>


</div>
<br>
<br>



<?php
include 'samplefooter.php';
?>