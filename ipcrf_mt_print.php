<?php
session_start();
include 'vendor/autoload.php';
include 'includes/conn.inc.php';
include 'libraries/func.lib.php';
include 'classes/ipcrf/ipcrf.class.php';

use Mpdf\Mpdf;
use IPCRF\IPCRF;

$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$num = 1;
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_details = $ipcrf->fetchIPCRF('ipcrf_mt');
$ipcrf_final_details = $ipcrf->fetchIPCRF('ipcrf_final_mt');
// pre_r($ipcrf_final_details);
if ($ipcrf_final_details) :
    $final_rating = $ipcrf_final_details[0]['final_rating'];
    $adj_rating = $ipcrf_final_details[0]['adjectival_rating'];
endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>

</head>

<body>


    <?php
    // include 'sampleheader.php';


    $pdf = new Mpdf(['orientation' => 'L']);
    // $stylesheet = file_get_contents(' bootstrap4/b4css/bootstrap.min.css');



    // $data = "";
    // $data .= displayName($conn, 33);
    // $pdf->WriteHTML(($data));
    // $pdf->Output('sss.pdf', 'D');

    $pdf->setHeader('IPCRF for Master Teacher');

    $pdf->WriteHTML('<style>
    #main {
        width: 300px;
        height: 300px;
        border: 1px solid black;
        display: -webkit-flex; /* Safari */
        display: flex;
      }
      
      #main div {
        -webkit-flex: 1;  /* Safari 6.1+ */ 
        flex: 1;
      }
    table{
        width: 100%;
    }
    th,
    td {
        border-collapse: 1px inset;
        text-align: center;
    }

    thead {
    background-color: yellow;
    }
    52
    </style>');
    $pdf->WriteHTML('<b>IPCRF of Master Teacher<b/>');
    $pdf->Image('img/depeds.png', 10, 6, 20, 20);
    $pdf->WriteHTML('
<div class="card">
<div class="card-header">
    <div class="main">
        <div>
            <p>
                <b class="font-weight-bold">Name of Employee: </b>' . displayname($conn, $user) . '<br>
                <b class="font-weight-bold">Position: </b>' . $position . '<br>
                <b class="font-weight-bold">Bureau/Center/Service/Division: </b>' . displaySchool($conn, $school) . '<br>
                <b class="font-weight-bold">Rating Period: </b>' . displaySydesc($conn, $sy) . '<br>
            </p>
        </div>
        <div>
            <b class="font-weight-bold">Name of Employee: </b>' . displayname($conn, $rater) . '<br>
            <b class="font-weight-bold">Position: </b>' . getPosition($conn, $rater) . '<br>
            <b class="font-weight-bold">Date of Review: </b><i class="text-danger"> Error: Please indicate the date! </i><br>
        </div>
    </div>
</div>
<div class="card-body">
<hr>
');
    $pdf->WriteHTML('<table>
<thead>
    
        <tr>    
        <th>
        <p>#</p>
    </th>
    <th>
        <p>KRA</p>
    </th>
    <th>
        <p>Objectives</p>
    </th>
    <th>
        <p>Timeline</p>
    </th>
    <th>
        <p>
            KRA weight
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
        <p class="text-nowrap">
            Actual Results
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
    </tbody>

<tbody>

');

    foreach ($ipcrf_details as $details) :
        $pdf->WriteHTML('
    <tr>
<td>
<b>
    ' . $num++ . '.
</b>
</td>

<td>
<p class="font-weight-bold" style="text-align:left;">
    KRA ' . $details['kra_uid'] . '
</p>
</td>

<!-- DISPLAY OBJECTIVE -->
<td>
    <p class="font-italic">
        Objective ' . $details['obj_id'] . ' 
    </p>
</td>
<!-- END OF OBJECTIVE -->

<!-- TIMELINE  -->
<td>
    <p>
        TIMELINE
    </p>
</td>
<!-- END OF TIMELINE -->

<!-- OBJECTIVE WEIGHT -->
<td>
    <p class="text-center font-weight-bold">
      ' . showPercent($details['objective_weight']) . '%
    </p>
</td>
<!-- END QUALITY WEIGHT -->

<!-- OBJECTIVE WEIGHT -->
<td>
    <p class="text-center font-weight-bold">
       ' . $details['quality'] . ' 
    </p>
</td>
<!-- END QUALITY WEIGHT -->

<!-- EFFICIENCY  -->
<td>
    <p class="text-center font-weight-bold">
         ' . $details['efficiency'] . ' 
    </p>
</td>
<!-- END OF EFFICIENCY  -->
<td>
    <p class="text-center font-weight-bold">
         ' . $details['timeliness'] . ' 
    </p>
</td>
<td>
    <p>
        actual results
    </p>
</td>
<td>
    <p class="text-center font-weight-bold">
         ' . $details['average'] . ' 
    </p>
</td>
<td>
    <p class="text-center font-weight-bold">
         ' . $details['score'] . ' 
    </p>
</td>


</tr>

');
    endforeach;




    $pdf->WriteHTML(
        '



</tbody>

</table>'
    );

    $pdf->Output('ipcrf_mt.pdf', 'I');

    // header('location:print_ipcrfmt.php');

    ?>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>

</html>