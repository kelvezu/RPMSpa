<?php

include 'includes/conn.inc.php';

if(isset($_POST['school_no'])):
    $school_no = $_POST['school_no'];
    $query = $conn->query("SELECT * FROM school_tbl WHERE school_no = '$school_no'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>School Number is taken.</div>";
    elseif(ctype_space($school_no)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($school_no)) < 6):
        echo "<div class='tomato-color'>School Number should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['school_name'])):

    $school_name = $_POST['school_name'];
    $query = $conn->query("SELECT * FROM school_tbl WHERE school_name = '$school_name'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>School Name is taken.</div>";
    elseif(ctype_space($school_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($school_name)) < 8):
        echo "<div class='tomato-color'>School Number should be contain 8 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;


endif;

if(isset($_POST['telno'])):

    $telno = $_POST['telno'];
    $query = $conn->query("SELECT * FROM school_tbl WHERE tel_no = '$telno' OR tel_no2 = '$telno' ");

    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Telephone Number is taken.</div>";
    elseif((strlen($telno)) < 8):
        echo "<div class='tomato-color'>Telephone Number should be contain 8 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;

endif;


?>

