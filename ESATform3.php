<?php
include 'sampleheader.php';
RPMSdb\RPMSdb::isEsatComplete($conn, $_SESSION['position']);
$verifyEsat = FilterUser\FilterUser::filterEsatCbc($conn, $_SESSION['position']);

$conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
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
            <form action="includes/processESATsurvey.php" method="POST">
                <input type="hidden" name="sy" value="<?php echo $_SESSION['active_sy_id']; ?>" />
                <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id']; ?>" />
                <input type="hidden" name="position" value="<?php echo $_SESSION['position'] ?>" />

                <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  Core Behavioral Competencies -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB  
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
                                        <select name="cbc_score[]" id="" class=" text-center font-weight-bold " maxlength="1">
                                            <option value="0">--select--</option>
                                            <option value="1">
                                                <p class="text-center"><strong>✓</strong></p>
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <strong> <?php echo $numind++ ?></strong> <?php echo $indicator = $rows['indicator'] ?>
                                    </td>
                            </tr>
                            <!-- END LOOP FOR THE CBC INDICATORS -->
                        <?php endwhile ?>




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
                    <button type="submit" class="btn btn-danger" name="cancel">Cancel</button>
                </div>
            </form>
        </div>

    </div>
    <!--End tag of container -->

</div>


<br>
<?php
include 'includes/scripts.php';
include 'samplefooter.php';
?>