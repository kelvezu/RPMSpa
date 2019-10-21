
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
    $results = mysqli_query($conn, $query);
    if (!empty($results)) :
        if ($results) :
            foreach ($results as $result) :
                array_push($data, $result);
            endforeach;
        endif;
    else :
        return false;
    endif;
    return $data;
}

function updateAll(mysqli $conn, $query)
{
    if ($conn->query($query)) {
        $conn->query($query);
    } else {
        echo 'Update Failed' . $query;
    }
}

function showAccountDB(mysqli $conn)
{
    $account_arr = [];
    $qry = "SELECT * FROM account_tbl";
    $exec  = mysqli_query($conn, $qry);
    array_push($account_arr, $exec);
    json_encode($account_arr);
    return $account_arr;
}
