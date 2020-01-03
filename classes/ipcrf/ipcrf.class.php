<?php

namespace IPCRF;



class IPCRF
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

    /* THIS METHOD WILL COUNT THE COT OF THE USER  */
    public function countCOT($rating_tbl)
    {
        $qry = "SELECT * FROM `$rating_tbl` WHERE `user_id` = " . $this->user . " AND sy = " . $this->sy . "  AND school_id = " . $this->school . " GROUP BY obs_period";
        $result =  mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $res_arr = [];
        foreach ($result as $r) :
            array_push($res_arr, $r);
        endforeach;
        return intval(count($res_arr));
    }

    /*
     THIS METHOD WILL FETCH THE COT OBS PERIOD
    working
    */
    public function fetchObsPeriodinCOT($rating_tbl)
    {
        $qry = "SELECT * FROM `$rating_tbl` WHERE `user_id` = " . $this->user . " AND sy = " . $this->sy . "  AND school_id = " . $this->school . " GROUP BY obs_period";
        $result =  mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $res_arr = [];
        foreach ($result as $r) :
            array_push($res_arr, $r['obs_period']);
        endforeach;
        return $result;
    }



    /*
    THIS METHOD WILL COUNT THE OBJECTIVE IN KRA
    TABLE MT = mtobj_tbl
    TABLE MT = tobj_tbl
    */
    public function countObj($kra, $obj_table)
    {
        $qry = "SELECT * FROM `$obj_table` WHERE kra_id = $kra";
        $result =  mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $res_arr = [];
        foreach ($result as $r) :
            array_push($res_arr, $r);
        endforeach;
        return intval(count($res_arr));
    }


    /*
    THIS METHOD WILL DISPLAY THE OBJECTIVE QUALITY THEN IT WILL CONVERT IT TO QUALITY RATING
    NOTE: use this method if the COT is the base of the QUALITY

    deprecated: issue quality is not based on the count of cot
    */
    public function getObjQuality($obj_table)
    {
        $cot_count = $this->countCOT($obj_table);
        if ($cot_count == 4) :
            return intval(5);
        elseif ($cot_count == 3) :
            return intval(4);
        elseif ($cot_count == 2) :
            return intval(3);
        elseif ($cot_count == 1) :
            return intval(2);
        else :
            return intval(1);
        endif;
    }




    /*
        THIS METHOD WILL COUNT THE MOV IN EACH OBJECTIVES
        TABLE MT = mov_main_mt_attach_tbl  , mov_supp_mt_attach_tbl
        TABLE T = mov_main_t_attach_tbl , mov_supp_t_attach_tbl
    */
    public function countMOV($kra, $obj, $table_name)
    {
        $qry  = "SELECT * FROM `$table_name` WHERE `kra_id` = $kra AND `obj_id` = $obj and `user_id` = " . $this->user . " AND `school_id` = " . $this->school . "  and sy_id = " . $this->sy . " AND doc_status = 'Approved' and status = 'Active'";
        $result =  mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            $res_arr = [];
            foreach ($result as $r) :
                array_push($res_arr, $r);
            endforeach;
            $mov_count =  intval(count($res_arr));
            if ($mov_count == 0) :
                return 1;
            else :  return $mov_count;
            endif;


        else : return 1;
        endif;
    }

    public function getEfficiency($kra_id, $obj_id, $table_name)
    {
        $eff_count = $this->countMOV($kra_id, $obj_id, $table_name);
        $eff = 0;
        if ($eff_count >= 5) : $eff = 5;
        elseif ($eff_count == 4) : $eff = 4;
        elseif ($eff_count == 3) : $eff = 3;
        elseif ($eff_count == 2) : $eff = 2;
        elseif ($eff_count == 1) : $eff = 1;
        else : $eff = 1;
        endif;
        return floatval($eff);
    }



    public function totalofCOTandMOV($kra, $obj, $table_name, $rating_tbl)
    {
        $count_mov = $this->countMOV($kra, $obj, $table_name);
        $count_cot = $this->countCOT($rating_tbl);
        $total = intval($count_mov + $count_cot);
        if ($total >= 4) :
            return intval(5);
        elseif ($total == 3) :
            return intval(4);
        elseif ($total == 2) :
            return intval(3);
        elseif ($total == 1) :
            return intval(2);
        else :
            return intval(1);
        endif;
    }

    /* THIS FUNCTION WILL SHOW THE AVERAGE THE OF THE INDICATOR RESULT OF COT  */
    public function getIndicatorAVGmt($indicator_id)
    {
        $qry  = "SELECT * FROM `cot_mt_indicator_ave_tbl` WHERE indicator_id = $indicator_id AND `user_id` = " . $this->user . " AND sy = " . $this->sy . " AND school = " . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return floatval($r['average']);
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function getSuppFileDate($mov_id, $kra_id, $obj)
    {
        $qry = "SELECT * FROM `mov_supp_mt_attach_tbl` where mov_id = $mov_id and kra_id = $kra_id and obj_id = $obj and user_id = 33 and school_id = 14 and sy_id = 17 and doc_status = 'approved' and status = 'Active'";
        $result = mysqli_query($this->conn(), $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }
    public function getIndicatorAVGt($indicator_id)
    {
        $qry  = "SELECT * FROM `cot_t_indicator_ave_tbl` WHERE indicator_id = $indicator_id AND `user_id` = " . $this->user . " AND sy = " . $this->sy . " AND school = " . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return floatval($r['average']);
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    /*
        THIS METHOD WILL FETCH ALL THE DATA IN COT
        TABLE: cot_mt_rating_a_tbl, cot_t_rating_a_tbl
    */

    public function fetchCOTdetails($obs_period, $table_name)
    {
        $qry = "SELECT * FROM `$table_name` WHERE obs_period = $obs_period AND sy = " . $this->sy . " AND school_id = " . $this->school . " AND `user_id` = " . $this->user . "";
        $result = mysqli_query($this->conn(), $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    /*
        THIS METHOD WILL CHECK IF THERE ARE ALREADY A RECORD IN IPCRF

        TABLES:
        ipcrf_mt,
        ipcrf_t,
        ipcrf_final_mt,
        ipcrf_final_t
    */

    public function hasIPCRF($table_name)
    {
        $qry = "SELECT * FROM `$table_name` WHERE `user_id` = " . $this->user . " AND `sy_id` = " . $this->sy . " AND `school_id` = " . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $count_result = mysqli_num_rows($result);
        if ($count_result > 0) : return true;
        else : return false;
        endif;
    }

    /*
        THIS METHOD WILL CHECK IF THERE ARE ALREADY A RECORD IN IPCRF
        TABLES:
        ipcrf_mt,
        ipcrf_t,
        ipcrf_final_mt,
        ipcrf_final_t
    */
    public function fetchIPCRF($table_name)
    {
        $qry = "SELECT * FROM `$table_name` WHERE `user_id` = " . $this->user . " AND `sy_id` = " . $this->sy . " AND `school_id` = " . $this->school . "";
        $result = mysqli_query($this->conn(), $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenT($conn, $sy_id)
    {
        $qry = "SELECT * FROM ipcrf_t WHERE `sy_id` = $sy_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenMT($conn, $sy_id)
    {
        $qry = "SELECT * FROM ipcrf_mt WHERE `sy_id` = $sy_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenTP($conn, $sy_id, $school_id)
    {
        $qry = "SELECT * FROM ipcrf_t WHERE `sy_id` = $sy_id and school_id =$school_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenMTP($conn, $sy_id, $school_id)
    {
        $qry = "SELECT * FROM ipcrf_mt WHERE `sy_id` = $sy_id and school_id =$school_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenFinalT($conn, $sy_id)
    {
        $qry = "SELECT * FROM ipcrf_final_t WHERE `sy_id` = $sy_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenFinalTP($conn, $sy_id, $school_id)
    {
        $qry = "SELECT * FROM ipcrf_final_t WHERE `sy_id` = $sy_id and school_id =$school_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenFinalMTP($conn, $sy_id, $school_id)
    {
        $qry = "SELECT * FROM ipcrf_final_mt WHERE `sy_id` = $sy_id and school_id =$school_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }

    public function fetchIPCRFGenFinalMT($conn, $sy_id)
    {
        $qry = "SELECT * FROM ipcrf_final_mt WHERE `sy_id` = $sy_id";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        endif;
    }


    /* THIS WILL FETCH THE KRA WEIGHT */
    public function fetchKRAweight($kra_id)
    {
        $qry  = "SELECT * FROM `kra_weight` where kra_id = $kra_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['weight']) * 100) . '%';
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }


    /*
        THIS WILL COUNT THE OBJECTIVE
        TABLE: mtobj_tbl,tobj_tbl
    */
    public function countKRAobjective($kra_id, $table_name)
    {
        $qry  = "SELECT COUNT(kra_id) as obj_count FROM `$table_name` WHERE kra_id = $kra_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (intval($r['obj_count']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchObjKRA($table_name)
    {
        $qry  = "SELECT * FROM `$table_name` GROUP BY kra_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        else : die($this->conn()->error . $qry);
        endif;
    }



    public function getOBJ($table_name, $kra_id)
    {
        $qry  = "SELECT * FROM `$table_name` WHERE kra_id = $kra_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        else : die($this->conn()->error . $qry);
        endif;
    }

    /*
     THIS METHOD WILL CHECK IF THERE ARE ALREADY A RECORD IN IPCRF
        TABLES:
        ipcrf_mt,
        ipcrf_t
    */
    public function fetchQuality($table, $obj_id)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = " . $this->user . " AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['quality']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchEfficiency($table, $obj_id)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = " . $this->user . " AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['efficiency']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchOBJweight($kra_id)
    {
        $qry = "SELECT * FROM `kra_weight` WHERE kra_id = $kra_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) {
            foreach ($result as $r) :
                $qry1 = "SELECT COUNT(kra_id) as count_kra FROM `mtobj_tbl` WHERE kra_id = " . $r['kra_id'] . "";
                $w_obj = mysqli_query($this->conn(), $qry1) or die($this->conn()->error . $qry1);
                if ($w_obj) :
                    foreach ($w_obj as $w) :
                        return floatval($r['weight'] / $w['count_kra']);
                    endforeach;
                endif;
            endforeach;
        }
    }

    public function fetchTimeliness($table, $obj_id)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = " . $this->user . " AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['timeliness']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchAVG($table, $obj_id)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = " . $this->user . " AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['average']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchScore($table, $obj_id)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = " . $this->user . " AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['score']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetch_user_Score($table, $obj_id, $user)
    {
        $qry  = "SELECT * FROM `$table` WHERE obj_id = $obj_id AND `user_id` = $user AND sy_id = " . $this->sy . " AND school_id =" . $this->school . "";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return (floatval($r['score']));
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }


    // TABLE = perfmtindicator_tbl,perftindicator_tbl
    public function getTimeliness($table_name, $kra_id, $obj_id)
    {
        $qry  = "  SELECT * FROM `$table_name` WHERE kra_id =  $kra_id and mtobj_id = $obj_id AND qet = 'Timeliness' ORDER BY level_no desc";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        else : die($this->conn()->error . $qry);
        endif;
    }

    // TABLE = perfmtindicator_tbl,perftindicator_tbl
    public function getTimelinessT($table_name, $kra_id, $obj_id)
    {
        $qry  = "  SELECT * FROM `$table_name` WHERE kra_id =  $kra_id and tobj_id = $obj_id AND qet = 'Timeliness' ORDER BY level_no desc";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $result_arr = [];
        if ($result) :
            foreach ($result as $r) :
                array_push($result_arr, $r);
            endforeach;
            return $result_arr;
        else : die($this->conn()->error . $qry);
        endif;
    }


    /*
    THIS WILL DISPLAY THE RESULT OF QUALITY BASED ON RPMS RANGE
    TABLES: perfmtindicator_tbl, perftindicator_tbl
    */

    public function actualResultQualityMT($kra_id, $obj_id, $quality_rate)
    {
        floatval($quality_rate);

        if ($quality_rate >= 4.500 and $quality_rate <= 5.000) :
            $quality_rate = 5;
        elseif ($quality_rate >= 3.500 and $quality_rate <= 4.499) :
            $quality_rate = 4;

        elseif ($quality_rate >= 2.500 and $quality_rate <= 3.499) :
            $quality_rate = 3;

        elseif ($quality_rate >= 1.500 and $quality_rate <= 2.499) :
            $quality_rate = 2;

        elseif ($quality_rate <= 1.499) :
            $quality_rate = 1;
        else : $quality_rate = 1.000;
        endif;

        $qry  = "SELECT * FROM `perfmtindicator_tbl` WHERE kra_id = $kra_id and mtobj_id = $obj_id and qet = 'Quality' and status = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['perfmtindicator_id'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function actualResultQualityT($kra_id, $obj_id, $quality_rate)
    {
        $qry  = "SELECT * FROM `perftindicator_tbl` WHERE kra_id = $kra_id and tobj_id = $obj_id and qet = 'Quality' and status = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['perftindicator_id'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    /*
    THIS WILL DISPLAY THE RESULT OF EFFICIENCY BASED ON RPMS RANGE
    TABLES: perfmtindicator_tbl, perftindicator_tbl
    */

    public function actualResultEfficiencyMT($kra_id, $obj_id, $quality_rate)
    {
        floatval($quality_rate);

        if ($quality_rate >= 4.500 and $quality_rate <= 5.000) :
            $quality_rate = 5;
        elseif ($quality_rate >= 3.500 and $quality_rate <= 4.499) :
            $quality_rate = 4;

        elseif ($quality_rate >= 2.500 and $quality_rate <= 3.499) :
            $quality_rate = 3;

        elseif ($quality_rate >= 1.500 and $quality_rate <= 2.499) :
            $quality_rate = 2;

        elseif ($quality_rate <= 1.499) :
            $quality_rate = 1;
        else : $quality_rate = 1.000;
        endif;

        $qry  = "SELECT * FROM `perfmtindicator_tbl` WHERE kra_id = $kra_id and mtobj_id = $obj_id and qet = 'Efficiency' and status = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['perfmtindicator_id'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function actualResultEfficiencyT($kra_id, $obj_id, $quality_rate)
    {
        $qry  = "SELECT * FROM `perftindicator_tbl` WHERE kra_id = $kra_id and tobj_id = $obj_id and qet = 'Efficiency' and status = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['perftindicator_id'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function actualResultTimelinessT($kra_id, $obj_id, $quality_rate)
    {
        $qry  = "SELECT * FROM `perftindicator_tbl` WHERE kra_id = $kra_id and tobj_id = $obj_id and qet = 'Timeliness' and status = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['perftindicator_id'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function actualResultTimelinessMT($kra_id, $obj_id, $quality_rate)
    {
        $qry  = "SELECT * FROM `perfmtindicator_tbl` WHERE kra_id = $kra_id and tobj_id = $obj_id and qet = 'Timeliness' and `status` = 'Active' AND level_no = $quality_rate";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        $result_count = mysqli_num_rows($result);
        if ($result_count > 0) :
            foreach ($result as $r) :
                return $r['perfmtindicator_id'];
            endforeach;
        else : return 0;
        endif;
    }


    public function getQualityRange($quality_rate)
    {
        floatval($quality_rate);

        if ($quality_rate >= 4.500 and $quality_rate <= 5.000) :
            return 5;
        elseif ($quality_rate >= 3.500 and $quality_rate <= 4.499) :
            return 4;

        elseif ($quality_rate >= 2.500 and $quality_rate <= 3.499) :
            return 3;

        elseif ($quality_rate >= 1.500 and $quality_rate <= 2.499) :
            return 2;

        elseif ($quality_rate <= 1.499) :
            return 1;
        else : return 1;
        endif;
    }


    /*
    THIS WILL DISPLAY THE RESULT OF EFFICIENCY BASED ON RPMS RANGE
    TABLES: perfmtindicator_tbl, perftindicator_tbl
    */
    public function displayPerfIndicator($table_name, $perf_id)
    {
        $qry  = " SELECT * FROM `$table_name` where perfmtindicator_id = $perf_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }


    public function displayPerfIndicatorT($table_name, $perf_id)
    {
        $qry  = " SELECT * FROM `$table_name` where perftindicator_id = $perf_id";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function displayPerfIndicatorGenT($conn)
    {
        $qry  = "SELECT * FROM perftindicator_tbl";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function displayPerfIndicatorGenTP($conn)
    {
        $qry  = "SELECT * FROM perftindicator_tbl";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function displayPerfIndicatorGenMT($conn)
    {
        $qry  = "SELECT * FROM perfmtindicator_tbl";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function displayPerfIndicatorGenMTP($conn)
    {
        $qry  = "SELECT * FROM perfmtindicator_tbl";
        $result = mysqli_query($conn, $qry) or die($conn->error . $qry);
        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }


    public function displayTimelinessDesc($table_name, $kra_id, $obj_id, $level_no)
    {
        $qry  = "  SELECT * FROM `$table_name` WHERE kra_id =  $kra_id and mtobj_id = $obj_id AND qet = 'Timeliness' AND level_no = $level_no ";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function displayTimelinessDescT($table_name, $kra_id, $obj_id, $level_no)
    {
        $qry  = "  SELECT * FROM `$table_name` WHERE kra_id =  $kra_id and tobj_id = $obj_id AND qet = 'Timeliness' AND level_no = $level_no ";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return $r['desc_name'];
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetchTObjective_tbl()
    {
        $qry = "SELECT * FROM `tobj_tbl`";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    public function fetchMTObjective_tbl()
    {
        $qry = "SELECT * FROM `mtobj_tbl`";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }



    /* THIS FUNCTION WILL DISPLAY ALL SCHOOL PERSONNEL WITHIN THE SCHOOL */
    public function fetchSchoolPersonnel()
    {
        $qry = "SELECT * FROM `account_tbl` where school_id = 14 AND status = 'Active'";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }
    /* THIS FUNCTION WILL DISPLAY ALL TEACHER WITH COT THE SCHOOL */
    public function fetchTeacherWithCOT()
    {
        $qry = "SELECT * FROM `ipcrf_mt` UNION SELECT * FROM `ipcrf_t` ORDER BY FIELD(position,'Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I','Teacher III','Teacher II','Teacher I')";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }
    /* 
        THIS FUNCTION WILL DISPLAY ALL SCORE 
        table = ipcrf_mt, ipcrf_t
    */
    public function fetchTotalScoreKRA()
    {
        $qry = "SELECT a.kra_id,sum(a.roundScore) as total_score from ((SELECT kra_id,ROUND(SUM(score), 3) as roundScore,sy_id, school_id  FROM `ipcrf_mt` where sy_id = " . $this->sy . " and school_id = " . $this->school . "  group by kra_id) UNION ALL (SELECT kra_id,ROUND(SUM(score), 3) as roundScore,sy_id, school_id  F" . $this->school . "M `ipcrf_t` where sy_id = " . $this->sy . " and school_id = " . $this->school . "  group by kra_id))a GROUP BY a.kra_id";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    public function fetchTotalScoreOBJ()
    {
        $qry = "SELECT a.obj_id, SUM(a.roundScore) AS total_score FROM ( ( SELECT obj_id, ROUND(SUM(score), 3) AS roundScore, sy_id, school_id FR" . $this->school . " `ipcrf_t` WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " GROUP BY obj_id ) UNION all ( SELECT obj_id, ROUND(SUM(score), 3) AS roundScore, sy_id, school_id FR" . $this->school . " `ipcrf_mt` WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " GROUP BY obj_id ) ) a GROUP BY a.obj_id";
        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    //     SELECT * FROM (SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_mt` where sy_id = 17 and school_id = 14 and status = 'Active' UNION ALL SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_t` where sy_id = 17 and school_id = 14 and status = 'Active')a ORDER BY FIELD (a.position,'Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I','Teacher III','Teacher II','Teacher I')
    // 

    // public function fetchIPCRF_QETscore()
    // {
    //     $qry = "SELECT * FROM (SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_mt` where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' UNION ALL SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_t` where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active')a ORDER BY FIELD (a.position,'Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I','Teacher III','Teacher II','Teacher I')";
    //     $result = mysqli_query($this->conn(), $qry);
    //     if ($result) {
    //         $array_res = [];
    //         foreach ($result as $r) {
    //             array_push($array_res, $r);
    //         }
    //         return $array_res;
    //     }
    // }

    public function fetch_QETscore_mt()
    {
        $qry = "SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_mt` where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' ORDER BY obj_id, FIELD (position,'Master Teacher IV','Master Teacher III','Master Teacher II','Master Teacher I')";

        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    public function fetch_QETscore_t()
    {
        $qry = "SELECT kra_id,obj_id,user_id,quality,efficiency,timeliness,position,average,objective_weight,score FROM `ipcrf_t` where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' ORDER BY obj_id, FIELD (position,'Teacher III','Teacher II','Teacher I')";

        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }


    /* 
    THIS METHOD WILL SHOW ALL THE USER WITH IPCRF 
    TABLES: ipcrf_final_mt, ipcrf_final_t
*/
    public function fetch_ipcrf_users($table)
    {
        $qry = "SELECT * FROM `$table` WHERE sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' ORDER BY FIELD(adjectival_rating,'Outstanding','Very Satisfactory','Satisfactory','Unsatisfactory','Poor'),final_rating";

        $result = mysqli_query($this->conn(), $qry);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    /* 
    THIS METHOD WILL SHOW ALL THE DETAILS OF USER WITH IPCRF 
    TABLES: ipcrf_mt, ipcrf_t
    */

    public function fetch_ipcrf_user_details($table, $user)
    {
        $qry = "SELECT * FROM `$table` WHERE sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' AND user_id = $user";

        $result = mysqli_query($this->conn(), $qry) or console_log($$this->conn()->error);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    // ipcrf_final_mt, ipcrf_final_t

    /* THIS FUNCTION WILL SHOW THE AVERAGE THE OF THE INDICATOR RESULT OF COT  */
    public function getFinalRating($table, $user)
    {
        $qry  = "SELECT final_rating FROM `$table` where `user_id` = $user AND sy_id = " . $this->sy . " AND school_id = " . $this->school . " and status = 'Active'";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return floatval($r['final_rating']);
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    // ipcrf_final_mt, ipcrf_final_t

    /* THIS FUNCTION WILL SHOW THE AVERAGE THE OF THE INDICATOR RESULT OF COT  */
    public function getAdjectivalRating($table, $user)
    {
        $qry  = "SELECT adjectival_rating FROM `$table` where `user_id` = $user AND sy_id = " . $this->sy . " AND school_id = " . $this->school . " and status = 'Active'";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return ($r['adjectival_rating']);
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function fetch_all_ipcrf_users()
    {
        $qry = "SELECT * FROM ((SELECT * FROM ipcrf_final_mt WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active') UNION ALL (SELECT * FROM ipcrf_final_t WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active'))a ORDER BY a.final_rating desc";

        $result = mysqli_query($this->conn(), $qry) or die($$this->conn()->error);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    public function fetch_all_ipcrf_users_unapproved()
    {
        $qry = "SELECT * FROM ((SELECT * FROM ipcrf_final_mt WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active') UNION ALL (SELECT * FROM ipcrf_final_t WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active'))a WHERE doc_status = 'For Approval' ORDER BY a.final_rating desc";

        $result = mysqli_query($this->conn(), $qry) or die($$this->conn()->error);
        if ($result) {
            $array_res = [];
            foreach ($result as $r) {
                array_push($array_res, $r);
            }
            return $array_res;
        }
    }

    /* THIS FUNCTION WILL SHOW THE AVERAGE THE OF THE INDICATOR RESULT OF COT  */
    public function getAllFinalRating()
    {
        $qry  = "SELECT round(AVG(final_rating),3) as final_rating FROM ((SELECT * FROM ipcrf_final_mt WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active') UNION ALL (SELECT * FROM ipcrf_final_t WHERE sy_id = " . $this->sy . " AND school_id = " . $this->school . " AND status = 'Active'))a ORDER BY a.final_rating desc";
        $result = mysqli_query($this->conn(), $qry) or die($this->conn()->error . $qry);

        if ($result) :
            foreach ($result as $r) :
                return floatval($r['final_rating']);
            endforeach;
        else : die($this->conn()->error . $qry);
        endif;
    }

    public function get_kra_average($kra_id, $user, $position)
    {
        if ($position == "Master Teacher IV" || $position == "Master Teacher III" || $position == "Master Teacher II" || $position == "Master Teacher I") :
            $table = 'ipcrf_mt';
        elseif ($position == "Teacher III" || $position == "Teacher II" || $position == "Teacher I") :
            $table = 'ipcrf_t';
        endif;

        $qry  = "SELECT round(avg(average),3) as ave FROM `$table` WHERE sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active' and kra_id = $kra_id and user_id = $user";
        $result = mysqli_query($this->conn(), $qry) or die($$this->conn()->error);
        if ($result) {
            foreach ($result as $r) {
                return floatval($r['ave']);
            }
        }
    }

    public function get_kra_avg_rank($kra_id)
    {
        $qry  = "SELECT user_id,ROUND(AVG(average),3) as kra_average FROM ((SELECT * FROM ipcrf_mt where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active') UNION ALL (SELECT * FROM ipcrf_t where sy_id = " . $this->sy . " and school_id = " . $this->school . " and status = 'Active'))a where kra_id = $kra_id GROUP BY user_id ORDER BY average desc";
        $result = mysqli_query($this->conn(), $qry) or die($$this->conn()->error);
        if ($result) {
            $res_array = [];
            foreach ($result as $r) {
                array_push($res_array, $r);
            }
            return $res_array;
        }
    }


    public function getSChoolFinalRating()
    {
        $qry  = "SELECT school_id,round(AVG(final_rating),3) as school_final_rating FROM (SELECT * FROM `ipcrf_final_mt` UNION ALL SELECT * FROM `ipcrf_final_t`)a where sy_id = " . $this->sy . "  and status = 'Active' GROUP BY school_id ORDER BY school_final_rating desc";
        $result = mysqli_query($this->conn(), $qry) or die($$this->conn()->error);
        if ($result) {
            $res_array = [];
            foreach ($result as $r) {
                array_push($res_array, $r);
            }
            return $res_array;
        }
    }
}
