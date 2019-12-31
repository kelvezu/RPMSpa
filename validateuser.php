<?php

include 'includes/conn.inc.php';

if(isset($_POST['prc_id'])):
    $prc_id = $_POST['prc_id'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE prc_id = '$prc_id'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>PRC ID is taken.</div>";
    elseif(ctype_space($prc_id)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($prc_id)) < 6):
        echo "<div class='tomato-color'>PRC ID should contain 6 digits above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['email'])):
    $email = $_POST['email'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE email = '$email'");

    $rowCount = $query->num_rows;


    if($rowCount > 0):
        echo "<div class='tomato-color'>Email is taken.</div>";
    elseif(ctype_space($email)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($email)) < 6):
        echo "<div class='tomato-color'>Invalid Email.</div>";
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        echo "<div class='tomato-color'>Invalid Email Format.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['surname'])):
    $surname = $_POST['surname'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE surname = '$surname'");

    $rowCount = $query->num_rows;


    if(ctype_space($surname)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($surname)) < 2):
        echo "<div class='tomato-color'>Surname should consist at least 2 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['firstname'])):
    $firstname = $_POST['firstname'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE firstname = '$firstname'");

    $rowCount = $query->num_rows;


    if(ctype_space($firstname)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($firstname)) < 2):
        echo "<div class='tomato-color'>Firstname should consist at least 2 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['middlename'])):
    $middlename = $_POST['middlename'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE middlename = '$middlename'");

    $rowCount = $query->num_rows;


    if(ctype_space($middlename)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($middlename)) < 2):
        echo "<div class='tomato-color'>Middlename should consist at least 2 characters above.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['contact'])):
    $contact = $_POST['contact'];
    $query = $conn->query("SELECT * FROM account_tbl WHERE contact = '$contact'");

    $rowCount = $query->num_rows;

    if($rowCount > 0):
        echo "<div class='tomato-color'>Contact number is taken.</div>";
    elseif(ctype_space($contact)):
        echo "<div class='tomato-color'>Whitespace are not allowed.</div>";
    elseif((strlen($contact)) < 11):
        echo "<div class='tomato-color'>Contact should consist of 11 digits.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;

if(isset($_POST['birthdate'])):
    $birthdate = $_POST['birthdate'];
    $from = new DateTime($birthdate);
    $to   = new DateTime('today');
    $age = $from->diff($to)->y;

    if($age < 18):
        echo "<div class='tomato-color'>Birthdate not valid.</div>";
    elseif($age > 65):
        echo "<div class='tomato-color'>Birthdate not valid.</div>";
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


if(isset($_POST['school']) && isset($_POST['position'])):
    $school = $_POST['school'];
    $position = $_POST['position'];

    if($position == 'Principal'):
        $query = $conn->query("SELECT * FROM account_tbl WHERE school_id = '$school'");

        $rowCount = $query->num_rows;


        if($rowCount > 0):
            echo "<div class='tomato-color'>Only one principal is allowed per school.</div>";
        else:
            echo "<div class='apple-color'>Valid</div>";
        endif;
    else:
        echo "<div class='apple-color'>Valid</div>";
    endif;
endif;


?>