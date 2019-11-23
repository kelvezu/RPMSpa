<?php

include 'conn.inc.php';

if(isset($_POST['submit'])):
    $user_id = $_POST['user_id'];
    $new_position = $_POST['new_pos'];


    $qry = $conn->query("UPDATE account_tbl SET position = '".$new_position."' WHERE user_id = $user_id") or die ($conn->error);
    header("Location:../promote.php?=sucess");
endif;

?>