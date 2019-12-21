<?php

include 'sampleheader.php';
include_once 'libraries/func.lib.php';


$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
$resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);

if (isset($_GET['notif'])) :
    if ($_GET['notif'] == "success") :
        echo '<div class="green-notif-border">Classroom Observation has been submitted!</div>';
    elseif ($_GET['notif'] == "recordexist") :
        echo '<div class="red-notif-border">Classroom Observation already exists!</div>';
    endif;
endif;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>




    <script>

    function ddlselect(){
        var obs = document.getElementById("observer2");
        var observer2 = obs.options[obs.selectedIndex].text;
        document.getElementById("observe2").value = observer2;

    }

    function obs3select(){
        var obs = document.getElementById("observer3");
        var observer3 = obs.options[obs.selectedIndex].text;
        document.getElementById("observe3").value= observer3;

    }

    function selectTobs(){
        var tobs = document.getElementById("tobserved");
        var tobserve = tobs.options[tobs.selectedIndex].text;
        document.getElementById("tobserve").value= tobserve;
    }

    function selectSubject(){
        var subj = document.getElementById("tsubject");
        var tsubj = subj.options[subj.selectedIndex].text;
        document.getElementById("tsubjec").value= tsubj;
    }
    
    function selectGlt(){
        var glt = document.getElementById("tgradelvltaught");
        var tgradelvl = glt.options[glt.selectedIndex].text;
        document.getElementById("tgradelvl").value= tgradelvl;
    }

   

    </script>

<div class="container text-center">
    <div class="breadcome-list shadow-reset">
       
            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
            <h5>COT-RPMS</h5>

            <div class="h3 bg-success text-white">Teacher I-III</div>
           

            <h4> Classroom Observation Rating Form</h4>
            <h5 class="text-left">

              
                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 1: </label>&nbsp;
                            <input type="text"  id="observe" value="<?php echo displayName($conn,$_SESSION['user_id']); ?>" readonly>
                            <input type="hidden" name="observer1" id="observer1" value="<?php echo $_SESSION['user_id']; ?>">
                        </div>

                        <div class="col-lg-6">
                            <label>DATE:</label>
                            <input type="text" name="date" id="date" value="<?php echo date("Y/m/d"); ?>" readonly>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 2: </label>&nbsp;
                            <select name="observer2" id="observer2" onchange="ddlselect()">
                                <option value="<?= NULL ?>">Select Observer</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];

                                $queryObserver2 = mysqli_query($conn, 'SELECT * FROM account_tbl WHERE `user_id` != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV","School Head","Principal","Principal-OIC") ') or die($conn->error);

                                if ($queryObserver2) :
                                    while ($row = $queryObserver2->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname']. ' - ' .$row['position'];
                                        ?>

                                        <option value="<?= $row['user_id'] ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>

                                    
                                <?php
                                endif; ?>
                            </select>
                           <input type="hidden" id="observe2" >

                        </div>

                        <div class="col-lg-6">
                            <label>TEACHER OBSERVED: </label>
                            <select name="tobserved" id="tobserved" required onchange="selectTobs()">
                                <option value="" disabled selected>--Select Teacher--</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];
                                $queryObserved = $conn->query('SELECT * FROM account_tbl WHERE  rater =  ' . $rater . '  AND  position  IN ("Teacher I","Teacher II","Teacher III") ') or die($conn->error);

                                if ($queryObserved) :
                                    while ($row = $queryObserved->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname'];
                                        ?>

                                        <option value="<?php echo $row['user_id']; ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>
                                <?php
                                endif; ?>
                            </select>
                            <input type="hidden" id="tobserve">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>OBSERVER 3: </label>&nbsp;
                            <select name="observer3" id="observer3" onchange="obs3select()">
                                <option value="<?= NULL ?>">Select Observer</option>
                                <?php
                                $school = $_SESSION['school_id'];
                                $rater = $_SESSION['user_id'];

                                $queryObserver3 = $conn->query('SELECT * FROM account_tbl WHERE user_id != ' . $rater . ' AND school_id = ' . $school . '  AND position  IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV","School Head","Principal","Principal-OIC") ') or die($conn->error);

                                if ($queryObserver3) :
                                    while ($row = $queryObserver3->fetch_assoc()) :
                                        $name = $row['firstname'] . ' ' . substr($row['middlename'], 0, 1) . '. ' . $row['surname']. ' - ' .$row['position'];
                                        ?>

                                        <option value="<?= $row['user_id']; ?>"><?php echo $name; ?></option>
                                    <?php
                                        endwhile;
                                    else : ?>
                                    <option value=""> No Record!</option>
                                <?php
                                endif; ?>
                            </select>
                                <input type="hidden" id="observe3">
                        </div>



                        <div class="col-lg-6">
                            <label>
                                SUBJECT:
                            </label>
                            <select name="tsubject" required id="tsubject" onchange="selectSubject()">
                                <option value="" disabled selected>--Select Subject--</option>
                                <?php
                                $querySubject = $conn->query('SELECT * FROM subject_tbl') or die($conn->error);
                                while ($subjrow = $querySubject->fetch_assoc()) :
                                    $subject_id = $subjrow['subject_id'];
                                    $subject = $subjrow['subject_name'];
                                    ?>
                                    <option value=" <?php echo $subject_id; ?>"><?php echo $subject; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <input type="hidden" id="tsubjec">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="gradeleveltaught">
                                GRADE LEVEL TAUGHT:
                            </label>
                            <select name="tgradelvltaught" required id="tgradelvltaught" onchange="selectGlt()">
                                <option value="" disabled selected>--Select Grade Level Taught--</option>
                                <?php
                                $queryGlt = $conn->query('SELECT * FROM gradelvltaught_tbl') or die($conn->error);
                                while ($gradelvltaught = $queryGlt->fetch_assoc()) :
                                    $glt_id = $gradelvltaught['gradelvltaught_id'];
                                    $glt = $gradelvltaught['gradelvltaught_name'];
                                    ?>
                                    <option value=" <?php echo $glt_id; ?>"><?php echo $glt; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <input type="hidden" id="tgradelvl">
                        </div>

                        <script>
                            function showIndicator(str) {
                                if (str == "") {
                                    document.getElementById("show").innerHTML = "";
                                    return;
                                } else {
                                    if (window.XMLHttpRequest) {
                                        // code for IE7+, Firefox, Chrome, Opera, Safari
                                        xmlhttp = new XMLHttpRequest();
                                    } else {
                                        // code for IE6, IE5
                                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById("show").innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    // getuser.php is seprate php file. q is parameter 
                                    xmlhttp.open("GET", "ajaxtioaf.php?period=" + str, true);
                                    xmlhttp.send();
                                }
                            }

                            var $observer2 = $("select[name='observer2']");
                            var $observer3 = $("select[name='observer3']");
                            $observer2.change(function() {
                                var selectedItem = $(this).val();
                                var $options = $("select[name='observer2'] > option").clone();
                                $("select[name='observer3']").html($options);
                                $("select[name='observer3'] > option[value=" + selectedItem + "]").remove();
                            });
                        </script>
                        <div class="col-lg-6">

                            <label for="obsperiod" class="col-form-label">
                                OBSERVATION PERIOD:
                            </label>

                            <?php
                            $date = date('Y/m/d');
                            $intdate = intval(strtotime($date));
                            $first_period_int = intval(strtotime($_SESSION['first_period']));
                            $second_period_int = intval(strtotime($_SESSION['second_period']));
                            $third_period_int = intval(strtotime($_SESSION['third_period']));
                            $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                            if ($intdate >= $fourth_period_int) :
                                $period = 4;
                            elseif ($intdate >= $third_period_int) :
                                $period = 3;
                            elseif ($intdate >= $second_period_int) :
                                $period = 2;
                            elseif ($intdate >= $first_period_int) :
                                $period = 1;
                            else :
                                $period = "Invalid Period";
                            endif;
                            ?>

                            <input type="text" name="obs" id="obs" value="<?php echo $period; ?>" readonly />
                        </div>

                        <br>

                        <?php
                        $date = date('Y/m/d');
                        $intdate = intval(strtotime($date));
                        $first_period_int = intval(strtotime($_SESSION['first_period']));
                        $second_period_int = intval(strtotime($_SESSION['second_period']));
                        $third_period_int = intval(strtotime($_SESSION['third_period']));
                        $fourth_period_int = intval(strtotime($_SESSION['final_period']));

                        if ($intdate >= $fourth_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period4=1';
                        elseif ($intdate >= $third_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period3=1';
                        elseif ($intdate >= $second_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period2=1';
                        elseif ($intdate >= $first_period_int) :
                            $periodqry = 'SELECT * FROM tindicator_tbl WHERE period1=1';
                        else :
                            echo 'invalid period!';
                        endif;

                      
                        $resultqry = $conn->query($periodqry)  or die($conn->error);
                        ?>
<!-- LEGEND OF COT RUBRICS-->
                <div class="container">
                        
                        <div class="right">
                            <div class="h4 breadcrumb bg-dark text-white " style="font-size: 12px;">COT Rubric for Teacher I-III</div>
                                    <?php
                                    
                                    $result = $conn->query('SELECT * FROM trubric_tbl')  or die($conn->error);
                                    ?>

                                    <table class="table table-bordered table-responsive-sm table-sm">
                                        <thead class="bg-success text-white">
                                            <tr>
                                                <th style="font-size: 13px;">Level</th>
                                                <th style="font-size: 13px;">Level Name</th>
                                                <th style="font-size: 13px;">Level Description</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = $result->fetch_assoc()) :
                                            ?>
                                            <tbody class="text-justify">
                                                <tr>
                                                    <td style="font-size: 12px; font-style: italic;"><?php echo $row['rubric_lvl']; ?></td>
                                                    <td style="font-size: 12px; font-style: italic;" ><?php echo $row['level_name']; ?></td>
                                                    <td style="font-size: 12px; font-style: italic;"><?php echo $row['rubric_description']; ?></td>
                                                    
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>

                
<!-- END OF LEGEND-->



                        <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                            <thead class="legend-control bg-success text-white ">
                                <tr>
                                    <th>Indicator No</th>
                                    <th>Indicator Name</th>
                                    <th>COT Rating</th>
                                </tr>
                            </thead>

                            <?php
                            $indicator_no = 1;
                            while ($row = $resultqry->fetch_assoc()) :
                                ?>


                                <input type="hidden" name="indicator_id[]" id="indicator_id<?php echo $indicator_no; ?>" value="<?php echo $row['indicator_id']; ?>" />
                                 <input type="hidden" name="indicator_id[]" id="tindicator_id<?php echo $indicator_no; ?>" value="<?php echo $row['indicator_id']; ?>" />
                                <input type="hidden" name="indicator_name[]" id="indicator_name<?php echo $indicator_no; ?>" value="<?php echo $row['indicator_name']; ?>" />

                                <tbody>
                                    <tr>
                                        <td><?php echo $row['indicator_id']; ?></td>
                                        <td><?php echo $row['indicator_name']; ?></td>
                                        <td>
                                            <select name="rating[]" required id="rating<?php echo $indicator_no; ?>" onchange="selectRating<?php echo $indicator_no; ?>()">
                                                <option value="<?= NULL ?>" disabled selected>--Select--</option>
                                                <option value="1">3</option>
                                                <option value="2">4</option>
                                                <option value="3">5</option>
                                                <option value="4">6</option>
                                                <option value="5">7</option>
                                                <option value="1">NO*</option>
                                            </select>
                                            <input type="hidden" id="rate<?php echo $indicator_no; ?>">

                                        </td>

                                        
                                            <script>
                                                 function selectRating<?php echo $indicator_no; ?>(){
                                                        var rating = document.getElementById("rating<?php echo $indicator_no; ?>");
                                                        var cotrate = rating.options[rating.selectedIndex].text;
                                                        document.getElementById("rate<?php echo $indicator_no; ?>").value= cotrate;
                                                    }
                                            </script>
                                    <?php
                                        $indicator_no++;
                                    endwhile;
                                    ?>
                                </tbody>
                                </tr>
                        </table>
                    </div>
                </div>


            </h5>



            <textarea class="form-control" name="ioaf_comment" id="ioaf_comment" rows="5" placeholder="OTHER COMMENTS" required="required"></textarea><br>
            <a href="dbAdmin.php" role="button" class="btn btn-danger">Cancel</a>
            <input type="submit" name="save" value="Submit" id="submitBtn" class="btn btn-default" />
       
</div>
    </div>


<!-- Modal -->
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title " id="exampleModalLabel">Classroom Observation Confirmation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                            <h4><div class="tomato-color font-italic">Are you sure you want to submit the following details for Classroom Observation?</div></h4><br>
            <center>
 <?php
               
                            $resultquery = $conn->query('SELECT * FROM tindicator_tbl')  or die($conn->error);
                            ?>

                            <img src="img\deped.png" width="100" height="100" class="rounded-circle"><br>
                            <h5>COT-RPMS</h5>

                            <div class="h3 bg-success text-white">Teacher I-III
                            </div>

                            <h4> COT Rating Sheet</h4>

                            <form method="POST" action="includes/processcotformT.php">
                                <input type="hidden" name="rater_id" value="<?php echo $_SESSION['user_id']; ?>" />
                                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />
                            <h6 class="text-left">
                                <table>
                                    <tr>
                                        <th>Observer 1: </th>
                                        <td id="obs1"></td>
                                        <input type="hidden" name="observer1" id="cotobs1" readonly>
                                    </tr>
                                    <tr>
                                        <th>Observer 2: </th>
                                        <td id="obs2"></td>
                                        <input type="hidden" name="observer2" id="cotobs2" readonly>
                                    </tr>
                                    <tr>
                                        <th>Observer 3: </th>
                                        <td id="obs3"></td>
                                        <input type="hidden" name="observer3" id="cotobs3" readonly>
                                    </tr>
                                     <tr>
                                        <th>Date: </th>
                                        <td><?php echo date("Y/m/d"); ?></td>
                                        <input type="hidden" name="date" value="<?php echo date("Y/m/d"); ?>" readonly>
                                    </tr>
                                     <tr>
                                        <th>Teacher Observed: </th>
                                        <td id="tobs"></td>
                                        <input type="hidden" name="tobserved" id="cottobs" readonly>
                                    </tr>
                                    <tr>
                                        <th>Subject: </th>
                                        <td id="tsub"></td>
                                        <input type="hidden" name="tsubject" id="cottsub" readonly>
                                    </tr>
                                    <tr>
                                        <th>Grade Level Taught: </th>
                                        <td id="tglt"></td>
                                        <input type="hidden" name="tgradelvltaught" id="cottglt" readonly>
                                    </tr>
                                    <tr>
                                        <th>Observation Period: </th>
                                        <td id="observation"></td>
                                        <input type="hidden" name="obs" id="cotobservation" readonly>
                                    </tr>
                                </table>
                                
                            </h6>
                        </div>
                        <table class="table table-bordered" style="background-color: white; table-layout: 10;">
                            <thead class="legend-control bg-success text-white ">
                                <tr>
                                    <th>Indicator No</th>
                                    <th>Indicator Name</th>
                                    <th>Final Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                                for( $num = 1; $num <=7; $num++):
                               ?>
                                    <tr>
                                        <td id="indi_id<?php echo $num;?>"></td>
                                        <input type="hidden" name="indicator_id[]" id="tindi_id<?php echo $num;?>" readonly>
                                        
                                        <td id="indi_name<?php echo $num;?>"></td>
                                        
                                        <td id="cotrating2<?php echo $num;?>"></td>
                                        <input type="hidden" name="rating[]" id="cotrate<?php echo $num;?>" readonly>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                                        
                        </table>
                       <table>
                           <tr>
                               <th>Comments</th>
                               <td><textarea name="ioaf_comment" id="comment" cols="15" rows="5" class="form-control"></textarea></td>

                           </tr>
                       </table>
         
                            <div class="m-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="save" id="submitConfirm" value="Submit">
                                </center>   
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL  -->


<script>
$(document).ready(function(){
    $('#submitBtn').click(function() {
        
        if(($('#observer1').val() !== '') && ($('#tobserve').val() !== '') && ($('#date').val() !== '') && ($('#tsubjec').val() !== '') && ($('#tgradelvl').val() !== '') && ($('#obs').val() !== '') && ($('#rate1').val() !== '') && ($('#rate2').val() !== '') && ($('#rate3').val() !== '') && ($('#rate4').val() !== '') && ($('#rate5').val() !== '') && ($('#rate6').val() !== '') && ($('#rate7').val() !== '') && ($('#ioaf_comment').val() !== '') ){
      
    $('#confirm-submit').modal('show');

        $('#obs1').text($('#observe').val());
        $('#obs2').text($('#observe2').val());
        $('#obs3').text($('#observe3').val());
        $('#date').text($('#date').val());  
        $('#tobs').text($('#tobserve').val());
        $('#tsub').text($('#tsubjec').val());
        $('#tglt').text($('#tgradelvl').val());
        $('#observation').text($('#obs').val());
        $('#comment').text($('#ioaf_comment').val());

        $('#cotobs1').val($('#observer1').val());
        $('#cotobs2').val($('#observer2').val());
        $('#cotobs3').val($('#observer3').val());
        $('#cotdate').val($('#date').val());  
        $('#cottobs').val($('#tobserved').val());
        $('#cottsub').val($('#tsubject').val());
        $('#cottglt').val($('#tgradelvltaught').val());
        $('#cotobservation').val($('#obs').val());
        
        

    for(let num = 0; num <= 7; num ++){
        $(`#indi_id${num}`).text($(`#indicator_id${num}` ).val());
        $(`#tindi_id${num}`).val($(`#tindicator_id${num}` ).val());
        $(`#indi_name${num}`).text($(`#indicator_name${num}` ).val());
        $(`#cotrating2${num}`).text($(`#rate${num}`).val());
        $(`#cotrate${num}`).val($(`#rating${num}`).val());
    }  
}else{
    alert("There are empty fields!");
}
    
    })
});

</script>



<br>

<?php

include 'samplefooter.php';
?>