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


// FETCH ALL DATA must INCLUDE THE DB CONNECTION AND QUERY 

function fetchAll(mysqli $conn, $query)
{
    $data = [];
    $results = $conn->query($query);
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

function updateAll(mysqli $conn, $query)
{
    if ($conn->query($query)) {
        $conn->query($query);
    } else {
        echo 'Update Failed';
    }
}
