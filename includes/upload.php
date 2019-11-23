<?php
include '../libraries/func.lib.php';
include 'conn.inc.php';


if(isset($_POST['submit'])):
    
    $file = $_FILES['file'];

    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    $fileExt = explode('.',$filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf','pptx','docx','xlsx','csv');

    $user_id = $_POST['user_id'];
    $position = $_POST['position'];
    $rater_id = $_POST['rater_id'];
    $school_id = $_POST['school_id'];
    $sy_id = $_POST['sy_id'];
    $obj_id = $_POST['obj'];
    $description = $_POST['description'];
    $mov_type = $_POST['mov_type'];
    
    
    if (in_array($fileActualExt, $allowed)):
        if($fileError === 0):
            if($fileSize < 100000):
                $filenameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../attachments/Teacher' . $filenameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    $filepath = "localhost/rpmspa/attachments/Teacher" . $filenameNew;

                    $mov_qry = "INSERT INTO `mov_a_t_attach_tbl` (`attachment`,`file_type`, `mov_type`, `user_id`, `position`, `rater_id`, `school_id`, `sy_id`) VALUES ('".$filepath."','".$fileActualExt."','".$mov_type."',$user_id,'".$position."',$rater_id,$school_id,$sy_id)";
                    $mov_results = mysqli_query($conn,$mov_qry) OR die($conn->error);

                    if($mov_results){
                        $last_id = mysqli_insert_id($conn);

                        for($count = 0; $count < count($obj_id); $count++){
                            $qry = "INSERT INTO `mov_b_t_attach_tbl`(`mov_id`, `file_type`, `mov_type`, `kra_id`, `obj_id`, `user_id`, `position`, `rater_id`, `school_id`, `sy_id`) VALUES ('$last_id','".$fileActualExt."','$mov_type',".displayKRAidofTobj($conn,$obj_id[$count]).",'$obj_id[$count]','$user_id','$position','$rater_id','$school_id','$sy_id')";
                            $mov_attach_qry = mysqli_query($conn,$qry) OR die($conn->error);
                        }
                    }
                   
                header("Location:../attachfile.php?=success");
            else:
                echo "Your file is too big!";
            endif;
        else:
            echo "There was an error uploading your file!";
        endif;
    else:
        echo "You cannot upload file of this type!";
    endif;

endif;


?>