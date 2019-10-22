<?php

namespace FilterUser;

class FilterUser
{

    /* ------------------------------------------------------------------------ */
    public static function filterEsatDemo($conn, $position)
    {
        if (isset($position)) :
            if (strpos($position, 'rincipal') || (strpos($position, 'chool'))) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'includes/footer.php';
                die();

            elseif ((strpos($position, 'eacher'))) :
                $esat_demo_T = 'SELECT * FROM esat1_demographics_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_demo_T_result = mysqli_query($conn, $esat_demo_T);
                $check_e1_t = mysqli_num_rows($esat_demo_T_result);
                if ($check_e1_t) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Demographics!</p>';
                    include 'includes/footer.php';
                    exit();
                else : return false;
                endif;
            else :
                false;
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatT($conn, $position)
    {
        if (isset($position)) :
            if (strpos($position, 'rincipal') || (strpos($position, 'chool'))) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'includes/footer.php';
                die();

            elseif (strpos($position, 'aster')) :
                echo '<p class="red-notif-border">This part of ESAT is for Teachers only!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            elseif (strpos(($position), 'eacher')) :
                $esat_objective_T = 'SELECT * FROM `esat2_objectivest_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_objective_T_result = mysqli_query($conn, $esat_objective_T);
                $check_e2_t = mysqli_num_rows($esat_objective_T_result);
                if ($check_e2_t) :
                    echo '<p class="green-notif-border">Youve already answer the ESAT Objectives!</p>';
                    directLastPage();
                    include 'includes/footer.php';
                    die();
                else :
                    return false;
                endif;
            else : return false;
            endif;

        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatMT($conn, $position)
    {
        if (isset($position)) :
            if (strpos($position, 'rincipal') || (strpos($position, 'chool'))) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'includes/footer.php';
                die();

            elseif (!strpos($position, 'aster')) :
                echo '<p class="red-notif-border">This part of ESAT is for Master Teachers only!</p>';
                directLastPage();
                include 'includes/footer.php';
                die();
            elseif (strpos(($position), 'aster')) :
                $esat_objectivesmt_T = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_objective_MT_result = mysqli_query($conn, $esat_objectivesmt_T);
                $check_e2_mt = mysqli_num_rows($esat_objective_MT_result);

                if ($check_e2_mt) :
                    echo '<p class="green-notif-border">You have already answer the ESAT Objectives!</p>';
                    directLastPage();
                    include 'includes/footer.php';
                    die();
                else :
                    return false;
                endif;

            else : return false;
            endif;

        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterEsatCbc($conn, $position)
    {
        if (isset($position)) :
            if (strpos($position, 'rincipal') || (strpos($position, 'chool'))) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'includes/footer.php';
                die();

            elseif ((strpos($position, 'eacher'))) :
                $esat_cbc_T = 'SELECT * FROM esat3_core_behavioral_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_cbc_T_result = mysqli_query($conn, $esat_cbc_T);
                $check_e3_t = mysqli_num_rows($esat_cbc_T_result);
                if ($check_e3_t) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Core Behavioral Competencies!</p>';
                    include 'includes/footer.php';
                    exit();
                else : return false;
                endif;
            else :
                false;
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'includes/footer.php';
            die();
        endif;
    }

    public static function filterDevplan($conn, $position)
    {
        if ($position === "Admin" || $position === "School Head") :
            return  'school heads';
        elseif (stripos(($position), 'aster')) :
            return 'Master Teacher';
        elseif (stripos(($position), 'eacher')) :
            return 'Teacher';
        else :
            return '<p class="red-notif-border">You are not allowed! </p>';
        endif;
    }
}
