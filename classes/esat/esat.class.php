<?php

namespace ESAT;

class ESAT
{


    public static function esatStatus($conn, $position)
    {
        $notif_array = [];
        $esat1qryT = 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND position IN ("Teacher I","Teacher II","Teacher III") ';
        $fetchESAT1result = mysqli_query($conn, $esat1qryT);
        $esat1resultT = mysqli_num_rows($fetchESAT1result);

        //QUERY FOR TEACHER



        if (isset($position)) :

            if (strpos(($position), 'rincipal') || strpos(($position), 'chool Head')) :
                echo "You are Qualified!";
                include 'includes/footer.php';
                exit();

            elseif (strpos(($position), 'eacher')) :
                /* CHECK IF THE USER HAS TAKEN ESAT DEMOGRAPHICS */
                $esat_demo_T = 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" ';
                $esat_demo_T_result = mysqli_query($conn, $esat_demo_T);
                $check_e1_t = mysqli_num_rows($esat_demo_T_result);
                if ($check_e1_t) :
                    array_push($notif_array, '<p class="green-notif-border"></p>');
                else :
                    array_push($notif_array, '<p class="red-notif-border"> You dont have ESAT demographics yet! </p>');
                endif;
                /* ********************************************************************************************************* */
                return $notif_array;
                exit();
            else :
                return false;
                exit();
            endif;


        // echo $_SESSION['position'] . BR;
        // AND `status` = Active 

        /* ESAT RESULT OF ESAT DEMOGRAPHICS */



        else :
            echo '<p class="red-notif-border">You dont have position!</p>';
            include 'includes/footer.php';
            die();

        endif;
    }
}
