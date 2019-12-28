<?php

namespace DevPlan;



class DevPlan
{

    public $servername = "localhost";
    public $dbUsername = "root";
    public $dbPassword = "";
    public $dbName = "rpms";

    public function __construct($user, $sy, $school, $position)
    {
        $this->user = $user;
        $this->sy = $sy;
        $this->school = $school;
        $this->position = $position;
    }

    public function conn()
    {
        $this->servername;
        $this->dbUsername;
        $this->dbPassword;
        $this->dbName;
        $conn =  mysqli_connect($this->servername,  $this->dbUsername,  $this->dbPassword,  $this->dbName);
        if (!$conn) {
            return  die("Connection Failed: " . mysqli_connect_error());
        }
        return $conn;
    }


    /* STRENGTH IN DEVPLAN FOR MT */
    public static function showStrDevplanMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE sy = ' . $_SESSION["active_sy_id"] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivesmt_tbl.status = "Active" AND esat2_objectivesmt_tbl.lvlcap >= 3  AND esat2_objectivesmt_tbl.priodev < 3 GROUP by esat2_objectivesmt_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    // DISPLAY THE STRENGTH OF TEACHER IN DEVPLAN
    public static function showStrDevplanT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, tobj_tbl. tobj_name, esat2_objectivest_tbl.* FROM ( esat2_objectivest_tbl INNER JOIN kra_tbl ON esat2_objectivest_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN tobj_tbl ON esat2_objectivest_tbl.tobj_id = tobj_tbl.tobj_id WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivest_tbl.status = "Active" AND esat2_objectivest_tbl.lvlcap >= 3 AND esat2_objectivest_tbl.priodev < 3 GROUP by esat2_objectivest_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (!empty(mysqli_num_rows($results))) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : echo '<p class="red-notif-border">No record!</p>';
        endif;
    }


    //DISPLAY THE PRIORITY FOR DEVELOPMENT OF MASTER TEACHER
    public static function showPrioDevplanMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, mtobj_tbl.mtobj_name, esat2_objectivesmt_tbl.* FROM ( esat2_objectivesmt_tbl INNER JOIN kra_tbl ON esat2_objectivesmt_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN mtobj_tbl ON esat2_objectivesmt_tbl.mtobj_id = mtobj_tbl.mtobj_id WHERE sy = ' . $_SESSION["active_sy_id"] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivesmt_tbl.status = "Active" AND esat2_objectivesmt_tbl.lvlcap < 3 AND esat2_objectivesmt_tbl.priodev >= 3 GROUP by esat2_objectivesmt_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 2';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    //DISPLAY THE PRIORITY FOR DEVELOPMENT OF TEACHER
    public static function showPrioDevplanT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT kra_tbl.kra_name, tobj_tbl.tobj_name, esat2_objectivest_tbl.* FROM ( esat2_objectivest_tbl INNER JOIN kra_tbl ON esat2_objectivest_tbl.kra_id = kra_tbl.kra_id ) INNER JOIN tobj_tbl ON esat2_objectivest_tbl.tobj_id = tobj_tbl.tobj_id WHERE sy = ' . $_SESSION["active_sy_id"] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat2_objectivest_tbl.status = "Active" AND esat2_objectivest_tbl.lvlcap < 3 AND esat2_objectivest_tbl.priodev >= 3 GROUP by esat2_objectivest_tbl.kra_id ORDER BY lvlcap desc, priodev LIMIT 2';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : echo '<p class="red-notif-border">No record!</p>';
        endif;
    }

    public static function showStrIndicatorT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioralt_tbl.cbc_score) as CBC_scores, esat3_core_behavioralt_tbl.* FROM (esat3_core_behavioralt_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioralt_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioralt_tbl.status = "Active"   GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioralt_tbl.cbc_score) >= 3 ORDER BY CBC_SCORES DESC LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else :  echo '<p class="red-notif-border">No record!</p>';
        endif;
    }

    public static function showStrIndicatorMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioralmt_tbl.cbc_score) as CBC_scores, esat3_core_behavioralmt_tbl.* FROM (esat3_core_behavioralmt_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioralmt_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioralmt_tbl.status = "Active" GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioralmt_tbl.cbc_score) >= 3 ORDER BY CBC_SCORES DESC LIMIT 3';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevNeedsIndicatorMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioralmt_tbl.cbc_score) as CBC_scores, esat3_core_behavioralmt_tbl.* FROM (esat3_core_behavioralmt_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioralmt_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioralmt_tbl.status = "Active" AND position IN ("Master Teacher I", "Master Teacher II", "Master Teacher III", "Master Teacher IV") GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioralmt_tbl.cbc_score) ORDER BY CBC_SCORES LIMIT 2';

        $results = mysqli_query($conn, $qry) or die($conn->error);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevNeedsIndicatorT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT core_behavioral_tbl.cbc_id,core_behavioral_tbl.cbc_name, SUM(esat3_core_behavioralt_tbl.cbc_score) as CBC_scores, esat3_core_behavioralt_tbl.* FROM (esat3_core_behavioralt_tbl INNER JOIN core_behavioral_tbl on esat3_core_behavioralt_tbl.cbc_id = core_behavioral_tbl.cbc_id) WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND esat3_core_behavioralt_tbl.status = "Active"  GROUP by core_behavioral_tbl.cbc_id HAVING SUM(esat3_core_behavioralt_tbl.cbc_score) ORDER BY CBC_SCORES  LIMIT 2';

        $results = mysqli_query($conn, $qry);
        if (mysqli_num_rows($results)) :
            foreach ($results as $result) :
                array_push($result_arr, $result);
            endforeach;
            return $result_arr;
        else :  echo '<p class="red-notif-border">No record!</p>';
        endif;
    }

    public static function showAllAvailRaterforMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Principal", "School Head" ) ';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showAllAvailRaterforT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Principal", "School Head","Head Teacher","Assistant Principal","Master Teacher I","Master Teacher II","Master Teacher III","Master Teacher IV") ';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showAllAppAuthforMT($conn)
    {
        $result_arr = [];
        $qry = 'SELECT * FROM account_tbl WHERE school_id = "' . $_SESSION['school_id'] . '" AND `status` = "Active" AND position IN ("Superintendent","Assistant Superintendent","Principal") ';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showAllAppAuthforT($conn, $school)
    {
        $result_arr = [];
        $qry = 'SELECT * FROM account_tbl WHERE school_id = ' . $school . ' AND `status` = "Active" AND position IN ("Superintendent","Assistant Superintendent","Principal","School Head","Principal Assistant" ) ';

        $result = mysqli_query($conn, $qry);
        if (!empty($result)) :
            foreach ($result as $res) :
                return $res['approving_authority'];
            endforeach;
        else : return false;
        endif;
    }

    public static function checkDevPlanT($conn)
    {
        $qry1 = 'SELECT * FROM `devplant_a1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result1 = mysqli_query($conn, $qry1) or die($conn->error);
        $count_res1 = mysqli_num_rows($result1);

        $qry2 = 'SELECT * FROM `devplant_a2_devneeds_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result2 = mysqli_query($conn, $qry2) or die($conn->error);
        $count_res2 = mysqli_num_rows($result2);

        $qry3 = 'SELECT * FROM `devplant_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result3 = mysqli_query($conn, $qry3) or die($conn->error);
        $count_res3 = mysqli_num_rows($result3);

        $qry4 = 'SELECT * FROM `devplant_b1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result4 = mysqli_query($conn, $qry4) or die($conn->error);
        $count_res4 = mysqli_num_rows($result4);

        $qry5 = 'SELECT * FROM `devplant_b2_devneeds_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result5 = mysqli_query($conn, $qry5) or die($conn->error);
        $count_res5 = mysqli_num_rows($result5);

        $qry6 = 'SELECT * FROM `devplant_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result6 = mysqli_query($conn, $qry6) or die($conn->error);
        $count_res6 = mysqli_num_rows($result6);

        $qry7 = 'SELECT * FROM `devplant_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result7 = mysqli_query($conn, $qry7) or die($conn->error);
        $count_res7 = mysqli_num_rows($result7);



        if ($count_res1 > 0 && $count_res2 > 0 && $count_res3 > 0 && $count_res4 > 0  && $count_res5 > 0  && $count_res6 > 0  && $count_res7 > 0) :
            echo '<p class="green-notif-border" >General Development Plan for Teacher\'s I-III is already submitted for  ' . $_SESSION['active_sy'] . '</p>';
            include 'samplefooter.php';
            exit();
        else : return false;
        endif;
    }

    public static function checkDevPlanMT($conn)
    {
        $qry1 = 'SELECT * FROM `devplanmt_a1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result1 = mysqli_query($conn, $qry1) or die($conn->error);
        $count_res1 = mysqli_num_rows($result1);

        $qry2 = 'SELECT * FROM `devplanmt_a2_devneeds_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result2 = mysqli_query($conn, $qry2) or die($conn->error);
        $count_res2 = mysqli_num_rows($result2);

        $qry3 = 'SELECT * FROM `devplanmt_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result3 = mysqli_query($conn, $qry3) or die($conn->error);
        $count_res3 = mysqli_num_rows($result3);

        $qry4 = 'SELECT * FROM `devplanmt_b1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result4 = mysqli_query($conn, $qry4) or die($conn->error);
        $count_res4 = mysqli_num_rows($result4);

        $qry5 = 'SELECT * FROM `devplanmt_b2_devneeds_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result5 = mysqli_query($conn, $qry5) or die($conn->error);
        $count_res5 = mysqli_num_rows($result5);

        $qry6 = 'SELECT * FROM `devplanmt_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result6 = mysqli_query($conn, $qry6) or die($conn->error);
        $count_res6 = mysqli_num_rows($result6);

        $qry7 = 'SELECT * FROM `devplanmt_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result7 = mysqli_query($conn, $qry7) or die($conn->error);
        $count_res7 = mysqli_num_rows($result7);



        if ($count_res1 > 0 && $count_res2 > 0 && $count_res3 > 0 && $count_res4 > 0  && $count_res5 > 0  && $count_res6 > 0  && $count_res7 > 0) :
            echo '<p class="green-notif-border" >General Development Plan for Master Teacher\'s I-IV is already submitted for  ' . $_SESSION['active_sy'] . '</p>';
            include 'includes/footer.php';
            exit();
        else : return false;
        endif;
    }

    public static function showA1strength($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_a1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showA1strengthMT($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_a1_strength_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showA3Action($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showA3ActionAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }


    public static function showA3ActionMT($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showA3ActionMTAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_a3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showB3Action($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }


    public static function showB3ActionAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showB3ActionMT($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showB3ActionMTAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_b3_actionplan_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevC($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevCAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplant_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevCMT($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND school = ' . $_SESSION['school_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }

    public static function showDevCMTAdmin($conn)
    {
        $result_arr = [];
        $qry1 = 'SELECT * FROM `devplanmt_c_tbl` WHERE sy = ' . $_SESSION['active_sy_id'] . ' AND `status` = "Submit"';
        $result = mysqli_query($conn, $qry1) or die($conn->error);

        $result = mysqli_query($conn, $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        else : return false;
        endif;
    }



    /*
    THIS TABLE WILL FETCH THE STRENGHT IN ESAT OBJECTIVES
    TABLES: esat2_objectivesmt_tbl, esat2_objectivest_tbl 
    */
    public function fetchStrengthOBJ($table_name)
    {
        $result_arr = [];
        $qry1 = "SELECT * FROM `$table_name` where `user_id` = " . $this->user . " and lvlcap >= 3 and priodev <= 2 and sy = " . $this->sy . " and school= " . $this->school . " and status = 'Active' ORDER BY lvlcap DESC LIMIT 5";
        $result = mysqli_query($this->conn(), $qry1) or die($this->conn()->error);

        $result = mysqli_query($this->conn(), $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        endif;
    }

    /*
    THIS TABLE WILL FETCH THE DEVNEEDS IN ESAT OBJECTIVES
    TABLES: esat2_objectivesmt_tbl, esat2_objectivest_tbl 
    */
    public function fetchDevNeedOBJ($table_name)
    {
        $result_arr = [];
        $qry1 = "SELECT * FROM `$table_name` where `user_id` = " . $this->user . " and lvlcap <= 2 and priodev >= 3 and sy = " . $this->sy . " and school= " . $this->school . " and status = 'Active' ORDER BY lvlcap DESC LIMIT 4";
        $result = mysqli_query($this->conn(), $qry1) or die($this->conn()->error);

        $result = mysqli_query($this->conn(), $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        endif;
    }

    /*
    THIS TABLE WILL FETCH THE STRENGTH IN ESAT BEHAVIORAL
    TABLES: esat3_core_behavioralmt_tbl, esat3_core_behavioralt_tbl 
    */
    public function fetchCoreBehavioralStr($table_name)
    {
        $result_arr = [];
        $qry1 = "SELECT SUM(cbc_score) AS total_score,cbc_id FROM `$table_name` where `user_id` = " . $this->user . "  AND sy = " . $this->sy . " AND school = " . $this->school . " GROUP BY cbc_id ORDER BY  SUM(cbc_score) DESC,cbc_id  LIMIT 5";
        $result = mysqli_query($this->conn(), $qry1) or die($this->conn()->error);

        $result = mysqli_query($this->conn(), $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        endif;
    }

    /*
    THIS TABLE WILL FETCH THE DevNeed IN ESAT BEHAVIORAL
    TABLES: esat3_core_behavioralmt_tbl, esat3_core_behavioralt_tbl 
    */

    public function fetchCoreBehavioralDevNeed($table_name)
    {
        $result_arr = [];
        $qry1 = "SELECT SUM(cbc_score) AS total_score,cbc_id FROM `$table_name` where `user_id` = " . $this->user . "  AND sy = " . $this->sy . " AND school = " . $this->school . " GROUP BY cbc_id ORDER BY SUM(cbc_score),cbc_id desc LIMIT 3";
        $result = mysqli_query($this->conn(), $qry1) or die($this->conn()->error);

        $result = mysqli_query($this->conn(), $qry1);
        if (!empty($result)) :
            foreach ($result as $res) :
                array_push($result_arr, $res);
            endforeach;
            return $result_arr;
        endif;
    }

    /*
    THIS TABLE WILL FETCH THE DevNeed IN ESAT BEHAVIORAL
    TABLES: devplanmt_a1_strength_tbl, devplant_a1_strength_tbl 
    */
    public function checkOBJ_dp($table_name)
    {
        $qry1 = "SELECT * FROM `$table_name` WHERE `user_id` = " . $this->user . " AND `sy` = " . $this->sy . " AND `school` = " . $this->school . " and `position` = '" . $this->position . "'";
        $result = mysqli_query($this->conn(), $qry1) or die($this->conn()->error);

        $count_result = mysqli_num_rows($result);
        if (($count_result) > 0) : return true;
        else : return false;
        endif;
    }
}
