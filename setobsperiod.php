<?php

use FilterUser\FilterUser;

include 'includes/header.php';

FilterUser::filterObsPeriod($_SESSION['position']);
echo '</b>';
?>

<div class="container breadcome-list shadow-reset p-0" style="padding:25px;">


    <form action="includes/processobsperiod.php" method="POST">

        <!-- ID OF WHO CREATED THE OBS PERIOD -->
        <input type="hidden" name="created_by" id="" value="<?= $_SESSION['user_id'] ?>" />
        <input type="hidden" name="current_year" value="<?= date('Y'); ?>">
        <input type="hidden" name="sy" value="<?= $_SESSION['active_sy_id'] ?>">
        <input type="hidden" name="school" value="<?= $_SESSION['school_id'] ?>">

        <fieldset>
            <legend>Set Grading/Observation Period:</legend>
            <div class="form-row">
                <div class="col-sm-12" style="margin: 20px;">
                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the First End Period Month: </strong></label>
                        <select name="first_month" class="form-control">
                            <option value="">--Choose Month--</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the First Period Day: </strong></label>
                        <select name="first_day" id="" class="form-control mx-2">
                            <?php for ($i = 1; $i < 32; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>



                <div class="col-sm-12" style="margin: 20px;">
                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Second End Period Month: </strong></label>
                        <select name="second_month" class="form-control">
                            <option value="">--Choose Month--</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Second Period Day: </strong></label>
                        <select name="second_day" id="" class="form-control mx-2">
                            <?php for ($i = 1; $i < 32; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12" style="margin: 20px;">
                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Third End Period Month: </strong></label>
                        <select name="third_month" class="form-control">
                            <option value="">--Choose Month--</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Third Period Day: </strong></label>
                        <select name="third_day" id="" class="form-control mx-2">
                            <?php for ($i = 1; $i < 32; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>



                <div class="col-sm-12" style="margin: 20px;">
                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Final End Period Month: </strong></label>
                        <select name="final_month" class="form-control">
                            <option value="">--Choose Month--</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label for="start-month" class="col"><strong>Enter the Final Period Day: </strong></label>
                        <select name="final_day" id="" class="form-control mx-2">
                            <?php for ($i = 1; $i < 32; $i++) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12" style="margin: 20px;">
                    <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                </div>








            </div>
            <!-- End div form row  -->
        </fieldset>
    </form>
</div>
<br>
<br>



<?php
include 'includes/footer.php';
?>