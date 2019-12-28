<?php

use IPCRF\IPCRF;

include 'classes/ipcrf/ipcrf.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';


$teacher_id = $_GET['user'];
$sy_id = $_GET['sy'];
$school_id = $_GET['sch'];

$num = 1;

 $ipcrf_details = IPCRF::fetchIPCRFGenTP($conn,$sy_id,$school_id);
 $ipcrf_final_details = IPCRF::fetchIPCRFGenFinalTP($conn,$sy_id,$school_id);

 if ($ipcrf_final_details) :
     $final_rating = $ipcrf_final_details[0]['final_rating'];
     $adj_rating = $ipcrf_final_details[0]['adjectival_rating'];
 endif;


 $ipcrf_array = [];
 $IPCRFqry = mysqli_query($conn, "SELECT * FROM ipcrf_t  WHERE sy_id = $sy_id AND school_id = $school_id and user_id = $teacher_id") or die($conn->error);

 if (mysqli_num_rows($IPCRFqry) == 0) :
     echo '<div class="red-notif-border">Average IPCRF is not available</div>';
     exit();
 else :
     foreach ($IPCRFqry as $ipcrf) :
         array_push($ipcrf_array, $ipcrf);
     endforeach;
 endif;
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
                <div class="p-2">
                    <p>
                        <span class="font-weight-bold">Rating Period: </span><?php echo displaySydesc($conn, $sy_id) ?><br>
                    </p>
                </div>
        <div class="card-body">
            <table class="table table-sm table-responsive-sm table-bordered">
                <thead class="text-white bg-dark font-weight-bold">
                    <tr>
                        <th>
                            <p>#</p>
                        </th>
                        <th>
                            <p>Key Result Area</p>
                        </th>
                        <th>
                            <p>Objectives</p>
                        </th>
                        <th>
                            <p>Timeline</p>
                        </th>
                        <th>
                            <p>
                                Weight per KRA
                            </p>
                        </th>
                        <th>
                            <p>
                                Actual Result of Quality
                            </p>
                        </th>
                        <th>
                            <p>
                                Actual Result of Efficiency
                            </p>
                        </th>

                        <th>
                            <p>
                                Actual Result of Timeliness
                            </p>
                        </th>
                        <th>
                            <p>
                                Quality
                            </p>
                        </th>
                        <th>
                            <p>
                                Efficiency
                            </p>
                        </th>
                        <th>
                            <p>
                                Timeliness
                            </p>
                        </th>
                        <th>
                            <p>
                                Average
                            </p>
                        </th>
                        <th>
                            <p class="text-center">
                                Score
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php if ($ipcrf_details) : foreach ($ipcrf_details as $details) : ?>
                                <!-- number -->
                                <td>
                                    <p>
                                        <?php echo $num++ ?>
                                    </p>
                                </td>
                                <!-- end of number -->

                                <!-- KRA DISPLAY  -->
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo displayKRA($conn, $details['kra_id']) ?>
                                    </p>
                                </td>
                                <!-- END OF KRA  -->

                                <!-- DISPLAY OBJECTIVE -->
                                <td>
                                    <p class="font-italic">
                                        <?php echo displayObjectiveT($conn, $details['obj_id']) ?>
                                    </p>
                                </td>
                                <!-- END OF OBJECTIVE -->

                                <!-- TIMELINE  -->
                                <td>
                                    <p>
                                        <?php echo $details['timeline'] ?>
                                    </p>
                                </td>
                                <!-- END OF TIMELINE -->

                                <!-- OBJECTIVE WEIGHT -->
                                <td>
                                    <p class="text-center font-weight-bold">
                                        <?php echo showPercent($details['objective_weight']) . '%' ?>
                                    </p>
                                </td>
                                <!-- END QUALITY WEIGHT -->

                                <!-- OBJECTIVE ACTUAL RESULT QUALITY -->
                                <td>
                                    <p class="text-justify font-italic">
                                        <?php echo IPCRF::displayPerfIndicatorGenT($conn,$details['actual_result_quality']) ?>
                                    </p>
                                </td>
                                <!-- END QUALITY ACTUAL RESULT QUALITY -->

                                <!-- OBJECTIVE ACTUAL RESULT EFFICIENCY -->
                                <td>
                                    <p class="text-justify font-italic">
                                        <?php echo IPCRF::displayPerfIndicatorGenT($conn,$details['actual_result_efficiency']) ?>
                                    </p>
                                </td>
                                <!-- END QUALITY ACTUAL RESULT EFFICIENCY -->

                                <!-- OBJECTIVE TIMELINESS DESC -->
                                <td>
                                    <p class="text-justify font-italic">
                                        <?php echo IPCRF::displayPerfIndicatorGenT($conn, $details['kra_id'], $details['obj_id'], $details['timeliness']) ?>
                                    </p>
                                </td>
                                <!-- END QUALITY TIMELINESS DESC -->

                                <!-- OBJECTIVE WEIGHT -->
                                <td>

                                    <p class="text-center font-weight-bold">
                                        <?php echo $details['quality'] ?>
                                    </p>
                                </td>
                                <!-- END QUALITY WEIGHT -->

                                <!-- EFFICIENCY  -->
                                <td>
                                    <p class="text-center font-weight-bold">
                                        <?php echo $details['efficiency'] ?>
                                    </p>
                                </td>
                                <!-- END OF EFFICIENCY  -->
                                <td>
                                    <p class="text-center font-weight-bold">
                                        <?php echo ($details['timeliness'] != 0) ?  $details['timeliness'] : "---" ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-center font-weight-bold">
                                        <?php echo $details['average'] ?>
                                    </p>
                                </td>
                                <td>
                                    <p class="text-center font-weight-bold">
                                        <?php echo $details['score'] ?>
                                    </p>
                                </td>

                    </tr>
                <?php
                            endforeach;
                        else : ?>
                <tr>
                    <td colspan="12">
                        <p class="red-notif-border">
                            No record!
                        </p>
                    </td>
                </tr>
            <?php endif; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="12">
                            <p class="text-right">
                                <span>Final Rating: </span><br>
                                <span>Adjectival Rating: </span><br>
                            </p>
                        </td>
                        <td>
                            <p class="text-center font-weight-bold">
                                <?php
                                if (!empty($final_rating)) {
                                    echo $final_rating;
                                }
                                ?><br>
                                <?php if (!empty($adj_rating)) {
                                    echo $adj_rating;
                                }
                                ?><br>
                            </p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>

</div>
