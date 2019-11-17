<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>




<?php
include 'includes/conn.inc.php';

if (isset($_GET["code"])) {
    $code = $_GET["code"];

    $getquery = mysqli_query($conn, "SELECT email FROM resetpassword WHERE code='$code'") or die($conn->error);
    if (mysqli_num_rows($getquery) == 0) {
        exit("Can't find code!");
    }

    if (isset($_POST["submit"])) {
        $pw = $_POST["password"];
        $pw2 = $_POST["password2"];
        $hashedPwd = password_hash($pw2, PASSWORD_DEFAULT);


        if (strlen($pw) >= 8) {

            if ($pw == $pw2) {

                $row = mysqli_fetch_array($getquery);
                $email = $row["email"];

                $query = mysqli_query($conn, "UPDATE account_tbl SET userpassword='$hashedPwd' WHERE email='$email'  ");

                if ($query) {
                    $query = mysqli_query($conn, "DELETE FROM resetpassword WHERE code='$code'");
                    exit("<div class='alert alert-success' role='alert'>Your password has been updated. Go to <a href='loginpage.php'>login</a> page. </div>");
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                                Your password don't match </div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
                Your password is too short! Please input at least 8 characters. </div>";
        }
    }
}
?>

<div class="container">
    <div class="col-sm-12 text-center">
        <div class="row">
            <h1>Change Password</h1>
            <p class="text-center">Please input new password.</p>
        </div>
    </div>

    <form method="post" id="passwordForm">

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3"><br>
                <input type="password" class="input-lg form-control" name="password" id="password1" placeholder="New Password" autocomplete="off">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6  col-sm-offset-3"><br>
                <input type="password" class="input-lg form-control" name="password2" id="inputPassword" placeholder="Repeat Password" autocomplete="off">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6  col-sm-offset-3"><br>
                <input type="submit" name="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">

            </div>
        </div>

    </form>
</div>
</div>