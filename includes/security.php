
    <?php

    include_once 'conn.inc.php';

    //REDIRECT THE USER IF NOT LOGGED IN
    if (empty($_SESSION['user_id'])) :
      header('location:loginpage.php');
      exit();

    else :

      if (isset($_SESSION['user_id'])) :
        echo ' <b>USER_ID: </b>' . $_SESSION['user_id'];
        echo ' <b>FIRSTNAME: </b>' . $_SESSION['uname'];
        echo ' <b>POSITION: </b>' . $_SESSION['position'];
        echo ' <b>SY: </b>' . $_SESSION['sy'];
        echo ' <b>SY_ID: </b>' . $_SESSION['sy_id'];
        echo ' <b>SCHOOL_ID: </b>' . $_SESSION['school_id'];
      else :
        $_SESSION['user_id'] = "";
        $_SESSION['uname'] = "";
        $_SESSION['position'] = "";
        $_SESSION['sy'] = "";
        $_SESSION['sy_id'] = "";
        $_SESSION['school_id'] = "";
      endif;
    endif;








    ?>
