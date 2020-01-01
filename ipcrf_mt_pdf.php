<?php
session_start();
include 'vendor/autoload.php';
include 'includes/conn.inc.php';
include 'libraries/func.lib.php';
include 'classes/ipcrf/ipcrf.class.php';

use Mpdf\Mpdf;

use IPCRF\IPCRF;

$user = $_SESSION['user_id'];
$name = displayName($conn, $user);
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$rater_name = ($rater) ? displayName($conn, $rater) : "No rater";
$rater_position = ($rater) ? getPosition($conn, $rater) : "No rater";
$app_auth = displayName($conn, $_SESSION['approving_authority']) or $app_auth = "N/A";
$num = 1;
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_details = $ipcrf->fetchIPCRF('ipcrf_mt');
$ipcrf_final_details = $ipcrf->fetchIPCRF('ipcrf_final_mt');
// pre_r($ipcrf_final_details);
if ($ipcrf_final_details) :
    $final_rating = $ipcrf_final_details[0]['final_rating'];
    $adj_rating = $ipcrf_final_details[0]['adjectival_rating'];
endif;

$pdf = new Mpdf(['orientation' => 'L']);
$pdf->WriteHTML('


<style>

.header_pdf{
    background-color:black;
    padding: 10px;
    color: white;
    text-align:center;
    margin-bottom:0px;
    margin-top:0px;
}

    table{
        width: 100%;
    }
    th,
    td {
        border: 1px dotted black;
        text-align: center;
    }

    .table_no_style{
        border: hidden;
        text-align: center;
    }
    </style>

    
    
    ');

$pdf->WriteHTML('
         <h4 class="header_pdf">INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW FORM – Master Teacher I-IV (High-Proficient Teachers)</h4>
');

$pdf->WriteHTML('
<table cellpadding="5">
<tr>
<td style="text-align:left">
    <p>
        <b class="font-weight-bold">Name of Teacher: </b>' . displayname($conn, $user) . '<br>
        <b class="font-weight-bold">Position: </b>' . $position . '<br>
        <b class="font-weight-bold">Bureau/Center/Service/Division: </b>' . displaySchool($conn, $school) . '<br>
        <b class="font-weight-bold">Rating Period: </b>' . displaySydesc($conn, $sy) . '<br>
    </p>
</td>
<td style="text-align:left" >
    <p>
        <b class="font-weight-bold">Name of Rater: </b>' . $rater_name . '<br>
        <b class="font-weight-bold">Position: </b>' .  $rater_position . '<br>
        <b class="font-weight-bold">Date of Review: </b><i class="text-danger"> Error: Please indicate the date! </i><br>
    </p>
</td>
</tr>
</table>');
$pdf->WriteHTML('<table>
<thead>
<tr>      
    <th>
        <p>KRA</p>
    </th>

    <th>
    <p>
        Weight per KRA
    </p>
    </th>   

    <th>
        <p>Objectives</p>
    </th>

    <th>
        <p>
            Weight per Objective
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

');

foreach (kra_tbl($conn) as $details) :
    $kra_id =  $details['kra_id'];
    $kra_name = $details['kra_name'];
    $count_obj = $ipcrf->countKRAobjective($kra_id, 'mtobj_tbl');
    $kra_weight = $ipcrf->fetchKRAweight($kra_id);


    // KRA NAME
    $pdf->WriteHTML(
        '
    <tr>
        <td  style="text-align:center;"><p>' . $kra_name . '</p></td>
        <td ><p>' . $kra_weight . '</p></td>
        <td  style="text-align:center;"> '
    );

    // OBJECTIVE
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $pdf->writeHTML('<p> Objective ' . $obj_id  . '</p> <br>');
    endforeach;
    $pdf->writeHTML('
    </td>
        <td>');
    // OBJECTIVE WEIGHT
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_weight = $ipcrf->fetchOBJweight($obj['kra_id']) * 100;
        $pdf->writeHTML('<p>' . $obj_weight  . '%</p> <br> ');
    endforeach;

    $pdf->WriteHTML('
        </td>
        <td>');

    // OBJECTIVE QUALITY
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_quality = ($ipcrf->fetchQuality('ipcrf_mt', $obj_id) != 0) ?  $ipcrf->fetchQuality('ipcrf_mt', $obj_id) : "---";
        // $obj_quality = $ipcrf->fetchQuality('ipcrf_mt', $obj_id);
        $pdf->writeHTML(' <p>' . $obj_quality  . '</p> <br>');
    endforeach;


    $pdf->writeHTML('
    </td>   
    <td>');

    // OBJECTIVE EFFICIENCY
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_efficiency = ($ipcrf->fetchEfficiency('ipcrf_mt', $obj_id) != 0) ?  $ipcrf->fetchEfficiency('ipcrf_mt', $obj_id) : "---";
        // $obj_efficiency = $ipcrf->fetchEfficiency('ipcrf_mt', $obj_id);
        $pdf->writeHTML('<p>' . $obj_efficiency  . '</p> <br>');
    endforeach;


    $pdf->WriteHTML('
    </td>
    <td>');

    // OBJECTIVE TIMELINESS
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_timeliness = ($ipcrf->fetchTimeliness('ipcrf_mt', $obj_id) != 0) ?  $ipcrf->fetchTimeliness('ipcrf_mt', $obj_id) : "---";
        $pdf->writeHTML('<p>' . $obj_timeliness  . '</p> <br> ');
    endforeach;


    $pdf->WriteHTML('
    </td>
    </tr>
    <td>');
    // OBJECTIVE AVERAGE
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_avg = $ipcrf->fetchAVG('ipcrf_mt', $obj_id);
        $pdf->writeHTML('<p>' . $obj_avg  . '</p> <br> ');
    endforeach;


    $pdf->WriteHTML('
    </td>
    <td>');

    // OBJECTIVE SCORE
    foreach ($ipcrf->getOBJ('mtobj_tbl', $kra_id) as $obj) :
        $obj_id = $obj['mtobj_id'];
        $obj_score = $ipcrf->fetchScore('ipcrf_mt', $obj_id);
        $pdf->writeHTML('<p>' . $obj_score  . '</p> <br> ');
    endforeach;


    $pdf->WriteHTML('
    </td>    


    </tr>
');
endforeach;

$pdf->WriteHTML(

    '
</tbody>
<tfoot>
<tr>
    <td colspan="8" style="text-align:right;">
        <p>
            <b>Final Rating: </b><br>
            <b>Adjectival Rating: </b><br>
        </p>
    </td>
    <td style="border: 1px solid black; text-align:left;">
        <p class="text-center font-weight-bold">
            ' . $final_rating . '
            <br>
            ' . $adj_rating . '
            <br>
        </p>
    </td>
</tr>
</tfoot>
</table>'
);

$pdf->WriteHTML('
<table style="border:none; margin-top:25px;">
    <tr style="border:none;">
        <td style="border:none;">
            <p>
                <u>' . $name . '</u>
                <p><b>Ratee</b></p>
            </p>
        </td>

        <td style="border:none;">
            <p>
                <u>' . $rater_name . '</u>
                <p><b>Rater</b></p>
            </p>
        </td>

        <td style="border:none;">
            <p>
                <u>' . $app_auth . '</u>
                <p><b>Approving Authority</b></p>
            </p>
        </td>
    </tr>
</table>
');

$pdf->Output("" . $name . "_IPCRF.pdf", "D");

header('location:print_ipcrfmt.php');
