<?php
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

        $conn->query('INSERT INTO account_tbl(surname,firstname,middlename,position,email,contact,gender,birthdate,username,userpassword) VALUES ("' . ucwords($surname[$count]) . '","' . ucwords($firstname[$count]) . '","' . ucwords($middlename[$count]) . '","' . ucwords($position[$count]) . '","' . $email[$count] . '","' . $contact[$count] . '","' . ucwords($gender[$count]) . '","' . $birthdate[$count] . '","' . $username = usernameGen($firstname[$count], $surname[$count], $contact[$count]) . '","' . defaultPwd() . '")') or die($conn->error);
    }
}
