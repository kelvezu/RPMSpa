<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'includes/conn.inc.php';

if(isset($_POST["email"])){
    $emailto = $_POST["email"];

    $code = uniqid(true);
    $query = mysqli_query($conn,"INSERT INTO resetpass(code,email) VALUES ('$code','$emailto')");
    if(!$query){
        exit("Error!");
    }
    $query2 = mysqli_query($conn,"SELECT firstname FROM account_tbl WHERE email='$emailto'");
        $row = mysqli_fetch_array($query2);
        $name = $row['firstname'];

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'guerramadz134@gmail.com';                     // SMTP username
        $mail->Password   = 'Baymax_0513';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 25;                                    // TCP port to connect to
    
        //Recipients    
        $mail->setFrom('guerramadz134@gmail.com', 'RPMS Admin');
        $mail->addAddress("$emailto");     // Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
    
        // Content
        $url = "https://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetpassword.php?code=$code";
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset Password Link';
        $mail->Body    = "<h1>Hi $name,</h1>
                        You've requested to reset your RPMS password. Click <a href='$url'>here</a> to enter a new password.
                        ** This is a system-generated message and does not require a signature. Please do not reply to this email. **
                        DISCLAIMER:The information contained in this email message is intended only for the individual or entity to which it is addressed, and such information may be privileged or confidential and protected under applicable laws.  If you are not the intended recipient, you must not disseminate, distribute, store, print, copy or deliver this message.  Email transmission cannot be guaranteed to be error-free owing to the nature of the internet.  Therefore, you fully understand that Division Office shall not be liable for any omission or error in this message which may arise as a result of email transmission.  Further Division Office does not warrant against, and will not be liable and/or responsible for, any loss or damage that the receipt, use or other disposition of this e-mail and/or its attachments may cause to the recipient's computer or network. ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        if($mail){
        echo "<div class='alert alert-success' role='alert'>Reset link has been sent to your email. Go to <a href='loginpage.php'>login</a> page.</div>";
    }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    exit();
}
?>

    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <br><br>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">

        <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
        <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
      </div>
    </div>
    <div class="form-group">
      <input name="submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
    </div>
  </form>
