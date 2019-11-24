<?php

use RPMSdb\RPMSdb;

include 'sampleheader.php';

?>
<div class="dashone-adminprowrap shadow-reset mg-b-30">
    <div class="dash-adminpro-project-title">
        <h4 align="center"><b>Master Teacher Progress View</b></h4>

        <div class="sparkline9-graph">
            <div class="static-table-list">


                <table class="table sparkle-table ">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>ESAT</th>
                            <th colspan="4" class="text-center">COT</th>
                            <th>IPCRF</th>
                            <th>DEVELOPMENT PLAN</th>



                        </tr>
                    </thead>
                    <?php
                    if (isset($masterteacherMasterlist_results)) :
                        foreach ($masterteacherMasterlist_results as $masterteacher) :
                            $masterteachername = $masterteacher['firstname'] . ' ' . substr($masterteacher['middlename'], 0, 1) . '. ' . $masterteacher['surname'];
                            ?>
                            <tbody>
                                <tr>

                                    <td width="20%"><?php echo $masterteachername; ?></td>
                                    <td width="20%"><?php echo $masterteacher['position']; ?></td>
                                    <td width="20%"><?php
                                                            if ((RPMSdb::isEsatCompleteBool($conn, $masterteacher['position'], $masterteacher['user_id']))) :

                                                                if (stripos($masterteacher['position'], 'aster')) :

                                                                    echo '<a href="redisplaymtchart.php"><img src="https://img.icons8.com/flat_round/20/000000/checkmark.png">';


                                                                elseif (stripos($masterteacher['position'], 'eacher')) :
                                                                    echo '<a href="redisplaytchart.php"><img src="https://img.icons8.com/flat_round/20/000000/checkmark.png">';


                                                                else :
                                                                    return false;

                                                                endif;

                                                            elseif ((RPMSdb::isEsatCompleteBool($conn, $masterteacher['position'], $masterteacher['user_id']) == false)) :

                                                                echo '<img src="https://img.icons8.com/cotton/24/000000/cancel--v1.png">';


                                                            else :
                                                                return false;
                                                                exit();
                                                            endif; ?>
                                    </td>

                                    <td>
                                        <?php echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">' ?>
                                    </td>
                                    <td>
                                        <?php echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">' ?>
                                    </td>
                                    <td>
                                        <?php echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">' ?>
                                    </td>
                                    <td>
                                        <?php echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">' ?>
                                    </td>

                                </tr>
                        <?php
                            endforeach;
                        else :
                            echo 'no record';

                        endif;
                        ?>

                            </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include 'samplefooter.php'; ?>