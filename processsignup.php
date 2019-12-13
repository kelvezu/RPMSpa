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
    $prc_id = $_POST['prc_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $school = $_POST['school'];
    $added_by = $_POST['added_by'];

    $sql = "SELECT * FROM account_tbl WHERE email = '$email'";
    $results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results) > 0):
        echo 'Email is already taken';
    else:
        $username = usernameGen($firstname, $surname, $contact);
        $password = defaultPwd();
        $activation_code = uniqid(rand('1000', '9999'));
        $status = "For Transfer";

        
        $sql = "INSERT INTO account_tbl (`prc_id`, `surname`, `firstname`, `middlename`, `position`, `email`, `contact`, `gender`, `birthdate`, `username`, `userpassword`, `added_by`, `school_id`, `activation_code`, `status`) VALUES ($prc_id,$surname,$firstname,$middlename,$position,$email,$contact, $gender, $birthdate, $username, $password, $added_by, $school, $activation_code,$status)";

        // $lastId = mysqli_insert_id($conn);
        // $pwd = 'Welcome' . date('Y');


    endif;

endif;

?>
