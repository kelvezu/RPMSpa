<link rel="stylesheet" href="bootstrap4/b4css/main.css">
<link rel="stylesheet" href="bootstrap4/b4css/bootstrap.min.css">
<?php

include_once 'includes/conn.inc.php';


$id = $_GET['id'];
	$activation_code = $_GET['activation_code'];

    $select = "UPDATE account_tbl SET email_status = 'Verified' WHERE `user_id` = '$id' AND activation_code = '$activation_code'";
    
	$result = mysqli_query($conn,$select);
	if ($result) {
		echo '<div class="green-notif-border my-5">You have successfully verified your email. Click <a href="loginpage.php">here</a> to login.</div>';
	}else{
		echo '<div class="red-notif-border my-5">Email Verification Failed</div>';
	}


?>

