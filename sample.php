<?php

use esat\ESAT;
use FilterUser\FilterUser;
use RPMSdb\RPMSdb;

include 'includes/header.php';



// echo activeSY($dbcon);

// $enddate = $_SESSION['end_date'];
// $startdate = $_SESSION['start_date'];

// // echo strtotime($enddate) . '<br>';
// // echo strtotime($startdate);


// // $diffdate = date_diff($enddate, $startdate, true);
// // echo $$diffdate->format("%R%a days");

// $date1 = new DateTime();
// $notif_array = [];
// // echo $date1->format('M d, Y');
// echo $sy_year = settype($_SESSION['start_year'], 'int');
// echo $sy_month = settype($_SESSION['start_month'], 'int');
// echo $sy_day = settype($_SESSION['start_day'], 'int');
// // print_r(settype($start_month),);
// try {
//     // $date1->setDate(, 01,);
// } catch (\Throwable $th) { }
// //echo gettype($_SESSION['start_year']);
// echo $start_sy = $date1->format('M d, Y');

// showNoRater($position);


// $person = [
//     'name' => 'Raymond',
//     'ign' => 'KELVEZU',
//     'game' => 'Crossfire'
// ];

// foreach ($person as $description => $value) :
//     
?>
<ul>
    <li><b><?php //$description 
            ?> :</b> <?php //$value 
                        ?></li>
    <?php //endforeach; 
    ?>
</ul>

<?php
//     $acc_arr = showAccountDB($conn);
//     foreach ($acc_arr as $acc_arrs) :
//         
?>
<li><?php //var_dump($acc_arrs);    

    //                 
    ?></li>
<?php
//     endforeach;


// $esat = ESAT::esatStatus($conn, $_SESSION['user_id'], $_SESSION['position']);
// var_dump($esat);
// echo "<ul>";
// foreach ($esat as $result) :

// $verifyEsat = FilterUser\FilterUser::filterEsatUser($conn, $position);
// if ($sample) :
//     foreach ($verifyEsat as $verf) :
//         echo $verf;
//     endforeach;
// else :
//     false;
// endif;


// echo $total = FilterUser::filterDevplan($conn, $_SESSION['position']) . BR;
// echo 'TOTAL OF NO T = ' . RPMSdb::totalTeachers($conn) . BR;
// echo 'TOTAL OF NO MT = ' . RPMSdb::totalMasterTeachers($conn) . BR;
// echo 'TOTAL OF NO MT W/ NO ESAT1 = ' . RPMSdb::masterteachersNoEsat1($conn) . BR;
// echo 'TOTAL OF NO T W/ NO ESAT1 = ' . RPMSdb::teachersNoEsat1($conn) . BR;
// echo 'TOTAL OF NO T W/ ESAT1 = ' . RPMSdb::teachersWithEsat1($conn) . BR . BR;

// echo 'TOTAL OF NO MT W/ NO ESAT1 = ' . RPMSdb::masterteachersNoEsat1($conn) . BR;
// echo 'TOTAL OF NO T W/ NO ESAT2 = ' . RPMSdb::teachersNoEsat2($conn) . BR;
// echo 'TOTAL OF NO MT W/ NO ESAT2 = ' . RPMSdb::masterteachersNoEsat2($conn) . BR;
// echo 'TOTAL OF NO T W/ NO ESAT3= ' . RPMSdb::teachersNoEsat3($conn) . BR;
// echo 'TOTAL OF NO MT W/ NO ESAT3 = ' . RPMSdb::masterteachersNoEsat3($conn) . BR;
// echo 'TOTAL OF NO OF COMPLETED E-SAT = ' . RPMSdb::masterteachersNoEsat3($conn) . BR;
// echo $_SESSION['position'];







//var_dump($rateeOBS1 = RPMSdb::teachersWithCOT1($conn));


// $results = RPMSdb::teachersWithCOT1($conn);

// foreach ($results as $result) :
//     echo   $result['firstname'];
// endforeach;

echo BR;

// date_default_timezone_set('Asia/Manila');
// $today_date = strtotime(intval(date('Y-m-d')));
// $enddate = strtotime(intval($_SESSION['end_date']));

// echo ($enddate) . BR;
// echo ($today_date) . BR;
// if ($today_date == $enddate) {
//     echo 'bakasyon na!';
// } else {
//     echo 'd pa bakasyon';
// }

// $qry1 = 'SELECT * FROM account_tbl WHERE surname = "asdjhsbdad"';
// $result = mysqli_query($conn, $qry1);
// pre_r($result);

// $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));
// $conn->query($qry1);
// if ($conn->query($qry1)->num_rows) :
//     echo 'May Laman';
// else :
//     echo 'wala';

// endif;

// $category = "User Management";
// $title = "Add User";
// $adder_name = $_SESSION['fullname'];
// $msg = $adder_name . "Added new users using CSV upload";
// $status = "Active";

// $adder_id = $_SESSION['user_id'];
// $adder_position = $_SESSION['position'];
// $sy_id = $_SESSION['active_sy_id'];
// $school_id = $_SESSION['school_id'];

// $query = $conn->query('INSERT INTO notification_tbl(category,title,`message`,`status`,`user_id`,rater_id,position,sy_id,school_id) VALUES ("' . $category . '","' . $title . '","' . $msg . '","' . $status . '","' . $adder_id . '","' . $adder_id . '","' . $adder_position . '","' . $sy_id . '","' . $school_id . '")') or die($conn->error);



//echo displayName($conn, $_SESSION['user_id']);


// echo $_SESSION['fullname'];

// $result = RPMSdb::teacherHasCOT1($conn, $_SESSION['user_id']);

// foreach ($result as $monay) :
//     echo $monay['surname'];
// endforeach;

// pre_r(BR . RPMSdb::teacherHasCOT1($conn, 32));

pre_r($teacherMasterlist_results);
?>

<?php //echo "</ul>";
//endforeach; -->
include 'includes/footer.php';  ?>