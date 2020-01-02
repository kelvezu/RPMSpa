<?php
session_start();


use Mpdf\Mpdf;
use IPCRF\IPCRF;

include 'vendor/autoload.php';
include 'includes/conn.inc.php';
include 'libraries/func.lib.php';
include 'classes/ipcrf/ipcrf.class.php';

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
$ipcrf_details = $ipcrf->fetch_all_ipcrf_users();
$overall_final_rating = $ipcrf->getAllFinalRating();
$overall_adjectival_rating = adjectivalRating($overall_final_rating);

$pdf = new Mpdf(['orientation' => 'L']);
$pdf->WriteHTML('
<style>

body{
    margin: 0;
}

.text-center{
    text-align: center;
    padding-top: 10px;
    margin-top: 10px;
}

.center {
    margin: auto;
    width: 50%;
    padding: 10px;
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
// THIS FUNCTION WILL CHECK IF THERE ARE RECORDS
$pdf->writehtml('<div class="container-fluid">');

isNoRecord($ipcrf_details);

$pdf->writehtml('
   <div>
  
</div>
<br>
<div class="card">
   <div class="card-header">
       <table class="table table-bordered" cellpadding="5">
           <tr>
               <td style="text-align:left">
                   <p>
                       <b class="font-weight-bold">Principal Name: </b>' . displayName($conn, displayPrincipal($conn, $school)) . '<br>
                       <b class="font-weight-bold">Bureau/Center/Service/Division: </b>' . displaySchool($conn, $school) . '<br>
                       <b class="font-weight-bold">Rating Period: </b>' . displaySydesc($conn, $sy) . '<br>
                   </p>
               </td>
           </tr>
       </table>
   </div>
   
   <div class="card-body">
       <h4 class="header_pdf">IPCRF Ranking for SY:  ' . displaysy($conn, $sy) . ' </h4>
       <table class="table table-sm table-responsive-sm table-bordered table-striped text-center font-weight-bold ">
           <thead class="text-white bg-dark font-weight-bold">
               <tr>
                   <th>
                       <p>#</p>
                   </th>
                   <th>
                       <p>Teacher Name</p>
                   </th>
                   <th>
                       <p>Position</p>
                   </th>
                   <th>
                       <p>Final Rating</p>
                   </th>
                   <th>
                       <p>
                           Adjectival Rating
                       </p>
                   </th>

               </tr>
           </thead>
           <tbody>

   ');

foreach ($ipcrf_details as $details) :
    $view_user = $details['user_id'];
    $name = displayName($conn, $details['user_id']);
    $user_position = $details['position'];
    $final_rating = $details['final_rating'];
    $adjectival_rating = $details['adjectival_rating'];

    $pdf->writehtml('
    <tr>
    <td>
        <p>
            ' . $num++ . '
        </p>
    </td>

    <td>
        <p>
            ' . $name . '
        </p>
    </td>

    <td>
        <p>
            ' . $user_position . '
        </p>
    </td>

    <td>
        <p>
            ' . $final_rating . '
        </p>
    </td>

    <td>
        <p>
            ' . $adjectival_rating . '
        </p>
    </td>
    
    
    ');
endforeach;

$pdf->writehtml('
 </tr>
 </tbody>

 </table>
 </div>
 <div class="card-footer">
     <div class="d-flex justify-content-center">
         <div class="p-2">
             <p>
                 <span><b>Overall Final Rating: </b>' . $overall_final_rating . ' </span><br>
                 <span><b>Overall Adjectival Rating:</b> ' . $overall_adjectival_rating . ' </span><br>
             </p>
         </div>
     </div>

 </div>
 </div>

 </div>
 
 ');




$pdf->writeHTML("
    <footer>
        <div class='center text-center'>
            <i><small>*** This is a system-generated report and does not require a signature. ***</small></i>
        </div>
    </footer>
    ");

$pdf->Output("IPCRF_RANKING_" . displaysy($conn, $sy) . ".pdf", "D");
