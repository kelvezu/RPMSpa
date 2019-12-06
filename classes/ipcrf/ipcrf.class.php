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


    public function countCOTmt($cot_rating_a_tbl)
    {
        $qry = "SELECT * FROM `$cot_rating_a_tbl` WHERE `user_id` = " . $this->user . " AND sy = " . $this->sy . "  AND school_id = " . $this->school . " GROUP BY obs_period";
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

    public function getObjQuality($obj_id, $obj_table)
    { }
}
