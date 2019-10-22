<?php

use esat\ESAT;

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

$sample = FilterUser\FilterUser::filterEsatUser($conn, $position);

if ($sample) :
    foreach ($sample as $res) :
        echo $res;
    endforeach;
else :
    false;
endif;
?>



<?php //echo "</ul>";
//endforeach; -->
include 'includes/footer.php';  ?>