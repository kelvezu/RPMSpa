<?php

if (isset($_POST["submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $password2 = $_POST["pwd2"];

    if (empty($password) || empty($password2)) {
        header("Location:createnewpass.php?newpwd=empty");
        exit();
    } elseif ($password != $password2) {
        header("Location:createnewpass.php?newpwd=pwdnotsame");
        exit();
    }

    $currentdate = date("U");

    require 'conn.inc.php';

    $sql = 'SELECT * FROM resetpass WHERE selector=? AND expires >= ?';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentdate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submityour reset request.";
            exit();
        } else {

            $tokenbin = hex2bin($validator);
            $tokencheck = password_verify($tokenbin, $row["token"]);

            if ($tokencheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } elseif ($tokencheck === true) {

                $tokenemail = $row["email"];

                $sql = 'SELECT * FROM account_tbl WHERE email =?;';
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    } else {
                        $sql = 'UPDATE account_tbl SET userpassword=? WHERE email=?';
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        } else {
                            $newpwdhash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenemail);
                            mysqli_stmt_execute($stmt);

                            $sql = 'DELETE FROM resetpass WHERE email=?';
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenemail);
                                mysqli_stmt_execute($stmt);
                                header("Location:../loginpage.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location:index.php");
}
