 <?php
 
  
include "conn.inc.php";


//REDIRECT THE USER IF NOT LOGGED IN
// if(empty($_SESSION['user_id'])){
//         // header('location:loginpage.php');
//         echo 'uncomment the header in php'
//         exit();

//       }else{
          
            if(isset($_SESSION['user_id'])):
            $_SESSION['uname'];
            $_SESSION['position'];
            $_SESSION['sy'];
            $_SESSION['sy_id'];
            $_SESSION['school_id'];
            else:
            $_SESSION['user_id'] = "";
            $_SESSION['uname'] = "";
            $_SESSION['position'] = "";
            $_SESSION['sy'] = "";
            $_SESSION['sy_id'] = "";
            $_SESSION['school_id'] = "";
            endif;
        
          
         
    
  //  }


