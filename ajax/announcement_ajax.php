<?php

use PHPMailer\PHPMailer\Exception;

$res_arr = [];
include '../includes/conn.inc.php';
$qry = 'SELECT * FROM `announcement_tbl` WHERE `status` = "Active" ORDER BY id  desc LIMIT 6';
$result = mysqli_query($conn, $qry) or die($conn->error);
try {
    if ($result) :
        foreach ($result as $res) :
            array_push($res_arr, $res);
        endforeach;
        echo json_encode($res_arr);
    else :
        echo 'No result';
    endif;
} catch (Exception $e) {
    echo $e->getMessage();
}
