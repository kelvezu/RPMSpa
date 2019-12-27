<?php

include 'includes/conn.inc.php';

if(isset($_POST['kra'])):
    $kra = $_POST['kra'];
    $query = $conn->query("SELECT * FROM kra_tbl WHERE kra_name = '$kra'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>KRA is taken.</div>";
    elseif(ctype_space($kra)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($kra)) < 6):
        echo "<div class='tomato-color'>KRA should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['obj_name'])):
    $obj_name = $_POST['obj_name'];
    $query = $conn->query("SELECT * FROM tobj_tbl WHERE tobj_name = '$obj_name'");

    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Objective is taken.</div>";
    elseif(ctype_space($obj_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($obj_name)) < 6):
        echo "<div class='tomato-color'>Objective should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['mtkra'])):
    $mtkra = $_POST['mtkra'];
    $query = $conn->query("SELECT * FROM kra_tbl WHERE kra_name = '$mtkra'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>KRA is taken.</div>";
    elseif(ctype_space($mtkra)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtkra)) < 6):
        echo "<div class='tomato-color'>KRA should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['mtobj_name'])):
    $mtobj_name = $_POST['mtobj_name'];
    $query = $conn->query("SELECT * FROM mtobj_tbl WHERE mtobj_name = '$mtobj_name'");

    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Objective is taken.</div>";
    elseif(ctype_space($mtobj_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtobj_name)) < 6):
        echo "<div class='tomato-color'>Objective should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;
?>