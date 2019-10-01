<?php
$sy_desc = "";
include "conn.inc.php";
include "../libraries/func.lib.php";

$current_date = date('Y-m-d');

$syresult = $conn->query('SELECT * FROM sy_tbl WHERE status = "active"')  or die($conn->error);
while ($syrow = $syresult->fetch_assoc()) :
    $end_date = $syrow['end_date'];
    $start_date = $syrow['startDate'];
    $sy_desc = $syrow['sy_desc'];
    $sy_id = $syrow['sy_id'];
endwhile;

$schresult = $conn->query('SELECT * FROM school_tbl')  or die($conn->error);
while ($schrow = $schresult->fetch_assoc()) :
    $school_id = $schrow['school_id'];
    $school_name = $schrow['school_name'];
endwhile;



if (isset($_POST['login-submit'])) {


    $userEmail = $_POST['userMail'];
    $password = $_POST['pwd'];

    if (empty($userEmail) || empty($password)) {
        header("Location:../loginpage.php?error=emptyfields");
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
                    $_SESSION['position'] = $row['position'];
                    $_SESSION['school_id'] = $row['school_id'];
                    $position = $_SESSION['position'];

                    //CHECK IF THE SCHOOL YEAR IS SET
                    if (!empty($sy_desc)) :
                        echo $_SESSION['sy'] = $sy_desc;
                        echo $_SESSION['sy_id'] = $sy_id;
                    endif;
                    directToDashboard($position);
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
