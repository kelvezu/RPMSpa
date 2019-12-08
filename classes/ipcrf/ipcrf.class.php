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

        if ($eff_count >= 5) : return 5;
        elseif ($eff_count == 4) : return 4;
        elseif ($eff_count == 3) : return 3;
        elseif ($eff_count == 2) : return 2;
        elseif ($eff_count == 1) : return 1;
        else : return 1;
        endif;
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
}
