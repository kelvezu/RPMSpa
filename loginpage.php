<header>
  <!-- <link rel="stylesheet" href="css/bootstrap4.css"> -->
  <link rel="stylesheet" href="css/newmain.css">
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

<div class="container col-sm-4 my-4">

  <div class="card">
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
          <a href="requestreset.php" class="text-primary text-decoration-none">Forgot Password?</a>
        </div>
      </form>


    </div>
    <div class="card-footer text-muted bg-dark">

    </div>
  </div>
</div>

<script src="bootstrap4/scripts/boootrap.min.js"></script>
<script src="bootstrap4/scripts/jquery-3.2.1.slim.min.js"></script>
<script src="bootstrap4/scripts/popper.min.js"></script>