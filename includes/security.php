
    <?php

    include_once 'conn.inc.php';

    //REDIRECT THE USER IF NOT LOGGED IN
    if (empty($_SESSION['user_id'])) :
      header('location:loginpage.php');
      exit();

    else :

      if (isset($_SESSION['user_id'])) :

        ' <b>USER_ID: </b>' . $_SESSION['user_id'];
        ' <b>FULLNAME: </b>' . $_SESSION['fullname'];
        ' <b>POSITION: </b>' . $_SESSION['position'];
        ' <b>SY: </b>' . $_SESSION['sy'];
        ' <b>SY_ID: </b>' . $_SESSION['sy_id'];
        ' <b>SCHOOL_ID: </b>' . $_SESSION['school_id'];
        $_SESSION['rater'];
        'Approving Authority: ' . $_SESSION['approving_authority'];

      else :
        $_SESSION['user_id'] = "";
        $_SESSION['fullname'] = "";
        $_SESSION['position'] = "";
        $_SESSION['sy'] = "";
        $_SESSION['sy_id'] = "";
        $_SESSION['school_id'] = "";
        $_SESSION['rater'] = "";
        $_SESSION['approving_authority'] = "";
      endif;
    endif;

    ?>