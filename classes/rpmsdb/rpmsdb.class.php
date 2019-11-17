<?php


namespace RPMSdb;

use mysqli;





class RPMSdb
{
    public static function mtobjectiveSy($conn)
    {
        $result_arr = [];
        $query = "SELECT  DISTINCT
                    c.sy_desc
                    
                    from mtobj_tbl a INNER JOIN esat2_objectivesmt_tbl b ON a.mtobj_id = b.mtobj_id
                    
                INNER JOIN sy_tbl c on b.sy = c.sy_id
                group by a.kra_id,a.mtobj_id";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function tobjectiveSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT a.region_name, COUNT(b.user_id)total,b.sy from region_tbl a 
                    INNER JOIN esat1_demographicst_tbl b on a.reg_id = b.region GROUP by a.region_name
                    
                    UNION ALL
                    
                    SELECT a.region_name, COUNT(b.user_id)total,b.sy from region_tbl a 
                    INNER JOIN esat1_demographicsmt_tbl b on a.reg_id = b.region GROUP by a.region_name
                    )a
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    
                    GROUP BY a.region_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function regionSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT a.region_name, COUNT(b.user_id)total,b.sy from region_tbl a 
                    INNER JOIN esat1_demographicst_tbl b on a.reg_id = b.region GROUP by a.region_name
                    
                    UNION ALL
                    
                    SELECT a.region_name, COUNT(b.user_id)total,b.sy from region_tbl a 
                    INNER JOIN esat1_demographicsmt_tbl b on a.reg_id = b.region GROUP by a.region_name
                    )a
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    
                    GROUP BY a.region_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function curriclassSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT curri_class,COUNT(DISTINCT user_id)total,sy FROM esat1_demographicst_tbl GROUP BY curri_class
                    UNION ALL
                    SELECT curri_class,COUNT(DISTINCT user_id)total,sy FROM esat1_demographicsmt_tbl GROUP BY curri_class
                    )a
                    INNER JOIN sy_tbl b on a.sy=b.sy_id
                    INNER JOIN curriclass_tbl c on a.curri_class = c.curriclass_id
                    GROUP BY c.curriclass_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function gradelvlSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                     SELECT a.gradelvltaught_name, COUNT(b.user_id)total,sy from gradelvltaught_tbl a 
                    INNER JOIN esat1_demographicst_tbl b on b.grade_lvl_taught LIKE CONCAT('%', a.gradelvltaught_id, '%') 
                    GROUP by a.gradelvltaught_id
                    
                    UNION ALL
                    
                    SELECT a.gradelvltaught_name, COUNT(b.user_id)total,sy from gradelvltaught_tbl a 
                    INNER JOIN esat1_demographicsmt_tbl b on b.grade_lvl_taught LIKE CONCAT('%', a.gradelvltaught_id, '%') 
                    GROUP by a.gradelvltaught_id
                    ) a
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    GROUP BY a.gradelvltaught_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function subjtaughtSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT a.subject_name, COUNT(b.user_id)total,sy from subject_tbl a INNER JOIN esat1_demographicst_tbl b on b.subject_taught LIKE CONCAT('%', a.subject_name, '%') GROUP by a.subject_name
                    UNION ALL
                    SELECT a.subject_name, COUNT(b.user_id)total,sy from subject_tbl a INNER JOIN esat1_demographicsmt_tbl b on b.subject_taught LIKE CONCAT('%', a.subject_name, '%') GROUP by a.subject_name
                    ) a
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    GROUP BY a.subject_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }


    public static function totalyearSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT totalyear,COUNT(user_id)total,sy from esat1_demographicst_tbl GROUP by totalyear
                    UNION ALL
                    SELECT totalyear,COUNT(user_id)total,sy from esat1_demographicsmt_tbl GROUP by totalyear
                    ) a
                    
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    INNER JOIN totalyear_tbl c on a.totalyear=c.totalyear_id
                    
                    GROUP BY c.totalyear_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function degreeSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT highest_degree, COUNT(user_id) total,sy from esat1_demographicst_tbl GROUP by highest_degree
                    UNION ALL
                    SELECT highest_degree, COUNT(user_id) total,sy from esat1_demographicsmt_tbl GROUP by highest_degree
                    )a
                    
                    INNER JOIN sy_tbl b on a.sy=b.sy_id
                    
                    GROUP BY a.highest_degree";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function positionSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM
                    (
                    SELECT position, COUNT(user_id)total,sy from  esat1_demographicst_tbl  GROUP by position
                    UNION ALL
                    SELECT position, COUNT(user_id)total,sy from  esat1_demographicsmt_tbl  GROUP by position
                    ) a
                    
                    INNER JOIN sy_tbl b on a.sy = b.sy_id
                    GROUP BY a.position
                    order BY a.position desc";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function empstatSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT b.sy_desc FROM 
                    (
                        SELECT employment_status, COUNT(user_id) total,sy FROM esat1_demographicst_tbl GROUP BY employment_status
                        UNION ALL
                        SELECT  employment_status, COUNT(user_id) total,sy FROM esat1_demographicsmt_tbl GROUP BY employment_status
                    ) a 
                INNER JOIN sy_tbl b on a.sy = b.sy_id
                GROUP BY a.employment_status";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }


    public static function genderSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT c.sy_desc FROM
                    (                        
                    SELECT gender, COUNT(user_id) total,sy FROM esat1_demographicst_tbl GROUP BY gender
                    UNION ALL
                    SELECT gender, COUNT(user_id) total,sy FROM esat1_demographicsmt_tbl GROUP BY gender
                    ) a
                    
                    INNER JOIN sy_tbl c on a.sy = c.sy_id
                    INNER JOIN gender_tbl b on a.gender = b.gender_id
                    GROUP BY a.gender";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function ageSy($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT c.sy_desc FROM
                    (                        
                    SELECT age, COUNT(user_id) total,sy FROM esat1_demographicst_tbl GROUP BY age
                    UNION ALL
                    SELECT age, COUNT(user_id) total,sy FROM esat1_demographicsmt_tbl GROUP BY age
                    ) a
                    
                    INNER JOIN age_tbl b on a.age = b.age_id
                    INNER JOIN sy_tbl c on a.sy = c.sy_id
                    GROUP BY b.age_name";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function esatSY($conn)
    {
        $result_arr = [];
        $query = "SELECT DISTINCT School_Year as sy_esat from tbl_rptwithesat where School_Year is not null";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function mteacherSYass($conn)
    {
        $result_arr = [];
        $query2 = "SELECT distinct c.sy_desc as mtyear2
            FROM esat2_objectivesmt_tbl a INNER JOIN mtobj_tbl b on a.mtobj_id = b.mtobj_id
            INNER JOIN sy_tbl c on a.sy = c.sy_id
            group by c.sy_desc";

        $result2 = mysqli_query($conn, $query2);
        foreach ($result2 as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function mteacherSYcbc($conn)
    {
        $result_arr = [];
        $query = "SELECT distinct c.sy_desc as mtyear1 FROM core_behavioral_tbl a 
            INNER JOIN 
            esat3_core_behavioralmt_tbl b  on a.cbc_id = b.cbc_id 
            INNER JOIN sy_tbl c on b.sy = c.sy_id
            group by c.sy_desc";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }


    public static function teacherSYcbc($conn)
    {
        $result_arr = [];
        $query = "SELECT distinct c.sy_desc as tyear1 FROM core_behavioral_tbl a 
                INNER JOIN 
                esat3_core_behavioralt_tbl b  on a.cbc_id = b.cbc_id 
                INNER JOIN sy_tbl c on b.sy = c.sy_id
                group by c.sy_desc";

        $result = mysqli_query($conn, $query);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function teacherSYass($conn)
    {
        $result_arr = [];
        $query2 = "SELECT distinct c.sy_desc as tyear2
            FROM esat2_objectivest_tbl a INNER JOIN tobj_tbl b on a.tobj_id = b.tobj_id
            INNER JOIN sy_tbl c on a.sy = c.sy_id
            group by c.sy_desc";

        $result2 = mysqli_query($conn, $query2);
        foreach ($result2 as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    // DISPLAY ALL TEACHERS ACCORDING TO USERS SCHOOL
    public static function displayMasterList($conn)
    {
        $user_arr = [];
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") ORDER BY notif_id desc  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            foreach ($result as $res) :
                array_push($user_arr, $res);
            endforeach;
            return $user_arr;
        else :
            return false;
        endif;
    }

    // DISPLAY ALL TEACHERS WITH FOR TRANSFER STATUS
    public static function displayVacantList($conn)
    {
        $user_arr = [];
        $totalqry = 'SELECT * FROM account_tbl WHERE  `status` = "For Transfer" AND school_id is NULL  AND position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") ORDER BY `user_id` desc  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            foreach ($result as $res) :
                array_push($user_arr, $res);
            endforeach;
            return $user_arr;
        else :
            return false;
        endif;
    }

    public static function totalAllTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  ';
        $result = mysqli_query($conn, $totalqry);
        $total = mysqli_num_rows($result);
        if ($total) :
            return $total;
        else :
            return false;
        endif;
    }

    public static function totalTeachers($conn)
    {
        $totalqry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND status = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III") ';
        $result = mysqli_query($conn, $totalqry);

        if (!empty($result)) :
            return  mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }
    //TOTAL OF ALL ACTIVE TEACHERS
    public static function totalTeachersCount($conn)
    {
        // $totalqry = 'SELECT COUNT(IF(`status` = "Active",1,NULL)) as "Total" FROM account_tbl WHERE position IN ("Teacher I", "Teacher II", "Teacher III","Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")';
        $totalqry = 'SELECT * FROM account_tbl WHERE (POSITION LIKE "Master%" OR POSITION LIKE "Teacher%") AND school_id is not null AND `status` = "Active" ';
        $result = mysqli_query($conn, $totalqry);


        if (!empty($result)) :
            return  mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public static function totalTOnlyCount($conn)
    {
        // $totalqry = 'SELECT COUNT(IF(`status` = "Active",1,NULL)) as "Total" FROM account_tbl WHERE position IN ("Teacher I", "Teacher II", "Teacher III")';
        $totalqry = 'SELECT * FROM account_tbl WHERE POSITION LIKE "Teacher%" AND school_id is not null AND `status` = "Active" ';
        $result = mysqli_query($conn, $totalqry);
        if (!empty($result)) :
            return  mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public static function totalMTOnlyCount($conn)
    {
        // $totalqry = 'SELECT COUNT(IF(`status` = "Active",1,NULL)) as "Total" FROM account_tbl WHERE position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")';
        $totalqry = 'SELECT * FROM account_tbl WHERE POSITION LIKE "Master%" AND school_id is not null';
        $result = mysqli_query($conn, $totalqry);
        if (!empty($result)) :
            return  mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public static function totalTeacherPerSchool($conn)
    {
        $result_arr = [];
        $totalqry = 'SELECT * FROM `total_teachers_per_school`';
        $result = mysqli_query($conn, $totalqry);

        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return  $result_arr;
        else :
            return false;
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
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographicst_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);

        if (!empty($result1)) :
            return  mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function teachersWithEsat1($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE `user_id` IN (SELECT `user_id` FROM esat1_demographicst_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);

        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function masterteachersWithEsat1($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE `user_id` IN (SELECT `user_id` FROM esat1_demographicsmt_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);

        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }



    public static function masterteachersNoEsat1($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographicsmt_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);

        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function teachersNoEsat2($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat2_objectivest_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);
        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function masterteachersNoEsat2($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat2_objectivesmt_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';

        $result1 = mysqli_query($conn, $qryesat1);
        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function teachersNoEsat3($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralt_tbl WHERE `user_id` is not null AND sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III")  AND `status` = "Active"';

        $result1 = mysqli_query($conn, $qryesat1);
        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function masterteachersNoEsat3($conn)
    {
        $qryesat1 = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralmt_tbl WHERE  sy = "' . $_SESSION['active_sy_id'] . '" AND school = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV")  AND `status` = "Active"';
        $result1 = mysqli_query($conn, $qryesat1);
        if (!empty($result1)) :
            return mysqli_num_rows($result1);
        else :
            return 0;
        endif;
    }

    public static function teachersWithCOT1($conn)
    {
        //THE OUTPUT OF THIS FUNCTION WILL BE AN ARRAY
        $result_arr = [];
        $qry = 'SELECT * FROM `account_tbl` WHERE  `user_id` IN (SELECT `user_id` FROM a_tioafrating_tbl WHERE obs_period = 1 AND `tioafrating` IS NOT NULL AND status = "Active" AND  school_id ="' . $_SESSION['school_id'] . '" AND position IN ("Teacher I", "Teacher II", "Teacher III"))  AND school_id =' . $_SESSION['school_id'] . ' AND position IN ("Teacher I", "Teacher II", "Teacher III") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }

    public static function teacherHasCOT1($conn, $user_id)
    {
        $qry = 'SELECT * FROM a_tioafrating_tbl WHERE obs_period = 1 AND `user_id` = ' . $user_id . ' AND `status` = "Active" AND  school_id ="' . $_SESSION['school_id'] . '" AND position IN ("Teacher I", "Teacher II", "Teacher III")';
        $result = mysqli_query($conn, $qry);
        if ($result) :
            $count = mysqli_num_rows($result);
            if ($count > 0) :
                return true;
            else : return false;
            endif;
        else : return false;
        endif;
    }

    public static function masterteachersWithCOT1($conn)
    {
        //THE OUTPUT OF THIS FUNCTION WILL BE AN ARRAY
        $result_arr = [];
        $qry = 'SELECT * FROM `account_tbl` WHERE  `user_id` IN (SELECT `user_id` FROM a_mtioafrating_tbl WHERE `tioafrating` IS NOT NULL AND status = "Active" AND  school_id ="' . $_SESSION['school_id'] . '" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV"))  AND school_id = ' . $_SESSION['school_id'] . ' AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV") AND `status` = "Active" ';

        $result = mysqli_query($conn, $qry);
        foreach ($result as $res) :
            array_push($result_arr, $res);
        endforeach;
        return $result_arr;
        exit;
    }


    public static function teachersNoCOT1($conn)
    {
        //THE OUTPUT OF THIS FUNCTION WILL BE AN ARRAY
        $result_arr = [];
        $qry = 'SELECT * FROM `account_tbl` WHERE  rater = "' . $_SESSION['user_id'] . '" AND NOT `user_id` IN (SELECT `user_id` FROM a_tioafrating_tbl WHERE `user_id` IS NOT NULL AND status = "Active" AND school_id = ' . $_SESSION['school_id'] . ' AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND school_id =' . $_SESSION['school_id'] . ' AND position IN ("Teacher I", "Teacher II", "Teacher III") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        if ($result) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else :
            return null;
        endif;
        exit;
    }

    public static function masterteachersNoCOT1($conn)
    {
        //THE OUTPUT OF THIS FUNCTION WILL BE AN ARRAY
        $result_arr = [];
        $qry = 'SELECT * FROM `account_tbl` WHERE rater = ' . $_SESSION['user_id'] . ' AND NOT `user_id` IN (SELECT `user_id` FROM a_mtioafrating_tbl WHERE `user_id` IS NOT NULL AND status = "Active" AND school_id = ' . $_SESSION['school_id'] . ' AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND school_id =' . $_SESSION['school_id'] . ' AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV") AND `status` = "Active" ';

        $result = mysqli_query($conn, $qry);
        if ($result) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else :
            return null;
        endif;
        exit;
    }



    /* FUNCTION THAT WILL CHECK IF ESAT IS COMPLETE */
    public static function isEsatComplete($conn, $position)
    {
        if (isset($position)) :
            if (stripos(($position), 'aster')) :
                $esat1qry = 'SELECT * FROM esat1_demographicsmt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

                $esat2qry = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

                $esat3qry = 'SELECT * FROM esat3_core_behavioralmt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

            elseif ($position = 'Teacher I' || $position = 'Teacher II' || $position = 'Teacher III') :
                $esat1qry = 'SELECT * FROM esat1_demographicst_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

                $esat2qry = 'SELECT * FROM `esat2_objectivest_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $_SESSION['user_id'] . '" AND status = "Active" ';

                $esat3qry = 'SELECT * FROM esat3_core_behavioralt_tbl WHERE school = ' . $_SESSION['school_id'] . ' AND sy = ' . $_SESSION['active_sy_id'] . ' AND `user_id` = ' . $_SESSION['user_id'] . ' AND `status` = "Active" ';

            else : return false;
            endif;

            $esat1result = mysqli_query($conn, $esat1qry);
            $esat1res = mysqli_num_rows($esat1result);
            $esat2result = mysqli_query($conn, $esat2qry);
            $esat2res = mysqli_num_rows($esat2result);
            $esat3result = mysqli_query($conn, $esat3qry);
            $esat3res = mysqli_num_rows($esat3result);

            if ($esat1res and $esat2res and $esat3res) :
                echo '<p class="green-notif-border">You have already taken the ESAT.</p>';
                directLastPage();
                include 'includes/footer.php';
                exit();
            else :
                return false;
            endif;

        else : return false;
        endif;
    }

    public static function isEsatCompleteBool($conn, $position, $user_id)
    {
        if (isset($position)) :
            if ($position == "Master Teacher I" || $position == "Master Teacher II" ||  $position == "Master Teacher III" || $position == "Master Teacher IV") :
                $esat1qry = 'SELECT * FROM esat1_demographicsmt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

                $esat2qry = 'SELECT * FROM `esat2_objectivesmt_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

                $esat3qry = 'SELECT * FROM esat3_core_behavioralmt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

            elseif (stripos(($position), 'eacher')) :

                $esat1qry = 'SELECT * FROM esat1_demographicst_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

                $esat2qry = 'SELECT * FROM `esat2_objectivest_tbl` WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

                $esat3qry = 'SELECT * FROM esat3_core_behavioralt_tbl WHERE school = "' . $_SESSION['school_id'] . '" AND sy = "' . $_SESSION['active_sy_id'] . '" AND user_id = "' . $user_id . '" AND status = "Active" ';

            else : return false;
            endif;




            $esat1result = mysqli_query($conn, $esat1qry);
            $esat1res = mysqli_num_rows($esat1result);
            $esat2result = mysqli_query($conn, $esat2qry);
            $esat2res = mysqli_num_rows($esat2result);
            $esat3result = mysqli_query($conn, $esat3qry);
            $esat3res = mysqli_num_rows($esat3result);

            if ($esat1res and $esat2res and $esat3res) :
                return true;
            else :
                return false;
            endif;

        else : return false;
        endif;
    }

    /* TOTAL OF T WITH WITH NO OR INCOMPLETE ESAT! */
    public  static function totalofNoESAT_t($conn)
    {
        $qry = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographicst_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND NOT `user_id` IN (SELECT `user_id` FROM esat2_objectivest_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            return mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }
    /* TOTAL OF MT WITH WITH NO OR INCOMPLETE ESAT! */
    public  static function totalofNoESAT_mt($conn)
    {
        $qry = 'SELECT * FROM `account_tbl` WHERE NOT `user_id` IN (SELECT `user_id` FROM esat1_demographicsmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND NOT `user_id` IN (SELECT `user_id` FROM esat2_objectivesmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND NOT `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            return mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public  static function totalofCompleteESAT_mt($conn)
    {
        $qry = 'SELECT * FROM `account_tbl` WHERE  `user_id` IN (SELECT `user_id` FROM esat1_demographicsmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND  `user_id` IN (SELECT `user_id` FROM esat2_objectivesmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND  `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralmt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV")) AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III","Master Teacher IV") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            return mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public  static function totalofCompleteESAT_t($conn)
    {
        $qry = 'SELECT * FROM `account_tbl` WHERE  `user_id` IN (SELECT `user_id` FROM esat1_demographicst_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND  `user_id` IN (SELECT `user_id` FROM esat2_objectivest_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND  `user_id` IN (SELECT `user_id` FROM esat3_core_behavioralt_tbl WHERE `user_id` is not null AND sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Active" AND position IN ("Teacher I", "Teacher II", "Teacher III")) AND position IN ("Teacher I", "Teacher II", "Teacher III") AND `status` = "Active"';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            return mysqli_num_rows($result);
        else :
            return 0;
        endif;
    }

    public static function sessionObsPeriod($conn, $position)
    {
        $result_array = [];
        $qry = 'SELECT * FROM obs_period_tbl WHERE `status` = "Active" ';
        $result = mysqli_query($conn, $qry);

        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_array, $res);
            endforeach;

            return $result_array;
        else :
            if (stripos($position, 'rincipal')) :
                echo '<p class="green-notif-border">Click <a href="setobsperiod.php">here</a> to set the Observation Period.</p>';
            else : return false;
            endif;
        endif;
    }

    public static function showNotif($conn)
    {
        $notif_arr = [];
        $qry = 'SELECT * FROM notification_tbl WHERE `status` = "Active" AND sy_id =  "' . $_SESSION['active_sy_id'] . '" ORDER BY notif_id desc LIMIT 6';
        $result = mysqli_query($conn, $qry);
        if ($result) :
            foreach ($result as $res) :
                array_push($notif_arr, $res);
            endforeach;
            return $notif_arr;
        else :
            return false;
        endif;
    }

    public static function showAllNotif($conn)
    {
        $notif_arr = [];
        $qry = 'SELECT * FROM notification_tbl WHERE `status` = "Active" AND sy_id =  "' . $_SESSION['active_sy_id'] . '" ORDER BY notif_id';
        $result = mysqli_query($conn, $qry);
        if ($result) :
            foreach ($result as $res) :
                array_push($notif_arr, $res);
            endforeach;
            return $notif_arr;
        else :
            return false;
        endif;
    }

    public static function showAnnouncement($conn, $sy, $limit = 6)
    {
        $notif_arr = [];

        $qry = "SELECT * FROM announcement_tbl WHERE `status` = 'Active' AND sy_id =  $sy ORDER BY id desc LIMIT $limit";
        $result = mysqli_query($conn, $qry);

        if ($result) :
            foreach ($result as $res) :
                array_push($notif_arr, $res);
            endforeach;
            return $notif_arr;
        else :
            return false;
        endif;
    }

    public static function showAllAnnouncement($conn)
    {
        $notif_arr = [];
        $qry = "SELECT * FROM announcement_tbl ORDER BY id desc";
        $result = mysqli_query($conn, $qry);
        if ($result) :
            foreach ($result as $res) :
                array_push($notif_arr, $res);
            endforeach;
            return $notif_arr;
        else :
            return false;
        endif;
    }

    public static function displayAnnouncement($conn, $id)
    {
        $notif_arr = [];

        $qry = 'SELECT * FROM announcement_tbl WHERE `status` = "Active"  AND id = "' . $id . '" ORDER BY id desc LIMIT 6';
        $result = mysqli_query($conn, $qry);

        if ($result) :
            foreach ($result as $res) :
                array_push($notif_arr, $res);
            endforeach;
            return $notif_arr;
        else :
            return false;
        endif;
    }

    // display all Principal 

    public static function showAllPrincipal($conn)
    {
        $qry = 'SELECT * FROM account_tbl WHERE position = "Principal" and `status` = "Active"';
        $result = mysqli_query($conn, $qry);

        if (mysqli_num_rows($result) > 0) {
            $result_array = [];

            foreach ($result as $res) :
                array_push($result_array, $res);
            endforeach;
            return $result_array;
        }
    }

    public static function showAllCBC()
    { }
}
