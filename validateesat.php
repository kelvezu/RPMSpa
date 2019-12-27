<?php

include 'includes/conn.inc.php';


if(isset($_POST['subj'])):
    $subj = $_POST['subj'];

    $query = $conn->query("SELECT * FROM subject_tbl WHERE subject_name = '$subj'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Subject Level is taken.</div>";
    elseif(ctype_space($subj)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($subj)) < 2):
        echo "<div class='tomato-color'>Subject Level should contain 2 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['age'])):
    $age = $_POST['age'];

    $query = $conn->query("SELECT * FROM age_tbl WHERE age_name = '$age'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Age Range is taken.</div>";
    elseif(ctype_space($age)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($age)) < 1):
        echo "<div class='tomato-color'>Age Range should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['position'])):
    $position = $_POST['position'];

    $query = $conn->query("SELECT * FROM position_tbl WHERE position_name = '$position'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Position is taken.</div>";
    elseif(ctype_space($position)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($position)) < 1):
        echo "<div class='tomato-color'>Position should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['totalyears'])):
    $totalyear = $_POST['totalyears'];

    $query = $conn->query("SELECT * FROM totalyear_tbl WHERE totalyear_name = '$totalyear'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Total Number of Years is taken.</div>";
    elseif(ctype_space($totalyear)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($totalyear)) < 1):
        echo "<div class='tomato-color'>Total Number of Years should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['glt'])):
    $glt = $_POST['glt'];

    $query = $conn->query("SELECT * FROM gradelvltaught_tbl WHERE gradelvltaught_name = '$glt'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Grade Level Taught is taken.</div>";
    elseif(ctype_space($glt)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($glt)) < 1):
        echo "<div class='tomato-color'>Grade Level Taught should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['curri'])):
    $curri = $_POST['curri'];

    $query = $conn->query("SELECT * FROM curriclass_tbl WHERE curriclass_name = '$curri'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Curricular Classification is taken.</div>";
    elseif(ctype_space($curri)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($curri)) < 1):
        echo "<div class='tomato-color'>Curricular Classification should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['region'])):
    $region = $_POST['region'];

    $query = $conn->query("SELECT * FROM region_tbl WHERE region_name = '$region'");
    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Region is taken.</div>";
    elseif(ctype_space($region)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($region)) < 1):
        echo "<div class='tomato-color'>Region should contain at least 1 character above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

?>