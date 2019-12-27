<?php
session_start();

include 'conn.inc.php';
$conn = mysqli_connect("localhost","root","","rpms");

if (isset($_POST['save'])) {
  
    $rubric_lvl  = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];

        $validate = mysqli_query($conn,"SELECT * FROM mtrubric_tbl WHERE rubric_lvl = '$rubric_lvl' OR level_name= '$level_name' OR rubric_description = '$rubric_description'") or die($conn->error);
        $count_result = mysqli_num_rows($validate);
        
        if($count_result > 0){
            header("location:../displaymtRubric.php?notif=taken");
            exit();
        }elseif((ctype_space($rubric_lvl)) || (ctype_space($level_name)) || (ctype_space($rubric_description))){
            header("location:../displaymtRubric.php?notif=whitespace");
            exit();
        }elseif((strlen($rubric_lvl)) < 0 || (strlen($level_name)) < 5 || (strlen($rubric_description)) < 10){
            header("location:../displaymtRubric.php?notif=charNumber");
            exit();
        }else{
            $conn->query("INSERT INTO mtrubric_tbl(rubric_lvl,level_name,rubric_description) VALUES ('$rubric_lvl','$level_name','$rubric_description')") or die($conn->error);
            header("location:../displaymtRubric.php?notif=success");
        }                 

}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM mtrubric_tbl WHERE rubric_id=$id") or die($conn->error);
    $_SESSION['message'] = 'Rubric has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header('location:../displaymtRubric.php');
}

if(isset($_POST['update'])){
    $rubric_id = $_POST['rubric_id'];
    $rubric_lvl = $_POST['rubric_lvl'];
    $level_name = $_POST['level_name'];
    $rubric_description = $_POST['rubric_description'];

    if((ctype_space($rubric_lvl)) || (ctype_space($level_name)) || (ctype_space($rubric_description))){
        header("location:../displaytRubric.php?notif=updatewhitespace");
        exit();
    }elseif((strlen($rubric_lvl)) < 0 || (strlen($level_name)) < 5 || (strlen($rubric_description)) < 10){
        header("location:../displaytRubric.php?notif=updatecharNumber");
        exit();
    }else{

    mysqli_query($conn,"UPDATE mtrubric_tbl SET rubric_lvl = '$rubric_lvl', level_name = '$level_name', rubric_description = '$rubric_description' WHERE rubric_id = '$rubric_id' ");
    header("location:../displaytRubric.php?notif=updatesuccess");

}
}

?>
  