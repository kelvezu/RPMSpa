<?php

use IPCRF\IPCRF;

include 'classes/ipcrf/ipcrf.class.php';
include 'libraries/func.lib.php';
include 'includes/conn.inc.php';


//$user = $_GET['user'];
//$school = $_GET['sch'];
//$rater = $_GET['rater'];
$sy_id = $_GET['sy'];
//$position = $_GET['pos'];


$num = 1;
///$ipcrf = new IPCRF('', $sy_id, '', '');
$ipcrf_details = IPCRF::fetchIPCRFGenT($conn,$sy_id);
$ipcrf_final_details = IPCRF::fetchIPCRFGenFinalT($conn,$sy_id);
// pre_r($ipcrf_final_details);
if ($ipcrf_final_details) :
    $final_rating = $ipcrf_final_details[0]['final_rating'];
    $adj_rating = $ipcrf_final_details[0]['adjectival_rating'];
endif;
//echo $final_rating;
// pre_r($ipcrf_details);
/* <p><?php echo displayName($conn, $user); ?></p>*/
?>
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="p-2">
                    <p>
                        <span class="font-weight-bold">Rating Period: </span><?php echo displaySydesc($conn, $sy_id) ?><br>
                    </p>
                </div>
            </div>
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
                        <?php if (IPCRF::fetchIPCRFGenT($conn,$sy_id)) : foreach ($ipcrf_details = IPCRF::fetchIPCRFGenT($conn,$sy_id) as $details) : ?>
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
                                        <?php echo IPCRF::displayPerfIndicatorGenT($conn, $details['actual_result_quality']) ?>
                                    </p>
                                </td>
                                <!-- END QUALITY ACTUAL RESULT QUALITY -->

                                <!-- OBJECTIVE ACTUAL RESULT EFFICIENCY -->
                                <td>
                                    <p class="text-justify font-italic">
                                        <?php echo IPCRF::displayPerfIndicatorGenT($conn, $details['actual_result_efficiency']) ?>
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
