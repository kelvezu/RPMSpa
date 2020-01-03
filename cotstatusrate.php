
<?php

include 'libraries/func.lib.php';
include 'includes/conn.inc.php';


if(isset($_POST['password_sub'])):
    $pass = $_POST['pass'];
    $school_id = $_POST['school_id'];
    // $sy_id = $_POST['sy_id'];

    $password = $conn->query("SELECT * FROM account_tbl WHERE position = 'Principal' AND school_id = '$school_id' ") or die ($conn->error);
        while($row = $password->fetch_assoc()):
            $principalpass = $row['userpassword'];
  
    $pwdCheck = password_verify($pass, $principalpass);

    if($pwdCheck == false):
        header("Location:cotstatus.php?notif=wrongpassword");
    else: 
        header("Location:cotformT.php");
    endif;

endwhile;
endif;



?>



