
<?php

require '../PHPMailer/PHPMailerAutoload.php';
require '../credential.php';

session_start();
include_once '../libraries/func.lib.php';




if (isset($_POST["upload"])) :
    $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

    $prc_id = $_POST['prc_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $added_by = $_POST['adder_id'];
    $password = defaultPwd();
    // $username = usernameGen($firstname, $surname, $contact);




    for ($count = 0; $count < count($prc_id); $count++) :

      
        $check_prc_qry = "SELECT * FROM account_tbl WHERE prc_id = $prc_id[$count]";
        $prc_query = $conn->query($check_prc_qry) or die($db->error);
        if(mysqli_num_rows($prc_query) > 0):
            header("Location:../usercsv.php?notif=prctaken&prc=$prc_id[$count]");
            exit();
        endif;


        $activation_code = uniqid(rand('1000', '9999'));
        // Check whether member already exists in the database with the same email

        $prevQuery = "SELECT * FROM account_tbl WHERE email = '$email[$count]'";
        $prevResult = $conn->query($prevQuery) or die($db->error);
        if ($prevResult->num_rows == 0) :
            $query1 = $conn->query('INSERT INTO account_tbl(prc_id,surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword,added_by,activation_code) VALUES ("' . $prc_id[$count] . '","' . ucwords($surname[$count]) . '","' . ucwords($firstname[$count]) . '","' . ucwords($middlename[$count]) . '","' . positionFormat($position[$count]) . '","' . $email[$count] . '","' . $contact[$count] . '","' . ucwords($gender[$count]) . '","' . $bday[$count] . '","' . usernameGen($firstname[$count], $surname[$count], $contact[$count])   . '","' . $password . '", ' . $added_by . ',"' . $activation_code . '" )') or die($conn->error);

            $lastId_array = [];
            $lastId = mysqli_insert_id($conn);
            array_push($lastId_array, mysqli_insert_id($conn));
            $pwd = 'Welcome' . date('Y');

            /* -----------------------------------------------------------------------------------------------*/
            foreach ($lastId_array as $LIA) :
                $username = usernameGen($firstname[$count], $surname[$count], $contact[$count]);

                $url = 'http://' . $_SERVER['SERVER_NAME'] . '/rpms/verify.php?id=' . $LIA . '&activation_code=' . $activation_code;
                $output = '<div>Thanks for registering with localhost. <br>
                Your Username is ' . $username . '. <br>
                Your Password is ' . $pwd . '. <br>
                Please click this link to complete this registation <br>' . $url . '</div>';


                if ($query1 == true) :
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = EMAIL;
                    $mail->Password = PASS;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom(EMAIL, 'RPMSSupport@noreply.com');
                    $mail->addAddress($email[$count], $firstname[$count]);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification';
                    $mail->Body    = $output;

                    if (!$mail->send()) :
                        header("Location../usercsv.php?notif=mailerror");
                        exit();
                    else :
                        header("Location:../usercsv.php?notif=success");
                    endif;
                endif;

                if ($query1) :
                    $category = "User Management";
                    $adder_name = $_SESSION['fullname'];
                    $added_name = ucwords($firstname[$count]) . ' ' . ucwords(substr($middlename[$count], 0, 1)) . '. ' . ucwords($surname[$count]);
                    $title = "Add User";
                    $msg = $adder_name . " added new user $added_name using CSV upload";
                    $status = "Active";
                    $adder_id = $_SESSION['user_id'];
                    $adder_position = $_SESSION['position'];
                    $sy_id = $_SESSION['active_sy_id'];
                    $school_id = $_SESSION['school_id'];


                    $query = $conn->query('INSERT INTO notification_tbl(category,title,`message`,`status`,`user_id`,rater_id,position,sy_id,school_id) VALUES ("' . $category . '","' . $title . '","' . $msg . '","' . $status . '","' . $adder_id . '","' . $adder_id . '","' . $adder_position . '","' . $sy_id . '","' . $school_id . '")') or die($conn->error);
                else :
                    header("Location:../usercsv.php?notif=error");
                endif;

            endforeach;


        else :
            //echo "$email[$count] is already registered!<br>";
            $dup_email_arr = array();
            array_push($dup_email_arr, $email[$count]);
            header("Location:../usercsv.php?notif=emailerror&email=".$email[$count]."");
        endif;
    endfor;
endif;
