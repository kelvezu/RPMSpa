 <?php
 
  
include "conn.inc.php";


//REDIRECT THE USER IF NOT LOGGED IN
// if(empty($_SESSION['user_id'])){
//         // header('location:loginpage.php');
//         echo 'uncomment the header in php'
//         exit();

//       }else{
         '<b>user id:</b> '.$_SESSION['user_id'];
         ' <b>name:</b> '.$_SESSION['uname'];
         ' <b>position:</b> '.$_SESSION['position'];
         ' <b>SY:</b> '.$_SESSION['sy'];
         ' <b>SY_ID:</b> '.$_SESSION['sy_id'];
         ' <b>sch_id:</b> '.$_SESSION['school_id'];
          
         
    
  //  }


