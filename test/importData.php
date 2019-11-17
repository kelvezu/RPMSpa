<?php
// Load the database configuration file
include_once 'conn.php';

if(isset($_POST['upload'])){

    $prc_id = $_POST['prc_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];

   
    
    // Check whether member already exists in the database with the same email
   
  
        for($count = 0; $count < count($prc_id); $count++){
        // Insert member data in the database

        $prevQuery = "SELECT * FROM members WHERE email = '$email[$count]'";
        $prevResult = $db->query($prevQuery) or die($db->error);
        if($prevResult){
            // echo $prevResult->num_rows;
            if($prevResult->num_rows == 0){
                $db->query('INSERT INTO members (prc_id,surname,firstname,middlename,position, email, contact, gender, birthdate ) VALUES ("'.$prc_id[$count].'","'.$surname[$count].'", "'.$firstname[$count].'", "'.$middlename[$count].'","'.$position[$count].'", "'.$email[$count].'","'.$contact[$count].'","'.$gender[$count].'","'.$bday[$count].'")') or die($db->error);
            }else{
                echo "$email[$count] is already registered!<br>";
            }
        }

       
           
        
          
        
          
       




        
        }
        
   
}

            
// Redirect to the listing page
// header("Location: index2.php".$qstring);