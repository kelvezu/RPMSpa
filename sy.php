
    <?php
     include_once 'includes/conn.inc.php';
     include_once 'includes/header.php';
    
    ?>

<!-- add a active status on the database! -->
<div class="container breadcome-list shadow-reset">
    
            <form action="includes/importsy.inc.php" class="form-inline " method="post">
                <legend class="legend-control"><strong>School Year</strong> </legend>
                    <label for="start-month" class="control-label "><strong>Enter the start date: </strong></label>
                        <select name="start-month" class="form-control mx-2" >
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
                                for($i=1; $i<32; $i++):                           
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                             endfor ?>
                        </select>
                        <input  type="text" name="start-year" id="start-year" value="
                        <?php 
                        
                        $currYear = date('Y');
                        echo trim($currYear);
                        
                            

                        ?>"  class="form-control mx-2" maxlength="4" disabled> 

                    <label for="end-month" class="control-label mx-3   "><strong>Enter the end date: </strong></label>
                    <select name="end-month" class="form-control mx-2">
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

                        <select name="end-day[]" id="" class="form-control mx-2">
                            <?php 
                                for($i=1; $i<32; $i++):                           
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php
                             endfor ?>
                        </select>

                        <input type="text" name="end-year" id="start-year" value="
                        <?php 
                            $currentYear =  date('Y');
                            $nextYear = strtotime('next Year');
                            $nextYearDate = date('Y',$nextYear);
                            echo $nextYearDate;
                            
                         ?>"
                           class="form-control mx-2" maxlength="4" disabled>


              
                <button type="submit" class="btn btn-success  my-2" name="sy-set" id="sy-set">Set </button>
                
            </form>
        </div>
        </div>
     
        </div>
             
         <br>
        <?php
      
        include 'includes/footer.php';
    ?>
    

   
