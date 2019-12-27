<?php

include 'includes/conn.inc.php';


if(isset($_POST['rubriclvl'])):
    $trubric_level = $_POST['rubriclvl'];

    $query = $conn->query("SELECT * FROM trubric_tbl WHERE rubric_lvl = '$trubric_level'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Level is taken.</div>";
    elseif(ctype_space($trubric_level)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($trubric_level)) < 0):
        echo "<div class='tomato-color'>Rubric Level should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['levelname'])):
    $levelname = $_POST['levelname'];

    $query = $conn->query("SELECT * FROM trubric_tbl WHERE level_name = '$levelname'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Name is taken.</div>";
    elseif(ctype_space($levelname)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($levelname)) < 5):
        echo "<div class='tomato-color'>Rubric Name should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['desc'])):
    $desc = $_POST['desc'];

    $query = $conn->query("SELECT * FROM trubric_tbl WHERE rubric_description = '$desc'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Description is taken.</div>";
    elseif(ctype_space($desc)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($desc)) < 10):
        echo "<div class='tomato-color'>Rubric Description should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['rubriclvlMT'])):
    $rubric_level = $_POST['rubriclvlMT'];

    $query = $conn->query("SELECT * FROM mtrubric_tbl WHERE rubric_lvl = '$rubric_level'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Level is taken.</div>";
    elseif(ctype_space($rubric_level)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($rubric_level)) < 0):
        echo "<div class='tomato-color'>Rubric Level should contain 10 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['levelnameMT'])):
    $levelnameMT = $_POST['levelnameMT'];

    $query = $conn->query("SELECT * FROM mtrubric_tbl WHERE level_name = '$levelnameMT'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Name is taken.</div>";
    elseif(ctype_space($levelnameMT)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($levelnameMT)) < 5):
        echo "<div class='tomato-color'>Rubric Name should contain 10 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['descMT'])):
    $descMT = $_POST['descMT'];

    $query = $conn->query("SELECT * FROM mtrubric_tbl WHERE rubric_description = '$descMT'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Rubric Description is taken.</div>";
    elseif(ctype_space($descMT)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($descMT)) < 10):
        echo "<div class='tomato-color'>Rubric Description should contain 10 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


?>