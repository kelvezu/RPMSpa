<?php

include 'includes/conn.inc.php';


if(isset($_POST['indicator_no'])):
    $indicator_no = $_POST['indicator_no'];

    $query = $conn->query("SELECT * FROM tindicator_tbl WHERE indicator_no = '$indicator_no'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Indicator Number is taken.</div>";
    elseif(ctype_space($indicator_no)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($indicator_no)) < 0):
        echo "<div class='tomato-color'>Indicator Number should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['indicator_name'])):
    $indicator_name = $_POST['indicator_name'];

    $query = $conn->query("SELECT * FROM tindicator_tbl WHERE indicator_name = '$indicator_name'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Indicator Name is taken.</div>";
    elseif(ctype_space($indicator_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($indicator_name)) < 0):
        echo "<div class='tomato-color'>Indicator Name should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['mtindicator_no'])):
    $mtindicator_no = $_POST['mtindicator_no'];

    $query = $conn->query("SELECT * FROM mtindicator_tbl WHERE mtindicator_no = '$mtindicator_no'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Indicator Number is taken.</div>";
    elseif(ctype_space($mtindicator_no)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtindicator_no)) < 0):
        echo "<div class='tomato-color'>Indicator Number should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['mtindicator_name'])):
    $mtindicator_name = $_POST['mtindicator_name'];

    $query = $conn->query("SELECT * FROM mtindicator_tbl WHERE mtindicator_name = '$mtindicator_name'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Indicator Name is taken.</div>";
    elseif(ctype_space($mtindicator_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtindicator_name)) < 0):
        echo "<div class='tomato-color'>Indicator Name should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;
?>