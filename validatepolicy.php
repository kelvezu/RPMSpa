<?php

include 'includes/conn.inc.php';

if(isset($_POST['policy_title'])):
    $policytitle = $_POST['policy_title'];

    $query = $conn->query("SELECT * FROM policy_tbl WHERE policy_title = '$policytitle'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Policy title is taken.</div>";
    elseif(ctype_space($policytitle)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($policytitle)) < 10):
        echo "<div class='tomato-color'>Policy title should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['policy_content'])):
    $policy_content = $_POST['policy_content'];

    $query = $conn->query("SELECT * FROM policy_tbl WHERE policy_content = '$policy_content'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Policy content is taken.</div>";
    elseif(ctype_space($policy_content)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($policy_content)) < 10):
        echo "<div class='tomato-color'>Policy Content should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif



?>