<?php
include 'sampleheader.php';
RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']);
$verifyEsat = FilterUser\FilterUser::filterEsatCbc($conn, $_SESSION['position']);

// $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
//QUERY FOR CORE BEHAVIORAL COMPETENCIES 
$result = $conn->query('SELECT * FROM core_behavioral_tbl')  or die($conn->error);
$numcbc = 1;
$numind = 1;



?>






<div class="container">

    <div class="card">
        <div class="card-header h4 text-center text-white bg-dark">
            Self Assessment Tool Form / Part III / Core Behavioral Competencies
        </div>
        <div class="card-body">
            <form method="POST" action="includes/processESATsurvey.php">
                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />
                <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />

                <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  Core Behavioral Competencies -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB 
                    $num = 1; 
                    while ($row = $result->fetch_assoc()) :
                        $cbc_id = $row['cbc_id'];
                        $cbc_name = $row['cbc_name'];
                        ?>
                        <thead class="bg-dark text-white">
                            <tr>
                                <!-- ASSIGN THE VALUE FROM THE DB  -->
                                <th colspan='3'> <?php echo $numcbc++ . '. ' . $row['cbc_name'] ?></th>
                                </th>
                            </tr>
                        </thead>


                        <tbody class="text-dark">
                            <tr>
                                <!-- START OF LOOP FROM CBC INDICATOR -->
                                <?php
                                    //QUERY FOR INDICATORS TABLE 
                                    
                                    $indresult = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE cbc_id = '$cbc_id'")  or die($conn->error);
                                    //FETCH THE DATA FROM INDICATOR TABLE
                                    while ($rows = $indresult->fetch_assoc()) :
                                        ?>
                                    <td>
                                        <input type="hidden" name="user_id[]" value="<?php echo $_SESSION['user_id']; ?>">
                                        <input type="hidden" name="cbc_id[]" value="<?php echo $cbc_id; ?>">
                                        <input type="hidden" name="cbc_ind_id[]" value="<?php echo $cbc_ind_id = $rows['cbc_ind_id'] ?>">
                                        <!-- ASSIGN THE VALUE FROM THE DB  -->
                                        <select name="cbc_score[]" id="cbcselect<?php echo $num; ?>" class=" text-center font-weight-bold form-control-sm " maxlength="1" onchange="selectcbc<?php echo $num; ?>()">
                                            <option value="0">--select--</option>
                                            <option value="1">
                                                <p class="text-center"><strong>✓</strong></p>
                                            </option>
                                        </select>
                                        <input type="hidden" id="selectedcbc<?php echo $num; ?>">
                                    </td>

                                     <script>

                                        function selectcbc<?php echo $num; ?>(){
                                            var cbc = document.getElementById("cbcselect<?php echo $num ?>");
                                            var selected = cbc.options[cbc.selectedIndex].text;
                                            document.getElementById("selectedcbc<?php echo $num; ?>").value = selected;

                                        }
                                    </script>
                                    <td>
                                        <strong> <?php echo $numind++ ?></strong> <?php echo $indicator = $rows['indicator'] ?>
                                    </td>
                            </tr>
                            <!-- END LOOP FOR THE CBC INDICATORS -->
                        <?php
                        $num++;  
                        endwhile ?>




                        </tbody>
                        <!-- END LOOP FOR THE CORE BEHAVIORAL COMPETENCIES -->
                    <?php
                        
                        $numind = 1;
                    endwhile


                    ?>

                </table>
                <div class="card-footer text-muted ">
                    <a href="javascript:history.back(1)" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success" name="submitESAT3">Submit</button>
                   <a href="includes/processESATsurvey.php?cancel" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>

    </div>
    <!--End tag of container -->

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
include 'includes/scripts.php';
include 'samplefooter.php';
?>