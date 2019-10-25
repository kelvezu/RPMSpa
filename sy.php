<?php
include_once 'includes/header.php';

?>

<!-- add a active status on the database! -->
<div class="container-fluid breadcome-list shadow-reset p-0">

    <form action="includes/importsy.inc.php" class="form-inline" method="post">
        <legend class="legend-control"><strong>School Year</strong> </legend>

        <div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="start-month" class="form-control-label"><strong>Enter the start date: </strong></label>
                    <select name="start-month" class="form-control">
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





                    <select name="start-day[]" id="" class="form-control mx-2">
                        <?php

                        for ($i = 1; $i < 32; $i++) :
                            ?>

                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                        endfor ?>
                    </select>
                    <input type="text" name="start-year" id="start-year" value="
                        <?php
                        $currYear = date('Y');
                        echo trim($currYear);
                        ?>" class="form-control mx-2" maxlength="4" disabled />
                </div>

                <div class="col-sm-6">
                    <label for="end-month" class="form-control-label   "><strong>Enter the end date: </strong></label>
                    <select name="end-month" class="form-control">
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

                    <select name="end-day[]" id="" class="form-control">
                        <?php
                        for ($i = 1; $i < 32; $i++) :
                            ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                        endfor ?>
                    </select>

                    <input type="text" name="end-year" id="start-year" value="
                        <?php
                        $currentYear =  date('Y');
                        $nextYear = strtotime('next Year');
                        $nextYearDate = date('Y', $nextYear);
                        echo $nextYearDate;
                        ?>" class="form-control" maxlength="4" disabled>





                </div>


            </div>
            <center>
                <div class="col-sm mx-auto">
                    <button type="submit" class="btn btn-success" name="sy-set" id="sy-set">Set </button>
                </div>

            </center>


        </div>


    </form>
</div>


<br>
<?php

include 'includes/footer.php';
?>