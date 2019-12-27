<?php

include 'includes/conn.inc.php';


if(isset($_POST['main_mov'])):
    $main_mov = $_POST['main_mov'];

    if(ctype_space($main_mov)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($main_mov)) < 5):
        echo "<div class='tomato-color'>Main MOV should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['supp_mov'])):
    $supp_mov = $_POST['supp_mov'];

    if(ctype_space($supp_mov)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($supp_mov)) < 5):
        echo "<div class='tomato-color'>Supporting MOV should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['mtmain_mov'])):
    $mtmain_mov = $_POST['mtmain_mov'];

    if(ctype_space($mtmain_mov)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtmain_mov)) < 5):
        echo "<div class='tomato-color'>Main MOV should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['mtsupp_mov'])):
    $mtsupp_mov = $_POST['mtsupp_mov'];

    if(ctype_space($mtsupp_mov)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($mtsupp_mov)) < 5):
        echo "<div class='tomato-color'>Supporting MOV should contain at least 5 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;
?>