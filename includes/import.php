
<?php
session_start();
include_once '../libraries/func.lib.php';



if (isset($_POST["surname"])) {
    $conn = new mysqli('localhost', 'root', '', 'rpms') or die(mysqli_error($conn));


    $surname = $_POST["surname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $position = $_POST["position"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $gender = $_POST["gender"];
    $birthdate = $_POST["birthdate"];

    for ($count = 0; $count < count($surname); $count++) {


        $query1 = $conn->query('INSERT INTO account_tbl(surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword) VALUES ("' . ucwords($surname[$count]) . '","' . ucwords($firstname[$count]) . '","' . ucwords($middlename[$count]) . '","' . positionFormat($position[$count]) . '","' . $email[$count] . '","' . $contact[$count] . '","' . ucwords($gender[$count]) . '","' . $birthdate[$count] . '","' . $username = usernameGen($firstname[$count], $surname[$count], $contact[$count]) . '","' . defaultPwd() . '")') or die($conn->error);
    }
    if ($query1) :
        $category = "User Management";
        $adder_name = $_SESSION['fullname'];
        $title = "Add User";
        $msg = $adder_name . " added new users using CSV upload";
        $status = "Active";
        $adder_id = $_SESSION['user_id'];
        $adder_position = $_SESSION['position'];
        $sy_id = $_SESSION['active_sy_id'];
        $school_id = $_SESSION['school_id'];

        $query = $conn->query('INSERT INTO notification_tbl(category,title,`message`,`status`,`user_id`,rater_id,position,sy_id,school_id) VALUES ("' . $category . '","' . $title . '","' . $msg . '","' . $status . '","' . $adder_id . '","' . $adder_id . '","' . $adder_position . '","' . $sy_id . '","' . $school_id . '")') or die($conn->error);
    else :

        echo 'Error';

    endif;
}
