<?php

use FilterUser\FilterUser;

include 'sampleheader.php';

FilterUser::filterObsPeriod($_SESSION['position']);
echo '</b>';
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
                    <legend>Enter the Class Period</legend>Z
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


</div>
<br>
<br>



<?php
include 'samplefooter.php';
?>