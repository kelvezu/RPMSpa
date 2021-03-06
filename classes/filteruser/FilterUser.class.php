<?php

namespace FilterUser;

class FilterUser
{

    /* ------------------------------------------------------------------------ */
    public static function filterEsatDemo($conn, $position)
    {
        if (isset($position)) :
            if (stripos($position, 'dmin') || stripos($position, 'rincipal') || stripos($position, 'uperintendent') || stripos($position, 'chool')) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'samplefooter.php';
                die();

            elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                $esat_demo_T = 'SELECT * FROM esat1_demographicsMT_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_demo_T_result = mysqli_query($conn, $esat_demo_T);
                $check_e1_t = mysqli_num_rows($esat_demo_T_result);
                if ($check_e1_t > 0) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Demographics! Do you want to update your answer? Click <a href="ESATform1update.php">here.</a></p>
                    <p class="green-notif-border">Proceed to Part II. Click <a href="ESATform2mt.php">here</a></p>';
                    include 'samplefooter.php';
                    exit();
                else :
                    return false;

                endif;

            elseif ($position = "Teacher I" ||  $position = "Teacher II" ||  $position = "Teacher III") :
                $esat_demo_T = 'SELECT * FROM esat1_demographicst_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_demo_T_result = mysqli_query($conn, $esat_demo_T);
                $check_e1_t = mysqli_num_rows($esat_demo_T_result);
                if ($check_e1_t > 0) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Demographics! Do you want to update your answer? Click <a href="ESATform1update.php">here.</a></p>
                        <p class="green-notif-border">Proceed to Part II. Click <a href="ESATform2t.php">here</a></p>';
                    
                    include 'samplefooter.php';
                    exit();
                else :
                    return false;

                endif;
            else :
                false;
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'samplefooter.php';
            die();
        endif;
    }

    public static function filterEsatT($conn, $position)
    {
        if (isset($position)) :
            if (stripos($position, 'dmin') || stripos($position, 'rincipal') || stripos($position, 'uperintendent') || stripos($position, 'chool')) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="gendevplant.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'samplefooter.php';
                die();

            elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                echo '<p class="red-notif-border">This part of ESAT is for Teachers only!</p>';
                directLastPage();
                include 'samplefooter.php';
                die();
            elseif ($position == 'Teacher I' || $position == 'Teacher II' || $position == 'Teacher III') :
                $esat_objective_T = 'SELECT * FROM `esat2_objectivest_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_objective_T_result = mysqli_query($conn, $esat_objective_T);
                $check_e2_t = mysqli_num_rows($esat_objective_T_result);
                if ($check_e2_t) :
                    echo '<p class="green-notif-border">You have already answer the ESAT Objectives! Do you want to update your answer? Click <a href="ESATform2tupdate.php">here.</a></p>
                    <p class="green-notif-border">Proceed to Part III. Click <a href="ESATform3.php">here</a></p>';
                    directLastPage();
                    include 'samplefooter.php';
                    die();
                else :
                    return false;
                endif;
            else : return false;
            endif;

        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'samplefooter.php';
            die();
        endif;
    }

    public static function filterEsatMT($conn, $position)
    {
        if (isset($position)) :
            if (stripos($position, 'dmin') || stripos($position, 'rincipal') || stripos($position, 'uperintendent') || stripos($position, 'chool')) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="gendevplanmt.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'samplefooter.php';
                die();

            elseif ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :
                echo '<p class="red-notif-border">This part of ESAT is for Master Teachers only!</p>';
                directLastPage();
                include 'samplefooter.php';
                die();
            elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                $esat_objectivesmt_T = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_objective_MT_result = mysqli_query($conn, $esat_objectivesmt_T);
                $check_e2_mt = mysqli_num_rows($esat_objective_MT_result);

                if ($check_e2_mt) :
                    echo '<p class="green-notif-border">You have already answer the ESAT Objectives! Do you want to update your answer? Click <a href="ESATform2MTupdate.php">here.</a></p>
                     <p class="green-notif-border">Proceed to Part III. Click <a href="ESATform3.php">here</a></p>';
                    directLastPage();
                    include 'samplefooter.php';
                    die();
                else :
                    return false;
                endif;

            else : return false;
            endif;

        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'samplefooter.php';
            die();
        endif;
    }

    public static function filterEsatCbc($conn, $position)
    {
        if (isset($position)) :
            if (stripos($position, 'dmin')) :
                echo '<p class="green-notif-border">
                ESAT is only available for Master Teachers and Teachers only.
                Click <a href="devplan.php">here</a> to proceed to the Development Plan.       
                </p>';
                directLastPage();
                include 'samplefooter.php';
                die();

            elseif ($position == "Master Teacher I" || $position == "Master Teacher II" || $position == "Master Teacher III" || $position == "Master Teacher IV") :
                $esat_cbc_T = 'SELECT * FROM esat3_core_behavioralmt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_cbc_T_result = mysqli_query($conn, $esat_cbc_T);
                $check_e3_t = mysqli_num_rows($esat_cbc_T_result);
                if ($check_e3_t) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Core Behavioral Competencies! Do you want to update your answer? Click <a href="ESATform3update.php">here.</a></p>';
                    include 'samplefooter.php';
                    exit();
                else : return false;
                endif;

            elseif ($position == "Teacher I" || $position == "Teacher II" || $position == "Teacher III") :
                $esat_cbc_T = 'SELECT * FROM esat3_core_behavioralt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';
                $esat_cbc_T_result = mysqli_query($conn, $esat_cbc_T);
                $check_e3_t = mysqli_num_rows($esat_cbc_T_result);
                if ($check_e3_t) :
                    echo  '<p class="green-notif-border">You have already taken the ESAT Core Behavioral Competencies! Do you want to update your answer? Click <a href="ESATform3update.php">here.</a></p>';
                    include 'samplefooter.php';
                    exit();
                else : return false;
                endif;
            else :
                false;
            endif;
        else :
            echo '<p class="red-notif-border">You dont have permission to take ESAT!</p>';
            directLastPage();
            include 'samplefooter.php';
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

    public static function filterDevplanTUsers($position)
    {
        if (stripos($position, 'dmin') || stripos($position, 'rincipal') || stripos($position, 'uperintendent') || stripos($position, 'chool') || stripos($position, 'aster')) :
            return true;
        else : echo '<p class="red-notif-border">You dont have access to this page!</p>';
            include 'samplefooter.php';
            exit();
        endif;
    }

    public static function filterDevplanMTUsers($position)
    {
        if (stripos($position, 'dmin') || stripos($position, 'rincipal') || stripos($position, 'uperintendent') || stripos($position, 'chool')) :
            return true;
        else : echo '<p class="red-notif-border">You dont have access to this page!</p>';
            include 'samplefooter.php';
            exit();
        endif;
    }

    public static function filterObsPeriod($position)
    {
        if (!stripos($position, 'rincipal')) :
            echo '<p class="red-notif-border">Only the Principal can set the Obervation Period!</p><center/>';
            directLastPage();
            include 'samplefooter.php';
            die();

        else : return false;
        endif;
    }
}
