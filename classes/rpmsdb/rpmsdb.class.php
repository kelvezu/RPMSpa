<?php

namespace RPMSdb;

class RPMSdb
{
    public static function totalAllTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }

    public static function totalTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III") ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }

    public static function totalMasterTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return null;
        endif;
    }

    //CREATE A TOTAL OF TEACHERS WHO DONT HAVE AN ESAT

    public static function teachersNoEsat1($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographics_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function masterteachersNoEsat1($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographics_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';

        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function teachersNoEsat2($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioral_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function masterteachersNoEsat2($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat2_objectivesmt_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';

        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function teachersNoEsat3($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioral_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';

        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function masterteachersNoEsat3($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioral_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);
        $total1 = mysqli_num_rows($result1);
        if ($total1) :
            return $total1;
        else :
            false;
        endif;
    }

    public static function totalTCompleteESAT($conn)
    {
        $esat3 = teachersNoEsat3($conn);
        $esat2 =  teachersNoEsat2($conn);
        $esat1 =  teachersNoEsat1($conn);
        if ($esat1 and $esat2 and $esat3) :
            return 'true';
        else :
            return false;
        endif;
    }
}
