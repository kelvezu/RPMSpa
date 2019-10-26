<?php

use RPMSdb\RPMSdb;

include 'includes/header.php';
RPMSdb::isEsatComplete($conn, $_SESSION['position']);
?>
<div class="dashone-adminprowrap shadow-reset mg-b-30">
    <div class="dash-adminpro-project-title">
        <h4 align="center"><b>Teacher Progress View</b></h4>

        <div class="sparkline9-graph">
            <div class="static-table-list">
                <div class="pre-scrollable">

                    <table class="table sparkle-table ">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>ESAT</th>
                                <th colspan="4">COT</th>
                                <th>IPCRF</th>
                                <th>DEVELOPMENT PLAN</th>

                            </tr>
                        </thead>
                        <?php
                        if (isset($teacherMasterlist_results)) :
                            foreach ($teacherMasterlist_results as $teacher) :

                                $teachername = $teacher['user_id'] . ' ' . $teacher['firstname'] . ' ' . substr($teacher['middlename'], 0, 1) . '. ' . $teacher['surname'];
                                ?>
                                <tbody>
                                    <tr>

                                        <td width="20%"><?php echo $teachername; ?></td>
                                        <td width="20%"><?php echo $teacher['position']; ?></td>
                                        <td width="20%"><?php
                                                                if ((RPMSdb::isEsatCompleteBool($conn, $teacher['position'], $teacher['user_id']))) :

                                                                    if (stripos($teacher['position'], 'aster')) :

                                                                        echo '<a href="redisplaymtchart.php"><img src="https://img.icons8.com/flat_round/20/000000/checkmark.png">';


                                                                    elseif (stripos($teacher['position'], 'eacher')) :
                                                                        echo '<a href="redisplaytchart.php"><img src="https://img.icons8.com/flat_round/20/000000/checkmark.png">';


                                                                    else :
                                                                        return false;

                                                                    endif;

                                                                elseif ((RPMSdb::isEsatCompleteBool($conn, $teacher['position'], $teacher['user_id']) == false)) :

                                                                    echo '<img src="https://img.icons8.com/cotton/24/000000/cancel--v1.png">';


                                                                else :
                                                                    return false;
                                                                    exit();
                                                                endif; ?>
                                        </td>

                                        <td>
                                            <?php if ((RPMSdb::teacherHasCOT1($conn, $teacher['user_id']))) :
                                                        echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">';

                                                    else :
                                                        echo 'ekis';
                                                    endif
                                                    ?>
                                        </td>
                                        <td> <?php echo '<img src="https://img.icons8.com/color/25/000000/checked-checkbox.png">' ?>
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
</div>
<?php include 'includes/footer.php'; ?>