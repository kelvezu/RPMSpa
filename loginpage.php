<header>
  <link rel="stylesheet" href="css/bootstrap4.css">

  <?php
  session_start();
  include_once 'includes/conn.inc.php';


  ?>
</header>




<div class="container col-sm-4 my-4">
  <div class="card">
    <div class="card-header bg-dark text-white font-weight-bold">
      Please Enter your Credentials
    </div>
    <div class="card-body">

      <form action="includes/login.inc.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1" class="form-control-label font-weight-bold">Email address/Username </label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="userMail" placeholder="Enter email or username" autocomplete="off" required>
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