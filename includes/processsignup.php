<?php

require '../PHPMailer/PHPMailerAutoload.php';
require '../credential.php';

if (isset($_POST['submit'])) :
    require_once "conn.inc.php";
    include_once "../libraries/func.lib.php";

    $prc_id = filter_var($_POST['prc_id'],FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'],FILTER_SANITIZE_STRING);
    $firstname = filter_var($_POST['firstname'],FILTER_SANITIZE_STRING);
    $middlename = filter_var($_POST['middlename'],FILTER_SANITIZE_STRING);
    $position = filter_var($_POST['position'],FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $contact = filter_var($_POST['contact'],FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'],FILTER_SANITIZE_STRING);
    $birthdate = filter_var($_POST['birthdate'],FILTER_SANITIZE_STRING);
    $school = filter_var($_POST['school'],FILTER_SANITIZE_STRING);
    $added_by = filter_var($_POST['added_by'],FILTER_VALIDATE_INT);
    $username = usernameGen($firstname, $surname, $contact);
    $status = "For Transfer";
    $password = defaultPwd();
    $activation_code = uniqid(rand('1000', '9999'));

 

    $sql = "INSERT INTO account_tbl(prc_id,surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword,added_by,school_id,activation_code,`status`) VALUES( '.$prc_id.' , '".$surname."', '".$firstname."', '".$middlename."', '".$position."', '".$email."', '".$contact."', '".$gender."', '".$birthdate."',  '".$username."', '".$password."', '.$added_by.', '.$school.',  '".$activation_code."', '".$status."')";
    $insert_Qry = mysqli_query($conn,$sql) or die ($conn->error);

                    $lastId = mysqli_insert_id($conn);
                    $pwd = 'Welcome' . date('Y');

                    $url = 'http://' . $_SERVER['SERVER_NAME'] . '/rpms/verify.php?id=' . $lastId . '&activation_code=' . $activation_code;

                    $output = '<div>Thanks for registering with localhost. <br>
                    Your Username is ' . $username . '. <br>
                    Your Password is ' . $pwd . '. <br>
                    Please click this link to complete this registation <br>' . $url . '</div>';

                    if ($resultInsert == true) :
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

                        if (!$mail->send()) :
                            header("Location../signup2.php?signup=mailerror");
                            exit();
                        else:
                            header("Location:../signup2.php?signup=success&uname=" . $username);
                            exit();
                        endif;
                    endif;

                    header("Location:../signup2.php?signup=success&uname=" . $username);
                    exit();
else:
    header("Location:../signup2.php?error");
    exit();
endif;


?>