
<?php

include 'includes/conn.inc.php';


if(isset($_POST['password_sub'])):
    $pass = $_POST['pass'];
    $school_id = $_POST['school_id'];
    $teacher_id = $_POST['user_id'];
    $obs = $_POST['obs'];
    $sy_id = $_POST['sy_id'];

    $password = $conn->query("SELECT * FROM account_tbl WHERE position = 'Principal' AND school_id = '$school_id' ") or die ($conn->error);
        while($row = $password->fetch_assoc()):
            $principalpass = $row['userpassword'];
  
    $pwdCheck = password_verify($pass, $principalpass);

    if($pwdCheck == false):
        header("location:displaymtcotprogress.php?user_id=$teacher_id&obs=$obs&notif=pwerror");
    else: 
        header("location:coteditMTpage.php?user_id=$teacher_id&obs=$obs&school_id=$school_id&sy_id=$sy");
    endif;

endwhile;
endif;



?>





<?php

include 'samplefooter.php';

?>