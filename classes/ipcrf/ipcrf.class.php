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
        $res_arr = [];
        foreach ($result as $r) :
            array_push($res_arr, $r);
        endforeach;
        return intval(count($res_arr));
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
        else : $eff = 0;
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
}
