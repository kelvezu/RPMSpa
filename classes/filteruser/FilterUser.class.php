<?php

namespace FilterUser;

class FilterUser
{
    public static function filterEsatUser($conn, $position)
    {
        if (isset($position)) :
            if (strpos($position, 'dmin') || strpos($position, 'chool head') || strpos($position, 'rincipal')) :
                //DISPLAY THE PROGESS OF ESAT
                $query_t = mysqli_query($conn, 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '"   AND position IN ("Teacher I","Teacher II","Teacher III") AND status = "Active" ');
                $total_t = mysqli_num_rows($query_t);
                echo $total_t . BR;

                $query_mt = mysqli_query($conn, 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' .
                    $_SESSION['active_sy_id'] . '"   AND position IN ("Master Teacher I","Master Teacher II","Master Teacher III", "Master Teacher IV") AND status = "Active"');
                $total_mt = mysqli_num_rows($query_mt);
                echo $total_mt;

                echo '<div class="container" style="padding: 50px;">
                <div class="col-sm" style="width="2px";">
                <p class="">" tae"</p>
                <div class="progress">
                <div 
                class="progress-bar progress-bar-success" 
                role="progressbar" aria-valuenow="1" 
                aria-valuemin="0" 
                aria-valuemax="' . $total_t . '" 
                style="width:70%">
                Number of Teacher who take ESAT!</div></div></div>';

                echo '<div class="col-sm" style="width="2px";">
                <div class="progress">
                <div 
                class="progress-bar progress-bar-info" 
                role="progressbar" aria-valuenow="1" 
                aria-valuemin="0"
                aria-valuemax="' . $total_mt . '" 
                style="width:70%">
                70%</div></div></div></div>';


                directLastPage();
                include 'includes/footer.php';
                die();
            elseif (strpos($position, 'eacher')) :
                $notif_array = [];
                /* ********************************************************************************* */
                $esat_demo_T = 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_demo_T_result = mysqli_query($conn, $esat_demo_T);
                $check_e1_t = mysqli_num_rows($esat_demo_T_result);
                if ($check_e1_t) :
                    //array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Demographics!</p>');
                    array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Demographics!</p>');
                else :
                    //array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT demographics yet! </p>');
                    array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT demographics yet! </p>');
                endif;
                /******************************************************************************************* */
                if (strpos(($position), 'aster')) :
                    $esat_objective_T = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

                elseif (strpos(($position), 'eacher')) :
                    $esat_objective_T = 'SELECT * FROM `esat2_objectivest_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                else :
                    return false;
                endif;

                $esat_objective_T_result = mysqli_query($conn, $esat_objective_T);
                $check_e2_t = mysqli_num_rows($esat_objective_T_result);
                if ($check_e2_t) :
                    //array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Demographics!</p>');
                    array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Objectives!</p>');
                else :
                    //array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT demographics yet! </p>');
                    array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT Objectives yet! </p>');
                endif;
                /* ******************************************************************************************************* */

                $esat_cbc_T = 'SELECT * FROM esat3_core_behavioral_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '"  AND status = "Active"  ';
                $esat_cbc_T_result = mysqli_query($conn, $esat_cbc_T);
                $check_e3_t = mysqli_num_rows($esat_cbc_T_result);
                if ($check_e3_t) :
                    //array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Demographics!</p>');
                    array_push($notif_array, '<p class="green-notif-border">Youve already answer the ESAT Core Behavioral Competencies!</p>');
                else :
                    //array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT demographics yet! </p>');
                    array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT Core Behavioral Competencies   yet! </p>');
                endif;
                /* ************************************************************************************************************ */

                if ($check_e1_t and $check_e2_t and $check_e3_t) :
                    // CHECK IF THE ESAT IS ALREADY SUBMITTED OR SAVED
                    unset($notif_array);
                    $notif_array = [];
                    array_push($notif_array, '<p class="green-notif-border">You\'ve already taken the ESAT!</p>');
                elseif (!$check_e1_t and !$check_e2_t and !$check_e3_t) :
                    unset($notif_array);
                    $notif_array = [];
                    array_push($notif_array, '<p class="red-notif-border">You\'ve not taken the ESAT!</p>');
                endif;
                return $notif_array;
            else :
                return false;
            endif;
        else :
            array_push($notif_array, '<p class="red-notif-border">You dont have permission to take ESAT!</p>');
        endif;
    }

    public static function filterEsatT($position)
    {
        if (isset($position)) :
            if ((!strpos($position, 'eacher'))) :
                echo '<p class="red-notif-border">You dont have to take ESAT!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatMT($position)
    {
        if (!isset($position)) :
            if ((!strpos($position, 'aster'))) :
                echo '<p class="red-notif-border">You dont have to take ESAT!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }
}
