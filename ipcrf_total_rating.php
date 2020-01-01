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
$kra_tbl = kra_tbl($conn);
$num = 1;
$ipcrf_tbl = 'ipcrf_mt';
$ipcrf_final_tbl = 'ipcrf_final_mt';
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_score = $ipcrf->fetch_QETscore_mt();
$obj_tbl = $ipcrf->fetchMTObjective_tbl();
$obj_count = intval(count($obj_tbl));
$ipcrf_user = $ipcrf->fetch_ipcrf_users($ipcrf_final_tbl);

$pdf = new Mpdf(['orientation' => 'L']);
$pdf->WriteHTML('
<style>

body{
    margin: 0;
}

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
        white-space:nowrap;
        padding-top: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
      }


    .table_no_style{
        border: hidden;
        text-align: center;
    }
    </style>



    ');

$pdf->WriteHTML('<h4 class="header_pdf">INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW FORM – Master Teacher I-IV (High-Proficient Teachers)</h4>');

$pdf->WriteHTML('
<table cellpadding="5">
<tr>
<td style="text-align:left">
    <p>
        <b class="font-weight-bold">Principal\'s Name: </b>' . displayName($conn, displayPrincipal($conn, $school)) . '<br>
        <b class="font-weight-bold">Bureau/Center/Service/Division: </b>' . displaySchool($conn, $school) . '<br>
        <b class="font-weight-bold">Rating Period: </b>' . displaySydesc($conn, $sy) . '<br>
    </p>
</td>

</tr>
</table>');

$pdf->WriteHTML("
<table>
    <thead>
        <tr>
            <th rowspan='3'>
                <p>#</p>
            </th>

            <th rowspan='3'>
                <p>Teacher Name </p>
            </th>

            <th rowspan='3'>
                <p>Position</p>
            </th>

            <th class='header_pdf' colspan='$obj_count'>
                <p >Objective Scores</p>
            </th>

            <th rowspan='3'>
                <p> Final  </p>
            </th>

            <th rowspan='3'>
            <p> Adjectival  </p>
            </th>
        </tr>
    <tr>
    ");

foreach ($kra_tbl as $kra) :
    $kra_id =  $kra['kra_id'];
    $pdf->writeHTML("<th colspan=" . $ipcrf->countKRAobjective($kra_id, 'mtobj_tbl') . "> <p> KRA: " . $kra_id . " </p> </th>");
endforeach;


$pdf->writehtml('</tr><tr>');

foreach ($obj_tbl as $obj) :
    $obj_id =  $obj['mtobj_id'];
    $pdf->writeHTML("<th> <p> " . $obj_id . " </p> </th>");
endforeach;

$pdf->WriteHTML('
        </tr>
    </thead>
    <tbody>

');

if ($ipcrf_user) :
    foreach ($ipcrf_user as $user) :
        $users = $user['user_id'];
        $user_position = $user['position'];
        $pdf->writehtml("<tr>
        <td><p>" . $num++ . "</p></td>
        <td><p>" . displayname($conn, $users) . "</p></td>");

        if ($user_position) :
            $pdf->writehtml("<td><p>$user_position</p>");
        else :  $pdf->writehtml("<td><p> --- </p>");
        endif;

        // DISPLAY OBJECTIVES
        if ($obj_tbl) :
            foreach ($obj_tbl as $obj) :
                // DISPLAY OBJECTIVE SCORE 
                if ($ipcrf->fetch_user_Score($ipcrf_tbl, $obj['mtobj_id'], $users)) :
                    $pdf->writehtml("<td><p> " . $ipcrf->fetch_user_Score($ipcrf_tbl, $obj['mtobj_id'], $users) . "</p>");
                else :  $pdf->writehtml("<td><p> --- </p>");
                endif;
            endforeach;
        endif;

        // DISPLAY OF FINAL RATING  
        if ($ipcrf->getFinalRating($ipcrf_final_tbl, $users)) :
            $pdf->writehtml("<td><p> " . $ipcrf->getFinalRating($ipcrf_final_tbl, $users) . "</p>");
        else :  $pdf->writehtml("<td><p> --- </p>");
        endif;

        // DISPLAY OF ADJECTIVAL FINAL RATING  
        if ($ipcrf->getAdjectivalRating($ipcrf_final_tbl, $users)) :
            $pdf->writehtml("<td><p> " . $ipcrf->getAdjectivalRating($ipcrf_final_tbl, $users) . "</p>");
        else :  $pdf->writehtml("<td><p> --- </p>");
        endif;

    endforeach;
endif;

$pdf->WriteHTML(

    '</td></tr>
</tbody>

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

$pdf->Output("" . $name . "_IPCRF.pdf", "I");

    // header('location:print_ipcrfmt.php');
