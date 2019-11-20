
<?php

include 'sampleheader.php';
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
                        <input type="file" name="file" class=" btn btn-outline-success form-control" required><br>
                        <label for="desc"><strong>Choose MOV Type:</strong></label><br>
                            <select name="mov_type" class="form-control" required>
                                <option value="" disabled selected>--Select MOV Type--</option>
                                <option name="main_mov" value="main_mov">Main MOV</option>
                                <option name="supp_mov" value="supp_mov">Supporting MOV</option>
                            </select><br>
                        <label for="desc"><strong>Description</strong></label><br>
                        <textarea name="description" cols="40" rows="8" required></textarea><br>
                        <button type="submit" name="submit" class="btn btn-success">Upload</button>
                </div>
                <div class="col">
                    <label for="selectkra"><strong>Choose KRA</strong></label><br>
                        <input type="checkbox" name="kra_one">KRA 1<br>
                        <input type="checkbox" name="kra_two">KRA 2<br>
                        <input type="checkbox" name="kra_three">KRA 3<br>
                        <input type="checkbox" name="kra_four">KRA 4<br>
                        <input type="checkbox" name="kra_five">KRA 5<br>
                </div>
                <div class="col">
                    <label for="selectkra"><strong>Choose Objective</strong></label><br>
                        <input type="checkbox" name="obj_one">Objective 1<br>
                        <input type="checkbox" name="obj_two">Objective 2<br>
                        <input type="checkbox" name="obj_three">Objective 3<br>
                        <input type="checkbox" name="obj_four">Objective 4<br>
                        <input type="checkbox" name="obj_five">Objective 5<br>
                        <input type="checkbox" name="obj_six">Objective 6<br>
                        <input type="checkbox" name="obj_seven">Objective 7<br>
                        <input type="checkbox" name="obj_eight">Objective 8<br>
                        <input type="checkbox" name="obj_nine">Objective 9<br>
                        <input type="checkbox" name="obj_ten">Objective 10<br>
                        <input type="checkbox" name="obj_eleven">Objective 11<br>
                        <input type="checkbox" name="obj_twelve">Objective 12<br>
                        <input type="checkbox" name="obj_thirteen">Objective 13<br>
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
