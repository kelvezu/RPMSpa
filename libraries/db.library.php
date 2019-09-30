<?php

//DATABASE FUNCTION

function connect($dbHost, $dbUsername, $dbPassword, $dbName)
{
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die('Cannot connect to the database: \n ' . $conn->connect_erro . '\n' . $conn->connect_errno);
    }
    return $conn;
}

//FETCH ALL DATA

function fetchAll(mysqli $conn)
{
    $data = [];
    $query = 'SELECT * FROM account_tbl WHERE rater IS NULL';
    $results = $conn->query($query);
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}
