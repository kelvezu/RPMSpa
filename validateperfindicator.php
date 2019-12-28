<?php

include 'includes/conn.inc.php';


if(isset($_POST['indicator_name'])):
    $indicator_name = $_POST['indicator_name'];

    if(ctype_space($indicator_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($indicator_name)) < 5):
        echo "<div class='tomato-color'>Indicator Name should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['desc'])):
    $desc = $_POST['desc'];

    if(ctype_space($desc)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($desc)) < 10):
        echo "<div class='tomato-color'>Description should contain at least 10 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['mtindicator_name'])):
    $mtindicator_name = $_POST['mtindicator_name'];

    if(ctype_space($mtindicator_name)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtindicator_name)) < 5):
        echo "<div class='tomato-color'>Indicator Name should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['mtdesc'])):
    $mtdesc = $_POST['mtdesc'];

    if(ctype_space($mtdesc)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtdesc)) < 10):
        echo "<div class='tomato-color'>Description should contain at least 10 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;
?>