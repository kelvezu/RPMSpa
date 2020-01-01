<?php
session_start();
include 'conn.inc.php';
include '../libraries/func.lib.php';

//DEFINE THE DATABASE


//SAVE DATA FOR SUBJECT 
if (isset($_POST['subjectsave'])) {

    $subject = $_POST['subject'];
    $validate = mysqli_query($conn, "SELECT * FROM subject_tbl WHERE subject_name = '$subject'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($subject)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($subject) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO subject_tbl(subject_name) VALUES('$subject')";
        $query_run = mysqli_query($conn, $query);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR SUBJECT
if (isset($_POST['updateSUB'])) {

    $subject_id = $_POST['subject_id'];
    $subject_name = $_POST['subject_name'];

    if (ctype_space($subject_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($subject_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {

        $qrySJ = mysqli_query($conn, 'UPDATE subject_tbl SET subject_id = ' . $subject_id . ', subject_name = "' . $subject_name . '", `status` = "Active" WHERE subject_id = ' . $subject_id . ' ') or die($conn->error);
        header("location:../ESAT.php?notif=updatesuccess");
    }
}

//REMOVE SUBJECT FROM SELECTION
if (isset($_GET['deleteSJ'])) {
    $subject_id = $_GET['deleteSJ'];
    mysqli_query($conn, "UPDATE  subject_tbl SET `status`='Inactive' WHERE subject_id=$subject_id") or die($conn->error);
    $_SESSION['message'] = 'Subject has been remove!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE SUBJECT
if (isset($_GET['unremovesub'])) {
    $subject_id = $_GET['unremovesub'];
    mysqli_query($conn, "UPDATE  subject_tbl SET `status`='Active' WHERE subject_id=$subject_id") or die($conn->error);
    $_SESSION['message'] = 'Subject successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

if (isset($_GET['subjectstatus'])) :
    mysqli_query($conn, "UPDATE subject_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'Subjects successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;


//SAVE DATA FOR AGE 
if (isset($_POST['agesave'])) {

    $age = $_POST['age'];
    $validate = mysqli_query($conn, "SELECT * FROM age_tbl WHERE age_name = '$age'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($age)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($age) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO age_tbl(age_name) VALUES('$age')";
        $query_run = mysqli_query($conn, $query);
        header('location:../ESAT.php?notif=success');
    }
}
//UPDATE DATA FOR AGE
if (isset($_POST['updateage'])) {
    $age_id = $_POST['age_id'];
    $age_name = $_POST['age_name'];

    if (ctype_space($age_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($age_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {

        mysqli_query($conn, "UPDATE age_tbl SET age_id = '$age_id', age_name = '$age_name' WHERE age_id = '$age_id' ");
        $_SESSION['message'] = 'Age Option has been updated!';
        $_SESSION['msg_type'] = 'green-notif-border';
        header("location:../ESAT.php");
    }
}

//REMOVE AGE
if (isset($_GET['deleteAGE'])) {
    $age_id = $_GET['deleteAGE'];
    mysqli_query($conn, "UPDATE  age_tbl SET `status` = 'Inactive' WHERE age_id= $age_id") or die($conn->error);
    $_SESSION['message'] = 'Age has been removed from the selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE AGE
if (isset($_GET['unremoveage'])) {
    $age_id = $_GET['unremoveage'];
    mysqli_query($conn, "UPDATE  age_tbl SET `status`='Active' WHERE age_id=$age_id") or die($conn->error);
    $_SESSION['message'] = 'Age option successfully unremoved!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

if (isset($_GET['agestatus'])) :
    mysqli_query($conn, "UPDATE age_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'Age successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;


//SAVE DATA FOR GENDER 
if (isset($_POST['gendersave'])) {
    $gender = $_POST['gender'];

    $query = "INSERT INTO gender_tbl(gender_name) VALUES('$gender')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Gender Option Successfully Added!";
        $_SESSION['msg_type'] = "green-notif-border";
        header('location:../ESAT.php');
    } else {
        $_SESSION['message'] = "Data Insertion Failed";
        $_SESSION['msg_type'] = "red-notif-border";
        header('location:../ESAT.php');
    }
}

//UPDATE DATA FOR GENDER
if (isset($_POST['updateGEN'])) {
    $gender_id = $_POST['gender_id'];
    $gender_name = $_POST['gender_name'];

    if (ctype_space($gender_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($gender_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {

        mysqli_query($conn, "UPDATE gender_tbl SET gender_id = '$gender_id', gender_name = '$gender_name' WHERE gender_id = '$gender_id' ");
        $_SESSION['message'] = 'Gender Option has been updated!';
        $_SESSION['msg_type'] = 'green-notif-border';
        header("location:../ESAT.php");
    }
}
//REMOVE GENDER
if (isset($_GET['deleteGD'])) {
    $gender_id = $_GET['deleteGD'];
    mysqli_query($conn, "UPDATE  gender_tbl SET `status` = 'Inactive' WHERE gender_id=$gender_id") or die($conn->error);
    $_SESSION['message'] = 'Gender has been removed from the ESAT selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE GENDER
if (isset($_GET['unremovegen'])) {
    $gender_id = $_GET['unremovegen'];
    mysqli_query($conn, "UPDATE  gender_tbl SET `status`='Active' WHERE gender_id=$gender_id") or die($conn->error);
    $_SESSION['message'] = 'Gender option successfully unremoved!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

//SAVE THE DATA FOR POSITION

if (isset($_POST['positionsave'])) {

    $position = $_POST['position'];
    $validate = mysqli_query($conn, "SELECT * FROM position_tbl WHERE position_name = '$position'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($position)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($position) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {
        $query = "INSERT INTO position_tbl(position_name) VALUES('$position')";
        $query_run = mysqli_query($conn, $query);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR POSITION
if (isset($_POST['updatePOS'])) {
    $position_id = $_POST['position_id'];
    $position_name = $_POST['position_name'];

    if (ctype_space($position_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($position_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {
        mysqli_query($conn, "UPDATE position_tbl SET position_id = '$position_id', position_name = '$position_name' WHERE position_id = '$position_id' ");
        $_SESSION['message'] = 'Position Option has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../ESAT.php");
    }
}

//DELETE POSITION
if (isset($_GET['deletePST'])) {
    $position_id = $_GET['deletePST'];
    mysqli_query($conn, "UPDATE  position_tbl SET `status` = 'Inactive' WHERE position_id=$position_id") or die($conn->error);
    $_SESSION['message'] = 'Position has been removed from the selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//SAVE THE DATA FOR TOTAL NUMBER OF YEARS IN TEACHING  
if (isset($_POST['totalyearsave'])) {

    $totalyear = $_POST['totalyears'];
    $validate = mysqli_query($conn, "SELECT * FROM totalyear_tbl WHERE totalyear_name = '$totalyear'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($totalyear)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($totalyear) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO totalyear_tbl(totalyear_name) VALUES('$totalyear')";
        $query_run = mysqli_query($conn, $query);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR TOTAL YEAR
if (isset($_POST['updateTY'])) {
    $totalyear_id = $_POST['totalyear_id'];
    $totalyear_name = $_POST['totalyear_name'];

    if (ctype_space($totalyear_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($totalyear_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {

        mysqli_query($conn, "UPDATE totalyear_tbl SET totalyear_id = '$totalyear_id', totalyear_name = '$totalyear_name' WHERE totalyear_id = '$totalyear_id' ");
        $_SESSION['message'] = 'Total Year Option has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../ESAT.php");
    }
}
//REMOVE TOTAL YEAR
if (isset($_GET['deleteTY'])) {
    $totalyear_id = $_GET['deleteTY'];
    mysqli_query($conn, "UPDATE  totalyear_tbl SET `status` = 'Inactive'  WHERE totalyear_id=$totalyear_id") or die($conn->error);
    $_SESSION['message'] = 'Total Year option has been removed from the ESAT selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE TOTAL YEAR
if (isset($_GET['unremovetot'])) {
    $totalyear_id = $_GET['unremovetot'];
    mysqli_query($conn, "UPDATE  totalyear_tbl SET `status`='Active' WHERE totalyear_id=$totalyear_id") or die($conn->error);
    $_SESSION['message'] = 'Total Year option added to the selection successfully!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

if (isset($_GET['totalyear'])) :
    mysqli_query($conn, "UPDATE totalyear_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'Total Year Options successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;

//SAVE THE DATA FOR GRADE LEVEL TAUGHT   
if (isset($_POST['gltsave'])) {

    $gradelvltaught = $_POST['glt'];
    $validate = mysqli_query($conn, "SELECT * FROM gradelvltaught_tbl WHERE gradelvltaught_name = '$gradelvltaught'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($gradelvltaught)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($gradelvltaught) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO gradelvltaught_tbl(gradelvltaught_name) VALUES('$gradelvltaught')";
        $query_run = mysqli_query($conn, $query);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR GRADE LEVEL TAUGHT
if (isset($_POST['updateGLT'])) {
    $gradelvltaught_id = $_POST['gradelvltaught_id'];
    $gradelvltaught_name = $_POST['gradelvltaught_name'];

    if (ctype_space($gradelvltaught_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($gradelvltaught_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {
        mysqli_query($conn, "UPDATE gradelvltaught_tbl SET gradelvltaught_id = '$gradelvltaught_id', gradelvltaught_name = '$gradelvltaught_name' WHERE gradelvltaught_id = '$gradelvltaught_id' ");
        $_SESSION['message'] = 'Grade Level Taught Option has been updated!';
        $_SESSION['msg_type'] = 'green-notif-border';
        header("location:../ESAT.php");
    }
}

//REMOVE TOTAL YEAR
if (isset($_GET['deleteGLT'])) {
    $gradelvltaught_id = $_GET['deleteGLT'];
    mysqli_query($conn, "UPDATE  gradelvltaught_tbl SET `status` = 'Inactive' WHERE gradelvltaught_id=$gradelvltaught_id") or die($conn->error);
    $_SESSION['message'] = 'Grade Level Taught has been removed from ESAT selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE TOTAL YEAR
if (isset($_GET['unremoveglt'])) {
    $gradelvltaught_id = $_GET['unremoveglt'];
    mysqli_query($conn, "UPDATE  gradelvltaught_tbl SET `status`='Active' WHERE gradelvltaught_id=$gradelvltaught_id") or die($conn->error);
    $_SESSION['message'] = 'Grade Level Taught option has been added to the selection successfully!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

if (isset($_GET['gradelvl'])) :
    mysqli_query($conn, "UPDATE gradelvltaught_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'Grade Level Taught Options successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;

//SAVE DATA FOR CURRICULAR CLASS

if (isset($_POST['currisave'])) {

    $curri = $_POST['curri'];
    $school_level = $_POST['school_level'];
    $validate = mysqli_query($conn, "SELECT * FROM curriclass_tbl WHERE curriclass_name = '$curri'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($curri)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($curri) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO curriclass_tbl(school_level,curriclass_name) VALUES('$school_level','$curri')";
        $query_run = mysqli_query($conn, $query) or die($conn->error);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR CURRICULAR CLASS
if (isset($_POST['updateCC'])) {
    $curriclass_id = $_POST['curriclass_id'];
    $curriclass_name = $_POST['curriclass_name'];

    if (ctype_space($curriclass_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($curriclass_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {
        mysqli_query($conn, "UPDATE curriclass_tbl SET curriclass_id = '$curriclass_id', curriclass_name = '$curriclass_name' WHERE curriclass_id = '$curriclass_id' ");
        $_SESSION['message'] = 'Curricular Classification Option has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../ESAT.php");
    }
}
//DELETE CURRICULAR CLASSIFICATION 
if (isset($_GET['deleteCURRI'])) {
    $curriclass_id = $_GET['deleteCURRI'];
    mysqli_query($conn, "UPDATE  curriclass_tbl SET `status` = 'Inactive' WHERE curriclass_id=$curriclass_id") or die($conn->error);
    $_SESSION['message'] = 'Curricular Classification has been removed from the selection!';
    $_SESSION['msg_type'] = 'red-notif-border';
    header("location:../ESAT.php");
}

//UNREMOVE CURRICULAR CLASSIFICATION 
if (isset($_GET['unremovecurr'])) {
    $curriclass_id = $_GET['unremovecurr'];
    mysqli_query($conn, "UPDATE  curriclass_tbl SET `status`='Active' WHERE curriclass_id=$curriclass_id") or die($conn->error);
    $_SESSION['message'] = 'Curricular Classification option has been added to the selection successfully!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");
}

if (isset($_GET['curriclass'])) :
    mysqli_query($conn, "UPDATE curriclass_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'Curricular Classification Options successfully unremoved!!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;

//SAVE DATA FOR REGION

if (isset($_POST['regionsave'])) {

    $region = $_POST['region'];

    $validate = mysqli_query($conn, "SELECT * FROM region_tbl WHERE region_name = '$region'") or die($conn->error);
    $count_result = mysqli_num_rows($validate);

    if ($count_result > 0) {
        header("location:../ESAT.php?notif=taken");
        exit();
    } elseif (ctype_space($region)) {
        header("location:../ESAT.php?notif=whitespace");
        exit();
    } elseif (strlen($region) < 2) {
        header("location:../ESAT.php?notif=charNumber");
        exit();
    } else {


        $query = "INSERT INTO region_tbl(region_name) VALUES('$region')";
        $query_run = mysqli_query($conn, $query) or die($conn->error);
        header('location:../ESAT.php?notif=success');
    }
}

//UPDATE DATA FOR REGION
if (isset($_POST['updateREG'])) {
    $reg_id = $_POST['reg_id'];
    $region_name = $_POST['region_name'];

    if (ctype_space($region_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($region_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {
        mysqli_query($conn, "UPDATE region_tbl SET reg_id = '$reg_id', region_name = '$region_name' WHERE reg_id = '$reg_id' ");
        $_SESSION['message'] = 'Region Option has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../ESAT.php");
    }
}
//DELETE Region 
if (isset($_GET['deleteREG'])) {
    $reg_id = $_GET['deleteREG'];
    mysqli_query($conn, "DELETE FROM region_tbl WHERE reg_id=$reg_id") or die($conn->error);
    $_SESSION['message'] = 'Region   has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../ESAT.php");
}

//SAVE DATA FOR DIVISION

if (isset($_POST['divisionsave'])) {
    $reg_id = $_POST['regionname'];
    $division = $_POST['division'];

    $query = "INSERT INTO division_tbl(reg_id,divi_name) VALUES('$reg_id','$division')";
    $query_run = mysqli_query($conn, $query) or die($conn->error);
    header('location:../ESAT.php?notif=success');
}


//UPDATE DATA FOR DIVISION  
if (isset($_POST['updateDIV'])) {
    $div_id = $_POST['div_id'];
    $divi_name = $_POST['divi_name'];
    $reg_id = $_POST['reg_name'];
    mysqli_query($conn, "UPDATE division_tbl SET div_id = '$div_id', divi_name = '$divi_name', reg_id = '$reg_id' WHERE div_id = '$div_id' ");
    $_SESSION['message'] = 'Division Option has been updated!';
    $_SESSION['msg_type'] = 'success';
    header("location:../ESAT.php");
}

//DELETE DIVISION  
if (isset($_GET['deleteDIV'])) {
    $div_id = $_GET['deleteDIV'];
    mysqli_query($conn, "DELETE FROM division_tbl WHERE div_id=$div_id") or die($conn->error);
    $_SESSION['message'] = 'Division    has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../ESAT.php");
}

//SAVE DATA FOR MUNICIPALITY 
if (isset($_POST['munisave'])) {
    $div_id = $_POST['divname'];
    $muni = $_POST['municipality'];

    $query = "INSERT INTO municipality_tbl(muni_name,div_id) VALUES('$muni','$div_id')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "Data Successfully Inserted!";
        $_SESSION['msg_type'] = "success";
        header('location:../ESAT.php');
    } else {
        $_SESSION['message'] = "Data Insertion Failed";
        $_SESSION['msg_type'] = "danger";
        header('location:../ESAT.php');
    }
}

//UPDATE DATA FOR MUNICIPALITY   
if (isset($_POST['updateMUNI'])) {
    $muni_id = $_POST['muni_id'];
    $muni_name = $_POST['muni_name'];
    $div_id = $_POST['diviname'];

    if (ctype_space($muni_name)) {
        header("location:../ESAT.php?notif=updatewhitespace");
        exit();
    } elseif (strlen($muni_name) < 2) {
        header("location:../ESAT.php?notif=updatecharNumber");
        exit();
    } else {

        mysqli_query($conn, "UPDATE municipality_tbl SET muni_id = '$muni_id', muni_name = '$muni_name', div_id = '$div_id' WHERE muni_id = '$muni_id' ");
        $_SESSION['message'] = 'Municipality Option has been updated!';
        $_SESSION['msg_type'] = 'success';
        header("location:../ESAT.php");
    }
}
//DELETE MUNICIPALITY   
if (isset($_GET['deleteMUNI'])) {
    $muni_id = $_GET['deleteMUNI'];
    mysqli_query($conn, "DELETE FROM municipality_tbl WHERE muni_id=$muni_id") or die($conn->error);
    $_SESSION['message'] = 'Municipality has been deleted!';
    $_SESSION['msg_type'] = 'danger';
    header("location:../ESAT.php");
}

if (isset($_GET['allstatus'])) :
    mysqli_query($conn, "UPDATE subject_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE age_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE totalyear_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE gradelvltaught_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE curriclass_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE region_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE division_tbl SET `status` = 'Active'") or die($conn->error);
    mysqli_query($conn, "UPDATE municipality_tbl SET `status` = 'Active'") or die($conn->error);
    $_SESSION['message'] = 'All status has been set to Active!';
    $_SESSION['msg_type'] = 'green-notif-border';
    header("location:../ESAT.php");

endif;
