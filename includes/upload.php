<?php
include '../libraries/func.lib.php';
include 'conn.inc.php';


if (isset($_POST['submit'])) :

    pre_r($_POST);

    $file = $_FILES['file'];

    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'pptx', 'docx', 'xlsx', 'csv');

    $user_id = $_POST['user_id'];
    $position = $_POST['position'];
    $rater_id = $_POST['rater_id'];
    $school_id = $_POST['school_id'];
    $sy_id = $_POST['sy_id'];
    $obj_id = $_POST['obj'];
    $description = $_POST['description'];
    $mov_type = $_POST['mov_type'];
    $date_attached = dateNow();


    if (in_array($fileActualExt, $allowed)) :
        if ($fileError === 0) :
            if ($fileSize < 100000000) :
                $filenameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../attachments/Teacher/' . $filenameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $filepath = "localhost/rpms/attachments/Teacher/" . $filenameNew;

                $mov_qry = "INSERT INTO `mov_a_t_attach_tbl` (`file_name`,`attachment`,`file_type`, `mov_type`, `user_id`, `position`, `rater_id`, `school_id`, `sy_id`,`file_desc`) VALUES ('" . $filename . "','" . $filenameNew . "','" . $fileActualExt . "','$mov_type','$user_id','$position','$rater_id','$school_id','$sy_id','$description')";
                $mov_results = mysqli_query($conn, $mov_qry) or die($conn->error . $mov_qry);

                if ($mov_results) {
                    $last_id = mysqli_insert_id($conn);

                    if ($mov_type == "main_mov") :
                        for ($count = 0; $count < count($obj_id); $count++) :
                            $qry = "INSERT INTO `mov_main_t_attach_tbl`(`mov_id`, `file_type`, `mov_type`, `kra_id`, `obj_id`, `user_id`, `position`, `rater_id`, `school_id`, `sy_id`,`date_attached`)
                             VALUES ('$last_id','$fileActualExt','$mov_type'," . displayKRAidofTobj($conn, $obj_id[$count]) . ",'$obj_id[$count]','$user_id','$position','$rater_id','$school_id','$sy_id','$date_attached')";
                            $mov_attach_qry = mysqli_query($conn, $qry) or die($conn->error);
                        endfor;
                    elseif ($mov_type == "supp_mov") :
                        for ($count = 0; $count < count($obj_id); $count++) :
                            $qry = "INSERT INTO `mov_supp_t_attach_tbl`(`mov_id`, `file_type`, `mov_type`, `kra_id`, `obj_id`, `user_id`, `position`, `rater_id`, `school_id`, `sy_id`,`date_attached`) VALUES ('$last_id','$fileActualExt','$mov_type'," . displayKRAidofTobj($conn, $obj_id[$count]) . ",'$obj_id[$count]','$user_id','$position','$rater_id','$school_id','$sy_id','$date_attached')";
                            $mov_attach_qry = mysqli_query($conn, $qry) or die($conn->error);
                        endfor;
                    else : die('Error');
                    endif;
                }

                header("Location:../attachfile.php?=success");
            else :
                echo "Your file is too big!";
            endif;
        else :
            echo "There was an error uploading your file!";
        endif;
    else :
        echo "You cannot upload file of this type!";
    endif;

endif;
