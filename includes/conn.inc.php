<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "rpms";

$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

if(!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
}

include_once 'func.lib.php';