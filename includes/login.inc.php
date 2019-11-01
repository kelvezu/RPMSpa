<?php
$sy_desc = "";
include_once "conn.inc.php";
include_once "../libraries/func.lib.php";
$notif_array = [];
$current_date = date('Y-m-d');

// $schresult = $conn->query('SELECT * FROM school_tbl')  or die($conn->error);
// while ($schrow = $schresult->fetch_assoc()) :
//     $school_id = $schrow['school_id'];
//     $school_name = $schrow['school_name'];
// endwhile;



if (isset($_POST['login-submit'])) {
    $userEmail = $_POST['userMail'];
    $password = $_POST['pwd'];

    if (empty($userEmail) || empty($password)) {
        // header("Location:../loginpage.php?error=emptyfields");
        array_push($notif_array, 'Fields must not be Empty!');
        return json_encode($notif_array);
        exit();
    } else {
        $sql = "SELECT * FROM account_tbl WHERE email=? OR username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../loginpage.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $userEmail, $userEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['userpassword']);
                if ($pwdCheck == false) {
                    header("Location:../loginpage.php?error=wrongpwd");
                    exit();
                } elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['uname'] = $row['firstname'];
                    $_SESSION['mname'] = $row['middlename'];
                    $_SESSION['sname'] = $row['surname'];
                    $_SESSION['position'] = $row['position'];
                    $_SESSION['school_id'] = $row['school_id'];
                    $_SESSION['rater'] = $row['rater'];
                    $_SESSION['approving_authority'] = $row['approving_authority'];
                    $_SESSION['fullname'] = $_SESSION['uname'] . ' ' . substr($_SESSION['mname'], 0, 1) . '. ' . $_SESSION['sname'];

                    header("location:../loginpage.php?success=" . $_SESSION['fullname']);
                } else {
                    header("Location:../loginpage.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location:../loginpage.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location:../loginpage.php");
    exit();
}
