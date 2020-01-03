<?php
session_start();
include 'vendor/autoload.php';
include 'includes/conn.inc.php';
include 'libraries/func.lib.php';
include 'classes/ipcrf/ipcrf.class.php';

use IPCRF\IPCRF;
use Mpdf\Mpdf;


$user = $_SESSION['user_id'];
$sy = $_SESSION['active_sy_id'];
$position = $_SESSION['position'];
$school = $_SESSION['school_id'];
$rater =  $_SESSION['rater'];
$num = 1;
$ipcrf = new IPCRF($user, $sy, $school, $position);
$ipcrf_details = $ipcrf->getSchoolFinalRating();
$ipcrf_school = $ipcrf->fetch_all_ipcrf_users();



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

$pdf->WriteHTML('
<div class="container-fluid">
<div class="card">
<div class="card-header">

</div>
<div class="card-body">
    <h4 class="text-center bg-dark text-white p-3">IPCRF School Ranking for SY: ' . displaysy($conn, $sy) . '</h4>
    <table class="table table-sm table-responsive-sm table-bordered table-striped text-center font-weight-bold">
        <thead class="text-white bg-dark font-weight-bold">
            <tr>
                <th>
                    <p>#</p>
                </th>
                <th>
                    <p>School Name</p>
                </th>
                <th>
                    <p>Principal Name</p>
                </th>
                <th>
                    <p>IPCRF General Rating</p>
                </th>
                <th>
                    <p>IPCRF Adjectival Rating</p>
                </th>
            </tr>
        </thead>
        <tbody>
');

foreach ($ipcrf_details as $ipcrf_d) :
    $id_school = $ipcrf_d['school_id'];
    $school_final_rating = $ipcrf_d['school_final_rating'];
    $school_adjectival_rating = adjectivalRating($school_final_rating);
    $pdf->writehtml('
                    <tr>
                    <td>
                        <p>
                            ' . $num++ . '
                        </p>
                    </td>

                    <td>
                        <a data-toggle="modal" data-target="#viewModal' . $id_school . '">
                            ' . displaySchool($conn, $id_school) . '
                        </a>
                    </td>

                    <td>
                        <p>
                            ' . displayName($conn, displayPrincipal($conn, $id_school)) . '
                        </p>
                    </td>

                    <td>
                        <p>
                            ' . $school_final_rating . '
                        </p>
                    </td>

                    <td>
                        <p>
                            ' . $school_adjectival_rating . '
                        </p>
                    </td>
                    
                    ');

endforeach;
$num = 1;
$pdf->WriteHTML('
                    </tr>
                    </tbody>
                </table>
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

$pdf->Output("IPCRF_SCHOOL_RANKING_" . displaysy($conn, $sy) . ".pdf", "D");
