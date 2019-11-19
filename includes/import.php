
<?php
session_start();
include_once '../libraries/func.lib.php';



if (isset($_POST["upload"])) :
    $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));

    $prc_id = $_POST['prc_id'];
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $added_by = $_POST['adder_id'];
 


    for ($count = 0; $count < count($prc_id); $count++) :

        // Check whether member already exists in the database with the same email

        $prevQuery = "SELECT * FROM account_tbl WHERE email = '$email[$count]'";
        $prevResult = $conn->query($prevQuery) or die($db->error);
        if($prevResult):

             if($prevResult->num_rows == 0):

                $query1 = $conn->query('INSERT INTO account_tbl(prc_id,surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword,added_by) VALUES ("' . $prc_id[$count] . '","' . ucwords($surname[$count]) . '","' . ucwords($firstname[$count]) . '","' . ucwords($middlename[$count]) . '","' . positionFormat($position[$count]) . '","' . $email[$count] . '","' . $contact[$count] . '","' . ucwords($gender[$count]) . '","' . $bday[$count] . '","' . $username = usernameGen($firstname[$count], $surname[$count], $contact[$count]) . '","' . defaultPwd() . '", ' . $added_by . ' )') or die($conn->error);
              
                if ($query1):
                    $category = "User Management";
                    $adder_name = $_SESSION['fullname'];
                    $added_name = ucwords($firstname[$count]).' '.ucwords(substr($middlename[$count],0,1)).'. '.ucwords($surname[$count]);
                    $title = "Add User";
                    $msg = $adder_name . " added new user $added_name using CSV upload";
                    $status = "Active";
                    $adder_id = $_SESSION['user_id'];
                    $adder_position = $_SESSION['position'];
                    $sy_id = $_SESSION['active_sy_id'];
                    $school_id = $_SESSION['school_id'];
                    
            
                    $query = $conn->query('INSERT INTO notification_tbl(category,title,`message`,`status`,`user_id`,rater_id,position,sy_id,school_id) VALUES ("' . $category . '","' . $title . '","' . $msg . '","' . $status . '","' . $adder_id . '","' . $adder_id . '","' . $adder_position . '","' . $sy_id . '","' . $school_id . '")') or die($conn->error);
            
                    header("Location:../usercsv.php?notif=success");
                
                else:
                    header("Location:../usercsv.php?notif=error");
                endif;


                    
                    
            else:
                //echo "$email[$count] is already registered!<br>";
                $dup_email_arr = array();
                array_push($dup_email_arr,$email[$count]);
                $_SESSION['dup_email'] = $dup_email_arr;
               
            endif;
        else:
            echo 'Error!';
        endif;
    endfor;
endif;
               
   
