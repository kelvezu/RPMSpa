<?php

include 'includes/conn.inc.php';


if(isset($_POST['indicator'])):
    $indicator = $_POST['indicator'];

    $query = $conn->query("SELECT * FROM cbc_indicators_tbl WHERE indicator = '$indicator'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Core Behavioral Indicator is taken.</div>";
    elseif(ctype_space($indicator)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($indicator)) < 2):
        echo "<div class='tomato-color'>Core Behavioral Indicator should contain 2 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


?>