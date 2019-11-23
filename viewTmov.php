<?php

include 'sampleheader.php';

?>

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h2>Means of Verification Summary</h2>
        </div>
        
        <div class="card-body">
            <table class="table table-hover table-responsive-sm ">
            <?php
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
                                <th class="bg-success"><small>Status</small></th>
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
                                    $movresult = $conn->query("SELECT * FROM mov_b_t_attach_tbl WHERE kra_id = '$kra_id' AND obj_id = '$tobj_id' AND mov_type='main_mov'")  or die($conn->error);
                                    while($rowss = $movresult->fetch_assoc()):
                                ?>
                                     <td><small><?php echo $rowss['mov_id']; ?></small></td>

                                     <?php
                                    //QUERY FOR MOV TABLE 
                                    $movresults = $conn->query("SELECT * FROM mov_b_t_attach_tbl WHERE kra_id = '$kra_id' AND obj_id = '$tobj_id' AND mov_type='supp_mov'")  or die($conn->error);
                                    while($rowsss = $movresults->fetch_assoc()):
                                ?>
                                     <td><small><?php echo $rowsss['mov_id']; ?></small></td>

 <?php endwhile; ?>
                <?php endwhile; ?>
                <?php endwhile; ?>
                <?php endwhile; ?>
                </table>
        </div>
    </div>
</div>






<?php

include 'samplefooter.php';

?>