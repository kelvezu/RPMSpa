<?php

include 'includes/conn.inc.php';


if(isset($_POST['tobserved'])):
    $tobserved = $_POST['tobserved'];
    $obs = $_POST['obs'];

    $teacher_Qry = $conn->query("SELECT * FROM cot_t_rating_a_tbl WHERE `user_id` = '$tobserved' AND obs_period = '$obs' ");
    $teacher_count = $teacher_Qry->num_rows;

    if($teacher_count > 0):
        echo "<div class='tomato-color'>Teacher has been rated!</div>";
    endif;


endif;


if(isset($_POST['mtobserved'])):
    $mtobserved = $_POST['mtobserved'];
    $obs = $_POST['obs'];

    $teacher_Qry = $conn->query("SELECT * FROM cot_mt_rating_a_tbl WHERE `user_id` = '$mtobserved' AND obs_period = '$obs' ");
    $teacher_count = $teacher_Qry->num_rows;

    if($teacher_count > 0):
        echo "<div class='tomato-color'>Teacher has been rated!</div>";
    endif;


endif;
?>