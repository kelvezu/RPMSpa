<?php

if (isset($_POST["submit"])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "localhost/rpmspa/createnewpass.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require 'includes/conn.inc.php';

    $useremail = $_POST["email"];

    $sql = 'DELETE FROM resetpass WHERE email=?;';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $useremail);
        mysqli_stmt_execute($stmt);
    }

    $sql = 'INSERT INTO resetpass (email,selector,token,expires) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        $hashedtoken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $useremail, $selector, $hashedtoken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $useremail;

    $subject = 'Reset your password for RPMS';

    $message = "You've requested to reset your RPMS password. Click <a href='$url'>here</a> to enter a new password.

    <br>
    <br>
    <br>
    <br>
    <br>


    ** This is a system-generated message and does not require a signature. Please do not reply to this email. **
    DISCLAIMER:The information contained in this email message is intended only for the individual or entity to which it is addressed, and such information may be privileged or confidential and protected under applicable laws.  If you are not the intended recipient, you must not disseminate, distribute, store, print, copy or deliver this message.  Email transmission cannot be guaranteed to be error-free owing to the nature of the internet.  Therefore, you fully understand that Division Office shall not be liable for any omission or error in this message which may arise as a result of email transmission.  Further Division Office does not warrant against, and will not be liable and/or responsible for, any loss or damage that the receipt, use or other disposition of this e-mail and/or its attachments may cause to the recipient's computer or network.";

    $headers = "From: RPMS Support <RPMS@gmail.com>\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: index.php?reset=success");
} else {
    header("Location:index.php");
}
