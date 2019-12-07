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
}
