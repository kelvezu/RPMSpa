<header>
    <link rel="stylesheet" href="css/bootstrap.css">
    <?php
        session_start();
        include 'includes/conn.inc.php';
    ?>  
</header>

  


<div class="container col-sm-4 my-4">
<div class="card text-center">
  <div class="card-header bg-dark text-white ">
    Please Enter your Credentials
  </div>
  <div class="card-body">

        <form action="includes/login.inc.php" method="post"> 
        <div class="form-group">
            <label for="exampleInputEmail1">Email address/Username </label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="userMail"  placeholder="Enter email or username">
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="pwd" id="exampleInputPassword1" placeholder="Password">
        </div>
 
    
        <div>
        <button type="submit" name="login-submit" class="btn btn-primary">Login</button> 
        </div>
        <div>
        <a href="requestreset.php">Forgot Password?</a>
        </div>
        
        </form>
    
    
  </div>
  <div class="card-footer text-muted bg-dark">
  
  </div>
</div>
</div>

