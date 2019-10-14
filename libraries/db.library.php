
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
    } else {
        echo $query;
        exit();
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

function isSubmit($dbcon)
{
    $submit_result = $dbcon->query(' SELECT * FROM `devplan_c_tbl` WHERE `user_id` ="' . $_SESSION['user_id'] . '" AND status = "Submit" ');
    $result = mysqli_num_rows($submit_result);
    if ($result === 2) {
        echo 'Youve already submitted your Development Plan!';
    } else {
        echo "You dont have a Development Plan yet!";
    }
}

function errorCatcher($errors)
{
    $error_array = [];
    foreach ($errors as $error) :
        array_push($error_array, $error);
    endforeach;
    return $error_array;
}
