<?php

// $servername = "localhost";
// $dbUsername = "root";
// $dbPassword = "";
// $dbName = "rpms";



$servername = "148.72.232.171";
$dbUsername = "rpmsadmin";
$dbPassword = "040430";
$dbName = "rpms";


$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Manila');
