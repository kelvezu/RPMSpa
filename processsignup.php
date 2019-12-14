<?php

include 'includes/conn.inc.php';

if(isset($_POST['prc_id'])):
    $prc_id = $_POST['prc_id'];
    $sql = "SELECT * FROM account_tbl WHERE prc_id = '$prc_id'";
    $results = mysqli_query($conn,$sql);
    	if (mysqli_num_rows($results) > 0):
  	        echo "taken";	
        else:
  	        echo 'not_taken';
        endif;
  	exit();
endif;

if(isset($_POST['email'])):
    $email = $_POST['email'];
    $sql = "SELECT * FROM account_tbl WHERE email = '$email'";
    $results = mysqli_query($conn,$sql);
    	if (mysqli_num_rows($results) > 0):
  	        echo "taken";	
        else:
  	        echo 'not_taken';
        endif;
  	exit();
endif;

if(isset($_POST['surname'])):
    $surname = $_POST['surname'];
    if(strlen($surname) < 2):
        echo "Not Valid";
    else:
        echo "Valid";
    endif;
endif;

if(isset($_POST['firstname'])):
    $firstname = $_POST['firstname'];
    if(strlen($firstname) < 2):
        echo "Not Valid";
    else:
        echo "Valid";
    endif;
endif;

if(isset($_POST['middlename'])):
    $middlename = $_POST['middlename'];
    if(strlen($middlename) < 2):
        echo "Not Valid";
    else:
        echo "Valid";
    endif;
endif;


if(isset($_POST['contact'])):
    $contact = $_POST['contact'];
    $sql = "SELECT * FROM account_tbl WHERE contact = '$contact'";
    $results = mysqli_query($conn,$sql);
         if(mysqli_num_rows($results) > 0):
            echo "taken";
        else:
            echo 'not_taken';
        endif;
    exit();
endif;

if(isset($_POST['birthdate'])):
    $birthdate = $_POST['birthdate'];
    $from = new DateTime($birthdate);
    $to   = new DateTime('today');
    $age = $from->diff($to)->y;

    if($age < 18):
        echo "Not Valid";
    else:
        echo 'Valid';
    endif;
    exit();
endif;

if(isset($_POST['school'])):
    $school = $_POST['school'];
    $position = "Principal";
    $sql = "SELECT * FROM account_tbl WHERE school_id = '$school' AND position = '$position'";
    $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) > 0):
            echo "taken";
        else:
            echo 'not_taken';
        endif;
        
    exit();
endif;

if(isset($_POST['save'])):
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


    if (!empty($school)) :
        $sql = "INSERT INTO account_tbl(prc_id,surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword,added_by,school_id,activation_code,`status`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) :
                header("Location:../signup.php?error=sqlerror");
                exit();               

                if (!empty($school)) :

                    mysqli_stmt_bind_param($stmt, "issssssssssiiss", $prc_id, $surname, $firstname, $middlename, $position, $email, $contact, $gender, $birthdate, $school, $added_by, $username, $password, $activation_code, $status);

                    $resultInsert = mysqli_stmt_execute($stmt) or die($conn->error);

                    // $lastId = mysqli_insert_id($conn);
                    // $pwd = 'Welcome' . date('Y');

                    // $url = 'http://' . $_SERVER['SERVER_NAME'] . '/rpms/verify.php?id=' . $lastId . '&activation_code=' . $activation_code;

                    // $output = '<div>Thanks for registering with localhost. <br>
                    // Your Username is ' . $username . '. <br>
                    // Your Password is ' . $pwd . '. <br>
                    // Please click this link to complete this registation <br>' . $url . '</div>';

                    // if ($resultInsert == true) :
                    //     $mail = new PHPMailer();
                    //     $mail->isSMTP();
                    //     $mail->Host = 'smtp.gmail.com';
                    //     $mail->SMTPAuth = true;
                    //     $mail->Username = EMAIL;
                    //     $mail->Password = PASS;
                    //     $mail->SMTPSecure = 'tls';
                    //     $mail->Port = 587;
                    //     $mail->setFrom(EMAIL, 'RPMSSupport@noreply.com');
                    //     $mail->addAddress($email, $firstname);

                    //     $mail->isHTML(true);
                    //     $mail->Subject = 'Email Verification';
                    //     $mail->Body    = $output;

                    //     if (!$mail->send()) :
                    //         header("Location../sign.up.php?signup=mailerror");
                    //         exit();
                    //     else:
                    //         header("Location:../signup.php?signup=success&uname=" . $username);
                    //         exit();
                    //     endif;
                    // endif;

                    header("Location:../signup.php?signup=success&uname=" . $username);
                    exit();

                endif;
            endif;
        endif;
    endif;
?>
