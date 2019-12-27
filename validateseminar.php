<?php

include 'includes/conn.inc.php';


if(isset($_POST['semname'])):
    $semname = $_POST['semname'];

    $query = $conn->query("SELECT * FROM seminar_tbl WHERE seminar_name = '$semname'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Seminar Name is taken.</div>";
    elseif(ctype_space($semname)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($semname)) < 5):
        echo "<div class='tomato-color'>Seminar Name should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


?>