<?php

namespace DatabaseConfig;

class DatabaseConfig
{
    public $servername = "localhost";
    public $dbUsername = "root";
    public $dbPassword = "";
    public $dbName = "rpms";


    // public function __construct($user, $sy, $school, $position)
    // {
    //     $this->user = $user;
    //     $this->sy = $sy;
    //     $this->school = $school;
    //     $this->position = $position;
    // }


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
}
