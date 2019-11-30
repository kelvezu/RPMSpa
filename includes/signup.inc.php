<?php

require '../PHPMailer/PHPMailerAutoload.php';
require '../credential.php';

if (isset($_POST['signup-submit'])) {
    require_once "conn.inc.php";
    include_once "../libraries/func.lib.php";

    $prc_id = $_POST['prc_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $username = usernameGen($firstname, $surname, $contact);
    $school = $_POST['school'];
    $added_by = $_POST['added_by'];

    $activation_code = md5(rand('10000','99999'));
    $status = "Active";

    //CHECK IF THE FIELDS ARE EMPTY 
    if (empty($prc_id) || empty($surname) || empty($firstname) ||  empty($email) || empty($contact)) {
        header("Location:../signup.php?error=emptyfields&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }

    //CHECK IF THE PRCID LENGTH IS LESS THAN 11
    elseif (!is_numeric($prc_id) && !strlen($prc_id) >= 5) {
        header("Location:../signup.php?error=shortprc_id&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&contact=" . $contact);
        exit();
    }

    //CHECK IF THE SURNAME FIRSTNAME MIDNAME CONTAINS SPECIAL CHARACTERS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $surname) && !preg_match("/^[a-zA-Z ]*$/", $firstname) && !preg_match("/^[a-zA-Z]*$/", $middlename)) {
        header("Location:../signup.php?error=nospeccharnames&prc_id=" . $prc_id . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF SURNAME AND FIRSTNAME CONTAINS SPECIAL CHARS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $surname) && !preg_match("/^[a-zA-Z ]*$/", $firstname)) {
        header("Location:../signup.php?error=nospeccharsnamefname&prc_id=" . $prc_id . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF FIRSTNAME AND MIDDLENAME CONTAINS SPECIAL CHARS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $firstname) && !preg_match("/^[a-zA-Z ]*$/", $middlename)) {
        header("Location:../signup.php?error=nospeccharfnamemname&prc_id=" . $prc_id . "&surname=" . $surname . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF SURNAME AND MIDDLENAME CONTAINS SPECIAL CHARS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $surname) && !preg_match("/^[a-zA-Z ]*$/", $middlename)) {
        header("Location:../signup.php?error=nospeccharsnamemname&prc_id=" . $prc_id . "&firstname=" . $firstname . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF EMAIL IS VALID
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:../signup.php?error=invalidemail&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE SURNAME CONTAINS SPECIAL CHARACTERS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
        header("Location:../signup.php?error=invalidsurname&prc_id=" . $prc_id . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE FIRSTNAME CONTAINS SPECIAL CHARACTERS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
        header("Location:../signup.php?error=invalidfirstname&prc_id=" . $prc_id . "&surname=" . $surname . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE MIDDLENAME CONTAINS SPECIAL CHARACTERS
    elseif (!preg_match("/^[a-zA-Z ]*$/", $middlename)) {
        header("Location:../signup.php?error=invalidmiddlename&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&email=" . $email . "&contact=" . $contact);
        exit();
    }

    //CHECK IF THE SURNAME LENGTH IS LESS THAN 1
    elseif (strlen($surname) <= 1) {
        header("Location:../signup.php?error=shortsurname&prc_id=" . $prc_id . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE FIRSTNAME LENGTH IS LESS THAN 1
    elseif (strlen($firstname) <= 1) {
        header("Location:../signup.php?error=shortfirstname&prc_id=" . $prc_id . "&surname=" . $surname . "&middlename=" . $middlename . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE MIDDLENAME LENGTH IS LESS THAN 1
    elseif (strlen($middlename) <= 1) {
        header("Location:../signup.php?error=shortmiddlename&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&email=" . $email . "&contact=" . $contact);
        exit();
    }
    //CHECK IF THE CONTACT IS NOT NUMERIC AND LENGTH IS NOT EQUAL TO 11 
    elseif (!is_numeric($contact) && !strlen($contact) == 11) {
        header("Location:../signup.php?error=invalidcontact&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email);
        exit();
    }
    //CHECK IF THE CONTACT IS NOT NUMERIC
    elseif (!is_numeric($contact)) {
        header("Location:../signup.php?error=contactnotnumeirc&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email);
        exit();
    }
    //CHECK IF THE CONTACT LENGTH IS EQUAL TO 11 
    elseif (strlen($contact) != 11) {
        header("Location:../signup.php?error=contactshort&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&email=" . $email);
        exit();
    } else {
        $prcquery = "SELECT prc_id FROM account_tbl WHERE prc_id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$prcquery)){
            header("Location:../signup.php?error=prciderror&surname=".$surname. "&firstname=" .$firstname. "&middlename=" .$middlename. "&contact=" .$contact);
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$prc_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $prccheck = mysqli_stmt_num_rows($stmt);
            if($prccheck > 0) {
                header("Location../signup.php?error=prctaken&surname=".$surname. "&firstname=" .$firstname. "&middlename=" .$middlename. "&contact=" .$contact);
                exit();
            }else{

        $sql = "SELECT email FROM account_tbl WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location:../signup.php?error=emailtaken&prc_id=" . $prc_id . "&surname=" . $surname . "&firstname=" . $firstname . "&middlename=" . $middlename . "&contact=" . $contact);
                exit();
            } else {
                // VALIDATE PRINCIPAL POSITION
            if($position == "Principal"):
                    $check_qry = "SELECT * FROM account_tbl WHERE school_id = $school AND position = 'Principal'";
                    $chk_result = mysqli_query($conn,$check_qry) or die($conn->error);
                    if(mysqli_num_rows($chk_result)>0):
                        header('location:../signup.php?error=oneprincipalonly');
                        exit();
                endif;              
            endif;


                if (!empty($school)) {
                    $sql = "INSERT INTO account_tbl(prc_id,surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword,added_by,school_id,activation_code) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location:../signup.php?error=sqlerror");
                        exit();
                    } else {
                        $password = defaultPwd();
                        // $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                        if (!empty($school)) {
                            
                            mysqli_stmt_bind_param($stmt, "issssssssssiis", $prc_id, nameFormat($surname), nameFormat($firstname), nameFormat($middlename), positionFormat($position), $email, $contact, ucwords($gender), $birthdate, $username, $password, $added_by, $school, $activation_code);
                        
                        $resultInsert = mysqli_stmt_execute($stmt) or die($conn->error);

                        $lastId = mysqli_insert_id($conn);

                        $url = 'http://'.$_SERVER['SERVER_NAME'].'/rpmspa/verify.php?id='.$lastId.'&activation_code='.$activation_code;

                        $output = '<div>Thanks for registering with localhost. Please click this link to complete this registation <br>'.$url.'</div>';

                        if($resultInsert == true){
                            $mail = new PHPMailer();
                            $mail->isSMTP();  
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = EMAIL;
                            $mail->Password = PASS; 
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;
                            $mail->setFrom(EMAIL, 'RPMSSupport@noreply.com');
                            $mail->addAddress($email, $firstname);

                            $mail->isHTML(true);
                            $mail->Subject = 'Email Verification';
                            $mail->Body    = $output;

                            if(!$mail->send()) {
                                header("Location../sign.up.php?signup=mailerror");
                                exit();
                            } else {
                                header("Location:../signup.php?signup=success&uname=" . $username);
                                exit();
                            }

                        }

                        header("Location:../signup.php?signup=success&uname=" . $username);
                        exit();
                    }
                        }
                } else {
                    header('location:../signup.php?error=emptyschool');
                    exit();
        
                

               
                }
            }
        }
    }
}
    mysqli_stmt_close($stmt);
    mysqli_close($stmt);
} 
}else {
    header("Location:signup.php");
    exit();
}

