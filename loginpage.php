<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="img/favicon.ico">
  <title>Online Results-based Performance
    Management System </title>
</head>

<body>


  <header>
    <!-- <link rel="stylesheet" href="css/bootstrap4.css"> -->
    <link rel="stylesheet" href="bootstrap4/b4css/main.css">
    <link rel="stylesheet" href="bootstrap4/b4css/bootstrap.min.css">

    <?php
    session_start();
    include_once 'includes/conn.inc.php';
    include_once 'libraries/func.lib.php';
    include_once 'includes/constants.inc.php';

    activeSY($conn);
    if (!empty($_SESSION['active_sy_id'])) :
      endSchoolYear($conn, $_SESSION['active_sy_id']);
    else : false;
    endif;

    if (isset($_SESSION['position'])) :
      redirectToDashboard($_SESSION['position']);
    else :
      false;
    endif;
    ?>

  </header>

  <div class="container col-sm-4 mt-5">
    <div class="row mb-3">
      <center />
      <img src="img/depeds.png" width="80" height="80" alt="">
      <span class=" text-center">
        <h5>Online Result-based Performance Monitoring System</h6>
      </span>
    </div>

    <div class="card border-dark">
      <div class="card-header bg-dark text-white font-weight-bold">

        Please Enter your Credentials
      </div>
      <div class="card-body">

        <?php if (isset($_GET['error'])) : ?>
          <p class="form-messages"><?php loginError($_GET['error']); ?></p>
        <?php else : false;
        endif;
        ?>


        <form action="includes/login.inc.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1" class="form-control-label font-weight-bold">Email address/Username </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="userMail" placeholder="Enter email or username" autocomplete="off" required spellcheck="false">
          </div>

          <div class="form-group">
            <label for="exampleInputPassword1" class="form-control-label font-weight-bold">Password</label>
            <input type="password" class="form-control" name="pwd" id="exampleInputPassword1" placeholder="Password" required>
          </div>


          <div class="row align-items-center justify-content-center">
            <button type="submit" name="login-submit" class="btn btn-primary">Login</button>
          </div>

          <div class="row align-items-center justify-content-center my-2">
            <a href="index.php" class="text-primary text-decoration-none">Forgot Password?</a>
          </div>
        </form>

        <?php
        if (isset($_GET["newpwd"])) {
          if ($_GET["newpwd"] == "passwordupdated") {
            echo '<p>Your password has been reset!</p>';
          }
        }
        ?>

      </div>
      <div class="card-footer text-muted bg-dark">

      </div>
    </div>
  </div>
</body>


<script src="bootstrap4/scripts/boootrap.min.js"></script>
<script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
<script src="bootstrap4/scripts/popper.min.js"></script>

</html>