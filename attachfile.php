
<?php

include 'sampleheader.php';

if(isset($_GET['notif'])):
    if($_GET['notif'] == 'success'):
       echo '<div class="green-notif-border">You have successfully attached files!</div>';
       elseif:
        echo '<div class="red-notif-border">There was an error uploading your files!</div>';
    endif;

endif;
?>



<h2 class="text-center">Means of Verification</h2>
<br>



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
    <div class="card"  style="height:500px;">
        <div class="card-header text-center">
            List of MOV's
        </div>

        <div class="card-body box">
        
            
            <table class="table table-hover table-responsive-sm table-sm ">
                    <!-- Start loop for  KRA -->
                    <?php
                    //FETCH THE FIELDS FROM THE DB  
                    $kra_num = 0;
                    $tobj_num = 1;
                    $result = $conn->query('SELECT * FROM kra_tbl')  or die($conn->error);
                    while ($row = $result->fetch_assoc()) :
                        $kra_id = $row['kra_id'];
                        $kra_name = $row['kra_name'];
                        $kra_num++;

                        ?>
                        <thead class="thead-dark">
                            <tr>
                                <!-- ASSIGN THE VALUE FROM THE DB  -->
                                <th class="bg-success"><small><?php echo "KRA " . $kra_num; ?></small></th>
                                <th class="bg-success"><small>Main MOV</small></th>
                                <th class="bg-success"><small>Supporting MOV</small></th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <!-- START OF LOOP FROM OBJECTIVE -->
                                <?php
                                    //QUERY FOR INDICATORS TABLE 
                                    $indresult = $conn->query("SELECT * FROM tobj_tbl WHERE kra_id = '$kra_id'")  or die($conn->error);
                                    //FETCH THE DATA FROM INDICATOR TABLE

                                    while ($rows = $indresult->fetch_assoc()) :

                                        ?>
                                    <td><small>

                                        <?php
                                                //ASSIGN THE VALUE FROM THE DB

                                                echo 'Objective' . $tobj_id = $rows['tobj_id'];

                                                ?>
                                                </small>
                                    </td>

                                <?php
                                    //QUERY FOR MOV TABLE 
                                    $movresult = $conn->query("SELECT * FROM tmov_tbl WHERE kra_id = '$kra_id' AND tobj_id = '$tobj_id'")  or die($conn->error);
                                    while($rowss = $movresult->fetch_assoc()):
                                ?>
                                    <td><small><?php echo $rowss['main_mov']; ?></small></td>
                                    <td><small><?php echo $rowss['supp_mov']; ?></small></td>
                            </tr>
                        </tbody>
                        <?php endwhile; ?>
                        <?php endwhile; ?>
                        <?php endwhile; ?>
            </table>
        

        </div>
    </div>
    </div>
<div class="col-sm-6">
    <div class="card" style="height:500px;">
        <div class="card-header text-center">
            Upload
        </div>
        <div class="card-body box"> 
            <div class="row">
                <div class="col">
                    <form action="includes/upload.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                        <input type="hidden" name="position" value="<?php echo $_SESSION['position'];?>">
                        <input type="hidden" name="rater_id" value="<?php echo $_SESSION['rater'];?>">
                        <input type="hidden" name="school_id" value="<?php echo $_SESSION['school_id'];?>">
                        <input type="hidden" name="sy_id" value="<?php echo $_SESSION['active_sy_id'];?>">


                        <input type="file" name="file" class=" btn btn-outline-success form-control" required><br>
                        <label for="desc"><strong>Choose MOV Type:</strong></label><br>
                            <select name="mov_type" class="form-control" required>
                                <option value="" disabled selected>--Select MOV Type--</option>
                                <option name="main_mov" value="main_mov">Main MOV</option>
                                <option name="supp_mov" value="supp_mov">Supporting MOV</option>
                            </select><br>
                        <label for="desc"><strong>Description</strong></label><br>
                        <textarea name="description" cols="40" rows="10" required></textarea><br>
                       
                </div>
               
                <div class="col">
                    <label for="selectkra"><strong>Choose Objective</strong></label><br>

                    <?php
                        $obj_id = 0;
                        $qry = $conn->query("SELECT * FROM tobj_tbl");
                        while ($resultQry = $qry->fetch_assoc()) :
                            $kra_id = $resultQry['kra_id'];
                            $obj_id = $resultQry['tobj_id'];

                    ?>
                         <input type="checkbox" name="obj[]" value="<?php echo $obj_id ;?>" /><?php echo "<a data-toggle='tooltip' data-placement='top' title='".displayKRA($conn,$kra_id)."'>KRA ". $kra_id . "</a> - <a data-toggle='tooltip' data-placement='top' title='".displayObjectiveT($conn,$obj_id)."'>Objective " . $obj_id. "</a>"; ?><br>
                       
                        <?php endwhile; ?>
                        <button type="submit" name="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>        
</div>


</div>


       
</form>

<?php

include 'samplefooter.php';
?>
